<?php

namespace model;

class ArbeitgeberModel extends Model
{
    /** @var int */
    public $intUnternehmenID;
    /** @var string */
    public $strUnternehmenName;
    /** @var string */
    public $strUnternehmenOrt;
    /** @var string */
    public $strUnternehmenBeschreibung;
    /** @var int */
    public $intJobCount;

    /** Zählt wie viele Jobs bei einem Arbeitgeber verfügbar sind. */
    protected static function countJobs($intUnternehmenID)
    {
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare("SELECT COUNT('ID') FROM Jobangebote WHERE Jobangebote.FKUnternehmenID = ?");
        $objPrepared->bind_param("i", $intUnternehmenID);
        $objPrepared->execute();
        $objResult = $objPrepared->get_result();
        return $objResult->fetch_all()[0];
    }

    /** Gibt ein Array zurück, mit Informationen über einen Arbeitgeber */
    public static function returnArbeitgeber(): array
    {
        $arrArbeitgeberList = [];
        $arrArbeitgeber     = Model::returnSQLArray("SELECT Unternehmen.UnternehmenID, Unternehmen.Name, Unternehmen.Ort, Unternehmen.Beschreibung FROM Unternehmen");
        foreach($arrArbeitgeber as $arrArbeitgeberItem)
        {
            $objArbeitgeberModel = new self();
            $objArbeitgeberModel->setIntUnternehmenID(htmlentities($arrArbeitgeberItem['UnternehmenID']));
            $objArbeitgeberModel->setStrUnternehmenName(htmlentities($arrArbeitgeberItem['Name']));
            $objArbeitgeberModel->setStrUnternehmenOrt(htmlentities($arrArbeitgeberItem['Ort']));
            $objArbeitgeberModel->setStrUnternehmenBeschreibung(htmlentities($arrArbeitgeberItem['Beschreibung']));
            $objArbeitgeberModel->setIntJobCount(self::countJobs($arrArbeitgeberItem['UnternehmenID'])[0]);

            $arrArbeitgeberList[] = $objArbeitgeberModel;
        }
        return $arrArbeitgeberList;
    }

    /**
     * @param int $intUnternehmenID
     */
    public function setIntUnternehmenID(int $intUnternehmenID): void
    {
        $this->intUnternehmenID = $intUnternehmenID;
    }

    /**
     * @param string $strUnternehmenName
     */
    public function setStrUnternehmenName(string $strUnternehmenName): void
    {
        $this->strUnternehmenName = $strUnternehmenName;
    }

    /**
     * @param string $strUnternehmenOrt
     */
    public function setStrUnternehmenOrt(string $strUnternehmenOrt): void
    {
        $this->strUnternehmenOrt = $strUnternehmenOrt;
    }

    /**
     * @param string $strUnternehmenBeschreibung
     */
    public function setStrUnternehmenBeschreibung(string $strUnternehmenBeschreibung): void
    {
        $this->strUnternehmenBeschreibung = $strUnternehmenBeschreibung;
    }

    /**
     * @param int $intJobCount
     */
    public function setIntJobCount(int $intJobCount): void
    {
        $this->intJobCount = $intJobCount;
    }
}