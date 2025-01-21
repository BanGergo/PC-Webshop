<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SABLON</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <script src="{{asset('assets/js/bootsrap.bundle.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="dropdown">
              <button class="dropbtn">Menü
                <i class="fa fa-caret-down"></i>
              </button>
              <div class="dropdown-content">
                <a href="#">Link 1</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
                <a href="#">Link 4</a>
                <a href="#">Link 5</a>
                <a href="#">Link 6</a>
                <a href="#">Link 7</a>
                <a href="#">Link 8</a>
                <a href="#">Link 9</a>
                <a href="#">Link 10</a>
              </div>
            </div>
            <div id="logo">
                <a href="#">LOGO</a>
            </div>
            <div id="ker">
                <input type="text" name="search" id="search" placeholder="Search..." autocomplete="off">
                <button><p>🔍</p></button>
            </div>
            <div id="lepesek">
                <label>Belépés<a class="lepes" href="#">👤</a></label>
                <label>Kosár<a class="lepes" href="#">🛒</a></label>
            </div>
          </div>
    </header>
<!-- Cut -->
@yield('content')
<!-- Cut -->
    <footer>
    <div id="szoveg">
    </div>
    <div id="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2693.9682055391345!2d19.0767067!3d47.529482!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741db939c5746e7%3A0xf93af4f99f4b38a8!2sBMSZC%20Vereb%C3%A9ly%20L%C3%A1szl%C3%B3%20Technikum!5e0!3m2!1shu!2shu!4v1736961532083!5m2!1shu!2shu" width="300" height="150" style="border:0;"></iframe></div>
    </footer>
</body>
</html>
