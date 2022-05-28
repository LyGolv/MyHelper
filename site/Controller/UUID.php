<?php

class UUID
{
    public static function generateID(): string {
        return uniqid() . date("YmdiH");
    }
}