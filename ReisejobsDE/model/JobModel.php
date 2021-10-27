<?php

namespace model;

class JobModel
{
    /** @var int */
    public $intJobID;
    /** @var string */
    public $strUnternehmenName;
    /** @var string */
    public $strJobName;
    /** @var string */
    public $strJobStandort;
    /** @var string */
    public $strJobBeschreibung;

    public function __construct($intJobID,$strUnternehmenName, $strJobName, $strJobStandort, $strJobBeschreibung){
        $this->intJobID = $intJobID;
        $this->strUnternehmenName = $strUnternehmenName;
        $this->strJobName = $strJobName;
        $this->strJobStandort = $strJobStandort;
        $this->strJobBeschreibung = $strJobBeschreibung;
    }
}