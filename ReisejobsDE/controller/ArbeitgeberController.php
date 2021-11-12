<?php

namespace controller;

use model\ArbeitgeberModel;

class ArbeitgeberController extends Controller
{

    public function verarbeiteDaten()
    {
        $arrUnternehmen = ArbeitgeberModel::returnArbeitgeber();
        $strFileName = "arbeitgeberView.php";
        include /** @lang text */
        "view/layout.php";
    }
}