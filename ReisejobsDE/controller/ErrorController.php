<?php
namespace controller;

class ErrorController extends Controller
{

    function verarbeiteDaten()
    {
        $strFileName = "errorView.php";
        include("view/layout.php");
    }
}