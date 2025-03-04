<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\webshop;
use App\Models\termek;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class WebshopController extends Controller
{
    function Kosar() {
        return view('kosar');
    }

    public function Search(){
        $req = Request()->query('search');
        return view('search', [
            'result'    => termek::where('nev', 'LIKE', '%'.$req.'%')
                                   ->get()
        ]);
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
}
