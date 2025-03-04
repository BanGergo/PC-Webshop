@extends('layout')
@section('content')
    <style>
        html{
            text-align: center;
        }
        #login{
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
    <form action="/login" method="post">
        @csrf
        <div class="my-5 p-4" id="login">
            <a id="cancel" href="/">❌</a>
            <h1 class="text-center">Bejelentkezés</h1>
            <label class="form-label" for="login_email">E-mail:*</label><br>
            <input class="form-control" type="email" name="login_email" id="login_email"><br>
            @error('login_email')
                <span class="text-danger">{{ $message }}</span><br>
            @enderror
            <label class="form-label" for="login_password">Jelszó:*</label><br>
            <input class="form-control" type="password" name="login_password" id="login_password"><br>
            @error('login_password')
                <span class="text-danger">{{ $message }}</span><br>
            @enderror
            <button class="btn btn-dark my-3" id="ok" type="submit">Bejelentkezés</button><br>
            <a href="/reg">Regisztrálás</a>
        </div>
    </form>
@endsection
