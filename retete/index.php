<?php
// Initialize the session
session_start();

// Check if the user is logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    // Include config file
    require_once "config.php";
    
    // Define variables and initialize with empty values
    $recipe_err = "";
    $inserted_recipe = false;
    $days = array("mon","tue","wed","thu","fri","sat","sun");
    $days_checked = array(0,0,0,0,0,0,0,0);
    $number_days_checked = 0;
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        $inserted_recipe = true;
        
        $recipe_id = (int)$_POST["id_recipe"];
            
        // Check each day
        for($i = 0; $i < 7; $i++){
            if(isset($_POST[$days[$i]])){
                $number_days_checked ++;
                $days_checked[$i] = 1;
            }
            else{
                $days_checked[$i] = 0;
            }
        }
            
        if($number_days_checked == 0)
            $recipe_err = "Nu ați selectat nicio zi.";
 
        // Check if there are not errors
        if(empty($recipe_err)){
            // Prepare a insert statement
            $sql = "INSERT INTO added_recipes (user_id, recipe_id, mon, tue, wed, thu, fri, sat, sun) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
            if($stmt = $mysqli->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("iiiiiiiii", $user_id, $recipe_id, $days_checked[0], $days_checked[1], $days_checked[2], $days_checked[3], $days_checked[4], $days_checked[5], $days_checked[6]);
            
                // Set parameters
                $user_id = $_SESSION["id"];
            
                // Attempt to execute the prepared statement
                if(!$stmt->execute())
                    echo "Oops! Something went wrong. Please try again later.";
                    
                // Close statement
                $stmt->close();
            }
        } 
    }
}
?>
<!DOCTYPE html>
<html>
<title>Rețete - Hopspreviitor</title>
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
            font-family: "Playfair Display", sans-serif
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
    <center><h1>Rețete</h1></center>
    <?php if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
            echo "<center><h4>Pentru a putea adăuga rețetele în planificator trebuie să fiți logați!</h4></center>";
    ?>
    <br><br><br>
    <!-- The Grid -->
    <div class="w3-row">
        <!-- First Column -->
        <div class="w3-col w3-row-padding m4" id="firstColumn">
            <!--<div class="w3-card w3-round w3-white w3-container">
                <p class="w3-center"><img src="photos/43photo.png" style="width:75%" alt="Poza preparat"></p>
                <h3 class="w3-center"><i class="fa fa-utensils fa-fw w3-margin-right w3-text-theme"></i> Nume
                    preparat</h3>
            </div>-->
            <!-- End First Column -->
        </div>

        <!-- Second Column -->
        <div class="w3-col w3-row-padding m4" id="secondColumn">
            <!--<div class="w3-card w3-round w3-white w3-container">
                <p class="w3-center"><img src="photos/43photo.png" style="width:75%" alt="Poza preparat"></p>
                <h3 class="w3-center"><i class="fa fa-utensils fa-fw w3-margin-right w3-text-theme"></i> Nume
                    preparat</h3>
            </div>-->
            <!-- End Second Column -->
        </div>

        <!-- Third Column -->
        <div class="w3-col w3-row-padding m4" id="thirdColumn">
            <!--<div class="w3-card w3-round w3-white w3-container">
                <p class="w3-left w3-center"><img src="photos/43photo.png" style="width:75%" alt="Poza preparat"></p>
                <h3 class="w3-center"><i class="fa fa-utensils fa-fw w3-margin-right w3-text-theme"></i> Nume
                    preparat</h3>
            </div>-->
            <!-- End Third Column -->
        </div>
        <!-- End Grid -->
    </div>
    <!-- End Page Container -->
    
    <div id="modal" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom">
            <header class="w3-container w3-teal"> 
                <span onclick="document.getElementById('modal').style.display='none'; document.getElementById('error_submit').style.display='none';" class="w3-button w3-display-topright">&times;</span>
            <h2>Selectați zilele în doriți să adăugați rețeta</h2>
            </header>
                <form action = <?php echo '"' . htmlspecialchars($_SERVER["PHP_SELF"]) . '"';?> method="post" class="w3-container">
                <input type="hidden" id="id_recipe" name="id_recipe" value="">
                    <h4>
                        <div class="w3-row-padding">
                            <div class="w3-quarter">
                                <p><input class="w3-check" type="checkbox" name="mon" value="Yes">
                                <label>Luni</label></p>
                                <p><input class="w3-check" type="checkbox" name="tue" value="Yes">
                                <label>Marți</label></p>
                            </div>
                            <div class="w3-quarter">
                                <p><input class="w3-check" type="checkbox" name="wed" value="Yes">
                                <label>Miercuri</label></p>
                                <p><input class="w3-check" type="checkbox" name="thu" value="Yes">
                                <label>Joi</label></p>
                            </div>
                            <div class="w3-quarter">
                                <p><input class="w3-check" type="checkbox" name="fri" value="Yes">
                                <label>Vineri</label></p>
                                <p><input class="w3-check" type="checkbox" name="sat" value="Yes">
                                <label>Sâmbătă</label></p>
                            </div>
                            <div class="w3-quarter">
                                <p><input class="w3-check" type="checkbox" name="sun" value="Yes">
                                <label>Duminică</label></p>
                            </div>
                        </div>
                <?php           
                    if(empty($recipe_err) && $inserted_recipe)
                        echo '<h4 id="error_submit" class="w3-text-green"> Rețeta a fost adăugată cu succes! </h4>';
                    else if($inserted_recipe)
                        echo '<h4 id="error_submit" class="w3-text-red">' . $recipe_err . '</h4>';
                ?>            
                        <p><input type="submit" class="w3-btn w3-blue-grey" value="Adaugă"></p>
                    </h4>
                </form>
        </div>
  </div>
<br><br><br><br><br><br>
</div>

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
    
    document.addEventListener("DOMContentLoaded", function() {
         if(<?php echo ($_SERVER["REQUEST_METHOD"] == "POST");?>){
            document.getElementById('id_recipe').value="<?php echo $id_recipe;?>";
            document.getElementById('modal').style.display='block';
         }
    });
    
    
</script>

<script src="preparat/retete.js"></script>
<script src="script.js"></script>

</body>

</html>