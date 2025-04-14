<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\webshop;
use App\Models\termek;
use App\Models\User;
use App\Models\kategoria;
use App\Models\billing;
use App\Models\guest;
use App\Models\gyarto;
use App\Models\image;
use App\Models\loyalty;
use App\Models\ranks;
use App\Models\rendeles_tetel;
use App\Models\rendeles_torzs;
use App\Models\review;
use App\Models\tulajdonsag;
use App\Models\termek_tul;
use App\Models\kat_tul;
use App\Models\filter_options;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class WebshopController extends Controller
{
    public function autocomplete(Request $req)
    {
        return termek::query()
                    ->where("termek_nev", "LIKE", "%{$req->search}%")
                    ->take(5)
                    ->get();
    }

    public function filterByCategory($category, Request $request)
    {
        $selectedCategory = kategoria::find($category);

        $gyartok = gyarto::select('gyarto.*')
                        ->distinct()
                        ->join('termek', 'termek.gyarto_id', 'gyarto.gyarto_id')
                        ->where('termek.kat_id', $category)
                        ->get();

        $tulajdonsagok = tulajdonsag::select('tulajdonsag.tul_nev', 'tulajdonsag.tul_nev_id', 'kat_tul.kat_tul_id', 'filter_options.mode')
                        ->distinct()
                        ->join('kat_tul', 'kat_tul.tul_nev_id', 'tulajdonsag.tul_nev_id')
                        ->join('filter_options', 'filter_options.tul_nev_id', 'tulajdonsag.tul_nev_id')
                        ->where('kat_tul.kat_id', $category)
                        ->whereNotNull('filter_options.mode')
                        ->get();

        $tul_ertek_min = termek_tul::selectRaw("MIN(CAST(termek_tul.tul_ertek AS DECIMAL)) as min_value, kat_tul.tul_nev_id")
                                    ->join('kat_tul', 'kat_tul.kat_tul_id', 'termek_tul.kat_tul_id')
                                    ->join('tulajdonsag', 'kat_tul.tul_nev_id', 'tulajdonsag.tul_nev_id')
                                    ->join('filter_options', 'filter_options.tul_nev_id', 'tulajdonsag.tul_nev_id')
                                    ->where('filter_options.mode', 'range')
                                    ->whereNotNull('filter_options.mode')
                                    ->groupBy('kat_tul.tul_nev_id')
                                    ->get()
                                    ->pluck('min_value', 'tul_nev_id')
                                    ->toArray();

        $tul_ertek_max = termek_tul::selectRaw("MAX(CAST(termek_tul.tul_ertek AS DECIMAL)) as max_value, kat_tul.tul_nev_id")
                                    ->join('kat_tul', 'kat_tul.kat_tul_id', 'termek_tul.kat_tul_id')
                                    ->join('tulajdonsag', 'kat_tul.tul_nev_id', 'tulajdonsag.tul_nev_id')
                                    ->join('filter_options', 'filter_options.tul_nev_id', 'tulajdonsag.tul_nev_id')
                                    ->where('filter_options.mode', 'range')
                                    ->whereNotNull('filter_options.mode')
                                    ->groupBy('kat_tul.tul_nev_id')
                                    ->get()
                                    ->pluck('max_value', 'tul_nev_id')
                                    ->toArray();

        $tulajdonsagok_ertek = termek_tul::select('termek_tul.tul_ertek', 'kat_tul.kat_tul_id')
                                        ->distinct()
                                        ->join('kat_tul', 'kat_tul.kat_tul_id', 'termek_tul.kat_tul_id')
                                        ->join('tulajdonsag', 'tulajdonsag.tul_nev_id', 'kat_tul.tul_nev_id')
                                        ->where('kat_tul.kat_id', $category)
                                        ->get();

        $query = termek::query()
                        ->join('image', 'image.cikkszam', '=', 'termek.cikkszam');

        if(isset($request->gyarto)){
            $query->where('termek.gyarto_id', $request->gyarto);
        }

        $products = $query->where('termek.kat_id', $category)
                        ->get();

        return view('products.filtered', compact('gyartok', 'products', 'selectedCategory', 'request', 'tulajdonsagok', 'tulajdonsagok_ertek', 'tul_ertek_min', 'tul_ertek_max'));
    }

    public function filter(Request $request)
    {
        $category = $request->category;
        $selectedCategory = kategoria::find($category);

        $gyartok = gyarto::select('gyarto.*')
                        ->distinct()
                        ->join('termek', 'termek.gyarto_id', 'gyarto.gyarto_id')
                        ->where('termek.kat_id', $category)
                        ->get();

        $tulajdonsagok = tulajdonsag::select('tulajdonsag.tul_nev', 'tulajdonsag.tul_nev_id', 'kat_tul.kat_tul_id', 'filter_options.mode')
                        ->distinct()
                        ->join('kat_tul', 'kat_tul.tul_nev_id', 'tulajdonsag.tul_nev_id')
                        ->join('filter_options', 'filter_options.tul_nev_id', 'tulajdonsag.tul_nev_id')
                        ->where('kat_tul.kat_id', $category)
                        ->whereNotNull('filter_options.mode')
                        ->get();

        $tul_ertek_min = termek_tul::selectRaw("MIN(CAST(termek_tul.tul_ertek AS DECIMAL)) as min_value, kat_tul.tul_nev_id")
                                    ->join('kat_tul', 'kat_tul.kat_tul_id', 'termek_tul.kat_tul_id')
                                    ->join('tulajdonsag', 'kat_tul.tul_nev_id', 'tulajdonsag.tul_nev_id')
                                    ->join('filter_options', 'filter_options.tul_nev_id', 'tulajdonsag.tul_nev_id')
                                    ->where('filter_options.mode', 'range')
                                    ->whereNotNull('filter_options.mode')
                                    ->groupBy('kat_tul.tul_nev_id')
                                    ->get()
                                    ->pluck('min_value', 'tul_nev_id')
                                    ->toArray();

        $tul_ertek_max = termek_tul::selectRaw("MAX(CAST(termek_tul.tul_ertek AS DECIMAL)) as max_value, kat_tul.tul_nev_id")
                                    ->join('kat_tul', 'kat_tul.kat_tul_id', 'termek_tul.kat_tul_id')
                                    ->join('tulajdonsag', 'kat_tul.tul_nev_id', 'tulajdonsag.tul_nev_id')
                                    ->join('filter_options', 'filter_options.tul_nev_id', 'tulajdonsag.tul_nev_id')
                                    ->where('filter_options.mode', 'range')
                                    ->whereNotNull('filter_options.mode')
                                    ->groupBy('kat_tul.tul_nev_id')
                                    ->get()
                                    ->pluck('max_value', 'tul_nev_id')
                                    ->toArray();

        $min_ar = termek::selectRaw('MIN(termek.netto * termek.afa) AS min_ar')
                        ->where('termek.kat_id', $category)
                        ->get();

        $max_ar = termek::selectRaw('MAX(termek.netto * termek.afa) AS max_ar')
                        ->where('termek.kat_id', $category)
                        ->get();

        $tulajdonsagok_ertek = termek_tul::select('termek_tul.tul_ertek', 'kat_tul.kat_tul_id')
                        ->distinct()
                        ->join('kat_tul', 'kat_tul.kat_tul_id', 'termek_tul.kat_tul_id')
                        ->join('tulajdonsag', 'tulajdonsag.tul_nev_id', 'kat_tul.tul_nev_id')
                        ->where('kat_tul.kat_id', $category)
                        ->get();

        $query = termek::query()
                        ->select('termek.*', 'image.url')
                        ->join('image', 'image.cikkszam', '=', 'termek.cikkszam')
                        ->join('kategoria', 'termek.kat_id', '=', 'kategoria.kat_id')
                        ->where('termek.kat_id', $category)
                        ->groupBy('termek.cikkszam');

        if (isset($request->gyarto) && !empty($request->gyarto)) {
            $query->where('termek.gyarto_id', $request->gyarto);
        }

        if (isset($request->min_price) && !empty($request->min_price)) {
            $query->where('termek.netto', '>=', $request->min_price);
        }

        if (isset($request->max_price) && !empty($request->max_price)) {
            $query->where('termek.netto', '<=', $request->max_price);
        }

        if (!empty($request->query)) {
            foreach ($request->query as $key => $value) {
                if (in_array($key, ['category', 'gyarto', 'min_price', 'max_price']) || $value == null) {
                    continue;
                }

                if (str_starts_with($key, 'tulajdonsag_')) {
                    $query->join("kat_tul AS kat_tul_$key", 'kategoria.kat_id', '=', "kat_tul_$key.kat_id")
                            ->join("tulajdonsag AS tul_$key", "tul_$key.tul_nev_id", '=', "kat_tul_$key.tul_nev_id")
                            ->join("termek_tul AS termek_tul_$key", function($join) use ($key) {
                                $join->on("termek_tul_$key.kat_tul_id", '=', "kat_tul_$key.kat_tul_id")
                                        ->on("termek_tul_$key.cikkszam", '=', 'termek.cikkszam');
                            })
                            ->where("termek_tul_$key.tul_ertek", '=', $value);
                }

                // else if (str_starts_with($key, 'min_')) {
                //     $baseKey = preg_replace('/^(min_)/', '', $key);
                //     $max = request()->get("max_$baseKey");
                //     $query->join("kat_tul AS kat_tul_$key", 'kategoria.kat_id', '=', "kat_tul_$key.kat_id")
                //             ->join("tulajdonsag AS tul_$key", "tul_$key.tul_nev_id", '=', "kat_tul_$key.tul_nev_id")
                //             ->join("termek_tul AS termek_tul_$key", function($join) use ($key) {
                //                 $join->on("termek_tul_$key.kat_tul_id", '=', "kat_tul_$key.kat_tul_id")
                //                         ->on("termek_tul_$key.cikkszam", '=', 'termek.cikkszam');
                //             })
                //             ->where("kat_tuL_$key.kat_id", $category)
                //             ->whereBetween("termek_tul_$key.tul_ertek", array($value, $max));
                // }
            }
        }

    //dd($query->toSql(), $query->getBindings());

    $products = $query->get();

        return view('products.filtered', compact('gyartok', 'products', 'selectedCategory', 'request', 'tulajdonsagok', 'tulajdonsagok_ertek', 'tul_ertek_min', 'tul_ertek_max', 'min_ar', 'max_ar'));
    }

    public function adatlap($cikkszam)
    {
        $termek = termek::where('cikkszam', $cikkszam)->first();
        $images = image::where('cikkszam', $cikkszam)->get();
        $reviews = review::where('cikkszam', $cikkszam)->get();
        $tulajdonsagok = tulajdonsag::where('termek_tul.cikkszam', $cikkszam)
                            ->join('kat_tul', 'kat_tul.tul_nev_id', 'tulajdonsag.tul_nev_id')
                            ->join('termek_tul', 'kat_tul.kat_tul_id', 'termek_tul.kat_tul_id')
                            ->get();

        return view('products.adatlap', [
            'termek' => $termek,
            'images' => $images,
            'reviews' => $reviews,
            'tulajdonsagok' => $tulajdonsagok
        ]);
    }
    public function addReview(Request $req, $cikkszam)
    {
        $req->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255'
        ]);

        $termek = termek::where('cikkszam', $cikkszam)->first();

        $review = new review();
        $review->cikkszam = $termek->cikkszam;
        $review->user_id = Auth::id();
        $review->rating = $req->rating;
        $review->comment = $req->comment;
        $review->save();

        return redirect()->back()->with('success', 'Review added successfully!');
    }

    public function showReviews($cikkszam)
    {
        $termek = termek::where('cikkszam', $cikkszam)->first();
        $reviews = review::where('cikkszam', $termek->id)->get();

        return view('products.showReviews', [
            'termek' => $termek,
            'reviews' => $reviews
        ]);
    }

    public function index()
    {
        $termekek = termek::all();
        return view('products.index', compact('termekek'));
    }

    public function profil(){
        return view('profil',[
            'result'    => rendeles_torzs::select('rendeles_torzs.rendt_id', 'rendeles_tetel.cikkszam', 'rendeles_tetel.menny', 'rendeles_tetel.netto', 'rendeles_tetel.afa', 'termek.termek_nev')
                                        ->join('rendeles_tetel', 'rendeles_torzs.rendt_id', 'rendeles_tetel.rendt_id')
                                        ->join('termek', 'rendeles_tetel.cikkszam', 'termek.cikkszam')
                                        ->where('rendeles_torzs.user_id', Auth::user()->user_id)
                                        ->get(),
            'azon'      => rendeles_torzs::select('rendt_id')
                                        ->where('user_id', Auth::user()->user_id)
                                        ->get()
        ]);
    }

    public function Cart(){
        $total = 0;
        if(!session('cart') == null){
            foreach(session('cart') as $row){
                $total = $total + $row['netto']*$row['afa']*$row['db'];
            }
        }
        return view('cart', [
            'total'     => $total
        ]);
    }

    public function CartData(Request $req){
        $cart = session()->get('cart');

        if($req->has('minus')){
            if($cart[$req->minus]['db']>1){
                $cart[$req->minus]['db'] = $cart[$req->minus]['db']-1;
            } else {
                unset($cart[$req->minus]);
            }
        }

        if($req->has('plus')){
            $cart[$req->plus]['db'] = $cart[$req->plus]['db']+1;
        }

        if($req->has('delete')){
            unset($cart[$req->delete]);
        }

        session()->put('cart',$cart);
        return redirect('/cart');
    }

    public function Delivery()
    {
        return view('delivery', [
        ]);
    }

    public function DeliveryData(Request $req)
    {
        if (Auth::check())
        {
            $req->validate([
                'user_telefon'      => 'required',
                'user_irszam'       => 'required|max:4|min:4',
                'user_varos'        => 'required',
                'user_uha'          => 'required',
            ],[
                'user_telefon.required'     => 'Adja meg a telefonszámát!',
                'user_irszam.required'      => 'Adja meg az irányítószámot!',
                'user_irszam.max'           => 'Az irányítószámnak 4 jegyűnek kell lennie!',
                'user_irszanmin'            => 'Az irányítószámnak 4 jegyűnek kell lennie!',
                'user_varos'                => 'Adja meg a várost!',
                'user_uha'                  => 'Adja meg az utcát és a házszámot!'
            ]);

            $data           = User::find(Auth::user()->user_id);
            $data->telefon  = $req->user_telefon;
            $data->irszam   = $req->user_irszam;
            $data->varos    = $req->user_varos;
            $data->uha      = $req->user_uha;
            $data->megj     = $req->user_megj;
            $data->Save();
        }
        else
        {
            $req->validate([
                'guest_nev'         => 'required',
                'guest_email'       => 'required|email|unique:guest,email',
                'guest_telefon'      => 'required',
                'guest_irszam'       => 'required|max:4|min:4',
                'guest_varos'        => 'required',
                'guest_uha'          => 'required',
            ],[
                'guest_nev.required'        => 'Adja meg a nevét!',
                'guest_email.required'      => 'Adja meg az email címét!',
                'guest_email.unique'        => 'Ez az email már létezik!',
                'guest_telefon.required'     => 'Adja meg a telefonszámát!',
                'guest_irszam.required'      => 'Adja meg az irányítószámot!',
                'guest_irszam.max'           => 'Az irányítószámnak 4 jegyűnek kell lennie!',
                'guest_irszanmin'            => 'Az irányítószámnak 4 jegyűnek kell lennie!',
                'guest_varos'                => 'Adja meg a várost!',
                'guest_uha'                  => 'Adja meg az utcát és a házszámot!'
            ]);

            $data           = new guest;
            $data->nev      = $req->guest_nev;
            $data->email    = $req->guest_email;
            $data->telefon  = $req->guest_telefon;
            $data->irszam   = $req->guest_irszam;
            $data->varos    = $req->guest_varos;
            $data->uha      = $req->guest_uha;
            $data->megj     = $req->guest_megj;
            $data->Save();
        }
        return redirect('/order')->withErrors(['sv' => 'Sikeres rendelés leadás!']);
    }

    public function Order(){
        $total = 0;
        if(!session('cart') == null){
            $order = session()->get('cart');
            foreach($order as $row){
                $total = $total + $row['netto']*$row['afa']*$row['db'];
            }
        }
        $billingData = new billing;
        $billingData->billingdate = date('Y-m-d H:i:s');
        $billingData->paymentstatus = "kifizetendő";
        $billingData->deliverystatus = "kiszállítandó";
        $billingData->Save();

        if (Auth::check())
        {
            $torzsData = new rendeles_torzs;
            $torzsData->user_id = Auth::user()->user_id;
            $torzsData->billing_id = billing::max('billing_id');
            $torzsData->ossz = $total;
            $torzsData->paymentmethod = "utánvétel";
            $torzsData->Save();

            foreach ($order as $row)
            {
                $tetelData = new rendeles_tetel;
                $tetelData->rendt_id = rendeles_torzs::max('rendt_id');
                $tetelData->cikkszam = $row['cikkszam'];
                $tetelData->menny = $row['db'];
                $tetelData->netto = $row['netto'];
                $tetelData->Save();
            }
        }
        else
        {
            $torzsData = new rendeles_torzs;
            $torzsData->guest_id = guest::max('guest_id');
            $torzsData->billing_id = billing::max('billing_id');
            $torzsData->ossz = $total;
            $torzsData->paymentmethod = "utánvétel";
            $torzsData->Save();

            foreach ($order as $row)
            {
                $tetelData = new rendeles_tetel;
                $tetelData->rendt_id = rendeles_torzs::max('rendt_id');
                $tetelData->cikkszam = $row['cikkszam'];
                $tetelData->menny = $row['db'];
                $tetelData->netto = $row['netto'];
                $tetelData->Save();
            }
        }

        session()->flush('cart');
        ## $order adatbázisba írása
        if($total == 0){
            return redirect('/');
        } else {
            return view('order', [
                'order' => $order,
                'total' => $total
            ]);
        }
    }
    public function Add(Request $req){
        ##dd($req);
        $termek  = termek::find($req->cikkszam);
        $image = image::select('image.url')
                        ->where('image.cikkszam', $req->cikkszam)
                        ->first();
        $cart = session()->get('cart');
        if(isset($cart[$termek->cikkszam])){
            $cart[$termek->cikkszam]['db'] = $cart[$termek->cikkszam]['db']+1;
        } else {
            $cart[$termek->cikkszam] = [
                'cikkszam' => $termek->cikkszam,
                'nev'       => $termek->termek_nev,
                'netto'        => $termek->netto,
                'afa'        => $termek->afa,
                'url'       => $image->url,
                'db'        => 1
            ];
        }

        session()->put('cart',$cart);
        ##dd($cart);
        return view('add', [
            'cikkszam'   => $req->cikkszam
        ]);
    }

    public function Welcome()
    {
        return view('welcome', [
            'result' => kategoria::all()
        ]);
    }
}
