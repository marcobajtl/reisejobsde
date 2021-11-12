<?php

namespace model;

class JobPageModel extends Model
{

    /** @var int */
    public $intID;
    /** @var int */
    public $intFKUnternehmenID;
    /** @var string */
    public $strName;
    /** @var string */
    public $strTitel;
    /** @var string */
    public $strStandort;
    /** @var int */
    public $intPostleitzahl;
    /** @var string */
    public $strBeschreibung;
    /** @var string */
    public $strVeroeffentlicht;
    /**
     * @var string
     */

    /** Holt alle Jobs aus der Jobangebote Datenbank */
    public static function loadJobs(): array
    {

        return Model::returnSQLArray(
            "SELECT Jobangebote.JobID, Jobangebote.FKUnternehmenID, Jobangebote.Titel, Unternehmen.Name, Jobangebote.Standort, Jobangebote.PLZ,
                    Jobangebote.Beschreibung, Jobangebote.Veroeffentlicht
                    FROM Jobangebote
                    INNER JOIN Unternehmen ON Jobangebote.FKUnternehmenID = Unternehmen.UnternehmenID"
        );
    }

    public static function loadJobsbyID(int $intID): array
    {
        return Model::returnSQLArray(
            "SELECT Jobangebote.JobID, Jobangebote.FKUnternehmenID, Jobangebote.Titel, Unternehmen.Name, Jobangebote.Standort, Jobangebote.PLZ,
                    Jobangebote.Beschreibung, Jobangebote.Veroeffentlicht
                    FROM Jobangebote
                    INNER JOIN Unternehmen ON Jobangebote.FKUnternehmenID = Unternehmen.UnternehmenID
                    WHERE Unternehmen.UnternehmenID = $intID"
        );
    }

    public static function loadJobsByUnternehmen($strUnternehmenName): array
    {
        $strStatement = "SELECT Jobangebote.JobID, Jobangebote.FKUnternehmenID, Jobangebote.Titel, Unternehmen.Name, Jobangebote.Standort, Jobangebote.PLZ,
                    Jobangebote.Beschreibung, Jobangebote.Veroeffentlicht, Unternehmen.Name
                    FROM Jobangebote
                    INNER JOIN Unternehmen ON Jobangebote.FKUnternehmenID = Unternehmen.UnternehmenID
                    WHERE Unternehmen.Name = ? ";
        $objDatabase  = Model::returnConnection();
        $objPrepared  = $objDatabase->prepare($strStatement);
        $objPrepared->bind_param("s", $strUnternehmenName);
        $objPrepared->execute();
        $objResult = $objPrepared->get_result();
        return $objResult->fetch_all(MYSQLI_ASSOC);
    }

    public static function loadJobsByJobtitel($strJobTitel): array
    {
        $strStatement = (
        "SELECT Jobangebote.JobID, Jobangebote.FKUnternehmenID, Jobangebote.Titel, Unternehmen.Name, Jobangebote.Standort, Jobangebote.PLZ,
                    Jobangebote.Beschreibung, Jobangebote.Veroeffentlicht
                    FROM Jobangebote
                    INNER JOIN Unternehmen ON Jobangebote.FKUnternehmenID = Unternehmen.UnternehmenID
                    WHERE Jobangebote.Titel = ?"
        );
        $objDatabase  = Model::returnConnection();
        $objPrepared  = $objDatabase->prepare($strStatement);
        $objPrepared->bind_param("s", $strJobTitel);
        $objPrepared->execute();
        $objResult = $objPrepared->get_result();
        return $objResult->fetch_all(MYSQLI_ASSOC);
    }

    public static function loadJobsByPLZ($intPLZ): array
    {
        $strStatement = (
        "SELECT Jobangebote.JobID, Jobangebote.FKUnternehmenID, Jobangebote.Titel, Unternehmen.Name, Jobangebote.Standort, Jobangebote.PLZ,
                    Jobangebote.Beschreibung, Jobangebote.Veroeffentlicht
                    FROM Jobangebote
                    INNER JOIN Unternehmen ON Jobangebote.FKUnternehmenID = Unternehmen.UnternehmenID
                    WHERE Jobangebote.Standort = ? OR Jobangebote.PLZ = ?"
        );
        $objDatabase  = Model::returnConnection();
        $objPrepared  = $objDatabase->prepare($strStatement);
        $objPrepared->bind_param("ii", $intPLZ, $intPLZ);
        $objPrepared->execute();
        $objResult = $objPrepared->get_result();
        return $objResult->fetch_all(MYSQLI_ASSOC);
    }//TODO Style von Quicksearch anpassen

    /**
     * @param int $intID
     */
    public function setIntID(int $intID): void
    {
        $this->intID = htmlentities($intID);
    }

    /**
     * @param int $intFKUnternehmenID
     */
    public function setIntFKUnternehmenID(int $intFKUnternehmenID): void
    {
        $this->intFKUnternehmenID = htmlentities($intFKUnternehmenID);
    }

    /**
     * @param string $strName
     */
    public function setStrName(string $strName): void
    {
        $this->strName = htmlentities($strName);
    }

    /**
     * @param string $strTitel
     */
    public function setStrTitel(string $strTitel): void
    {
        $this->strTitel = htmlentities($strTitel);
    }

    /**
     * @param string $strStandort
     */
    public function setStrStandort(string $strStandort): void
    {
        $this->strStandort = htmlentities($strStandort);
    }

    /**
     * @param int $intPostleitzahl
     */
    public function setIntPostleitzahl(int $intPostleitzahl): void
    {
        $this->intPostleitzahl = htmlentities($intPostleitzahl);
    }

    /**
     * @param string $strBeschreibung
     */
    public function setStrBeschreibung(string $strBeschreibung): void
    {
        $this->strBeschreibung = htmlentities($strBeschreibung);
    }

    /**
     * @param string $strVeroeffentlicht
     */
    public function setStrVeroeffentlicht(string $strVeroeffentlicht): void
    {
        $this->strVeroeffentlicht = htmlentities($strVeroeffentlicht);
    }
}