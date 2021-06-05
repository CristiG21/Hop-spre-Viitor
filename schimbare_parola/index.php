<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: https://hopspreviitor.ro/login/");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$change_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $change_password_err = "Vă rugăm introduceți parola nouă. ";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $change_password_err = "Parola trebuie să aibă cel puțin 6 caractere. ";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $change_password_err = "Vă rugăm confirmați parola. ";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($change_password_err) && ($new_password != $confirm_password)){
            $change_password_err .= "Parolele nu se potrivesc. ";
        }
    }
        
    // Check input errors before updating the database
    if(empty($change_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: https://hopspreviitor.ro/login/");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Schimbare parolă - Hopspreviitor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>
<body class="img js-fullheight" style="background-image: url(images/bg.jpg); background-attachment: fixed;">
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Schimbare parolă Hopspreviitor</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <br><br>
                    <?php 
                        if(!empty($change_password_err)){
                            echo '<div class="alert alert-danger">' . $change_password_err . '</div>';
                        }        
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="signin-form">
                        <div class="form-group">
                            <input id="password-field" type="password" name="new_password" class="form-control" placeholder="Parola nouă">
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input id="password-field2" type="password" name="confirm_password" class="form-control" placeholder="Confirmă parola">
                            <span toggle="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <br><br>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Resetează parola</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>

