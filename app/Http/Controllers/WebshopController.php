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

        $tulajdonsagok = tulajdonsag::select('tulajdonsag.tul_nev')
                        ->distinct()
                        ->join('termek', 'termek.cikkszam', 'tulajdonsag.cikkszam')
                        ->where('termek.kat_id', $category)
                        ->get();

        $tulajdonsagok_ertek = tulajdonsag::select('tulajdonsag.tulajdonsag', 'tulajdonsag.tul_nev_id')
                                ->join('termek', 'termek.cikkszam', 'tulajdonsag.cikkszam')
                                ->where('termek.kat_id', $category)
                                ->get();

        $query = termek::query()
                        ->join('image', 'image.cikkszam', '=', 'termek.cikkszam');

        if(isset($request->gyarto)){
            $query->where('termek.gyarto_id', $request->gyarto);
        }

        $products = $query->where('termek.kat_id', $category)
                        ->get();

        return view('products.filtered', compact('gyartok', 'products', 'selectedCategory', 'request', 'tulajdonsagok', 'tulajdonsagok_ertek'));
    }

    public function filter(Request $request)
    {
        // Get the category from the request
        $category = $request->category;
        $selectedCategory = kategoria::find($category);

        // Get manufacturers for the selected category
        $gyartok = gyarto::select('gyarto.*')
                        ->distinct()
                        ->join('termek', 'termek.gyarto_id', 'gyarto.gyarto_id')
                        ->where('termek.kat_id', $category)
                        ->get();

        $tulajdonsagok = tulajdonsag::select('tulajdonsag.tul_nev')
                        ->distinct()
                        ->join('termek', 'termek.cikkszam', 'tulajdonsag.cikkszam')
                        ->where('termek.kat_id', $category)
                        ->get();

        $tulajdonsagok_ertek = tulajdonsag::select('tulajdonsag.tulajdonsag', 'tulajdonsag.tul_nev_id')
                                ->join('termek', 'termek.cikkszam', 'tulajdonsag.cikkszam')
                                ->where('termek.kat_id', $category)
                                ->get();

        // Start building the product query
        $query = termek::query()
                        ->join('image', 'image.cikkszam', '=', 'termek.cikkszam')
                        ->where('termek.kat_id', $category);

        // Filter by manufacturer if selected
        if(isset($request->gyarto) && $request->gyarto != ''){
            $query->where('termek.gyarto_id', $request->gyarto);
        }

        // Filter by price range if set
        if(isset($request->min_price) && $request->min_price != ''){
            $query->where('termek.netto', '>=', $request->min_price);
        }

        if(isset($request->max_price) && $request->max_price != ''){
            $query->where('termek.netto', '<=', $request->max_price);
        }

        $products = $query->get();

        return view('products.filtered', compact('gyartok', 'products', 'selectedCategory', 'request', 'tulajdonsagok', 'tulajdonsagok_ertek'));
    }

    public function adatlap($cikkszam)
    {
        $termek = termek::where('cikkszam', $cikkszam)->first();
        $images = image::where('cikkszam', $cikkszam)->get();
        $reviews = review::where('cikkszam', $cikkszam)->get();

        return view('products.adatlap', [
            'termek' => $termek,
            'images' => $images,
            'reviews' => $reviews
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
        $reviews = review::where('termek_id', $termek->id)->get();

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

    public function termekadddata(Request $req){
        $req->validate([
            'tnev' => 'required',
            'tar' => 'required',
            'tkedv' => 'required',
            'tcikk' => 'required|unique:termek,cikkszam',
            'tkep' => 'required',
            'tmenny' => 'required',
            'tdesc' => 'required',
            'tgar' => 'required',
            'tkat' => 'required',
            'tgyarto' => 'required'
        ],[
            'tnev.required' => "kötelező megadni!",
            'tar.required' => "kötelező megadni!",
            'tkedv.required' => "kötelező megadni!",
            'tcikk.required' => "kötelező megadni!",
            'tcikk.unique' => "Ez a cikkszám már foglalt",
            'tkep.required' => "kötelező megadni!",
            'tmenny.required' => "kötelező megadni!",
            'tdesc.required' => "kötelező megadni!",
            'tgar.required' => "Kötelező megadni!",
            'tkat.required' => "Kötelező megadni!",
            'tgyarto.required' => "Kötelező megadni!",
        ]);


        $data = new termek;
        $data->nev = $req->tnev;
        $data->netto = $req->tar;
        $data->kedv = $req->tkedv;
        $data->cikkszam = $req->tcikk;
        $data->img_id = $req->tkep;
        $data->keszlet = $req->tmenny;
        $data->leiras = $req->tdesc;
        $data->garancia = $req->tgar;
        $data->kat_id = $req->tkat;
        $data->gyarto_id = $req->tgyarto;
        $data->Save();

        return redirect("/profil");
    }

    public function mind(){
        return view('mind',[
            'result' => termek::select('*')
                    ->get()
                ]);
            }

            public function profil(){
                return view('profil',[
                    'nevek' => termek::select('*')
                    ->get()
                ]);
            }

            public function tmod($cikkszam){
                return view('tmod',[
                    'adatok' => termek::select('*')
                    ->where('cikkszam', $cikkszam)
                    ->get()
                ]);
            }

            public function tmoddata(Request $req, $cikkszam){
                $req->validate([
                    'tnev' => 'required',
                    'tar' => 'required',
                    'tkedv' => 'required',
                    'tcikk' => 'required|unique:termek,cikkszam',
                    'tkep' => 'required',
                    'tmenny' => 'required',
                    'tdesc' => 'required',
                    'tgar' => 'required',
                    'tkat' => 'required',
                    'tgyarto' => 'required'
                ],[
                    'tnev.required' => "kötelező megadni!",
                    'tar.required' => "kötelező megadni!",
                    'tkedv.required' => "kötelező megadni!",
                    'tcikk.required' => "kötelező megadni!",
                    'tcikk.unique' => "Ez a cikkszám már foglalt",
                    'tkep.required' => "kötelező megadni!",
                    'tmenny.required' => "kötelező megadni!",
                    'tdesc.required' => "kötelező megadni!",
                    'tgar.required' => "Kötelező megadni!",
                    'tkat.required' => "Kötelező megadni!",
                    'tgyarto.required' => "Kötelező megadni!",
        ]);

        if (Auth::user()->email == "admin@gmail.com") {
            $data = termek::find($cikkszam);
            $data->nev = $req->tnev;
            $data->netto = $req->tar;
            $data->kedv = $req->tkedv;
            $data->cikkszam = $req->tcikk;
            $data->img_id = $req->tkep;
            $data->keszlet = $req->tmenny;
            $data->leiras = $req->tdesc;
            $data->garancia = $req->tgar;
            $data->kat_id = $req->tkat;
            $data->gyarto_id = $req->tgyarto;
            $data->Save();
            return redirect('/profil')->withErrors(['sv' => 'Sikeres termék módosítás']);
        }
        else {
            return redirect('/')->withErrors(['sv' => 'Termék módosítást csak az admin végezhet']);
        }
    }
    public function Cart(){
        $total = 0;
        if(!session('cart') == null){
            foreach(session('cart') as $row){
                $total = $total + $row['ar']*$row['db'];
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
        $termek  = termekek::find($req->termek_id);
        $cart = session()->get('cart');
        if(isset($cart[$termek->termekek_id])){
            $cart[$termek->termekek_id]['db'] = $cart[$termek->termekek_id]['db']+1;
        } else {
            $cart[$termek->termekek_id] = [
                'termek_id' => $termek->termekek_id,
                'nev'       => $termek->nev,
                'ar'        => $termek->ar,
                'db'        => 1
            ];
        }

        session()->put('cart',$cart);
        ##dd($cart);
        return view('add', [
            'termekek_id'   => $req->termek_id
        ]);
    }

    public function Welcome()
    {
        return view('welcome', [
            'result' => kategoria::all()
        ]);
    }
}
