<?php

namespace model;

class JobModel
{
    /** @var int */
    public $intJobID;
    /** @var int */
    public $intUnternehmenID;
    /** @var string */
    public $strUnternehmenName;
    /** @var string */
    public $strJobName;
    /** @var string */
    public $strJobStandort;
    /** @var string */
    public $strJobBeschreibung;

    /**
     * @param int $intJobID
     */
    public function setIntJobID(int $intJobID): void
    {
        $this->intJobID = $intJobID;
    }

    /**
     * @param string $strUnternehmenName
     */
    public function setStrUnternehmenName(string $strUnternehmenName): void
    {
        $this->strUnternehmenName = $strUnternehmenName;
    }

    /**
     * @param string $strJobName
     */
    public function setStrJobName(string $strJobName): void
    {
        $this->strJobName = $strJobName;
    }

    /**
     * @param string $strJobStandort
     */
    public function setStrJobStandort(string $strJobStandort): void
    {
        $this->strJobStandort = $strJobStandort;
    }

    /**
     * @param string $strJobBeschreibung
     */
    public function setStrJobBeschreibung(string $strJobBeschreibung): void
    {
        $this->strJobBeschreibung = $strJobBeschreibung;
    }

    /**
     * @param string $intUnternehmenID
     */
    public function setIntUnternehmenID(string $intUnternehmenID): void
    {
        $this->intUnternehmenID = $intUnternehmenID;
    }
}