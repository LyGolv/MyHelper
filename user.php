<?php

require_once "Controller/UserC.php";

session_start();

$userC = new UserC();

$passmodif = 0 ;

if (isset($_POST["old-pwd"]) && isset($_POST["new-pwd"]) && isset($_POST["new-pwd-confirm"])) {
    if ($_SESSION["user_password"] === $_POST["old-pwd"]) {
        $_SESSION['user_password_new'] = $_POST["new-pwd"];
        $passmodif = 1;
    }
}

if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_FILES['profile-file']))
{
    if (!empty($_POST['nom'])) {
        $extFile = ['png', 'jpg', 'jpeg', 'bmp'];
        $test = 0;
        $file = pathinfo($_FILES['profile-file']['name']);
        if (isset($file['extension'])) {
            if (in_array($file['extension'], $extFile) && $_FILES['profile-file']['size'] <= 5000000) //5Mo
                $test = 1;
            if ($test) {
                $localFile = "images/profile/";
                $pathImage = $localFile . strtolower(str_replace(' ', '',
                            $_POST['nom']) . '.' . $file['extension']);
                move_uploaded_file($_FILES['profile-file']['tmp_name'], $pathImage);
            }
        } else {
            $pathImage = $_SESSION['user_image'];
            $test = 1;
        }
        if ($test) {
            if ($passmodif)
                $pass = $_SESSION['user_password_new'];
            else
                $pass = $_SESSION["user_password"];
            $user = new User($_SESSION['user_id'], $_POST['nom'], $_POST['prenom'], $_POST['mail'],
                $pass);
            $user->setImage($pathImage);
            $userC->updateUserInfo($user);

            $_SESSION['user_name'] = $_POST['nom'];
            $_SESSION['user_surname'] = $_POST['prenom'];
            $_SESSION['user_image'] = $pathImage;
            $_SESSION['user_email'] = $_POST['mail'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE-edge" />
    <meta name="viewport" content="width=device-width, initial-scale-1.0" />
    <title>WebCV</title>
    <link rel="icon" type="image/x-icon" href="images/logo-icon.svg" />
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
          rel="stylesheet">

    <!-- CSS IMPORTATION -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/navbar.css" rel="stylesheet" type="text/css" />
    <link href="css/sidebar.css" rel="stylesheet" type="text/css" />
    <link href="css/user.css" rel="stylesheet" type="text/css" />

    <script>
        let password = <?php echo json_encode($_SESSION['user_password']); ?>;
    </script>

</head>

<body>
    <!---------- BEGIN NAVBAR ---------------->
    <?php require_once "navbar.php"; ?>
    <!---------- END OF NAVBAR ---------------->

    <div class="container">
        <!----------------------- BEGIN ASIDE -------------------->
        <?php require_once "sidebar.php" ?>
        <!----------------------- END OF ASIDE -------------------->

        <!----------------------- BEGIN MAIN ---------------------->
        <main>
            <h1>User Profile</h1>
            &nbsp;
            <div class="card">
                <form action="user.php" method="post" enctype="multipart/form-data">
                    <div class="user-photo">
                        <div class="photo">
                            <img class="img_profile_photo" src="<?php echo $_SESSION['user_image']; ?>"
                                 alt="photo de profile de l'utilisateur">
                        </div>
                        <label for="profile-file"><span class="material-icons-sharp add-photo">add_a_photo</span></label>
                        <input type="file" id="profile-file" name="profile-file" onChange="changeProfilePhoto(this);"
                               accept="image/png, image/gif, image/jpeg" hidden>
                    </div>

                    <div class="user-info">
                        <h1>Profile Informations</h1>
                            <label for="nom">Nom: </label>
                            <input type="text" name="nom" value="<?php echo $_SESSION['user_name']; ?>" >
                            <label for="prenom">Prénom: </label>
                            <input type="text" name="prenom" value="<?php echo $_SESSION['user_surname']; ?>">
                            <label for="mail">Mail: </label>
                            <input type="email" name="mail" value="<?php echo $_SESSION['user_email']; ?>">
                            <label for="pwd">Password: </label>
                            <div class="user-pwd">
                                <input type="password" name="pwd" value="baalabla" readonly>
                                <a href="#edit-pwd">Edit Password</a>
                            </div>
                            <?php
                                if ($passmodif) echo '<i style="color: var(--color-danger);">"votre mot de mot de passe 
                            à été modifier, enrigistrer vos information pour la conserver" </i>';
                            ?>

                            <div class="profile-action">
                                <div></div>
                                <button type="submit" class="user-action">
                                    <span class="material-icons-sharp">save</span>
                                    Enregistrer
                                </button>
                            </div>
                    </div>
                </form>
            </div>
        </main>
        <!----------------------- END MAIN ---------------------->
    </div>

    <!----------- MODAL SCREEN --------------->
    <div class="modal edit-pwd" id="edit-pwd">
        <div class="modal_content">
            <h1>🖋️ Modifier votre mot de passe</h1>
            <form action="#" method="post" onsubmit="return textPwd()" class="form-pwd">
                <label for="">Ancien mot de passe</label>
                <input type="password" name="old-pwd" id="old-pwd" placeholder="mot de passe actuel">
                <span id="milkey" style="color: var(--color-danger); margin-top: -1rem; margin-bottom: 1rem"></span>
                <label for="">Nouveau mot de passe</label>
                <input type="password" name="new-pwd" id="new-pwd" placeholder="nouveau mot de passe">
                <label for="">Confirmation de mot de passe</label>
                <input type="password" name="new-pwd-confirm" id="new-pwd-confirm"
                       placeholder="confirmer le nouveau mdp">
                <span id="equality" style="color: var(--color-danger); margin-top: -1rem; margin-bottom: 1rem"></span>
                <input type="submit" class="a_button" value="Modifier">
            </form>
            <a href="#" class="modal_close">&times;</a>
        </div>
    </div>


    <!-- SCRIPT IMPORTATION -->
    <script src="js/index.js" type="text/javascript"></script>
    <script>
        function textPwd() {
            let value = document.getElementById('old-pwd').value;
            console.log(value);
            console.log(password);
            if (password !== value) {
                document.getElementById("milkey").innerText = ">> mot de passe incorrect !!!";
                return false;
            }

            if (document.getElementById('new-pwd').value === ""
                || document.getElementById('new-pwd-confirm').value === "") {
                document.getElementById("equality").innerText = ">> Veuillez saisir un mot de passe !!!";
                return false;
            }

            if (document.getElementById('new-pwd').value !== document.getElementById('new-pwd-confirm').value) {
                document.getElementById("equality").innerText = ">> Les 02 mots de passe ne sont pas les mêmes !!!";
                return false;
            }
            return true;
        }
    </script>
</body>
</html>