<?php

namespace model;

class ArbeitnehmerModel extends Model
{
    /** @var int */
    public $intBewerberID;
    /** @var string */
    public $strName;
    /** @var string */
    public $strNachname;
    /** @var string */
    public $strBeschreibung;
    /** @var string */
    public $strEmail;

    public static function loadBewerber(): array
    {
        $arrBewerberList = [];
        $arrBewerberDB   = Model::returnSQLArray("SELECT BewerberID,Name, Nachname, Beschreibung, Email FROM Bewerber");
        foreach($arrBewerberDB as $arrBewerber)
        {
            $objBewerber = new self();
            $objBewerber->setIntBewerberID($arrBewerber['BewerberID']);
            $objBewerber->setStrName($arrBewerber['Name']);
            $objBewerber->setStrNachname($arrBewerber['Nachname']);
            $objBewerber->setStrBeschreibung($arrBewerber['Beschreibung']);
            $objBewerber->setStrEmail($arrBewerber['Email']);
            $arrBewerberList[] = $objBewerber;
        }
        return $arrBewerberList;
    }

    public static function loadBewerberData(int $intBewerberID)
    {
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare(
            "SELECT Email, Nachname FROM Bewerber WHERE BewerberID = ?"
        );
        $objPrepared->bind_param("i", $intBewerberID);
        $objPrepared->execute();
        $objResult        = $objPrepared->get_result();
        return $objResult->fetch_all(MYSQLI_ASSOC)[0];
    }

    // SETTER Methoden

    /**
     * @param mixed $intBewerberID
     */
    public function setIntBewerberID($intBewerberID): void
    {
        $this->intBewerberID = $intBewerberID;
    }

    /**
     * @param mixed $strName
     */
    public function setStrName($strName): void
    {
        $this->strName = $strName;
    }

    /**
     * @param mixed $strNachname
     */
    public function setStrNachname($strNachname): void
    {
        $this->strNachname = $strNachname;
    }

    /**
     * @param mixed $strBeschreibung
     */
    public function setStrBeschreibung($strBeschreibung): void
    {
        $this->strBeschreibung = $strBeschreibung;
    }

    /**
     * @param mixed $strEmail
     */
    public function setStrEmail($strEmail): void
    {
        $this->strEmail = $strEmail;
    }
}