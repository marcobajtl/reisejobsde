<?php

namespace controller;

use model\JobPageModel;
use model\Model;

class JobsController extends Controller
{
    /** Läd alle Jobs aus der Datenbank */
    private function loadJobs(): array
    {
        if(isset($_GET['ArbeitgeberID']))
        {
            $arrJobData = JobPageModel::loadJobsByID($_GET['ArbeitgeberID']);
        }
        elseif(isset($_GET['Unternehmen']))
        {
            $arrJobData = JobPageModel::loadJobsByUnternehmen($_GET['Unternehmen']);
        }
        elseif(isset($_GET['Jobtitel']))
        {
            $arrJobData = JobPageModel::loadJobsByJobtitel($_GET ['Jobtitel']);
        }
        elseif(isset($_GET['Postleitzahl']))
        {
            $arrJobData = JobPageModel::loadJobsByPLZ($_GET['Postleitzahl']);
        }
        else
        {
            $arrJobData = JobPageModel::loadJobs();
        }

        $arrJobList = [];
        foreach($arrJobData as $arrJob)
        {
            $strBeschreibung = "";
            $arrBeschreibung = explode(" ", $arrJob["Beschreibung"]);
            if(count($arrBeschreibung) >= 20)
            {
                for($i = 1; $i <= 20; $i++)
                {
                    $strBeschreibung .= " " . $arrBeschreibung[$i];
                }
                $strBeschreibung .= "...";
            }
            else
            {
                $strBeschreibung = implode(" ", $arrBeschreibung);
            }

            $objJobPageModel = new JobPageModel;
            $objJobPageModel->setIntID($arrJob['JobID']);
            $objJobPageModel->setIntFKUnternehmenID($arrJob['FKUnternehmenID']);
            $objJobPageModel->setStrName($arrJob['Name']);
            $objJobPageModel->setStrTitel($arrJob['Titel']);
            $objJobPageModel->setStrStandort($arrJob['Standort']);
            $objJobPageModel->setIntPostleitzahl($arrJob['PLZ']);
            $objJobPageModel->setStrBeschreibung($strBeschreibung);
            $objJobPageModel->setStrVeroeffentlicht($arrJob['Veroeffentlicht']);
            $arrJobList[] = $objJobPageModel;
        }
        return $arrJobList;
    }

    private function loadFavorites(): array
    {
        if(isset($_SESSION['user_id']) && $_SESSION['user_type'] === "Bewerber")
        {
            return Model::returnSQLArray("SELECT FKJobID FROM Favoriten WHERE FKUserID = ".$_SESSION['user_id'] );
        }
        return [];

    }

    public function verarbeiteDaten()
    {

        $arrJobList  = $this->loadJobs();
        $arrFavJobs  = $this->loadFavorites();
        $strFileName = "jobsView.php";
        include "view/layout.php";
    }
}