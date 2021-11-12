<?php

use controller\Controller;
use controller\ErrorController;

require_once "vendor/autoload.php";

//z. B. C:\xampp\htdocs\schoetex-reisenOOP
$strDir = __DIR__;

//z. B. C:/xampp/htdocs/schoetex-reisenOOP
$strVerzeichnis = str_replace('\\', '/', $strDir);

//z. B. C:/xampp/htdocs/
$strDirName = dirname($strDir);

//z. B. azubi/schoetex-reisenOOP
$strProjektOhneRoot = str_replace($_SERVER['DOCUMENT_ROOT'], '', $strVerzeichnis);
define("BASEPATH", $strProjektOhneRoot);
//z. B. /Hotel
$strController = str_replace($strProjektOhneRoot, '', $_SERVER['REQUEST_URI']);

//z. B. Hotel
$strControllerName = explode("?", ltrim($strController, '/'))[0];
//Prüfen, ob ein Controller angefragt
if($strControllerName === '')
{
    $strController = 'IndexController';
}
else
{
    //z. B. HotelController
    $strController = ucfirst($strControllerName) . 'Controller';
}

//z. B. controller\HotelController
$strControllerClass = 'controller\\' . $strController;

$strControllerClass = str_replace('/', '\\', $strControllerClass);

session_start();
//$_SESSION['csrf_token'] = hash("SHA256", uniqid('', true)); //TODO Abfragen ob schon gesetzt
if(class_exists($strControllerClass))
{
    /** @var Controller $objController */
    $objController = new $strControllerClass();
}
else
{
    //Controller wurde nicht gefunden
    $objController = new ErrorController();
}
$objController->verarbeiteDaten();