<?php
namespace controller;

use model\LoginModel;

class LoginController extends Controller
{

    function verarbeiteDaten()
    {
        $objLoginModel = new LoginModel();
        /** Prüft ob Request eine Registrierung ist */
        if(isset($_POST['usertype']))
        {
            $strUsertype     = htmlentities($_POST['usertype']);
            $strEmail        = htmlentities($_POST['email']);
            $strPasswordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

            /** Registriert User als Unternehmen */
            if($strUsertype == "unternehmen")
            {
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

            //TODO !!! SQL INJECTION !!!
            /** Registriert User als Bewerber */
            elseif($strUsertype == "bewerber")
            {
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
        /** Prüft ob Request ein Login ist */
        elseif(isset($_POST['password']))
        {
            $strEmail               = htmlentities($_POST['email']);
            $strPasswordInput       = $_POST['password'];
            $arrDatabaseInformation = $objLoginModel->loginData($strEmail);
            $strDatabasePassword    = $arrDatabaseInformation[0];
            $intUserID              = $arrDatabaseInformation[1];
            $strUsertype            = $arrDatabaseInformation[2];

            if(password_verify($strPasswordInput, $strDatabasePassword))
            {
                $_SESSION["logged_in"] = true;
                $_SESSION["user_type"] = $strUsertype;
                $_SESSION["email"]     = $strEmail;
                $_SESSION["user_id"]     = $intUserID;

                header('Location: ' . BASEPATH . '/userinterface');
            }
            else
            {
                $loginerror = "Die Email oder das Passwort sind falsch!";
            }
        }
        /** Zerstört die Session → logout */
        elseif(isset($_GET["logout"]))
        {
            session_destroy();
            header('Location: ' . BASEPATH . '/login');
        }

        $strFileName = "loginView.php";
        include /** @lang text */
        "view/layout.php";
    }
}