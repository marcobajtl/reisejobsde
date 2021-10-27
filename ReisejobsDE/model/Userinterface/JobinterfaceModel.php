<?php

namespace model\Userinterface;

use model\Model;

class JobinterfaceModel extends Model
{
    /** @var int */
    public $intJobID;
    /** @var string */
    public $strJobName;
    /** @var string */
    public $strJobOrt;
    /** @var string */
    public $strJobBeschreibung;

    /** Konstruktor für das Arbeitgeber Objekt */
    public function __construct($intJobID, $strJobName, $strJobOrt, $strJobBeschreibung)
    {
        $this->intJobID           = htmlentities($intJobID);
        $this->strJobName         = htmlentities($strJobName);
        $this->strJobOrt          = htmlentities($strJobOrt);
        $this->strJobBeschreibung = htmlentities($strJobBeschreibung);
    }

    /** Gibt eine Liste zurück, mit allen Jobs für ein angegebenes Unternehmen */
    public static function getJobs($intUnternehmensID): array
    {
        $arrJobListe = [];
        $arrJobsDB   = Model::returnSQLData("SELECT * FROM Jobangebote WHERE FKUnternehmenID = " . $intUnternehmensID);

        foreach($arrJobsDB as $arrJob)
        {
            $arrJobListe[] = new JobinterfaceModel($arrJob[0], $arrJob[2], $arrJob[3], $arrJob[5]);
        }
        return $arrJobListe;
    }

    public static function getJobByJobID($intUnternehmensID, $intJobID): array
    {
        return Model::returnSQLData(
            "SELECT Jobangebote.Name, Jobangebote.Standort, Jobangebote.Beschreibung FROM Jobangebote WHERE Jobangebote.FKUnternehmenID = " . $intUnternehmensID . " AND Jobangebote.ID = " . $intJobID
        );
    }

    public static function updateJob($strJobTitel, $strJobOrt, $strJobBeschreibung, $intJobID, $intUnternehmenID)
    {
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare("UPDATE Jobangebote SET Jobangebote.Name=?, Jobangebote.Standort= ?, Jobangebote.Beschreibung= ? WHERE  Jobangebote.ID= ? AND FKUnternehmenID = ?");
        $objPrepared->bind_param("sssii", $strJobTitel, $strJobOrt, $strJobBeschreibung, $intJobID, $intUnternehmenID);
        $objPrepared->execute();
    }

    /** Schreibt einen neuen Job in die Datenbank */
    public static function writeJob($intID, $strStellenname, $strStandort, $strBeschreibung){
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare("INSERT INTO Jobangebote(FKUnternehmenID, Name, Standort, Beschreibung) VALUE (?, ?, ?, ?)");
        $objPrepared->bind_param("isss", $intID, $strStellenname, $strStandort, $strBeschreibung);
        $objPrepared->execute();
    }

    /** Löscht einen Job aus der Datenbank */
    public static function deleteJob($intJobID, $intUnternehmenID){
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare("DELETE FROM `reisejobs`.`Jobangebote` WHERE `ID`=? AND FKUnternehmenID = ?");
        $objPrepared->bind_param("ii", $intJobID, $intUnternehmenID);
        $objPrepared->execute();
    }
}