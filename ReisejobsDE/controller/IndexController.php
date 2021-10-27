<?php

namespace controller;

use model\IndexModel;

class IndexController extends Controller
{
    /** Verarbeitet Daten aus dem IndexModel und läd die Seite */
    function verarbeiteDaten()
    {
        $objIndexInstance = new IndexModel();
        $arrJobList = $objIndexInstance->loadRandomJobs();
        $strFileName = "indexView.php";
        include("view/layout.php");

        //TODO Wenn Jobseite fertig, weiterleitung der Quicksearch implementieren
    }
}