<?php

namespace controller\ajax;

use controller\Controller;
use JsonException;
use model\enum\PasswordEnum;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class KontaktAjaxController extends controller
{
    /** Überprüft, ob das Absenden des Kontaktformulars erfolgreich war
     * @return bool
     */

    /** Überprüft, ob in das Honeypotfeld etwas eingetragen wurde
     *
     * @param $strHoneypot
     *
     * @return bool
     */
    public function checkHoneypot($strHoneypot): bool
    {
        return $strHoneypot !== "";
    }

    /** Sendet die Kontaktnachricht an die Administrator-E-Mail
     *
     * @param $arrJSONData
     *
     * @return void
     */
    public function sendEmail($arrJSONData): void
    {
        if(isset($arrJSONData['nachricht']) && Controller::checkCSRF($arrJSONData['CSRFToken']))
        {

            $strVorame    = $arrJSONData['vorname'];
            $strNachname  = $arrJSONData['nachname'];
            $strEmail     = $arrJSONData['email'];
            $strNachricht = $arrJSONData['nachricht'];
            $strHoneypot  = $arrJSONData['honeypot'];


            $objTransport    = Transport::fromDsn(PasswordEnum::SMTP);
            $strMessage   = file_get_contents('mailtemplate/KontaktNachrichtMail.html');
            $arrVars    = array(
                "{{vorname}}" => $strVorame,
                "{{nachname}}"  => $strNachname,
                "{{email}}"      => $strEmail,
                "{{message}}"    => $strNachricht
            );
            foreach($arrVars as $strKey => $strValue)
            {
                $strMessage = str_replace($strKey, $strValue, $strMessage);
            }
            if($this->checkHoneypot($strHoneypot))
            {
                $strMessage = "--Spam-- \n" . $strMessage;
            }

            $objMailer = new Mailer($objTransport);
            $objEmail  = (new Email())
                ->from('ReiseJobs.de <info@reisejobs.de>')
                ->to($strEmail)
                ->subject('Neues Support Ticket')
                ->html($strMessage);

            try
            {
                $objMailer->send($objEmail);
                echo 0;
            }
            catch(TransportExceptionInterface $strError)
            {
                echo 1;
                echo $strError->getMessage();
            }
        }else{
            echo 1;
            sleep(3);
        }
    }

    /**
     * @throws JsonException
     */
    public function verarbeiteDaten()
    {
        header("Content-Type: application/json");
        // Lese JSON Daten aus dem Header aus
        $arrJSONData = json_decode(stripslashes(file_get_contents("php://input")), true, 512, JSON_THROW_ON_ERROR);
        $this->sendEmail($arrJSONData);

    }


}