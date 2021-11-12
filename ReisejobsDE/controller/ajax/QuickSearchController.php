<?php

namespace controller\ajax;



use controller\Controller;
use model\ajax\QuickSearchModel;

class QuickSearchController extends Controller
{

    /** Holt Daten für die Schnellsuche auf der Index Seite aus der Datenbank
     *
     */
    public function verarbeiteDaten()
    {
        if(isset($_GET["unternehmen"]))
        {
            $objQuickSearchModel = new QuickSearchModel();
            $strID               = "Unternehmen";
            $arrUnternehmenList  = ($objQuickSearchModel->quickFindUnternehmen($_GET["unternehmen"]));
            include "view/ajax/QuickSearchUnternehmen.php";
        }

        if(isset($_GET["jobtitel"]))
        {
            $objQuickSearchModel = new QuickSearchModel();
            $strID               = "Jobtitel";
            $arrUnternehmenList  = ($objQuickSearchModel->quickFindJobTitel($_GET["jobtitel"]));
            include "view/ajax/QuickSearchUnternehmen.php";
        }
        if(isset($_GET["postleitzahl"]))
        {
            $objQuickSearchModel = new QuickSearchModel();
            $strID               = "Postleitzahl";
            $arrUnternehmenList  = ($objQuickSearchModel->quickFindOrt($_GET["postleitzahl"]));
            include "view/ajax/QuickSearchUnternehmen.php";
        }
    }
}