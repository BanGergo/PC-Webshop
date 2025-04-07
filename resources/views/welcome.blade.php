@extends('layout')
@section('content')
        @error("sv")
            <div class="alert alert-info text-center" role="alert">
                {{$message}}
            </div>
        @enderror
        <div class="container py-3 mx-auto">
            <div id="carouselExampleIndicators" class="carousel slide w-75 mx-auto" data-bs-ride="carousel" data-bs-touch="true">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./assets/img/welcomebanner.PNG" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/img/loyaltybanner.PNG" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/img/comingsoonbanner.PNG" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="container px-5" id="kategoriak">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 py-3">
                @foreach ($result as $row)
                    <div class="card mx-1 my-2" style="width: 18rem;">
                        <a href="/search/{{$row->kat_id}}"><img src="{{asset('assets/img/kategoriak/'. $row->kat_id. '.jpg')}}" class="card-img-top" alt="{{$row->kat_nev}}"></a>
                        <div class="card-body d-flex align-items-end flex-column mb-3">
                        <h5 class="card-title mt-auto mx-auto p-2"><a href="">{{$row->kat_nev}}</a></h5>
                        </div>
                    </div>
                    @endforeach
                </div>
        </div>
@endsection
