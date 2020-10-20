<?php

//Carga las librerias importadas del composer
require(__DIR__ .'/../../vendor/autoload.php');
//__DIR__ => D:\laragon\www\WebER\views\partials
?>
<?php
$dotenv = Dotenv\Dotenv::create(__DIR__ ."../../../"); //Cargamos el archivo .env de la raiz del sitio
$dotenv->load(); //Carga las variables del archivo .env

$baseURL = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/".$_ENV['ROOT_FOLDER'];
//https://localhost/institucion-educativa-indalecio-vasquez/
$adminlteURL = $baseURL."/vendor/almasaeed2010/adminlte";
//https://localhost/institucion-educativa-indalecio-vasquez/vendor/almasaeed2010/adminlte
?>