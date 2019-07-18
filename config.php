<?php
/**
 * Class MyAutoload -> configuration de l'application et de l'environnement
 */
class MyAutoload
{
    public static function start()
    {

        spl_autoload_register(array(__CLASS__, 'autoload'));

        $host = $_SERVER['HTTP_HOST'];
        $folder = 'Projet_3_init';

        define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/' . $folder . '/');

        define('HOST', '');

        define('VIEW', ROOT . 'view/');
        define('CONTROLLER', ROOT . 'controller/');
        define('MODEL', ROOT . 'model/');
        define('PUBLIC', ROOT . 'public/');
        define('CLASSES', ROOT . 'classes/');

        define('DBHOST', 'localhost');
        define('DBNAME', 'projet3_2');
        define('DBLOGIN', 'root');
        define('DBPASSWORD', '');


        session_start();
    }

    public static function autoload($class)
    {
        if (file_exists(MODEL . $class . '.php')) {
            include_once(MODEL . $class . '.php');
        } elseif (file_exists(CONTROLLER . $class . '.php')) {
            include_once(CONTROLLER . $class . '.php');
        } elseif (file_exists(CLASSES . $class . '.php')) {
            include_once(CLASSES . $class . '.php');
        }
    }
}
// faire la mm chose pour les public avec HTTP_HOST ==> CSS et URLS