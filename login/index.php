<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: https://hopspreviitor.ro/");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $login_err .= "Vă rugăm introduceți numele de utilizator. ";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $login_err .= "Vă rugăm introduceți parola. ";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($login_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($id, $username, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: https://hopspreviitor.ro/");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Numele de utilizator sau parola greșită!";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Numele de utilizator sau parola greșită!";
                }
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
    <title>Login - Hopspreviitor</title>
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
                <h2 class="heading-section">Login Hopspreviitor</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center">Ai deja cont?</h3>
                    <?php 
                        if(!empty($login_err)){
                            echo '<div class="alert alert-danger">' . $login_err . '</div>';
                        }        
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="signin-form">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" placeholder="Nume de utilizator" value="<?php echo $username; ?>">
                        </div>
                        <div class="form-group">
                            <input id="password-field" type="password" name="password" class="form-control" placeholder="Parolă">
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Autentifică-te</button>
                        </div>
                    </form>
                    <br><br>
                    <button onclick="location.href='https://hopspreviitor.ro/signup/'" class="form-control btn btn-primary px-3">Nu ai cont? Creează unul acum!</button>
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

