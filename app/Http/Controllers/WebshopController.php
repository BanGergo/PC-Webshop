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
use App\Models\tulajdonsag_nev;
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

    public function search($id, Request $request)
    {
        $category = $request->query('kat_id');
        $products = termek::when($category, function ($query, $category) {
            return $query->where('kat_id', $category);
        })->get();

        $categories = termek::select('kat_id')->distinct()->pluck('kat_id');

        return view('search', compact('products', 'categories', 'category'));

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
