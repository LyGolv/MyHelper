<?php

define('__ROOT__', dirname(__FILE__, 2));

require_once(__ROOT__.'/config.php');
require_once(__ROOT__.'/Model/User.php');

class UserC {

    public function addNewUser(User $user): bool
    {
        $sql = "INSERT INTO user(id, nom, prenom, email, password) 
                VALUE (:id, :nom, :prenom, :email, :pass)";
        try {
            $bdd = Config::getConnexion();
            $data = $bdd->prepare($sql);
            $data->bindValue(':id', $user->getID());
            $data->bindValue(':nom', $user->getName());
            $data->bindValue(':prenom', $user->getSurname());
            $data->bindValue(':email', $user->getMail());
            $data->bindValue(':pass', $user->getPassword());
            return $data->execute();
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }

    public function loginUser($email, $pwd)
    {
        $sql = "SELECT id, nom, email, password, image, prenom 
                FROM user
                WHERE (nom=:nom or email=:email) and password=:pass";
        try {
            $bdd = Config::getConnexion();
            $data = $bdd->prepare($sql);
            $data->bindValue(':nom', $email);
            $data->bindValue(':email', $email);
            $data->bindValue(':pass', $pwd);
            $data->execute();
            return $data->fetch();
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }

    public function updateUserInfo(User $user) {
        $sql = "UPDATE user
                SET nom = :nom, prenom =:prenom, email =:email, password =:password, image =:image
                WHERE id = :id ";
        try {
            $bdd = Config::getConnexion();
            $data = $bdd->prepare($sql);
            $data->bindValue(':id', $user->getID());
            $data->bindValue(':nom', $user->getName());
            $data->bindValue(':prenom',$user->getSurname());
            $data->bindValue(':email', $user->getMail());
            $data->bindValue(':password', $user->getPassword());
            $data->bindValue(':image', $user->getImage());
            return $data->execute();
        } catch (Exception $e) {
            die('Error : ' . $e->getMessage());
        }
    }
}