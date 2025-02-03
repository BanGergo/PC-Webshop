<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\webshop;

class WebshopController extends Controller
{
    function Kosar() {
        return view('kosar');
    }
}
