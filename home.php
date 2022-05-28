<?php

require_once "Controller/ListC.php";
require_once "Controller/ActivityC.php";
require_once "Controller/UUID.php";

session_start();

$listC = new ListC();
$activityC = new ActivityC();

if (isset($_POST['newlist'])) {
    if (!empty($_POST["newlist"])) {
        $list = new Lists(UUID::generateID(), $_POST['newlist'], date("Y-m-d"), date("Y-m-d"), $_SESSION["user_id"]);
        $listC->addNewList($list);
    }
}

if (isset($_POST['selectList'])) {
    if (!empty($_POST["selectList"])) {
        $_SESSION["ActualListID"] = $_POST['selectList'];
        $_SESSION["ActualListName"] = $_POST['selectListName'];
    }
}

if (isset($_POST['activity'])) {
    if (!empty($_POST["activity"])) {
        $myactivity = new Activity(UUID::generateID(), $_POST['activity'], $_SESSION["ActualListID"], 0);
        $activityC->addNewActivity($myactivity);
    }
}

if (isset($_POST['del_activity'])) {
    if (!empty($_POST["id_activity"])) {
        $activityC->delActivity($_POST["id_activity"]);
    }
}

if (isset($_POST['del_list'])) {
    if (!empty($_POST["id_list"])) {
        $listC->delList($_POST["id_list"]);
        $_SESSION["ActualListID"] = "";
        $_SESSION["ActualListName"] = "";
    }
}

if (isset($_POST['my_id_activity'])) {
    if (!empty($_POST["my_id_activity"])) {
        if ($_POST["changeState"] == "0")
            $etat = 1;
        else
            $etat = 0;
        $activityC->updateActivityState($_POST["my_id_activity"], $etat);
    }
}

$activityListToDo = $activityC->findActivityListToDo($_SESSION["ActualListID"]);
$activityListDone = $activityC->findActivityListDone($_SESSION["ActualListID"]);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE-edge" />
    <meta name="viewport" content="width=device-width, initial-scale-1.0" />
    <title>MyHelper</title>
    <link rel="icon" type="image/x-icon" href="images/logo-icon.svg" />
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
          rel="stylesheet">

    <!-- CSS IMPORTATION -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/user.css" rel="stylesheet" type="text/css" />
    <link href="css/navbar.css" rel="stylesheet" type="text/css" />
    <link href="css/sidebar.css" rel="stylesheet" type="text/css" />
    <link href="css/home.css" rel="stylesheet" type="text/css" />

</head>

<body>
<!---------- BEGIN NAVBAR ---------------->
<?php include_once("navbar.php") ?>
<!---------- END OF NAVBAR ---------------->

<div class="container">
    <!----------------------- BEGIN ASIDE --------------------->
    <?php include_once("sidebar.php") ?>
    <!----------------------- END OF ASIDE -------------------->

    <!----------------------- BEGIN MAIN ---------------------->
    <main>
        <h1>Dashboard</h1>
        &nbsp;<?php if ($_SESSION["ActualListID"] != "") {?>
        <div class="list">
            <h2 class="listname">
                <?php echo $_SESSION["ActualListName"] ?>

                <form action="home.php" method="post">
                    <input type="text" name="id_list" value="<?php echo $_SESSION["ActualListID"];?>" hidden>
                    <input type="text" name="edit_list" hidden>
                    <button type="submit" class="button_icon-setter">
                        <span class="material-icons-sharp icon-setter edit-activity">edit</span>
                    </button>
                </form>
                <form action="home.php" method="post">
                    <input type="text" name="id_list" value="<?php echo $_SESSION["ActualListID"];?>" hidden>
                    <input type="text" name="del_list" hidden>
                    <button type="submit" class="button_icon-setter">
                        <span class="material-icons-sharp icon-setter del-activity">delete</span>
                    </button>
                </form>
            </h2>
            <?php $rows = $listC->findAllUserList($_SESSION["user_id"]); ?>

            <div class="state todo-activity">
                To Do
            </div>
            <?php
            foreach ($activityListToDo as $activity) {
            ?>
            <div class="activity item">
                <form action="home.php" method="post">
                    <input type="text" name="my_id_activity" value="<?php echo $activity['id'];?>" hidden>
                    <input type="text" name="changeState" value="<?php echo $activity['etat'];?>" hidden>
                    <button type="submit" class="button_icon-setter">
                        <div class="cercle without-check-mark"></div>
                    </button>
                </form>
                <?php echo $activity['texte']; ?>
                <form action="home.php" method="post">
                    <input type="text" name="id_activity" value="<?php echo $activity['id'];?>" hidden>
                    <input type="text" name="del_activity" hidden>
                    <button type="submit" class="button_icon-setter">
                        <span class="material-icons-sharp icon-setter del-activity">delete</span>
                    </button>
                </form>
            </div>
            <?php
            }
            ?>

            <div class="state done-activity">
                Done
            </div>
            <?php
            foreach ($activityListDone as $activity) {
                ?>
                <div class="activity item">
                    <form action="home.php" method="post">
                        <input type="text" name="my_id_activity" value="<?php echo $activity['id'];?>" hidden>
                        <input type="text" name="changeState" value="<?php echo $activity['etat'];?>" hidden>
                        <button type="submit" class="button_icon-setter">
                            <div class="cercle with-check-mark"></div>
                        </button>
                    </form>
                    <span class="activity-text"><?php echo $activity['texte']; ?> </span>
                    <form action="home.php" method="post">
                        <input type="text" name="id_activity" value="<?php echo $activity['id'];?>" hidden>
                        <input type="text" name="del_activity" hidden>
                        <button type="submit" class="button_icon-setter">
                            <span class="material-icons-sharp icon-setter del-activity">delete</span>
                        </button>
                    </form>
                </div>
                <?php
            }
            ?>

            <div class="item add-activity">
                <div>
                    <span class="material-icons-sharp">add</span>
                </div>
                <form action="home.php" method="post">
                    <input type="text" value="<?php echo $_SESSION["ActualListID"]; ?>" hidden>
                    <input type="text" name="activity" placeholder="Ajouter une activité" />
                    <input type="submit" hidden />
                </form>
            </div>
        </div>
        <?php } ?>
    </main>
    <!----------------------- END OF MAIN --------------------->

    <!----------------------- BEGIN RIGHT ---------------------->
    <div class="right">
        <div class="sales-analytics">
            <h2>Vos Listes</h2>
            <div class="myLists">
                <?php
                    $rows = $listC->findAllUserList($_SESSION["user_id"]);
                    foreach ($rows as $row) {
                        ?>
                <form action="home.php" method="post">
                    <input type="text" name="selectList" value="<?php echo $row['id'] ?>" hidden>
                    <input type="text" name="selectListName" value="<?php echo $row['nom'] ?>" hidden>
                    <button type="submit" class="button_list">
                        <div class="item list-item">
                            <div class="icon"></div>
                            <div class="right">
                                <div class="info">
                                    <h3><?php echo $row['nom'] ?></h3>
                                    <small class="text-muted"><?php echo $row['date_creation'] ?></small>
                                </div>
                            </div>
                        </div>
                    </button>
                </form>
                <?php
                    }
                ?>
            </div>

            <a href="#newlist" class="item add-product">
                <div>
                    <span class="material-icons-sharp">add</span>
                </div>
                <h3>Ajouter une nouvelle liste</h3>
            </a>
        </div>
    </div>
    <!----------------------- END OF RIGHT --------------------->
</div>

<!----------- MODAL SCREEN --------------->
<div class="modal welcome" id="welcome">
    <div class="modal_content">
        <h1>👋 Bienvenue sur notre site 🔮</h1>
        <p>
            MyHelper est un site proposant de nombreuses fonctionnalités <br>
            qui te permettront de gagner du temps et de suivre l'évolution <br>
            de tes activités.
        </p>
        <p>
            Avant de commencer, tu dois créer une liste dans laquelle <br>
            tu mettras les activités que tu veux gérer
        </p>
        <a href="#newlist" class="a_button">
            <span class="material-icons-sharp">add</span>
            Créer une nouvelle liste
        </a>
    </div>
</div>

<div class="modal newlist" id="newlist">
    <div class="modal_content">
        <h1>➕ Créer une nouvelle list ✨</h1>
        <form action="#" method="post">
            <div class="newlist-name">
                <input type="text" name="newlist" placeholder="Nom de la liste">
            </div>
            <input type="submit" class="a_button" value="Add">
        </form>

        <a href="#" class="modal_close">&times;</a>
    </div>
</div>


<!-- SCRIPT IMPORTATION -->
<script src="js/index.js" type="text/javascript"></script>
</body>
</html>