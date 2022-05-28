<?php

class User {
    private String $ID;
    private String $name;
    private String $surname;
    private String $mail;
    private String $password;
    private String $image;

    function __construct($ID, $name, $surname, $mail, $password)
    {
        $this->setName($name);
        $this->setSurname($surname);
        $this->setMail($mail);
        $this->setPassword($password);
        $this->ID = $ID;
    }

    /**
     * @return String
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param String $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return String
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param String $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return String
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param String $mail
     */
    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return String
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param String $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return String
     */
    public function getID(): string
    {
        return $this->ID;
    }

    /**
     * @return String
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param String $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }


}