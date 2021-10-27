<?php

namespace model\Userinterface;

use model\Model;

class UnternehmensinterfaceModel extends Model
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

    /** Konstruktor für das Arbeitgeber Objekt */
    public function __construct(int $intUnternehmenID, $strUnternehmenName, $strUnternehmenOrt, $strUnternehmenBeschreibung)
    {
        $this->intUnternehmenID           = htmlentities($intUnternehmenID);
        $this->strUnternehmenName         = htmlentities($strUnternehmenName);
        $this->strUnternehmenOrt          = htmlentities($strUnternehmenOrt);
        $this->strUnternehmenBeschreibung = htmlentities($strUnternehmenBeschreibung);
        $this->arrJobs                    = JobinterfaceModel::getJobs($intUnternehmenID);
    }

    /** Gibt ein Model mit allen Unternehmensdaten sowie vom Unternehmen gelistete Jobs zurück */
    public static function getUnternehmensData(): UnternehmensinterfaceModel
    {
        $arrUnternehmenDB = Model::returnSQLData(
            'SELECT Unternehmen.ID, Unternehmen.Name, Unternehmen.Ort, Unternehmen.Beschreibung FROM Unternehmen WHERE Unternehmen.Email = "'. $_SESSION["email"] .'" '
        );

        return new UnternehmensinterfaceModel($arrUnternehmenDB[0][0], $arrUnternehmenDB[0][1], $arrUnternehmenDB[0][2], $arrUnternehmenDB[0][3]);
    }
}