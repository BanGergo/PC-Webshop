@extends('layout')
@section('content')

<div class="col-md-9">
    <div class="mx-auto">
        @error('sv')
            <div class="alert alert-success my-3">
                {{$message}}
            </div>
        @enderror
<form class="mx-auto" action="/mod" method="post">
    @csrf
    <div class="py-2">
        <label for="opassword" class="form-label">Régi jelszó:</label>
        <input type="password" name="opassword" id="opassword" class="form-control">
        @error('opassword')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="py-2">
        <label for="npassword" class="form-label">Új jelszó:</label>
        <input type="password" name="npassword" id="npassword" class="form-control">
        @error('npassword')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="py-2">
        <label for="npassword_confirmation" class="form-label">Új jelszó mégegyszer:</label>
        <input type="password" name="npassword_confirmation" id="npassword_confirmation" class="form-control">
        @error('npassword_confirmation')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="py-2">
        <button class="btn btn-dark" type="submit">Módosítás</button>
    </div>
</form>
</div>
</div>
@endsection
