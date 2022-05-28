<!DOCTYPE html>
<html lang="fr">

<?php

session_start();

require_once "Controller/UserC.php";
require_once "Controller/UUID.php";

$userC = new UserC;

$signin_error = 0;
if(isset($_POST['email_signin']) && isset($_POST['password_signin']))
{
    if(!empty($_POST['email_signin']) && !empty($_POST['password_signin']))
    {
        $row = $userC->loginUser($_POST['email_signin'], $_POST['password_signin']);
        if ($row) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['nom'];
            $_SESSION['user_surname'] = $row['prenom'];
            $_SESSION['user_image'] = $row['image'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_password'] = $row['password'];
            $_SESSION["ActualListID"] = "";
            $_SESSION["ActualListName"] = "";
            $_SESSION["newUser"] = 1;

            header("Location: home.php");
            die();
        }
        else
            $signin_error = 1;
    }
}

if(isset($_POST['name_signup']) && isset($_POST['surname_signup'])
    && isset($_POST['email_signup']) && isset($_POST['password_signup']))
{
    if(!empty($_POST['name_signup']) && !empty($_POST['surname_signup'])
        && !empty($_POST['email_signup']) && !empty($_POST['password_signup']))
    {
        $id = UUID::generateID();
        $user = new User($id, $_POST['name_signup'], $_POST['surname_signup'],
            $_POST['email_signup'], $_POST['password_signup']);
        if($userC->addNewUser($user)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $_POST['name_signup'];
            $_SESSION['user_surname'] = $_POST['surname_signup'];
            $_SESSION['user_image'] = "images/profile/profile-1.jpg";
            $_SESSION['user_email'] = $_POST['email_signup'];
            $_SESSION['user_password'] = $_POST['password_signup'];
            $_SESSION["ActualListID"] = "";
            $_SESSION["ActualListName"] = "";
            $_SESSION["newUser"] = 1;
            header("Location: home.php#welcome");
            die();
        }
    }
}

$test_signup = 0;
if(isset($_POST['name_signup']) || isset($_POST['surname_signup'])
    || isset($_POST['email_signup']) || isset($_POST['password_signup']))
    $test_signup = 1;

?>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE-edge" />
    <meta name="viewport" content="width=device-width, initial-scale-1.0" />
    <title>MyHelper</title>
    <link rel="icon" type="image/x-icon" href="images/logo-icon.svg" />
    <link rel="stylesheet" href="css/sign_in-up.css" />
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
          rel="stylesheet">
</head>

<body>
    <div class="container <?php if($test_signup) echo "right-panel-active"; ?>" id="container">
        <!-- SIGN UP -->
        <div class="form-container sign-up-container">
            <form action="sign_in-up.php" method="post">
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>Fill in your information in the input field</span>
                <input name="name_signup" type="text" placeholder="Name" />
                <input name="surname_signup" type="text" placeholder="Surname" />
                <input name="email_signup" type="email" placeholder="Email" />
                <input name="password_signup" type="password" placeholder="Password" required/>
                <span class="material-icons-sharp eye" id="eye_signup">visibility_off</span>
                <button>Sign Up</button>
            </form>
        </div>

        <!-- SIGN IN -->
        <div class="form-container sign-in-container">
            <form action="sign_in-up.php" method="post">
                <h1>Sign in</h1>
                <div class="social-container">
                    <a href="#" class="social">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social">
                        <i class="fab fa-google-plus-g"></i>
                    </a>
                    <a href="#" class="social">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
                <span>Enter your information to login</span>
                <input name="email_signin" type="text" placeholder="Email/Username" required/>
                <input name="password_signin" type="password" placeholder="Password" required/>
                <span class="material-icons-sharp eye" id="eye_signin">visibility_off</span>
                <?php if($signin_error) echo "<p style='color:red'>Nom d'utilisateur ou mot de passe incorrect</p>" ?>
                <a href="#">Forgot your password?</a>
                <button>Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>You don't have an account, go sign up and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/sign_in-up.js" type="text/javascript"></script>
</body>

</html>