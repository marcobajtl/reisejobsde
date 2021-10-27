<?php

namespace controller\userinterface;

use controller\Controller;
use model\Userinterface\JobinterfaceModel;

class EditPostController extends Controller
{


    function verarbeiteDaten()
    {
        $this->checkForChange();
        $this->checkFileUpload($_GET["ID"]);
        if(isset($_GET["ID"]))
        {
            $arrJobData        = JobinterfaceModel::getJobByJobID($_SESSION["user_id"], $_GET["ID"])[0];
            $strJobTitel       = $arrJobData[0];
            $strJobLocation    = $arrJobData[1];
            $strJobDescription = $arrJobData[2];
            $strFileName       = "userinterface/editPostView.php";
            include("view/layout.php");
        }
    }

    /** Überprüft, ob eine Datei hochgeladen wurde. Wenn ja, wird sie im Upload Ordner gespeichert */
    private function checkFileUpload($intJobID)
    {
        if(isset($_FILES["fileToUpload"]))
        {
            $target_dir  = "bilder\\upload\\job\\";
            $target_file = $target_dir . basename($intJobID . ".png");
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            $im_php = imagecreatefromjpeg($target_file);
            $size = min(imagesx($im_php), imagesy($im_php));
            $im_php = imagecrop($im_php, ['x' => $size*0.4, 'y' => 0, 'width' => $size, 'height' => $size]);
            $im_php = imagescale($im_php, 1000);
            imagepng($im_php, $target_file);
        }

    }

    /** Überprüft, ob änderungen an Texten vorgenommen wurden und speichert diese in eine Datenbank */
    private function checkForChange()
    {
        if(isset($_POST["jobtitel"]))
        {
            JobinterfaceModel::updateJob($_POST["jobtitel"], $_POST["joblocation"], $_POST["jobdescription"], $_GET["ID"], $_SESSION["user_id"]);
            header("Location: ".BASEPATH."/userinterface");
        }
    }
}
