<?php
// Initialize the session
session_start();

// Check if the user is logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    // Include config file
    require_once "config.php";
    
    // Define variables and initialize with empty values
    $recipe = $recipe_err = "";
    $inserted_recipe = false;
    $days = array("mon","tue","wed","thu","fri","sat","sun");
    $days_checked = array(0,0,0,0,0,0,0,0);
    $number_days_checked = 0;
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(isset($_POST["recipe"])){
            $inserted_recipe = true;
            
             // Check if input field is empty
            if(empty(trim($_POST["recipe"])))
                $recipe_err .= "Câmpul introdus este gol.";
            else
                $recipe = trim($_POST["recipe"]);
            
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
                $recipe_err .= " Nu ați selectat nicio zi.";
 
            // Check if there are not errors
            if(empty($recipe_err)){
                // Prepare a insert statement
                $sql = "INSERT INTO recipes (user_id, text, mon, tue, wed, thu, fri, sat, sun) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
                if($stmt = $mysqli->prepare($sql)){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bind_param("isiiiiiii", $user_id, $recipe, $days_checked[0], $days_checked[1], $days_checked[2], $days_checked[3], $days_checked[4], $days_checked[5], $days_checked[6]);
            
                    // Set parameters
                    $user_id = $_SESSION["id"];
            
                    // Attempt to execute the prepared statement
                    if($stmt->execute())
                        $recipe = "";
                    else
                        echo "Oops! Something went wrong. Please try again later.";
                    // Close statement
                    $stmt->close();
                }
            } 
        }
        else if(isset($_POST["id_recipe_delete"])){
            // Prepare a update statement
            $sql = "UPDATE recipes SET " . $days[(int)$_POST["number_day_delete"]] . "  = 0 WHERE id = ?";
            
            if($stmt = $mysqli->prepare($sql)){
                
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("i", $id_recipe_delete);
                
                // Set parameters
                $id_recipe_delete = (int)$_POST["id_recipe_delete"];
                
                // Attempt to execute the prepared statement
                if(!$stmt->execute())
                    echo "Oops! Something went wrong. Please try again later.";

                // Close statement
                $stmt->close();
            }
            
            // Prepare a select statement
            $sql = "SELECT mon, tue, wed, thu, fri, sat, sun FROM recipes WHERE id = ?";
            
            if($stmt = $mysqli->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("i", $id_recipe_delete);

                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    $daysResults = array();
                    
                    $atleastOneDay = false;

                    // Bind result variables
                    $stmt->bind_result($daysResults[0], $daysResults[1], $daysResults[2], $daysResults[3], $daysResults[4], $daysResults[5], $daysResults[6]);
                    
                    if($stmt->fetch())
                        for($i = 0; $i < 7; $i++)
                            if($daysResults[$i])
                                $atleastOneDay = true;
                                
                    $stmt->close();
                    
                    if(!$atleastOneDay)
                    {
                        // Prepare a delete statement
                        $sql = "DELETE FROM recipes WHERE id = ?";
            
                        if($stmt = $mysqli->prepare($sql)){
                
                            // Bind variables to the prepared statement as parameters
                            $stmt->bind_param("i", $id_recipe_delete);
                
                            // Attempt to execute the prepared statement
                            if(!$stmt->execute())
                                echo "Oops! Something went wrong. Please try again later.";

                            // Close statement
                            $stmt->close();
                        }
                    }
                }
            }
        }
        else {
            // Prepare a update statement
            $sql = "UPDATE added_recipes SET " . $days[(int)$_POST["number_day_delete"]] . "  = 0 WHERE id = ?";
            
            if($stmt = $mysqli->prepare($sql)){
                
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("i", $id_predefined_recipe_delete);
                
                // Set parameters
                $id_predefined_recipe_delete = (int)$_POST["id_predefined_recipe_delete"];
                
                // Attempt to execute the prepared statement
                if(!$stmt->execute())
                    echo "Oops! Something went wrong. Please try again later.";

                // Close statement
                $stmt->close();
            }
            
            // Prepare a select statement
            $sql = "SELECT mon, tue, wed, thu, fri, sat, sun FROM added_recipes WHERE id = ?";
            
            if($stmt = $mysqli->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("i", $id_predefined_recipe_delete);

                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    $daysResults = array();
                    
                    $atleastOneDay = false;

                    // Bind result variables
                    $stmt->bind_result($daysResults[0], $daysResults[1], $daysResults[2], $daysResults[3], $daysResults[4], $daysResults[5], $daysResults[6]);
                    
                    if($stmt->fetch())
                        for($i = 0; $i < 7; $i++)
                            if($daysResults[$i])
                                $atleastOneDay = true;
                                
                    $stmt->close();
                    
                    if(!$atleastOneDay)
                    {
                        // Prepare a delete statement
                        $sql = "DELETE FROM added_recipes WHERE id = ?";
            
                        if($stmt = $mysqli->prepare($sql)){
                
                            // Bind variables to the prepared statement as parameters
                            $stmt->bind_param("i", $id_predefined_recipe_delete);
                
                            // Attempt to execute the prepared statement
                            if(!$stmt->execute())
                                echo "Oops! Something went wrong. Please try again later.";

                            // Close statement
                            $stmt->close();
                        }
                    }
                }
            }
        }
    }
    
    class Day {
        private $firstColumn;
        private $secondColumn;
        private $thirdColumn;
        private $recipesNumber;
        private $dayName;
        private $dayNumber;
        
        function __construct($dayName,$dayNumber) {
            $this->firstColumn = $this->secondColumn = $this->thirdColumn = "";
            $this -> recipesNumber = 0;
            $this -> dayName = $dayName;
            $this -> dayNumber = $dayNumber;
        }
        
        function addRecipe($text, $id){
            //Separate lines in a list
            $lines = explode("\n",$text);

            $htmlCode = '<div class="w3-card-4 w3-round w3-white w3-container w3-margin-bottom">
                            <h3 class="w3-center">';

            //Take each line from the list
            foreach($lines as $line){
                $htmlCode .= $line . '<br>';
            }

            $htmlCode .= '  </h3>
                            <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post" class="w3-container w3-right">
                                <input type="hidden" name="id_recipe_delete" value="'.$id.'">
                                <input type="hidden" name="number_day_delete" value="'.$this->dayNumber.'">
                                <p><h3><button type="submit" class="w3-button w3-circle w3-red w3-card-4 w3-ripple"><i class="fas fa-trash"></i></button></h3></p>
                            </form>
                        </div>';

            //Verify to which column to put the code
            if($this->recipesNumber % 3 == 0)
                $this->firstColumn .= $htmlCode;
            else if($this->recipesNumber % 3 == 1)
                $this->secondColumn .= $htmlCode;
            else
                $this->thirdColumn .= $htmlCode;

            $this->recipesNumber++;
        }
        
        function addPredefinedRecipe($image, $name, $id){
            $htmlCode = '<div class="w3-card-4 w3-round w3-white w3-container w3-margin-bottom">
                            <p class="w3-center"><a href="https://hopspreviitor.ro/retete/preparat/?nume=' . $name .'"><img src="https://hopspreviitor.ro/assets/images/' . $image . '" style="width:75%; cursor: pointer;" class="w3-hover-opacity" alt="Poza ' . $name .'"></a></p>
                            <h3 class="w3-center">' . $name . '</h3>
                            <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post" class="w3-container w3-right">
                                <input type="hidden" name="id_predefined_recipe_delete" value="'.$id.'">
                                <input type="hidden" name="number_day_delete" value="'.$this->dayNumber.'">
                                <p><h3><button type="submit" class="w3-button w3-circle w3-red w3-card-4 w3-ripple"><i class="fas fa-trash"></i></button></h3></p>
                            </form>
                        </div>';

            //Verify to which column to put the code
            if($this->recipesNumber % 3 == 0)
                $this->firstColumn .= $htmlCode;
            else if($this->recipesNumber % 3 == 1)
                $this->secondColumn .= $htmlCode;
            else
                $this->thirdColumn .= $htmlCode;

            $this->recipesNumber++;
        }
        
        function makeHTML()
        {
            //Verify if we have lists in this day
            if($this->recipesNumber == 0)
                return "";
            // Make code  
            return '<center><h2>'.$this->dayName.'</h2></center><br>
                        <div class="w3-row">
                            <div class="w3-col w3-row-padding m4">' . $this->firstColumn .'</div>
                            <div class="w3-col w3-row-padding m4">' . $this->secondColumn .'</div>
                            <div class="w3-col w3-row-padding m4">' . $this->thirdColumn .'</div>
                        </div>';
        }
    }
    
    $atleastOne = false;
    $daysResults = array();
    $daysObjects[] = new Day("Luni","0");
    $daysObjects[] = new Day("Marți","1");
    $daysObjects[] = new Day("Miercuri","2");
    $daysObjects[] = new Day("Joi","3");
    $daysObjects[] = new Day("Vineri","4");
    $daysObjects[] = new Day("Sâmbătă","5");
    $daysObjects[] = new Day("Duminică","6");
    
    // Prepare a select statement
    $sql = "SELECT added_recipes.id, predefined_recipes.name, predefined_recipes.image, added_recipes.mon, added_recipes.tue, added_recipes.wed, added_recipes.thu, added_recipes.fri, added_recipes.sat, added_recipes.sun FROM added_recipes INNER JOIN predefined_recipes ON predefined_recipes.id = added_recipes.recipe_id WHERE added_recipes.user_id = ?";

    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $user_id);

        // Set parameters
        $user_id = $_SESSION["id"];

        // Attempt to execute the prepared statement
        if($stmt->execute()){

            // Store result
            $stmt->store_result();
                
            // Check if username has any lists, if yes then show them
            if($stmt->num_rows > 0){
            
                $atleastOne = true;

                // Bind result variables
                $stmt->bind_result($id, $name, $image, $daysResults[0], $daysResults[1], $daysResults[2], $daysResults[3], $daysResults[4], $daysResults[5], $daysResults[6]);

                //Take recipe by recipe
                while($stmt->fetch())
                    for($i = 0; $i < 7; $i++)
                        if($daysResults[$i])
                            $daysObjects[$i]->addPredefinedRecipe($image,$name,$id);
                
            }
         }
         else{
             echo "Oops! Something went wrong. Please try again later.";
         }

         // Close statement
         $stmt->close();
    }
    
    // Prepare a select statement
    $sql = "SELECT id, text, mon, tue, wed, thu, fri, sat, sun FROM recipes WHERE user_id = ?";

    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $user_id);

        // Set parameters
        $user_id = $_SESSION["id"];

        // Attempt to execute the prepared statement
        if($stmt->execute()){

            // Store result
            $stmt->store_result();
                
            // Check if username has any lists, if yes then show them
            if($stmt->num_rows > 0){
            
                $atleastOne = true;

                // Bind result variables
                $stmt->bind_result($id, $text, $daysResults[0], $daysResults[1], $daysResults[2], $daysResults[3], $daysResults[4], $daysResults[5], $daysResults[6]);

                //Take recipe by recipe
                while($stmt->fetch())
                    for($i = 0; $i < 7; $i++)
                        if($daysResults[$i])
                            $daysObjects[$i]->addRecipe($text,$id);
            }
         }
         else{
             echo "Oops! Something went wrong. Please try again later.";
         }

         // Close statement
         $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<title>Planificare mese - Hopspreviitor</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-green.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Playfair+Display'>

<head>
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
    <?php
        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
            echo "<center><h1>Nu sunțeți logat la contul dumneavoastă, vă rugăm să vă logați pentru a vă putea vedea portofoliul de rețete!</h1></center>";
        else {
            if($atleastOne)
                echo "<center><h1>Planul meu</h1></center><br>";
            else    
                echo "<center><h1>Deocamdată nu ai nicio rețetă adăugată!</h1></center><br>";
                
                $htmlTitle .= '
                <div class="w3-card-4 w3-round w3-white">
                    <div class="w3-container w3-teal">
                        <h2>Adaugă rețetă</h2>
                    </div>
                    <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post" class="w3-container">
                        <h4>
                            <label class="w3-text-teal"><b>Introduceți rețeta</b></label>
                            <textarea class="w3-input w3-border w3-light-grey" name="recipe" style="resize: vertical;height: 100px;">'.$recipe.'</textarea>
                            <label class="w3-text-teal"><b>Selectați zilele</b></label>
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
                            </div>';
                            
                if(empty($recipe_err) && $inserted_recipe)
                    $htmlTitle .= '<h4 class="w3-text-green"> Rețeta a fost adăugată cu succes! </h4>';
                else if($inserted_recipe)
                    $htmlTitle .= '<h4 class="w3-text-red">' . $recipe_err . '</h4>';
                            
                $htmlTitle .= '
                        <p><input type="submit" class="w3-btn w3-blue-grey" value="Adaugă"></p>
                        </h4>
                    </form>
                </div><br>';
                
                echo $htmlTitle;
        }
    ?>
    <?php
        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $atleastOne){
            $htmlCode = "";
            for ($i = 0; $i < 7; $i++)
                $htmlCode .= $daysObjects[$i]->makeHTML();
            echo $htmlCode;
        }
    ?>
    <br>
    <!-- End Page Container -->
    <br><br><br><br>
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
</script>

</body>

</html>