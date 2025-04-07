@extends('layout')
@section('content')
    <div class="container">
        <h1 class="text-center">{{ $selectedCategory->kat_nev }}</h1>
        <hr class="mx-auto w-50">
        <div class="row">
            <div class="col-md-4">
                <form action="{{ url('/products/category/'.$selectedCategory) }}" method="get">
                    <label for="gyarto" class="form-label">Gyártók</label>
                    <select name="gyarto" id="gyarto" onchange="this.form.submit">
                        <option value="">Összes</option>

                        @foreach ($gyartok as $gyarto)
                            <option value="{{ $gyarto->gyarto_id }}">{{ $gyarto->gyarto_nev }}</option>
                        @endforeach
                    </select>
                    <button type="submit">Filter</button>
                </form>
            </div>
            <div class="col-md-8">
                @forelse ($products as $product)
                    <div class="card">
                        <div class="card-body">
                            <img src="{{$product->url}}" alt="{{$product->termek_nev}}" class="w-25 px-2" style="float: left">
                            <h5>{{ $product->termek_nev }}</h5>
                            <p>{{ $product->netto * 1.27 }} Ft</p>
                        </div>
                    </div>
                @empty

                @endforelse
            </div>
        </div>
    </div>
@endsection