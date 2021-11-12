<?php

namespace controller;

use model\ajax\UnternehmenBenutzerbereichAjaxModel;
use model\benutzerbereich\BewerberBenutzerbereichModel;
use model\benutzerbereich\JobBenutzerbereichModel;
use model\benutzerbereich\UnternehmenBenutzerbereichModel;
use model\enum\PasswordEnum;
use model\enum\UserTypeEnum;
use model\JobPageModel;
use model\Model;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class BenutzerbereichController extends Controller
{

    /** Schreibt wenn möglich änderungen am Unternehmensprofil in die Datenbank. */
    private function checkChangesUnternehmen(int $intUnternehmensID): void
    {
        if(isset($_POST["uname"]))
        {
            /** Passt das hochgeladene Bild an */
            UnternehmenBenutzerbereichAjaxModel::changeInDatabase($_POST["uname"], $_POST["uort"], $_POST["ubeschreibung"], $intUnternehmensID); //TODO Ajax ändern
            if(isset($_FILES['fileToUpload']))
            {
                $strUploadDir  = "bilder\\upload\\profile\\";
                $strTarloadDir = $strUploadDir . basename($intUnternehmensID . ".png");
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $strTarloadDir);
                $objImage  = imagecreatefromjpeg($strTarloadDir);
                $floatSize = min(imagesx($objImage), imagesy($objImage));
                $objImage  = imagecrop($objImage,
                                       [
                                           'x'      => $floatSize * 0.4,
                                           'y'      => 0,
                                           'width'  => $floatSize,
                                           'height' => $floatSize
                                       ]
                );
                $objImage  = imagescale($objImage, 600, 600);
                imagepng($objImage, $strTarloadDir);
            }
            header("Location: " . BASEPATH . "/benutzerbereich");
        }
    }

    private function checkChangesBewerber(BewerberBenutzerbereichModel $arrBewerberData): void
    {
        if(isset($_POST["sidevorname"]) && Controller::checkCSRF())
        {
            BewerberBenutzerbereichModel::changeInDatabase(
                $_POST["sidevorname"],
                $_POST["sidenachname"],
                $_POST["sideemail"],
                $_POST["sidebeschreibung"],
                $arrBewerberData->intBewerberID
            );
            /** Passt das hochgeladene Bild an */
            if(isset($_FILES['fileToUpload']))
            {
                $strUploadDir  = "bilder\\upload\\bewerber\\";
                $strTarloadDir = $strUploadDir . basename($arrBewerberData->intBewerberID . ".png");
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $strTarloadDir);
                $objImage  = imagecreatefromjpeg($strTarloadDir);
                $floatSize = min(imagesx($objImage), imagesy($objImage));
                $objImage  = imagecrop($objImage,
                                       [
                                           'x'      => $floatSize * 0.4,
                                           'y'      => 0,
                                           'width'  => $floatSize,
                                           'height' => $floatSize
                                       ]
                );
                $objImage  = imagescale($objImage, 600, 600);
                imagepng($objImage, $strTarloadDir);
            }
            header("Location: " . BASEPATH . "/benutzerbereich");
        }
    }

    /** Überprüft, ob der Benutzer angemeldet ist
     * @return void
     */
    private function checkLogin(): void
    {
        /** Wenn ja, dann mit welcher Benutzergruppe */
        if(!isset($_SESSION["logged_in"]))
        {
            header("Location: " . BASEPATH . "/login");
        }
        /** Sonst wird man zum Loginbereich weitergeleitet */
    }

    /** Sendet eine E-Mail an ein ausgewähltes Unternehmen */
    public function sendEmail(): string //TODO Typenbezeichnungen
    {
        if(isset($_POST['nachricht']) && Controller::checkCSRF())
        {
            $strEmail   = Model::returnSQLData("SELECT Unternehmen.Email FROM Unternehmen WHERE Unternehmen.UnternehmenID =" . (int)$_POST['unternehmen'])[0][0];
            $transport = Transport::fromDsn(PasswordEnum::SMTP);
            $strMessage = file_get_contents('mailtemplate/UnternehmenKontaktMail.html');
            $variables = array(
                "{{first_name}}" => $_POST['vorname'],
                "{{last_name}}" => $_POST['nachname'],
                "{{email}}" => $_POST['email'],
                "{{message}}" => $_POST['nachricht']
            );
            foreach ($variables as $key => $value)
            {
                $strMessage = str_replace($key, $value, $strMessage);
            }

            $mailer    = new Mailer($transport);
            $email     = (new Email())
                ->from('ReiseJobs.de <info@reisejobs.de>')
                ->to($strEmail)
                ->subject('Neue Bewerbung')
                ->html($strMessage);

            try
            {
                $mailer->send($email);
                return "Deine Nachricht wurde erfolgreich abgesendet";
            }
            catch(TransportExceptionInterface $e)
            {
                return "Es ist ein Fehler aufloadreten";

            }
        }
        return "";
    }

    /** Gibt ein Array mit den IDs der Favorisierten Jobs zurück */
    private function loadFavorites(): array
    {
        if(isset($_SESSION['user_id']))
        {

            return Model::returnSQLArray("SELECT `FavoritenID`, `FKUserID`, `FKJobID` FROM `reisejobs`.`Favoriten` WHERE  `FKUserID`=" . $_SESSION['user_id']);

        }
        return [];
    }

    /** Gibt alle Jobs aus der Datenbank zurück, die der Benutzer auf seiner Favoritenliste hat.
     *
     * @param $arrFavoriteJobs
     *
     * @return array
     */
    private function loadJobs($arrFavoriteJobs): array
    {
        $arrJobData = JobPageModel::loadJobs();
        $arrJobList = [];
        foreach($arrJobData as $arrJob)
        {
            if(in_array($arrJob["JobID"], array_column($arrFavoriteJobs, 'FKJobID'), true))
            {
                $strBeschreibung = "";
                $arrBeschreibung = explode(" ", $arrJob["Beschreibung"]);
                if(count($arrBeschreibung) >= 20)
                {
                    for($i = 1; $i <= 20; $i++)
                    {
                        $strBeschreibung .= " " . $arrBeschreibung[$i];
                    }
                    $strBeschreibung .= "...";
                }
                else
                {
                    $strBeschreibung = implode(" ", $arrBeschreibung);
                }

                $objJobPageModel = new JobPageModel;
                $objJobPageModel->setIntID($arrJob['JobID']);
                $objJobPageModel->setIntFKUnternehmenID($arrJob['FKUnternehmenID']);
                $objJobPageModel->setStrName($arrJob['Name']);
                $objJobPageModel->setStrTitel($arrJob['Titel']);
                $objJobPageModel->setStrStandort($arrJob['Standort']);
                $objJobPageModel->setIntPostleitzahl($arrJob['PLZ']);
                $objJobPageModel->setStrBeschreibung($strBeschreibung);
                $objJobPageModel->setStrVeroeffentlicht($arrJob['Veroeffentlicht']);
                $arrJobList[] = $objJobPageModel;
            }
        }
        return $arrJobList;
    }

    /** Prüft, ob ein neuer Job angelegt werden soll. */
    private function checkNewJob(int $intUnternehmenID): void
    {

        if(isset($_POST["Jobtitel"]) && Controller::checkCSRF())
        {
            JobBenutzerbereichModel::writeJob($intUnternehmenID, $_POST["Jobtitel"], $_POST["Standort"], $_POST["jobbeschreibung"]);
            header("Location: " . BASEPATH . "/benutzerbereich");
        }
    }

    /** Prüft, ob ein neuer Job entfernt werden soll. */
    private function checkDeleteJob(int $intUnternehmenID): void
    {
        if(isset($_POST["delete"]) && Controller::checkCSRF())
        {
            JobBenutzerbereichModel::deleteJob((string)$_POST["delete"], (string)$intUnternehmenID);
            header("Location: " . BASEPATH . "/benutzerbereich");
        }

    }


    public
    function verarbeiteDaten()
    {
        $this->checkLogin();
        if($_SESSION["user_type"] === UserTypeEnum::UNTERNEHMEN)
        {
            $objUnternehmensDaten = UnternehmenBenutzerbereichModel::loadUnternehmensData();
            $this->checkNewJob($objUnternehmensDaten->intUnternehmenID);
            $this->checkChangesUnternehmen($objUnternehmensDaten->intUnternehmenID);
            $this->checkDeleteJob($objUnternehmensDaten->intUnternehmenID);
            $strFileName = "unternehmensBereichView.php";
        }
        elseif($_SESSION["user_type"] === UserTypeEnum::BEWERBER)
        {

            $arrFavJobs         = $this->loadFavorites();
            $arrUnternehmenList = BewerberBenutzerbereichModel::loadUnternehmen();
            $arrBewerberData    = BewerberBenutzerbereichModel::loadBewerberData();
            $this->checkChangesBewerber($arrBewerberData);
            $strBoxMessage = $this->sendEmail();
            $arrJobList    = $this->loadJobs($arrFavJobs);
            $strFileName   = "bewerberBereichView.php";
        }

        include /** @lang text */
        "view/layout.php";
    }

}