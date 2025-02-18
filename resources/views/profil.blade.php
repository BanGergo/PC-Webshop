@extends('layout')
@section('content')

        <div class="mx-auto my-2 col-md-8">
            @error('sv')
                <div class="alert alert-success my-3">
                    {{$message}}
                </div>
            @enderror
            <h1 class="text-center py-3">{{Auth::user()->nev}} profilja</h1>
            <p class="text-start">Felhasználónév: {{Auth::user()->nev}}</p>
            <p class="text-start">E-mail cím: {{Auth::user()->email}}</p>
            <p class="text-start">Tag már: {{ date_format(date_create(Auth::user()->created_at),"Y. m. d.")}} óta!</p>
            <p class="text-start">Jelszó módosítása: <a href="/mod">itt</a></p>
            <p class="text-start">Utolsó módosítás dátuma: {{ date_format(date_create(Auth::user()->updated_at),"Y. m. d.")}} | {{ date_format(date_create(Auth::user()->updated_at),"h : m")}}</p>
        </div>

@endsection
