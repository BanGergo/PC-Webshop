@extends('layout')
@section('content')

        <div class="mx-auto my-2 col-md-8">
            @error('sv')
                <div class="alert alert-success my-3">
                    {{$message}}
                </div>
            @enderror
            @if (Auth::user()->email == "admin@gmail.com")
                <div class="row">
                    <div class="col-md">
                        <h1 class="text-center py-3">{{Auth::user()->nev}} profilja</h1>
                        <p class="text-start">Felhasználónév: {{Auth::user()->nev}}</p>
                        <p class="text-start">E-mail cím: {{Auth::user()->email}}</p>
                        <p class="text-start">Tag már: {{ date_format(date_create(Auth::user()->created_at),"Y. m. d.")}} óta!</p>
                        <p class="text-start">Jelszó módosítása: <a href="/mod">itt</a></p>
                        <p class="text-start">Utolsó módosítás dátuma: {{ date_format(date_create(Auth::user()->updated_at),"Y. m. d.")}} | {{ date_format(date_create(Auth::user()->updated_at),"h : m")}}</p>

                        <div class="row">
                            {{-- <form id="tmodositas" action="" method="post"> --}}
                                <label for="nevek" class="form-label my-3"><h2>Válasszon terméket!</h2></label>
                                <select class="form-control" name="nevek" id="nevek">
                                    @foreach ($nevek as $nev)
                                        <option class="form-control" value="{{$nev->tcikk}}"><a href="/cikkszam/{{$nev->tcikk}}">{{$nev->tnev}}</a></option>
                                    @endforeach
                                </select>
                                <button class="btn btn-outline-dark my-3" id="valasztott" onclick="tmod()" type="button">Módosítás</button>
                            {{-- </form> --}}
                        </div>
                    </div>
                    <div class="col-md">
                        <style>
                            html{
                                text-align: center;
                            }
                            #tadd{
                                max-width: 400px;
                                width: 400px;
                                height: auto;
                                border: 2px solid black;
                                border-radius: 25px;
                                margin: auto;
                            }
                            #cancel{
                                float: right;
                                text-decoration: none;
                            }
                            label{
                                float: left;
                            }
                        </style>
                        <form action="/profil" method="post">
                            @csrf
                            <div class="my-2 p-4" id="tadd">
                                <a id="cancel" href="/">Vissza</a><br>
                                <h1>Új Termék</h1>
                                <label class="form-label" for="tnev">Termék neve:*</label>
                                <input class="form-control" type="text" name="tnev" id="tnev">
                                @error('tnev')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                <label class="form-label" for="tar">Termék ára:*</label>
                                <input class="form-control" type="number" name="tar" id="tar">
                                @error('tar')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                <label class="form-label" for="tkedv">Termék ár kedvezménye:*</label>
                                <input class="form-control" min="0" max="100" type="number" name="tkedv" id="tkedv">
                                @error('tkedv')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                <label class="form-label" for="tcikk">Termék cikkszáma:*</label>
                                <input class="form-control" type="text" name="tcikk" id="tcikk">
                                @error('tcikk')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                <label class="form-label" for="tkep">Termék képszáma:*</label>
                                <input class="form-control" type="number" name="tkep" id="tkep">
                                @error('tkep')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                <label class="form-label" for="tmenny">Termék mennyisége:*</label>
                                <input class="form-control" type="number" name="tmenny" id="tmenny">
                                @error('tmenny')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                <label class="form-label" for="tdesc">Termék leírása:*</label>
                                <textarea class="form-control" rows="3" name="tdesc" id="tdesc"></textarea>
                                @error('tdesc')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                <button class="btn btn-dark my-3" id="ok" type="submit">Hozzáadás</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            @else
                <h1 class="text-center py-3">{{Auth::user()->nev}} profilja</h1>
                <p class="text-start">Felhasználónév: {{Auth::user()->nev}}</p>
                <p class="text-start">E-mail cím: {{Auth::user()->email}}</p>
                <p class="text-start">Tag már: {{ date_format(date_create(Auth::user()->created_at),"Y. m. d.")}} óta!</p>
                <p class="text-start">Jelszó módosítása: <a href="/mod">itt</a></p>
                <p class="text-start">Utolsó módosítás dátuma: {{ date_format(date_create(Auth::user()->updated_at),"Y. m. d.")}} | {{ date_format(date_create(Auth::user()->updated_at),"h : m")}}</p>
            @endif
        </div>

@endsection
