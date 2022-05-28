<?php

class Activity
{
    private String $ID;
    private String $text;
    private String $id_list;
    private String $state;

    function __construct(string $id, string $text, string $id_list, string $state) {
        $this->ID = $id;
        $this->text = $text;
        $this->id_list = $id_list;
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getID(): string
    {
        return $this->ID;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getIdList(): string
    {
        return $this->id_list;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state): void
    {
        $this->state = $state;
    }
}