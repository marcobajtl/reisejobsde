<?php

namespace model\benutzerbereich;

use model\Model;

class UnternehmenBenutzerbereichModel extends Model
{
    /** @var int */
    public $intUnternehmenID;
    /** @var string */
    public $strUnternehmenName;
    /** @var string */
    public $strUnternehmenOrt;
    /** @var string */
    public $strUnternehmenBeschreibung;
    /** @var array */
    public $arrJobs;


    /** Gibt ein Model mit allen Unternehmensdaten sowie vom Unternehmen gelistete Jobs zurück */
    public static function loadUnternehmensData(): UnternehmenBenutzerbereichModel
    {
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare(
            "SELECT Unternehmen.UnternehmenID, Unternehmen.Name, Unternehmen.Ort, Unternehmen.Beschreibung FROM Unternehmen WHERE Unternehmen.Email = ?"
        );
        $objPrepared->bind_param("s", $_SESSION["email"]);
        $objPrepared->execute();
        $objResult        = $objPrepared->get_result();
        $arrUnternehmenDB = $objResult->fetch_all(MYSQLI_ASSOC)[0];
        $objUnternehmenBenuzterModel = new self();
        $objUnternehmenBenuzterModel->setIntUnternehmenID($arrUnternehmenDB["UnternehmenID"]);
        $objUnternehmenBenuzterModel->setStrUnternehmenName($arrUnternehmenDB["Name"]);
        $objUnternehmenBenuzterModel->setStrUnternehmenOrt($arrUnternehmenDB["Ort"]);
        $objUnternehmenBenuzterModel->setStrUnternehmenBeschreibung($arrUnternehmenDB["Beschreibung"]);
        $objUnternehmenBenuzterModel->setArrJobs(JobBenutzerbereichModel::loadJobs($arrUnternehmenDB["UnternehmenID"]));
        return $objUnternehmenBenuzterModel;
    }

    /**
     * @param int $intUnternehmenID
     */
    private function setIntUnternehmenID(int $intUnternehmenID): void
    {
        $this->intUnternehmenID = $intUnternehmenID;
    }

    /**
     * @param string $strUnternehmenName
     */
    private function setStrUnternehmenName(string $strUnternehmenName): void
    {
        $this->strUnternehmenName = $strUnternehmenName;
    }

    /**
     * @param string $strUnternehmenOrt
     */
    private function setStrUnternehmenOrt(string $strUnternehmenOrt): void
    {
        $this->strUnternehmenOrt = $strUnternehmenOrt;
    }

    /**
     * @param string $strUnternehmenBeschreibung
     */
    private function setStrUnternehmenBeschreibung(string $strUnternehmenBeschreibung): void
    {
        $this->strUnternehmenBeschreibung = $strUnternehmenBeschreibung;
    }

    /**
     * @param array $arrJobs
     */
    private function setArrJobs(array $arrJobs): void
    {
        $this->arrJobs = $arrJobs;
    }
}