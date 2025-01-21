@extends('layout')
@section('content')
<main>
        <!-- Slideshow container -->
    <div class="slideshow-container">

    <!-- Full-width images with number and caption text -->
        <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <img src="https://letsenhance.io/static/8f5e523ee6b2479e26ecc91b9c25261e/1015f/MainAfter.jpg">
        </div>

        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <img src="https://img.freepik.com/free-photo/close-up-cute-green-gecko-eye-generated-by-ai_188544-151832.jpg">
        </div>

        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQKGvxtr7vmYvKw_dBgBPf98isHM4Cz6REorg&s">
        </div>

    <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>

    <!-- The dots/circles -->
    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>

    <div id="container">
        <section class="center-column">Szöveg1</section>
        <section class="center-column">Szöveg2</section>
        <section class="center-column">Szöveg3</section>
        <section class="center-column">Szöveg4</section>
        <section class="center-column">Szöveg5</section>
        <section class="center-column">Szöveg6</section>
    </div>
</main>
@endsection
