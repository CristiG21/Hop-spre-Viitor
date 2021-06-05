<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $email = $password = $confirm_password = "";
$all_fields = true;
$signup_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $all_fields = false;
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $signup_err .= "Numele de utilizator este deja folosit. ";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Validate email
    if(empty(trim($_POST["email"]))){
        $all_fields = false;
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $all_fields = false;     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $signup_err .= "Parola trebuie să aibă cel putin 6 caractere. ";
        $password = trim($_POST["password"]);
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $all_fields = false;    
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password) && empty($signup_err)){
            $signup_err .= "Parolele introduse nu se potrivesc. ";
        }
    }
    
    // Check input errors before inserting in database
    if($all_fields && empty($signup_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: https://hopspreviitor.ro/login/");
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
    <title>Signup - Hopspreviitor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>
<body class="img js-fullheight" style="background-image: url(images/bg.jpg);background-attachment: fixed;">
<section class="">
    <div class="container">
        <br><br><br>
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h2 class="heading-section">Bine ai venit!</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center">Vrei sa te alaturi misiunii noastre de a salva planeta?<br>Creeaza un cont chiar acum!</h3>
                    <?php
                        if(!$all_fields){
                             echo '<div class="alert alert-danger">Vă rugăm completați toate câmpurile.</div>';
                        }
                        else if(!empty($signup_err)){
                            echo '<div class="alert alert-danger">' . $signup_err . '</div>';
                        }        
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="signin-form">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" placeholder="Nume de utilizator" value="<?php echo $username; ?>">
                        </div>
                         <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>">
                        </div>
                        <div class="form-group">
                            <input id="password-field" type="password" name="password" class="form-control" placeholder="Parolă" value="<?php echo $password; ?>">
                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input id="password-field2" type="password" name="confirm_password" class="form-control" placeholder="Confirmă parola" value="<?php echo $confirm_password; ?>">
                            <span toggle="#password-field2" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Creează cont</button>
                        </div>
                    </form>
                    <button onclick="location.href='https://hopspreviitor.ro/login/'" class="form-control btn btn-primary px-3">Ai cont? Autentifică-te acum!</button>
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

