@extends("layout")
@section('content')
    <div class="container py-3">
        <div class="pb-3">
            <h1>{{$kategoria->kat_nev}}</h1>
        </div>
        <div class="row row-cols-1 row-cols-md-2">
            <div class="col-md-4">
                <table class="table table-bordered">
                    <tr>
                        <th>{{$kategoria->kat_nev}}</th>
                    </tr>
                </table>
            </div>
            <div class="col-md-8">
                @dd($result)
                @foreach ($result as $row)
                    <div class="card">
                        <img src="{{$row->url}}" alt="{{$row->termek_nev}}">
                        <div class="card-body">
                            <h5>{{$row->termek_nev}}</h5>
                            <p>{{$row->netto}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
