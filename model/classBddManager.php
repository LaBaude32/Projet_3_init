<?php

/**
 * Class BddManger
 *
 * to connect to the data base
 *
 */

abstract class BddManager{

    private $bdd;

    public function __construct()
    {
        $this->$bdd = new PDO('mysql:host=localhost;dbname=projet3;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
}