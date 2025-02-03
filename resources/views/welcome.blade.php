@extends('layout')
@section('content')
        <div class="container py-3 mx-auto">
            <div id="carouselExampleIndicators" class="carousel slide w-75 mx-auto" data-bs-ride="carousel" data-bs-touch="true">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./assets/img/img1.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/img/img2.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./assets/img/img3.jpg" class="d-block w-100" alt="...">
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
            <div class="row py-3">
                <div class="col-lg py-3">
                    <a href="#" class="py-3"><img src="./assets/img/sablon-pc.jpg" alt="sablon-pc" class="border border-dark border-3 my-3"></a>
                    <a href="#" class="py-3"><img src="./assets/img/sablon-pc.jpg" alt="sablon-pc" class="border border-dark border-3 my-3"></a>
                </div>
                <div class="col-lg py-3">
                    <a href="#" class="py-3"><img src="./assets/img/sablon-pc.jpg" alt="sablon-pc" class="border border-dark border-3 my-3"></a>
                    <a href="#" class="py-3"><img src="./assets/img/sablon-pc.jpg" alt="sablon-pc" class="border border-dark border-3 my-3"></a>
                </div>
                <div class="col-lg py-3">
                    <a href="#" class="py-3"><img src="./assets/img/sablon-pc.jpg" alt="sablon-pc" class="border border-dark border-3 my-3"></a>
                    <a href="#" class="py-3"><img src="./assets/img/sablon-pc.jpg" alt="sablon-pc" class="border border-dark border-3 my-3"></a>
                </div>
            </div>
        </div>
@endsection
