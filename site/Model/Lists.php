<?php

class Lists
{
    private String $id;
    private String $name;
    private String $creation_date;
    private String $modif_date;
    private String $user_id;

    function __construct(string $id, string $name, String $creation_date, String $modif_date, string $user_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->creation_date = $creation_date;
        $this->modif_date = $modif_date;
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return String
     */
    public function getCreationDate(): String
    {
        return $this->creation_date;
    }

    /**
     * @return String
     */
    public function getModifDate(): String
    {
        return $this->modif_date;
    }

    /**
     * @param String $modif_date
     */
    public function setModifDate(String $modif_date): void
    {
        $this->modif_date = $modif_date;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->user_id;
    }
}