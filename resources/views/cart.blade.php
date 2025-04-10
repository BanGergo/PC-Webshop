    @extends('layout')
    @section('content')
    <div class="container py-3">
        <div class="d-flex justify-content-center">
            <div class="w-75">
                @if($total <> 0)
                <form action="/cart" method="POST">
                    @csrf
                    @foreach (session('cart') as $row)
                        <div class="row">
                            <div class="col-md">
                                <h5>{{ $row['nev'] }}</h5>
                                <p>{{ $row['db'] }} darab - {{ number_format($row['netto']*$row['afa']*$row['db'],0,',',' ') }} Ft</p>
                                <img src="" alt="{{$row['cikkszam']}}.jpg" class="w-100">
                            </div>
                            <div class="col-md">
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-dark me-3 px-3" type="submit" name="delete" value="{{$row['cikkszam']}}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <button class="btn btn-dark" type="submit" name="minus" value="{{$row['cikkszam']}}">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                    <input type="text" name="db" value="{{$row['db']}}" class="form-control text-center" style="width: 4rem;" disabled>
                                    <button class="btn btn-dark" type="submit" name="plus" value="{{$row['cikkszam']}}">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </form>
                <div class="row">
                    <div class="col-md">
                        <p class="fs-4"><b>Összesen: {{ number_format($total,0,',',' ') }} Ft</b></p>
                    </div>
                    <div class="col-md text-end">
                        <a class="btn btn-dark" href="/delivery">Adatok megadása</a>
                    </div>
                </div>
                @else
                <p class="fs-4"><b>A kosár üres!</b></p>
                @endif
            </div>
        </div>
    </div>
    @endsection
