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
            'tcikk' => 'required|unique:termek,tcikk',
            'tkep' => 'required',
            'tmenny' => 'required',
            'tdesc' => 'required',
        ],[
            'tnev.required' => "kötelező megadni!",
            'tar.required' => "kötelező megadni!",
            'tkedv.required' => "kötelező megadni!",
            'tcikk.required' => "kötelező megadni!",
            'tcikk.unique' => "Ez a cikkszám már foglalt",
            'tkep.required' => "kötelező megadni!",
            'tmenny.required' => "kötelező megadni!",
            'tdesc.required' => "kötelező megadni!",
        ]);


        $data = new termek;
        $data->tnev = $req->tnev;
        $data->tar = $req->tar;
        $data->tkedv = $req->tkedv;
        $data->tcikk = $req->tcikk;
        $data->tkep = $req->tkep;
        $data->tmenny = $req->tmenny;
        $data->tdesc = $req->tdesc;
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

    public function tmod($tcikk){
        return view('tmod',[
            'adatok' => termek::select('*')
                    ->where('tcikk', $tcikk)
                    ->get()
        ]);
    }

    public function tmoddata(Request $req, $tcikk){
        $req->validate([
            'tnev' => 'required',
            'tar' => 'required',
            'tkedv' => 'required',
            'tcikk' => 'required|unique:termek,tcikk',
            'tkep' => 'required',
            'tmenny' => 'required',
            'tdesc' => 'required',
        ],[
            'tnev.required' => "kötelező megadni!",
            'tar.required' => "kötelező megadni!",
            'tkedv.required' => "kötelező megadni!",
            'tcikk.required' => "kötelező megadni!",
            'tcikk.unique' => "Ez a cikkszám már foglalt",
            'tkep.required' => "kötelező megadni!",
            'tmenny.required' => "kötelező megadni!",
            'tdesc.required' => "kötelező megadni!",
        ]);

        if (Auth::user()->email == "admin@gmail.com") {
            $data = termek::find($tcikk);
            $data->tnev = $req->tnev;
            $data->tar = $req->tar;
            $data->tkedv = $req->tkedv;
            $data->tmenny = $req->tmenny;
            $data->tdesc = $req->tdesc;
            $data->Save();
            return redirect('/profil')->withErrors(['sv' => 'Sikeres termék módosítás']);
        }
        else {
            return redirect('/')->withErrors(['sv' => 'Termék módosítást csak az admin végezhet']);
        }
    }
}
