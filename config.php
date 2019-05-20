<?php
//configuration de l'appli

$folder = 'Projet_3_init';
define('ROOT',$_SERVER['DOCUMENT_ROOT'].'/'.$folder.'/');
define('VIEW', ROOT.'view/');
define('CONTROLLER', ROOT.'controller/');
define('MODEL', ROOT.'model/');
define('PUBLIC', ROOT.'public/');

//faire une session start

// ajouter tous les dossier

// faire la mm chose pour les public avec HTTP_HOST ==> CSS et URLS

// pour les connections à la BDD faire la mm chose avec DbName DbConfig DbHost dBpassword