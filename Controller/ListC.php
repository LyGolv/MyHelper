<?php

require_once "config.php";
require_once "Model/Lists.php";

class ListC
{
    public function addNewList(Lists $lists): bool
    {
        $sql = "INSERT INTO list(id, nom, date_creation, date_modif, id_user) 
                VALUE (:id, :nom, :creation_date, :modif_date, :id_user)";
        try {
            $bdd = Config::getConnexion();
            $data = $bdd->prepare($sql);
            $data->bindValue(':id', $lists->getId());
            $data->bindValue(':nom', $lists->getName());
            $data->bindValue(':creation_date', $lists->getCreationDate());
            $data->bindValue(':modif_date', $lists->getModifDate());
            $data->bindValue(':id_user', $lists->getUserId());
            return $data->execute();
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }

    public function findAllUserList($user_id)
    {
        $sql = "SELECT id, nom, date_creation
                FROM list
                WHERE id_user = :user_id";
        try {
            $bdd = Config::getConnexion();
            $data = $bdd->prepare($sql);
            $data->bindValue(':user_id', $user_id);;
            $data->execute();
            return $data->fetchAll();
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }

    public function delList($id_list) {
        $sql = "DELETE FROM list 
                WHERE id = :id_list";
        try {
            $bdd = Config::getConnexion();
            $data = $bdd->prepare($sql);
            $data->bindValue(':id_list', $id_list);
            return $data->execute();
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }
}