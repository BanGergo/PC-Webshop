@extends('layout')
@section('content')
{{-- @dd(Auth::user()) --}}
    <div class="container">
        <h2>Adja meg az adatait</h2>
        @if (!Auth::check())
            <form action="/delivery" method="POST">
                @csrf
                <div class="py-2">
                    <label for="guest_nev" class="form-label">Név:</label>
                    <input type="text" name="guest_nev" id="guest_nev" value="{{old('guest_nev')}}" class="form-control">
                    @error('guest_nev')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="py-2">
                    <label for="guest_email" class="form-label">Email:</label>
                    <input type="email" name="guest_email" id="guest_email" value="{{old('guest_email')}}" class="form-control">
                    @error('guest_email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="py-2">
                    <label for="guest_telefon" class="form-label">Telefonszám:</label>
                    <input type="text" name="guest_telefon" id="guest_telefon" value="{{old('guest_telefon')}}" class="form-control">
                    @error('guest_telefon')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="py-2">
                    <label for="guest_irszam" class="form-label">Irányítószám:</label>
                    <input type="text" name="guest_irszam" id="guest_irszam" value="{{old('guest_irszam')}}" class="form-control">
                    @error('guest_irszam')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="py-2">
                    <label for="guest_varos" class="form-label">Város:</label>
                    <input type="text" name="guest_varos" id="guest_varos" value="{{old('guest_varos')}}" class="form-control">
                    @error('guest_varos')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="py-2">
                    <label for="guest_uha" class="form-label">Utca, házszám:</label>
                    <input type="text" name="guest_uha" id="guest_uha" value="{{old('guest_uha')}}" class="form-control">
                    @error('guest_uha')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="py-2">
                    <label for="guest_megj" class="form-label">Megjegyzés:</label>
                    <textarea type="text" name="guest_megj" id="guest_megj" value="{{old('guest_megj')}}" class="form-control" rows="3"></textarea>
                    @error('guest_megj')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="py-4">
                    <button class="btn btn-secondary" type="submit">Rendelés leadása</button>
                </div>
            </form>
        @else
        <form action="/delivery" method="POST">
            @csrf
            <div class="py-2">
                <label for="user_telefon" class="form-label">Telefonszám:</label>
                <input type="tel" name="user_telefon" id="user_telefon" value="{{old('user_telefon', Auth::user()->telefon)}}" class="form-control">
                @error('user_telefon')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="py-2">
                <label for="user_irszam" class="form-label">Irányítószám:</label>
                <input type="text" name="user_irszam" id="user_irszam" value="{{old('user_irszam', Auth::user()->irszam)}}" class="form-control">
                @error('user_irszam')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="py-2">
                <label for="user_varos" class="form-label">Város:</label>
                <input type="text" name="user_varos" id="user_varos" value="{{old('user_varos', Auth::user()->varos)}}" class="form-control">
                @error('user_varos')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="py-2">
                <label for="user_uha" class="form-label">Utca, házszám:</label>
                <input type="text" name="user_uha" id="user_uha" value="{{old('user_uha', Auth::user()->uha)}}" class="form-control">
                @error('user_uha')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="py-2">
                <label for="user_megj" class="form-label">Megjegyzés:</label>
                <textarea type="text" name="user_megj" id="user_megj" value="{{old('user_megj')}}" class="form-control" rows="3"></textarea>
                @error('user_megj')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="py-4">
                <button class="btn btn-secondary" type="submit">Rendelés leadása</button>
            </div>
        </form>
        @endif
    </div>
@endsection