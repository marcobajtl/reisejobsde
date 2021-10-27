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

    /** Konstruktor für das Arbeitgeber Objekt */
    public function __construct($intUnternehmenID, $strUnternehmenName, $strUnternehmenOrt, $strUnternehmenBeschreibung)
    {
        $this->intUnternehmenID           = $intUnternehmenID;
        $this->strUnternehmenName         = $strUnternehmenName;
        $this->strUnternehmenOrt          = $strUnternehmenOrt;
        $this->strUnternehmenBeschreibung = $strUnternehmenBeschreibung;
        $this->intJobCount                = $this->countJobs($intUnternehmenID);
    }

    /** Zählt wie viele Jobs bei einem Arbeitgeber verfügbar sind. */
    function countJobs($intUnternehmenID): array
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
        $arrArbeitgeber     = Model::returnSQLData("SELECT * FROM Unternehmen");
        foreach($arrArbeitgeber as $arrArbeitgeberItem)
        {
            $arrArbeitgeberList[] = new ArbeitgeberModel($arrArbeitgeberItem[0], $arrArbeitgeberItem[1], $arrArbeitgeberItem[2], $arrArbeitgeberItem[3]);
        }
        return $arrArbeitgeberList;
    }
}