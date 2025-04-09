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
                //             ->whereBetween("termek_tul_$key.tul_ertek", array($value, $max));
                // }
            }
        }

    //dd($query->toSql(), $query->getBindings());

    $products = $query->get();

        return view('products.filtered', compact('gyartok', 'products', 'selectedCategory', 'request', 'tulajdonsagok', 'tulajdonsagok_ertek', 'tul_ertek_min', 'tul_ertek_max'));
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
            'nevek' => termek::select('*')
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

    public function Order(){
        $total = 0;
        if(!session('cart') == null){
            $order = session()->get('cart');
            foreach($order as $row){
                $total = $total + $row['ar']*$row['db'];
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
        $cart = session()->get('cart');
        if(isset($cart[$termek->cikkszam])){
            $cart[$termek->cikkszam]['db'] = $cart[$termek->cikkszam]['db']+1;
        } else {
            $cart[$termek->cikkszam] = [
                'cikkszam' => $termek->cikkszam,
                'nev'       => $termek->termek_nev,
                'netto'        => $termek->netto,
                'afa'        => $termek->afa,
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
