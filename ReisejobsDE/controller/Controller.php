<?php

namespace controller;

abstract class Controller
{
    /** Verarbeitet Daten
     * @return mixed
     */
    abstract public function verarbeiteDaten();

    public static function checkCSRF($strCSRFToken = ""): bool
    {
        if(isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token'])
        {
            return true;
        }

        if(isset($_GET['csrf_token']) && $_GET['csrf_token'] === $_SESSION['csrf_token'])
        {
            return true;
        }
        if(($strCSRFToken !== "") && $strCSRFToken === $_SESSION['csrf_token'])
        {
            return true;
        }
        return false;
    }
}