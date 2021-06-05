<?php
    $remindere = array("Nu uita să îți iei sacoșa cu tine când mergi la magazin!","Folosește bicicleta sau mergi pe jos!","Stinge lumina din cameră atunci când nu o folosești!", "Închide apa atunci când te speli pe dinți și nu o folosești");
?>

<!DOCTYPE html>
<html>
<title>Acasă - Hopspreviitor</title>
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
    <h1 class="w3-center"><b>Acasă</b></h1>
    <div class="w3-card w3-round w3-white w3-margin-bottom w3-padding">
        <div class="w3-container w3-center">
            <div class="slideshow-container">

            <div class="mySlides fade">
                <div class="numbertext">1 / 3</div>
                <img src="p1.jpeg" style="width:100%" class="w3-round">
                <div class="text">Hop spre Viitor</div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">2 / 3</div>
                <img src="p2.jpeg" style="width:100%" class="w3-round">
                <div class="text">Echipa Alt+Viitor</div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">3 / 3</div>
                <img src="p3.jpg" style="width:100%" class="w3-round">
                <div class="text">Gândește verde!</div>
            </div>
            </div>
        </div>
        <br>

        <div style="text-align:center">
            <span class="dot"></span> 
            <span class="dot"></span> 
            <span class="dot"></span> 
        </div>
    </div>
    
    <div class="w3-card w3-round w3-white w3-container w3-center w3-margin-bottom">
    <!-- The Grid -->
    <div class="w3-row">
        <h4>
        <!-- First Column -->
        <div class="w3-col w3-row-padding m4">
            <a href="https://hopspreviitor.ro/filmulete_explicative/" style="border:5px solid white" class="w3-bar-item w3-button w3-hover-none w3-hover-border-green">Filmulețe explicative</a><br>
            <a href="https://hopspreviitor.ro/planificare_mese/" style="border:5px solid white" class="w3-bar-item w3-button w3-hover-none w3-hover-border-green">Planificare mese</a><br>
            <a href="https://hopspreviitor.ro/cronometru/" style="border:5px solid white" class="w3-bar-item w3-button w3-hover-none w3-hover-border-green">Cronometru</a>
            <!-- End First Column -->
        </div>

        <!-- Second Column -->
        <div class="w3-col w3-row-padding m4">
            <a href="#" style="border:5px solid white" class="w3-bar-item w3-button w3-hover-none w3-hover-border-green">Întrebări și jocuri</a><br>
            <a href="https://hopspreviitor.ro/lista_de_cumparaturi/" style="border:5px solid white" class="w3-bar-item w3-button w3-hover-none w3-hover-border-green">Listă de cumpărături</a><br>
            <a href="https://hopspreviitor.ro/reviews/" style="border:5px solid white" class="w3-bar-item w3-button w3-hover-none w3-hover-border-green">Ajută-ne cu o părere!</a>
            <!-- End Second Column -->
        </div>

        <!-- Third Column -->
        <div class="w3-col w3-row-padding m4">
            <a href="https://hopspreviitor.ro/retete/" style="border:5px solid white" class="w3-bar-item w3-button w3-hover-none w3-hover-border-green">Rețete</a><br>
            <a href="https://hopspreviitor.ro/articole/" style="border:5px solid white" class="w3-bar-item w3-button w3-hover-none w3-hover-border-green">Articole</a>
            <!-- End Third Column -->
        </div>
        </h4>
        <!-- End Grid -->
    </div>
    </div>
    
    <div class="w3-card w3-round w3-white w3-container w3-center w3-margin-bottom">
        <h3>
            <?php
                $folosite  = array();
                $nrRemindere = count($remindere);
                do{
                    $selectat = rand(0,$nrRemindere-1);
                } while($folosite[$selectat] == True);
                $folosite[$selectat] = True;
                echo $remindere[$selectat];
            ?>
        </h3>
    </div>
    
    <div class="w3-card w3-round w3-white w3-container w3-center w3-margin-bottom">
        <h3>
            <?php
                do{
                    $selectat = rand(0,$nrRemindere-1);
                } while($folosite[$selectat] == True);
                $folosite[$selectat] = True;
                echo $remindere[$selectat];
            ?>
        </h3>    
    </div>
    
    <div class="w3-card w3-round w3-white w3-container w3-center w3-margin-bottom">
        <h3>
            <?php
                do{
                    $selectat = rand(0,$nrRemindere-1);
                } while($folosite[$selectat] == True);
                $folosite[$selectat] = True;
                echo $remindere[$selectat];
            ?>
        </h3>    
    </div>
    
    <div class="w3-card w3-round w3-white w3-container w3-center w3-margin-bottom">
        <div class="w3-row">
            <div class="w3-col w3-row-padding w3-half">
                <img src="logo_hopspreviitor.jpeg" class="w3-round w3-margin" width="50%">
            </div>
            <div class="w3-col w3-row-padding w3-half">
                <h3><br><br><br>Împreună facem un <b>HOP SPRE VIITOR</b>.<br> Haideți să schimbăm lumea împreună!<br></h3><h2>Gândește verde!</h2>
            </div>
        </div>
    </div>
    
    <div class="w3-card w3-round w3-white w3-container w3-center w3-margin-bottom">
        <div class="w3-row">
            <div class="w3-col w3-row-padding w3-half">
                <h2><br>Salut!</h2><h3><br>Noi suntem echipa Alt+Viitor. Suntem 5 adolescenți ambițioși, perseverenți și dornici de schimbare. <br>Te invităm să te alături într-o incredibilă misiune de a face lumea un loc mai bun cât ai zice <b>“Natură”</b>! 
<br>Ești pregătit?</h3>
            </div>
            <div class="w3-col w3-row-padding w3-half">
                <img src="echipa_hopspreviitor.jpeg" class="w3-round w3-margin" width="50%">
            </div>
        </div>
    </div>
    
    <div class="w3-card w3-round w3-white w3-container w3-center w3-margin-bottom">
        <center>
        <h3>Prezentarea echipei noastre</h3>
        <div style="position: relative; width:70%; padding-top: 40%">
            <div class="w3-container" style="position: absolute; top: 10px; left: 0; bottom: 10px; right: 0;" >
                <iframe width="100%" height="100%" class="w3-round" src="https://www.youtube.com/embed/QRyQP942OCU"></iframe>
            </div>
        </div>
        </center>
    </div>
    
    <div class="w3-card w3-round w3-white w3-container w3-center w3-margin-bottom">
        <h3>Urmărește-ne pe rețelele de socializare pentru a fi mai aproape de noi!</h3>
        <h3>
            <div class="w3-row">
                <div class="w3-col w3-row-padding w3-third">
                    <a href="https://www.instagram.com/hop.spre.viitor/?hl=ro" class="w3-button w3-padding-large w3-green w3-card-4 w3-ripple w3-round w3-margin-bottom"><i
                        class="fa fa-instagram w3-margin-right"></i>Instagram</a>
                </div>
                <div class="w3-col w3-row-padding w3-third">
                    <a href="https://vm.tiktok.com/ZMev4xov5/" class="w3-button w3-padding-large w3-green w3-card-4 w3-ripple w3-round w3-margin-bottom"><i
                        class="fab fa-tiktok w3-margin-right"></i>TikTok</a>
                </div>
                <div class="w3-col w3-row-padding w3-third">
                    <a href="https://youtube.com/channel/UCICo-UasVWoOKUrnl9eeYhg" class="w3-button w3-padding-large w3-green w3-card-4 w3-ripple w3-round w3-margin-bottom"><i
                        class="fab fa-youtube w3-margin-right"></i>YouTube</a>
                </div>
            </div>
        </h3>    
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