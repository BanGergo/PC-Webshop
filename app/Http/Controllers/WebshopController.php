<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\webshop;

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
}
