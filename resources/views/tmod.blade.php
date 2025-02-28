@extends('layout')
@section('content')
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
<form action="" method="post" id="tmodositas">
    @csrf
    <div class="my-2 p-4" id="tadd">
        <a id="cancel" href="/profil">Vissza</a><br>
        <h1>Termék módosítás</h1>
        <label class="form-label" for="tnev">Termék neve:*</label>
        <input class="form-control" type="text" name="tnev" id="tnev" value="{{old('tnev')}}">
        @error('tnev')
            <span class="text-danger">{{$message}}</span>
        @enderror
        <label class="form-label" for="tar">Termék ára:*</label>
        <input class="form-control" type="number" name="tar" id="tar" value="{{old('tar')}}">
        @error('tar')
            <span class="text-danger">{{$message}}</span>
        @enderror
        <label class="form-label" for="tkedv">Termék ár kedvezménye:*</label>
        <input class="form-control" min="0" max="100" type="number" name="tkedv" id="tkedv"  value="{{old('tkedv')}}">
        @error('tkedv')
            <span class="text-danger">{{$message}}</span>
        @enderror
        <label class="form-label" for="tcikk">Termék cikkszáma:*</label>
        <input class="form-control" type="text" name="tcikk" id="tcikk" value="{{old('tcikk')}}">
        @error('tcikk')
            <span class="text-danger">{{$message}}</span>
        @enderror
        <label class="form-label" for="tkep">Termék képszáma:*</label>
        <input class="form-control" type="number" name="tkep" id="tkep" value="{{old('tkep')}}">
        @error('tkep')
            <span class="text-danger">{{$message}}</span>
        @enderror
        <label class="form-label" for="tmenny">Termék mennyisége:*</label>
        <input class="form-control" type="number" name="tmenny" id="tmenny" value="{{old('tmenny')}}">
        @error('tmenny')
            <span class="text-danger">{{$message}}</span>
        @enderror
        <label class="form-label" for="tdesc">Termék leírása:*</label>
        <textarea class="form-control" rows="3" name="tdesc" id="tdesc">{{old('tdesc')}}</textarea>
        @error('tdesc')
            <span class="text-danger">{{$message}}</span>
        @enderror
        <button class="btn btn-dark my-3" id="ok" onclick="tmodconf()" type="submit">Módosítás</button>
    </div>
</form>
@endsection
