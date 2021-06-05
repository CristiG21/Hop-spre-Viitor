<!DOCTYPE html>
<html>
<title>Preparat - Hopspreviitor</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-green.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Playfair+Display'>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/8da054f81e.js" crossorigin="anonymous"></script>

    <style>
        html,
        body,
        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: "Playfair Display", sans-serif;
        }

    </style>
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
    <div class="w3-card w3-round w3-white">
        <div class="w3-container" id="container">
            <!-- <h1 class="w3-center"><b>Nume reteta</b></h1>
             <p class="w3-center"><img src="photos/43photo.png" style="width:40%" alt="Poza preparat">
             </p>

             <br>

             <h2 class="w3-center"><i class="fa fa-clock fa-fw w3-margin-right w3-text-theme"></i> Timp preparare: ...
                 minute</h2>

             <h2 class="w3-center"><i class="fa fa-clipboard-list fa-fw w3-margin-right w3-text-theme"></i> Ingrediente:
             </h2>

             <h3 class="w3-center">
                 <ul style="list-style-position: inside;">
                     <li>Ingredient 1 - Cantitate 1</li>
                     <li>Ingredient 2 - Cantitate 2</li>
                     <li>Ingredient 3 - Cantitate 3</li>
                     <li>Ingredient 4 - Cantitate 4</li>
                 </ul>
             </h3>

             <h2 class="w3-center"><i class="fa fa-list-ol fa-fw w3-margin-right w3-text-theme"></i> Mod de
                 preparare:</h2>

             <h3 class="w3-left">
                 <ol class="w3-left">
                     <li>fjsaoifjisafkasbcbsaknckjsabkvsbdkfbvgjkchnxkzlukjsknbhdhjnvidkcsjnbc vhcbnjdskogkjnvb
                         cbfndsjkodkjnb snajkoskjnb abnjkokjnb njkokjnb bnjkokjnb bnjkoskjhb bnjkosk
                         jnbnjkiokjnbnjkiokjnb njkokjnb njio kjnnjiokjn njiokjn njoikjn njioikj nnji j
                     </li>
                     <li>Pas 2</li>
                     <li>Pas 3</li>
                     <li>Pas 4</li>
                 </ol>
             </h3>-->
        </div>
        <br><br><br><br>
    </div><!---->
    <!-- End Page Container -->
</div>

<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16 w3-bottom">
    <h5>Footer</h5>
</footer>

<footer class="w3-container w3-theme-d5 w3-bottom">
    <p>Powered by Alt+Viitor</p>
</footer>

<script src="retete.js"></script>
<script src="script.js"></script>

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
</script>

</body>

</html>