<?php

namespace controller;

use model\enum\PasswordEnum;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class ErrorController extends Controller
{

    public function verarbeiteDaten()
    {

        $strFileName = "errorView.php";
        include("view/layout.php");
    }



}