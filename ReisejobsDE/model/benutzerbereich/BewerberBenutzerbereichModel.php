<?php

namespace model\benutzerbereich;

use model\Model;

class BewerberBenutzerbereichModel extends Model
{

    /** @var int */
    public $intBewerberID;
    /** @var string */
    public $strName;
    /** @var string */
    public $strNachname;
    /** @var string */
    public $strBeschreibung;
    /** @var array */
    public $strEmail;


    /** Gibt ein Model mit allen Unternehmensdaten sowie vom Unternehmen gelistete Jobs zurück */
    public static function loadBewerberData(): BewerberBenutzerbereichModel
    {
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare(
            "SELECT Bewerber.BewerberID, Bewerber.Name, Bewerber.Nachname, Bewerber.Beschreibung, Bewerber.Email FROM Bewerber WHERE Bewerber.Email = ?"
        );
        $objPrepared->bind_param("s", $_SESSION["email"]);
        $objPrepared->execute();
        $objResult        = $objPrepared->get_result();
        $arrBewerberData = $objResult->fetch_all(MYSQLI_ASSOC)[0];
        $objBewerberModel = new self();
        $objBewerberModel->setIntBewerberID($arrBewerberData['BewerberID']);
        $objBewerberModel->setStrName($arrBewerberData["Name"]);
        $objBewerberModel->setStrNachname($arrBewerberData["Nachname"]);
        $objBewerberModel->setStrEmail($arrBewerberData["Email"]);
        $objBewerberModel->setStrBeschreibung($arrBewerberData["Beschreibung"]);

        return $objBewerberModel;
    }

    public static function loadUnternehmen(): array
    {
        return self::returnSQLData("SELECT Unternehmen.UnternehmenID, Unternehmen.Name, Unternehmen.Email
                                    FROM Unternehmen");

    }

    public static function changeInDatabase($strSidevorname, $strSidenachname, $strSideemail, $strSidebeschreibung, $intBewerberID): void
    {
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare(
            "UPDATE `reisejobs`.`Bewerber`
            SET `Name`=?,`Nachname`=?, `Email`=?, `Beschreibung`=?
            WHERE `BewerberID`=?;"
        );
        $objPrepared->bind_param("ssssi", $strSidevorname, $strSidenachname, $strSideemail, $strSidebeschreibung, $intBewerberID);
        $objPrepared->execute();
    }

    /**
     * @param int $intBewerberID
     */
    public function setIntBewerberID(int $intBewerberID): void
    {
        $this->intBewerberID = $intBewerberID;
    }

    /**
     * @param string $strName
     */
    public function setStrName(string $strName): void
    {
        $this->strName = $strName;
    }

    /**
     * @param string $strNachname
     */
    public function setStrNachname(string $strNachname): void
    {
        $this->strNachname = $strNachname;
    }

    /**
     * @param string $strBeschreibung
     */
    public function setStrBeschreibung(string $strBeschreibung): void
    {
        $this->strBeschreibung = $strBeschreibung;
    }

    /**
     * @param string $strEmail
     */
    public function setStrEmail(string $strEmail): void
    {
        $this->strEmail = $strEmail;
    }


}