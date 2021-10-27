<?php

namespace controller;

use model\ajax\UnternehmenInterfaceModel;
use model\Userinterface\JobinterfaceModel;
use model\Userinterface\UnternehmensinterfaceModel;

class UserinterfaceController extends Controller
{

    /** Schreibt wenn möglich änderungen am Unternehmensprofil in die Datenbank. */
    private function checkChanges(int $intUnternehmensID)
    {
        if(isset($_POST["uname"]))
        {
            UnternehmenInterfaceModel::changeInDatabase($_POST["uname"], $_POST["uort"], $_POST["ubeschreibung"], $intUnternehmensID);
            if(isset($_FILES['fileToUpload'])){
                $target_dir  = "bilder\\upload\\profile\\";
                $target_file = $target_dir . basename($intUnternehmensID . ".png");
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
                $im_php = imagecreatefromjpeg($target_file);
                $size = min(imagesx($im_php), imagesy($im_php));
                $im_php = imagecrop($im_php, ['x' => $size*0.4, 'y' => 0, 'width' => $size, 'height' => $size]);
                $im_php = imagescale($im_php, 600);
                imagepng($im_php, $target_file);
            }
            header("Location: " . BASEPATH . "/userinterface");
        }
    }

    /** Überprüft, ob der Benutzer angemeldet ist
     * @return string|null
     */
    private function checkLogin(): ?string
    {
        /** Wenn ja, dann mit welcher Benutzergruppe */
        if(isset($_SESSION["logged_in"]))
        {
            if($_SESSION["user_type"] == "Unternehmen")
            {
                return "unternehmensinterfaceView.php";
            }
            else
            {
                return "bewerberinterfaceView.php";
            }
        }
        /** Sonst wird man zum Loginbereich weitergeleitet */
        else
        {
            header("Location: " . BASEPATH . "/login");
            return null;
        }
    }

    /** Prüft, ob ein neuer Job angelegt werden soll. */
    private function checkNewJob(int $intUnternehmenID)
    {
        if(isset($_POST["Jobtitel"])){
            JobinterfaceModel::writeJob($intUnternehmenID, $_POST["Jobtitel"],$_POST["Standort"],$_POST["jobbeschreibung"]);
            header("Location: " . BASEPATH . "/userinterface");
        }
    }

    /** Prüft, ob ein neuer Job entfernt werden soll. */
    private function checkDeleteJob(int $intUnternehmenID)
    {
        if(isset($_POST["delete"])){
            JobinterfaceModel::deleteJob($_POST["delete"], $intUnternehmenID);
            header("Location: " . BASEPATH . "/userinterface");
        }

    }

    public function verarbeiteDaten()
    {
        $objUnternehmensDaten = UnternehmensinterfaceModel::getUnternehmensData();
        $strFileName          = $this->checkLogin();
        $this->checkNewJob($objUnternehmensDaten->intUnternehmenID);
        $this->checkChanges($objUnternehmensDaten->intUnternehmenID);
        $this->checkDeleteJob($objUnternehmensDaten->intUnternehmenID);
        include /** @lang text */
        "view/layout.php";
    }
}