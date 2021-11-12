<?php

namespace controller\Benutzerbereich;

use controller\Controller;
use model\benutzerbereich\JobBenutzerbereichModel;

class EditPostController extends Controller
{

    public function verarbeiteDaten()
    {
        $this->checkForChange();
        $this->checkFileUpload($_GET["ID"]);
        if(isset($_GET["ID"]))
        {
            $arrJobData        = JobBenutzerbereichModel::loadJobByJobID($_SESSION["user_id"], $_GET["ID"])[0];
            $strJobTitel       = $arrJobData[0];
            $strJobLocation    = $arrJobData[1];
            $strJobDescription = $arrJobData[2];
            $strFileName       = "Benutzerbereich/editPostView.php";
            include("view/layout.php");
        }
    }

    /** Überprüft, ob eine Datei hochgeladen wurde. Wenn ja, wird sie im Upload Ordner gespeichert */
    private function checkFileUpload($intJobID): void
    {
        if(isset($_FILES["fileToUpload"]))
        {
            $strUploadDir  = "bilder\\upload\\job\\";
            $strTargetDir = $strUploadDir . basename($intJobID . ".png");
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $strTargetDir);
            $objImg = imagecreatefromjpeg($strTargetDir);
            $floatImg = min(imagesx($objImg), imagesy($objImg));
            $objImg = imagecrop($objImg, ['x' => $floatImg*0.4, 'y' => 0, 'width' => $floatImg, 'height' => $floatImg]);
            $objImg = imagescale($objImg, 1000);
            imagepng($objImg, $strTargetDir);
        }

    }

    /** Überprüft, ob änderungen an Texten vorgenommen wurden und speichert diese in eine Datenbank */
    private function checkForChange(): void
    {
        if(isset($_POST["jobtitel"]))
        {
            JobBenutzerbereichModel::updateJob($_POST["jobtitel"], $_POST["joblocation"], $_POST["jobdescription"], $_GET["ID"], $_SESSION["user_id"]);
            header("Location: ".BASEPATH."/benutzerbereich");
        }
    }
}
