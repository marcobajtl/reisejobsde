<?php

namespace model;

class LoginModel extends Model
{

    /** Fügt ein Unternehmen in die Datenbank ein
     */
    public function registerUnternehmen($strEmail, $strPassword): void
    {
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare("INSERT INTO Unternehmen(Email, Passwort) VALUE (?, ?)");
        $objPrepared->bind_param("ss", $strEmail, $strPassword);
        $objPrepared->execute();
    }


    /** Fügt ein Bewerber in die Datenbank ein */
    public function registerBewerber($strEmail, $strPassword): void
    {
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare("INSERT INTO Bewerber(Email, Passwort) VALUE (?, ?)");
        $objPrepared->bind_param("ss", $strEmail, $strPassword);
        $objPrepared->execute();
    }


    /** Gibt ein Passwort für eine E-Mail zurück */
    public function loginData($strEmail): array
    {
        // Prüft die E-Mail in der Bewerberdatenbank
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare(
            "SELECT Bewerber.Passwort, Bewerber.BewerberID
                                FROM Bewerber
                                WHERE Bewerber.Email = ?"
        );
        $objPrepared->bind_param("s", $strEmail);
        $objPrepared->execute();
        $objResult             = $objPrepared->get_result();
        $strBewerberPasswordDB = $objResult->fetch_all(MYSQLI_ASSOC);
        // Prüft die E-Mail in der Unternehmensdatenbank
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare(
            "SELECT Unternehmen.Passwort, Unternehmen.UnternehmenID
                                FROM Unternehmen
                                WHERE Unternehmen.Email = ?"
        );
        $objPrepared->bind_param("s", $strEmail);
        $objPrepared->execute();
        $objResult                = $objPrepared->get_result();
        $strUnternehmenPasswordDB = $objResult->fetch_all(MYSQLI_ASSOC);
        if($strBewerberPasswordDB !== [])
        {
            $usertype = "Bewerber";

            return array(
                $strBewerberPasswordDB[0]["Passwort"],
                $strBewerberPasswordDB[0]["BewerberID"],
                $usertype
            );
        }
        if($strUnternehmenPasswordDB !== [])
        {
            $usertype = "Unternehmen";
            return array(
                $strUnternehmenPasswordDB[0]["Passwort"],
                $strUnternehmenPasswordDB[0]["UnternehmenID"],
                $usertype
            );
        }
        return array();
    }

    /**
     * Gibt zurück, ob eine E-Mail schon verwendet wurde
     */
    public function isRegistered($strEmail): int
    {
        //Zählt, wie oft die angegebene E-Mail als Benutzerkonto registriert wurde.
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare(
            "SELECT COUNT('Bewerber.Email') FROM Bewerber WHERE Bewerber.Email = ?");
        $objPrepared->bind_param("s", $strEmail);
        $objPrepared->execute();
        $objResult                = $objPrepared->get_result();
        $intBewerberRegister = (int)$objResult->fetch_row()[0];
        //Zählt, wie oft die angegebene E-Mail als Unternehmenskonto registriert wurde.
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare(
            "SELECT COUNT('Unternehmen.Email') FROM Unternehmen WHERE Unternehmen.Email = ?");
        $objPrepared->bind_param("s", $strEmail);
        $objPrepared->execute();
        $objResult                = $objPrepared->get_result();
        $intUnternehmenRegister = (int)$objResult->fetch_row()[0];
        //Gibt zurück, wie oft eine E-Mail registriert wurde
        return $intBewerberRegister + $intUnternehmenRegister;
    }
}