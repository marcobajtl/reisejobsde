<?php

namespace model;

class LoginModel extends Model
{

    /** Fügt ein Unternehmen in die Datenbank ein
     */
    public function registerUnternehmen($strEmail, $strPassword)
    {
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare("INSERT INTO Unternehmen(Email, Passwort) VALUE (?, ?)");
        $objPrepared->bind_param("ss", $strEmail, $strPassword);
        $objPrepared->execute();
    }


    /** Fügt ein Bewerber in die Datenbank ein */
    public function registerBewerber($strEmail, $strPassword)
    {
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare("INSERT INTO Bewerber(Email, Passwort) VALUE (?, ?)");
        $objPrepared->bind_param("ss", $strEmail, $strPassword);
        $objPrepared->execute();
    }


    /** Gibt ein Passwort für eine E-Mail zurück */
    public function loginData($strEmail): array
    {
        $strBewerberPasswordDB    = Model::returnSQLData(
            "SELECT Bewerber.Passwort, Bewerber.ID
                                FROM Bewerber
                                WHERE Bewerber.Email = \"$strEmail\""
        );
        $strUnternehmenPasswordDB = Model::returnSQLData(
            "SELECT Unternehmen.Passwort, Unternehmen.ID
                                FROM Unternehmen
                                WHERE Unternehmen.Email = \"$strEmail\""
        );
        if($strBewerberPasswordDB != null)
        {
            $usertype = "Bewerber";
            return array($strBewerberPasswordDB[0][0],$strBewerberPasswordDB[0][1], $usertype);
        }
        elseif($strUnternehmenPasswordDB != null)
        {
            $usertype = "Unternehmen";
            return array($strUnternehmenPasswordDB[0][0],$strUnternehmenPasswordDB[0][1], $usertype);
        }
        return array();
    }

    /**
     * Gibt zurück, ob eine E-Mail schon verwendet wurde
     */
    public function isRegistered($strEmail): int
    {
        $arrBewerberRegister    = intval(Model::returnSQLData("SELECT COUNT('Bewerber.Email') FROM Bewerber WHERE Bewerber.Email =  \"$strEmail\"")[0][0]);
        $arrUnternehmenRegister = intval(Model::returnSQLData("SELECT COUNT('Unternehmen.Email') FROM Unternehmen WHERE Unternehmen.Email = \"$strEmail\"")[0][0]);
        return $arrBewerberRegister + $arrUnternehmenRegister;
    }
}