<?php

namespace controller;

use model\ArbeitnehmerModel;
use model\enum\PasswordEnum;
use model\Model;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class ArbeitnehmerController extends Controller
{

    private function checkUser(): void
    {
        if($_SESSION['user_type'] !== "Unternehmen")
        {
            header("Location: " . BASEPATH . "/");
        }
    }

    /** Sendet eine E-Mail an einen Ausgewählten Arbeitssuchenden Arbeitnehmer */
    public function sendEmail(): string //TODO Typenbezeichnungen
    {
        if(isset($_POST['Nachricht']))
        {
            $arrData             = ArbeitnehmerModel::loadBewerberData($_POST['arbeitnehmerid']);
            $transport = Transport::fromDsn(PasswordEnum::SMTP);
            $strMessage = file_get_contents('mailtemplate/ArbeitnehmerKontaktMail.html');
            $variables = array(
                "{{unternehmenEmail}}" => $_SESSION['email'],
                "{{nachricht}}" => $_POST['Nachricht']
            );
            foreach ($variables as $key => $value)
            {
                $strMessage = str_replace($key, $value, $strMessage);
            }

            $mailer    = new Mailer($transport);
            $email     = (new Email())
                ->from('ReiseJobs.de <info@reisejobs.de>')
                ->to($arrData['Email'])
                ->subject('Kontaktanfrage')
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

    public function verarbeiteDaten()
    {
        $this->sendEmail();
        $this->checkUser();
        $arrBewerberList = ArbeitnehmerModel::loadBewerber();
        $strFileName     = "arbeitnehmerView.php";
        include_once "view/layout.php";
    }
}