<?php

/**
 * @param $classname
 */
function autoload($classname){
    $file = (str_replace('\\','/',$classname)).'.php';
    //Überprüft, ob die Datei Existiert
    if(file_exists($file))
    {
        include_once($file);
    }
}

//Registriert einen Autoloader
spl_autoload_register("autoload");