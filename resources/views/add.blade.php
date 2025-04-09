@extends('layout')
@section('content')
@dd($cikkszam)
<div class="container py-3">
    <div class="d-flex justify-content-center">
        <div class="w-50 border border-dark rounded p-2 row">
            <div class="col-md-5">
                <img src="" alt="" class="w-100">
            </div>
            <div class="col-md-7 text-center">
                <h5>Sikeresen a kosárba raktad!</h5>
                <p>{{ session('cart')[$cikkszam]['nev'].' - '.session('cart')[$cikkszam]['netto'] * session('cart')[$cikkszam]['afa'] }}Ft</p>
                <p>
                    <a class="btn btn-dark" href="{{url()->previousPath()}}">Vissza</a>
                    <a class="btn btn-dark" href="/cart">Kosárhoz</a>
                </p>
            </div>
        </div>
    </div>
@endsection
