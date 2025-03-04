@extends('layout')
@section('content')
    <style>
        html{
            text-align: center;
        }
        #reg{
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
    <form action="/reg" method="post">
        @csrf
        <div class="my-2 p-4" id="reg">
            <a id="cancel" href="/">❌</a>
            <h1>Regisztráció</h1>
            <label class="form-label" for="nev">Név:*</label><br>
            <input class="form-control" type="text" name="nev" id="nev" value="{{old('nev')}}"><br>
            @error('nev')
                <span class="text-danger">{{ $message }}</span><br>
            @enderror
            <label class="form-label text-start" for="email">E-mail:*</label><br>
            <input class="form-control" type="email" name="email" id="email"  value="{{old('email')}}"><br>
            @error('email')
                <span class="text-danger">{{ $message }}</span><br>
            @enderror
            <label class="form-label" for="password">Jelszó:*</label><br>
            <input class="form-control" type="password" name="password" id="password"><br>
            @error('password')
                <span class="text-danger">{{ $message }}</span><br>
            @enderror
            <label class="form-label" for="password_confirmation">Jelszó mégegyszer:*</label><br>
            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation"><br>
            @error('password')
                <span class="text-danger">{{ $message }}</span><br>
            @enderror
            <button class="btn btn-dark my-3" id="ok" type="submit">Regisztrálás</button><br>
            <a href="/login">Bejelentkezés</a>
        </div>
    </form>
@endsection
