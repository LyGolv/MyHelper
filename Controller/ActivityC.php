<?php

require_once "config.php";
require_once "Model/Activity.php";

class ActivityC
{
    public function addNewActivity(Activity $activity) {
        $sql = "INSERT INTO activity(id, texte, id_list, etat) 
                VALUE (:id, :texte, :id_list, :etat)";
        try {
            $bdd = Config::getConnexion();
            $data = $bdd->prepare($sql);
            $data->bindValue(':id', $activity->getID());
            $data->bindValue(':texte', $activity->getText());
            $data->bindValue(':id_list', $activity->getIdList());
            $data->bindValue(':etat', $activity->getState());
            return $data->execute();
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }

    public function findActivityList($listname) {
        $sql = "SELECT id, texte, etat
                FROM activity
                WHERE id_list = :listname ";
        try {
            $bdd = Config::getConnexion();
            $data = $bdd->prepare($sql);
            $data->bindValue(':listname', $listname);
            $data->execute();
            return $data->fetchAll();
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }

    public function findActivityListToDo($listname) {
        $sql = "SELECT id, texte, etat
                FROM activity
                WHERE id_list = :listname and etat = 0 ";
        try {
            $bdd = Config::getConnexion();
            $data = $bdd->prepare($sql);
            $data->bindValue(':listname', $listname);
            $data->execute();
            return $data->fetchAll();
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }

    public function findActivityListDone($listname) {
        $sql = "SELECT id, texte, etat
                FROM activity
                WHERE id_list = :listname and etat = 1 ";
        try {
            $bdd = Config::getConnexion();
            $data = $bdd->prepare($sql);
            $data->bindValue(':listname', $listname);
            $data->execute();
            return $data->fetchAll();
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }

    public function delActivity($id) {
        $sql = "DELETE FROM activity 
                WHERE id = :id_activity";
        try {
            $bdd = Config::getConnexion();
            $data = $bdd->prepare($sql);
            $data->bindValue(':id_activity', $id);
            return $data->execute();
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }

    public function updateActivityState($id, $etat) {

        $sql = "UPDATE activity
                SET etat = :etat
                WHERE id = :id";
        try {
            $bdd = Config::getConnexion();
            $data = $bdd->prepare($sql);
            $data->bindValue(':id', $id);
            $data->bindValue(':etat', $etat);
            return $data->execute();
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }
}