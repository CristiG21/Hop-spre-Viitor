<!DOCTYPE html>
<html>
<title>Filmulețe - Hopspreviitor</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-green.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Playfair+Display'>
<link rel="stylesheet" href="style.css">

<head>
    <script src="https://kit.fontawesome.com/8da054f81e.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="w3-theme-l5">

<!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2"
                href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
            <a href="https://hopspreviitor.ro/" class="w3-bar-item w3-button w3-padding-large w3-theme-d4 w3-hover-white"><i
                    class="fa fa-home w3-margin-right"></i>Acasă</a>
            <div class="w3-dropdown-hover w3-hide-small">
                <button class="w3-button w3-padding-large" title="Notifications">Info</button>
                <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
                    <a href="https://hopspreviitor.ro/filmulete_explicative/" class="w3-bar-item w3-button">Filmulețe explicative</a>
                    <a href="#" class="w3-bar-item w3-button">Întrebări și jocuri</a>
                </div>
            </div>
            <div class="w3-dropdown-hover w3-hide-small">
                <button class="w3-button w3-padding-large" title="Notifications">Salvează mâncarea</button>
                <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
                    <a href="https://hopspreviitor.ro/retete/" class="w3-bar-item w3-button">Rețete</a>
                    <a href="https://hopspreviitor.ro/planificare_mese/" class="w3-bar-item w3-button">Planificare mese</a>
                    <a href="https://hopspreviitor.ro/lista_de_cumparaturi/" class="w3-bar-item w3-button">Listă de cumpărături</a>
                </div>
            </div>
            <div class="w3-dropdown-hover w3-hide-small">
                <button class="w3-button w3-padding-large" title="Notifications">Mediu</button>
                <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
                    <a href="https://hopspreviitor.ro/articole/" class="w3-bar-item w3-button">Articole</a>
                    <a href="https://hopspreviitor.ro/cronometru/" class="w3-bar-item w3-button">Cronometru</a>
                </div>
            </div>
            <a href = "https://hopspreviitor.ro/reviews/" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Ajută-ne cu o părere!</a>
            <a href = <?php
                        session_start();
                        if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true)
                            echo '"https://hopspreviitor.ro/logout/"';
                        else
                            echo '"https://hopspreviitor.ro/login/"';
                ?>
            class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="My Account">
                <?php
                        if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true)
                            echo "Logout";
                        else
                            echo "Login";
                ?>
            </a>
        </div>
    </div>

    <!-- Navbar on small screens -->
    <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Gol</a>
        <a href="https://hopspreviitor.ro/filmulete_explicative/" class="w3-bar-item w3-button w3-padding-large">Filmulețe explicative</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Întrebări și jocuri</a>
        <a href="https://hopspreviitor.ro/retete/" class="w3-bar-item w3-button w3-padding-large">Rețete</a>
        <a href="https://hopspreviitor.ro/planificare_mese/" class="w3-bar-item w3-button w3-padding-large">Planificare mese</a>
        <a href="https://hopspreviitor.ro/lista_de_cumparaturi/" class="w3-bar-item w3-button w3-padding-large">Listă de cumpărături</a>
        <a href="https://hopspreviitor.ro/articole/" class="w3-bar-item w3-button w3-padding-large">Articole</a>
        <a href="https://hopspreviitor.ro/cronometru/" class="w3-bar-item w3-button w3-padding-large">Cronometru</a>
        <a href="https://hopspreviitor.ro/reviews/" class="w3-bar-item w3-button w3-padding-large">Ajută-ne cu o părere!</a>
        <a href = <?php
                        session_start();
                        if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true)
                            echo '"https://hopspreviitor.ro/logout/"';
                        else
                            echo '"https://hopspreviitor.ro/login/"';
                ?>
            class="w3-bar-item w3-button w3-padding-large">
                <?php
                        if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true)
                            echo "Logout";
                        else
                            echo "Login";
                ?>
            </a> 
    </div>
    
    <br>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
    <h1 class="w3-center"><b>Filmulețe explicative</b></h1>
    
    <div class="w3-card w3-round w3-white w3-container w3-center w3-margin-bottom w3-margin-top">
        <center>
        <h3>Super misiunea păpușilor Vrăjitoarea cea Rea și Mustăcilă</h3>
        <div style="position: relative; width:70%; padding-top: 40%">
            <div class="w3-container" style="position: absolute; top: 10px; left: 0; bottom: 10px; right: 0;" >
                <iframe width="100%" height="100%" class="w3-round" src="https://www.youtube.com/embed/xJhxV2NM-Xw"></iframe>
            </div>
        </div>
        </center>
    </div>
    
    <div class="w3-card w3-round w3-white w3-container w3-center w3-margin-bottom">
        <center>
        <h3>Gândește verde!</h3>
        <div style="position: relative; width:70%; padding-top: 40%">
            <div class="w3-container" style="position: absolute; top: 10px; left: 0; bottom: 10px; right: 0;" >
                <iframe width="100%" height="100%" class="w3-round" src="https://www.youtube.com/embed/H0qFFEvsQUE"></iframe>
            </div>
        </div>
        </center>
    </div>
    
    <div class="w3-card w3-round w3-white w3-container w3-center w3-margin-bottom">
        <center>
        <h3>Haideți să reciclăm împreună!</h3>
        <div style="position: relative; width:70%; padding-top: 47%">
            <div class="w3-container" style="position: absolute; top: 10px; left: 0; bottom: 10px; right: 0;" >
                <iframe width="100%" height="100%" class="w3-round" src="https://www.youtube.com/embed/rsOFelp3xXs"></iframe>
            </div>
        </div>
        </center>
    </div>
    
    <div class="w3-card w3-round w3-white w3-container w3-center w3-margin-bottom">
        <center>
        <h3>Economisește apa și energia!</h3>
        <div style="position: relative; width:70%; padding-top: 40%">
            <div class="w3-container" style="position: absolute; top: 10px; left: 0; bottom: 10px; right: 0;" >
                <iframe width="100%" height="100%" class="w3-round" src="https://www.youtube.com/embed/q8ZhMIahIL0"></iframe>
            </div>
        </div>
        </center>
    </div>
    
    <div class="w3-card w3-round w3-white w3-container w3-center w3-margin-bottom">
        <center>
        <h3>Videoclip de prezentare a echipei Alt+Viitor</h3>
        <div style="position: relative; width:70%; padding-top: 40%">
            <div class="w3-container" style="position: absolute; top: 10px; left: 0; bottom: 10px; right: 0;" >
                <iframe width="100%" height="100%" class="w3-round" src="https://www.youtube.com/embed/QRyQP942OCU"></iframe>
            </div>
        </div>
        </center>
    </div>
</div>

<br><br><br><br><br><br>

<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16 w3-bottom">
    <h5>Footer</h5>
</footer>

<footer class="w3-container w3-theme-d5 w3-bottom">
    <p>Powered by Alt+Viitor</p>
</footer>

<script>
    // Accordion
    function myFunction(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
            x.previousElementSibling.className += " w3-theme-d1";
        } else {
            x.className = x.className.replace("w3-show", "");
            x.previousElementSibling.className =
                x.previousElementSibling.className.replace(" w3-theme-d1", "");
        }
    }

    // Used to toggle the menu on smaller screens when clicking on the menu button
    function openNav() {
        var x = document.getElementById("navDemo");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }
    
    var slideIndex = 0;
    showSlides();

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}    
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";  
        dots[slideIndex-1].className += " active";
        setTimeout(showSlides, 2000); // Change image every 2 seconds
    }
</script>

</body>

</html>