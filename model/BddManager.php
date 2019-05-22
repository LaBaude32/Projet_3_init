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
        $this->bdd = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.';charset=utf8', DBLOGIN, DBPASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

    public function getBdd()
    {
        return $this->bdd;
    }
}