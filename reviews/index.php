<?php
// Initialize the session
session_start();

$htmlTitle = "";

// Check if the user is logged in, if not then display that he is not currently logged in
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
    $htmlTitle = "<center><h1>Nu sunțeți logat la contul dumneavoastă, vă rugăm să vă logați pentru a vă putea vedea review-urile!<h1><center>";
else
{
    // Include config file
    require_once "config.php";
    
    // Define variables and initialize with empty values
    $review_err = "";
    $inserted_review = false;
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if(isset($_POST["review"])){
            $inserted_review = true;
 
            // Check if input field is empty
            if(empty(trim($_POST["review"]))){
                $review_err = "Câmpul introdus este gol!";
            } else{
                $review = trim($_POST["review"]);
            
            // Prepare a insert statement
            $sql = "INSERT INTO reviews (user_id, text) VALUES (?, ?)";
        
            if($stmt = $mysqli->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("is", $user_id, $review);
            
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
        else{
            // Prepare a delete statement
            $sql = "DELETE FROM reviews WHERE id = ?";
            
            if($stmt = $mysqli->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("i", $id_review_delete);
            
                // Set parameters
                $id_review_delete = (int)$_POST["id_review_delete"];
            
                // Attempt to execute the prepared statement
                if(!$stmt->execute())
                    echo "Oops! Something went wrong. Please try again later.";

                // Close statement
                $stmt->close();
            }
        } 
    }

    
    // Define variables and initialize with empty values
    $firstColumn = $secondColumn = $thirdColumn = "";
    $reviewsNumber = 0;
    $user_id = $_SESSION["id"];

    // Select statement
    $sql = "SELECT id, user_id, text FROM reviews";
    
    // Execute SQL
    $result = $mysqli->query($sql);
    
    if ($result->num_rows > 0) {
        $htmlTitle = "<center><h1>Review-urile site-ului</h1></center><br>";
        
        // Take row by row
        while($row = $result->fetch_assoc()) {
            //Separate lines in a review
            $lines = explode("\n", $row["text"]);

            $htmlCode = '<div class="w3-card-4 w3-round w3-white w3-container w3-margin-bottom">
                            <h3 class="w3-center">';

            //Take each line from the review
            foreach($lines as $line)
                $htmlCode .= $line . '<br>';

            $htmlCode .= '  </h3>';
            
            if($user_id == $row["user_id"])
                $htmlCode .='<form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post" class="w3-container w3-right">
                                <input type="hidden" name="id_review_delete" value="'.$row["id"].'">
                                <p><button type="submit" class="w3-button w3-circle w3-red w3-card-4 w3-ripple"><i class="fas fa-trash"></i></button></p>
                            </form>';
            
            $htmlCode .='</div>';

            //Verify to which column to put the code
            if($reviewsNumber % 3 == 0)
                $firstColumn .= $htmlCode;
            else if($reviewsNumber % 3 == 1)
                $secondColumn .= $htmlCode;
            else
                $thirdColumn .= $htmlCode;

            $reviewsNumber++;
        }
    }
    else
         $htmlTitle = "<center><h1>Deocamdată nu este niciun review adăugat!</h1></center><br>";
    
    $htmlTitle .= '
    <div class="w3-card-4 w3-round w3-white">
        <div class="w3-container w3-teal">
            <h2>Adaugă review</h2>
        </div>
        <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post" class="w3-container">
            <h4>
                <label class="w3-text-teal"><b>Introduceți review-ul</b></label>
                <textarea class="w3-input w3-border w3-light-grey" name="review" style="resize: vertical;height: 100px;" maxlength="1000"></textarea>';
                            
    if(empty($review_err) && $inserted_review)
        $htmlTitle .= '<h4 class="w3-text-green"> Review-ul a fost adăugat cu succes! </h4>';
    else if($inserted_review)
        $htmlTitle .= '<h4 class="w3-text-red">' . $review_err . '</h4>';
                            
    $htmlTitle .= '
            <p><input type="submit" class="w3-btn w3-blue-grey" value="Adaugă"></p>
            </h4>
        </form>
    </div><br>';
}
?>

<!DOCTYPE html>
<html>
<title>Review-uri - Hopspreviitor</title>
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
        echo $htmlTitle;
    ?>
    <br>
    <!-- The Grid -->
    <div class="w3-row">
        <!-- First Column -->
        <div class="w3-col w3-row-padding m4" id="firstColumn">
            <?php
                echo $firstColumn;
            ?>
            <!-- End First Column -->
        </div>

        <!-- Second Column -->
        <div class="w3-col w3-row-padding m4" id="secondColumn">
            <?php
                echo $secondColumn;
            ?>
            <!-- End Second Column -->
        </div>

        <!-- Third Column -->
        <div class="w3-col w3-row-padding m4" id="thirdColumn">
            <?php
                echo $thirdColumn;
            ?>
            <!-- End Third Column -->
        </div>
        <!-- End Grid -->
    </div>
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