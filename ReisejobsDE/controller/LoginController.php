<?php

namespace controller;

use model\LoginModel;

class LoginController extends Controller
{

    /** Zerstört die Session → logout */
    private function checkLogout(): void
    {

        if(isset($_GET["logout"]))
        {
            session_destroy();
            header('Location: ' . BASEPATH . '/login');
        }
    }

    /** Prüft, ob ein Login/ eine Registrierung vorliegt */
    private function checkLogin(): void
    {
        $objLoginModel = new LoginModel();
        /** Prüft ob Request eine Registrierung ist */
        if(isset($_POST['usertype']))
        {
            $strUsertype     = htmlentities($_POST['usertype']);
            $strEmail        = htmlentities($_POST['email']);
            $strPasswordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

            /** Registriert User als Unternehmen */
            if($strUsertype === "unternehmen")
            {
                if(Controller::checkCSRF()){
                    if($objLoginModel->isRegistered($strEmail) <= 0)
                    {
                        $objLoginModel->registerUnternehmen($strEmail, $strPasswordHash);
                        $registersuccess = "Du hast dich erfolgreich Registriert.";
                    }
                    else
                    {
                        $registererror = "Die Email ist bereits Registriert";
                    }
                }
            }

            /** Registriert User als Bewerber */
            elseif($strUsertype === "bewerber")
            {
                if(Controller::checkCSRF()){
                    if($objLoginModel->isRegistered($strEmail) <= 0)
                    {
                        $objLoginModel->registerBewerber($strEmail, $strPasswordHash);
                        $registersuccess = "Du hast dich erfolgreich Registriert.";
                    }
                    else
                    {
                        $registererror = "Die Email ist bereits Registriert";
                    }
                }
            }
        }
        /** Prüft ob Request ein Login ist */
        elseif(isset($_POST['password']))
        {
            if(Controller::checkCSRF()){
                $strEmail               = htmlentities($_POST['email']);
                $strPasswordInput       = $_POST['password'];
                $arrDatabaseInformation = $objLoginModel->loginData($strEmail);
                $strDatabasePassword    = $arrDatabaseInformation[0];
                $intUserID              = $arrDatabaseInformation[1];
                $strUsertype            = $arrDatabaseInformation[2];
                /** Prüft, ob das eingegebene Passwort mit dem Hashwert aus der Datenbank übereinstimmt */
                if(password_verify($strPasswordInput, $strDatabasePassword))
                {
                    $_SESSION["logged_in"] = true;
                    $_SESSION["user_type"] = $strUsertype;
                    $_SESSION["email"]     = $strEmail;
                    $_SESSION["user_id"]   = $intUserID;
                    header('Location: ' . BASEPATH . '/benutzerbereich');
                }
                else
                {
                    $loginerror = "Die Email oder das Passwort sind falsch!";
                }
            }
        }
        $strFileName = "loginView.php";

        include /** @lang text */
        "view/layout.php";
    }

    public function verarbeiteDaten()
    {
        $this->checkLogout();
        $this->checkLogin();
    }
}
