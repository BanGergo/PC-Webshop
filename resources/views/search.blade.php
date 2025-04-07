@extends("layout")
@section('content')
    <div class="container py-3">
        <div class="pb-3">
            <h1></h1>
        </div>
        <div class="row row-cols-1 row-cols-md-2">
            <div class="col-md-4">
                <form action="{{ url('/search') }}" method="GET">
                    <label for="category">Kategoriák</label>
                    <select name="category" id="category" onchange="this.form.submit()">
                        <option value="">All</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}" {{ $cat == $category ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
            <div class="col-md-8">
                {{-- @dd($result) --}}
                @foreach ($products as $row)
                    <div class="card">
                        <div class="card-body d-flex align-items-center">
                            <img src="{{$row->url}}" alt="{{$row->termek_nev}}" class="w-25" style="float: left">
                            <h5>{{$row->termek_nev}}</h5><br>
                            <p>{{$row->netto}} Ft</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
