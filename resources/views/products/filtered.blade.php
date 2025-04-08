@extends('layout')
@section('content')
    <div class="container">
        <h1 class="text-center">{{ $selectedCategory->kat_nev }}</h1>
        <hr class="mx-auto w-50">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Szűrők</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.filter') }}" method="get">
                            <!-- Hidden input to keep track of category -->
                            <input type="hidden" name="category" value="{{ $selectedCategory->kat_id }}">

                            <!-- Manufacturer filter -->
                            <div class="mb-3">
                                <label for="gyarto" class="form-label">Gyártók</label>
                                <select name="gyarto" id="gyarto" class="form-select" onchange="this.form.submit()">
                                    <option value="">Összes</option>
                                    @foreach ($gyartok as $gyarto)
                                        <option value="{{ $gyarto->gyarto_id }}" {{ isset($request) && $request->gyarto == $gyarto->gyarto_id ? 'selected' : '' }}>
                                            {{ $gyarto->gyarto_nev }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                @foreach ($tulajdonsagok as $tulajdonsag)
                                    <label for="tulajdonsag">{{$tulajdonsag->tul_nev}}</label>
                                    <select name="tulajdonsag" id="tulajdonsag" class="form-select" onchange="this.form.submit()">
                                        <option value="">Összes</option>
                                        @foreach ($tulajdonsagok_ertek as $ertek)

                                            @if (str_contains($ertek, "mag"))
                                            <option value="{{ $ertek->tul_nev_id }}" {{ isset($request) && $request->tulajdonsag == $ertek->tul_nev_id ? 'selected' : '' }}>
                                                {{ $ertek->tulajdonsag }}
                                            </option>
                                            @endif
                                        @endforeach
                                    </select>
                                @endforeach
                            </div>

                            <!-- Price range filter -->
                            <div class="mb-3">
                                <label class="form-label">Ár tartomány</label>
                                <div class="row">
                                    <div class="col">
                                        <input type="number" name="min_price" class="form-control" placeholder="Min Ft"
                                            value="{{ isset($request) ? $request->min_price : '' }}">
                                    </div>
                                    <div class="col-1 text-center">-</div>
                                    <div class="col">
                                        <input type="number" name="max_price" class="form-control" placeholder="Max Ft"
                                            value="{{ isset($request) ? $request->max_price : '' }}">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Szűrés</button>
                            <a href="{{ route('products.byCategory', ['category' => $selectedCategory->kat_id]) }}" class="btn btn-secondary">Alaphelyzet</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                @if ($products->count() > 0)
                    @foreach ($products as $product)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{$product->url}}" alt="{{$product->termek_nev}}" class="img-fluid">
                                    </div>
                                    <div class="col-md-8">
                                        <h5>{{ $product->termek_nev }}</h5>
                                        <p class="text-danger fw-bold">{{ number_format($product->netto, 0, ',', ' ') }} Ft</p>
                                        <p>{{ Str::limit($product->leiras, 100) }}</p>
                                        <a href="/products/{{$product->cikkszam}}" class="btn btn-primary">Részletek</a>
                                        <!-- Add to cart button could go here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-info">
                        Nincs találat a megadott szűrési feltételekkel.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
