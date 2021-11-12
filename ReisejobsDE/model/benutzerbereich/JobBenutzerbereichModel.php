<?php

namespace model\benutzerbereich;

use model\Model;

class JobBenutzerbereichModel extends Model
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
    public static function loadJobs($intUnternehmensID): array
    {
        $arrJobListe = [];
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare("SELECT * FROM Jobangebote WHERE FKUnternehmenID = ?");
        $objPrepared->bind_param("i", $intUnternehmensID);
        $objPrepared->execute();
        $objResult = $objPrepared->get_result();
        $arrJobsDB = $objResult->fetch_all();

        foreach($arrJobsDB as $arrJob)
        {
            $arrJobListe[] = new JobBenutzerbereichModel($arrJob[0], $arrJob[2], $arrJob[3], $arrJob[5]);
        }
        return $arrJobListe;
    }

    public static function loadJobByJobID($intUnternehmensID, $intJobID): array
    {
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare(
            "SELECT Jobangebote.Titel, Jobangebote.Standort, Jobangebote.Beschreibung FROM Jobangebote WHERE Jobangebote.FKUnternehmenID = ? AND Jobangebote.JobID = ?"
        );
        $objPrepared->bind_param("ii", $intUnternehmensID, $intJobID);
        $objPrepared->execute();
        $objResult = $objPrepared->get_result();
        return $objResult->fetch_all();
    }

    /** Ändert die angegebenen Jobeigenschaften in der Datenbank zu denen, die in den Parametern übergeben werden. */
    public static function updateJob($strJobTitel, $strJobOrt, $strJobBeschreibung, $intJobID, $intUnternehmenID): void
    {
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare(
            "UPDATE Jobangebote SET Jobangebote.Titel=?, Jobangebote.Standort= ?, Jobangebote.Beschreibung= ? WHERE  Jobangebote.JobID= ? AND FKUnternehmenID = ?"
        );
        $objPrepared->bind_param("sssii", $strJobTitel, $strJobOrt, $strJobBeschreibung, $intJobID, $intUnternehmenID);
        $objPrepared->execute();
    }

    /** Schreibt einen neuen Job in die Datenbank */
    public static function writeJob($intID, $strStellenname, $strStandort, $strBeschreibung): void
    {
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare("INSERT INTO Jobangebote(FKUnternehmenID, Titel, Standort, Beschreibung) VALUE (?, ?, ?, ?)");
        $objPrepared->bind_param("isss", $intID, $strStellenname, $strStandort, $strBeschreibung);
        $objPrepared->execute();
    }

    /** Löscht einen Job aus der Datenbank */
    public static function deleteJob($intJobID, $intUnternehmenID): void
    {
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare("DELETE FROM `reisejobs`.`Jobangebote` WHERE `JobID`=? AND FKUnternehmenID = ?");
        $objPrepared->bind_param("ii", $intJobID, $intUnternehmenID);
        $objPrepared->execute();
    }
}