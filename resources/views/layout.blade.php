<!DOCTYPE html>
<html lang="hu">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CyberByte Corner</title>
        <link rel="icon" type="image/x-icon" href="{{asset('/assets/img/favicon.png')}}">
        <link rel="stylesheet" href="{{asset('/assets/css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/fontawesome/css/fontawesome.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/fontawesome/css/solid.css')}}">
        <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
        <script src="{{asset('/assets/js/bootstrap.bundle.js')}}"></script>
        <script src="{{asset('/assets/js/script.js')}}"></script>

    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary bg-primary">
            <div class="container-fluid">
                <a href="/" class="navbar-brand"><i class="fa-solid fa-house"></i></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Menü
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/mind">Mind</a></li>
                                <li><a class="dropdown-item" href="#">Kategória_2</a></li>
                                <li><a class="dropdown-item" href="#">Kategória_3</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="mobilGombok py-2">
                        @auth
                            @if (Auth::user()->email == "admin@gmail.com")
                                <a href="/profil" class="btn btn-primary"><i class="fa-solid fa-user"></i></a>
                                <a class="btn btn-primary" href="/logout"><i class="fa-solid fa-right-to-bracket"></i></a>
                            @else
                                <a href="/profil" class="btn btn-primary"><i class="fa-solid fa-user"></i></a>
                                <a class="btn btn-primary" href="/logout"><i class="fa-solid fa-right-to-bracket"></i></a>
                                <a href="/kosar" role="button" class="btn btn-primary mx-2" id="mobilKosar"><i class="fa-solid fa-cart-shopping"></i></a>
                            @endif
                        @else
                            <a href="/login" class="btn btn-primary" id="mobilProfil"><i class="fa-solid fa-user"></i></a>
                            {{-- <a class="btn btn-primary" data-bs-target="#loginModal" data-bs-toggle="modal" id="mobilProfil"><i class="fa-solid fa-user"></i></a> --}}
                            <a href="/kosar" role="button" class="btn btn-primary mx-2" id="mobilKosar"><i class="fa-solid fa-cart-shopping"></i></a>
                        @endauth
                    </div>
                    <form class="d-flex px-2" role="search">
                        <input class="form-control me-2" id="searchBar" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                    <div class="modal fade justify-content-end" id="loginModal" aria-labelledby="loginModalLabel" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="loginModalLabel"><strong>Bejelentkezés</strong></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/login" method="POST">
                                        @csrf
                                        <div class="py-2">
                                            <label class="form-label" for="login_email"><strong>E-mail:*</strong></label>
                                            <input type="email" name="login_email" id="login_email" class="form-control" >
                                            @error('login_email')
                                                <span class="text-danger">{{$message}}</span><br>
                                                <script>
                                                    $("#loginModal").modal(show: true);
                                                </script>
                                            @enderror
                                        </div>
                                        <div class="py-2">
                                            <label class="form-label" for="login_password"><strong>Jelszó:*</strong></label>
                                            <input type="password" name="login_password" id="login_password" class="form-control" >
                                            @error('login_password')
                                                <span class="text-danger">{{$message}}</span><br>
                                            @enderror
                                        </div>
                                        <div class="py-2 d-flex justify-content-center">
                                            <button class="btn btn-primary" type="submit">Bejelentkezés</button>
                                        </div>
                                    </form>

                                </div>
                                <div class="modal-footer mx-auto">
                                    <div class="row">
                                        <button class="btn" data-bs-target="#regModal" data-bs-toggle="modal">Regisztráció</button>
                                    </div><br>
                                    <div class="row">
                                        <button href="/mod" class="btn" data-bs-target="#newPassModalToggle" data-bs-toggle="modal">Jelszó visszaállítás</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="regModal" aria-labelledby="loginModalLabel2" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="loginModalLabel2">Regisztráció</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/reg" method="POST">
                                        @csrf
                                        <div class="py-2">
                                            <label class="form-label" for="nev"><strong>Név:*</strong></label>
                                            <input type="text" name="nev" id="nev" class="form-control" value="{{old('nev')}}">
                                            @error('nev')
                                                <span class="text-danger">{{$message}}</span><br>
                                            @enderror
                                        </div>
                                        <div class="py-2">
                                            <label class="form-label" for="email"><strong>E-mail cím:*</strong></label>
                                            <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}">
                                            @error('email')
                                                <span class="text-danger">{{$message}}</span><br>
                                            @enderror
                                        </div>
                                        <div class="py-2">
                                            <label class="form-label" for="password"><strong>Jelszó:*</strong></label>
                                            <input type="password" name="password" id="password" class="form-control">
                                            @error('password')
                                                <span class="text-danger">{{$message}}</span><br>
                                            @enderror
                                        </div>
                                        <div class="py-2">
                                            <label class="form-label" for="password_confirmation"><strong>Jelszó mégegyszer:*</strong></label>
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                            @error('password_confirmation')
                                                <span class="text-danger">{{$message}}</span><br>
                                            @enderror
                                        </div>
                                        <div class="py-2 d-flex justify-content-center">
                                            <button class="btn btn-primary" type="submit">Regisztráció</button>
                                        </div>
                                    </form>

                                </div>
                                <div class="modal-footer mx-auto">
                                    <button class="btn" data-bs-target="#loginModal" data-bs-toggle="modal">Bejelentkezés</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="newPassModalToggle" aria-labelledby="newPassModalToggle" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="#newPassModalToggle">Új jelszó kérése</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/newpass" method="POST">
                                        @csrf
                                        <div class="py-2">
                                            <label class="form-label" for="newpass_email"><strong>E-mail:*</strong></label>
                                            <input type="email" name="newpass_email" id="newpass_email" class="form-control">
                                        </div>
                                    </form>
                                    <div class="py-2 d-flex justify-content-center">
                                        <button class="btn btn-primary" type="submit">Új jelszó kérése</button>
                                    </div>
                                </div>
                                <div class="modal-footer mx-auto">
                                    <button class="btn" data-bs-target="#loginModal" data-bs-toggle="modal">Bejelentkezés</button>
                                    <button class="btn" data-bs-target="#regModal" data-bs-toggle="modal">Regisztráció</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="desktopGombok">
                        @auth
                            @if (Auth::user()->email == "admin@gmail.com")
                                <a href="/profil" class="btn btn-primary"><i class="fa-solid fa-user"></i></a>
                                <a class="btn btn-primary" href="/logout"><i class="fa-solid fa-right-to-bracket"></i></a>
                            @else
                                <a href="/profil" class="btn btn-primary"><i class="fa-solid fa-user"></i></a>
                                <a class="btn btn-primary" href="/logout"><i class="fa-solid fa-right-to-bracket"></i></a>
                                <a href="/kosar" role="button" class="btn btn-primary mx-2" id="mobilKosar"><i class="fa-solid fa-cart-shopping"></i></a>

                            @endif
                        @else
                            <a class="btn btn-primary" data-bs-target="#loginModal" data-bs-toggle="modal" id="mobilProfil"><i class="fa-solid fa-user"></i></a>
                            <a href="/kosar" role="button" class="btn btn-primary mx-2" id="mobilKosar"><i class="fa-solid fa-cart-shopping"></i></a>

                        @endauth
                    </div>
                </div>
            </div>
        </nav>
@yield('content')
        <div class="container-fluid text-center text-dark bg-light">
            <footer class="pt-3 pb-1 fs-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md fs-6">
                            <h4 class="cim4">Elérhetőségek</h4>
                            <span class="footer-text">1139 Budapest, Üteg utca 15.</span><br>
                            <span class="footer-text">Telefonszám:</span> +36-70-502-2297<br>
                            <span class="footer-text">E-mail: </span><a href="mailto:ban.gergo@verebelyszki.hu">ban.gergo@verebelyszki.hu</a>
                            <a href="mailto:gaspar.marcell@verebelyszki.hu">gaspar.marcell@verebelyszki.hu</a><br>
                            <a href="mailto:weisz.mate@verebelyszki.hu">weisz.mate@verebelyszki.hu</a>
                        </div>
                        <div class="col-md fs-6">
                            <h4 class="cim4">Információk</h4>
                            <a href="#">ÁSZF</a><br>
                            <a href="#">Adatvédelem</a>
                        </div>
                        <div class="col-md">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d617.5940369273575!2d19.076594482156562!3d47.52956361454255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741db939c5746e7%3A0xf93af4f99f4b38a8!2sBMSZC%20Vereb%C3%A9ly%20L%C3%A1szl%C3%B3%20Technikum!5e0!3m2!1shu!2shu!4v1738143282628!5m2!1shu!2shu" width="300" height="225" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
