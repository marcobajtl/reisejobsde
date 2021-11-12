<?php

namespace model\ajax;


use model\Model;

class QuickSearchModel extends Model
{
    /**
     * @param $strUnternehmen
     *
     * @return array
     */
    public function quickFindUnternehmen($strUnternehmen): array
    {
        $objDatabase = Model::returnConnection();
        $strParameter = "%$strUnternehmen%";
        $objPrepared = $objDatabase->prepare("SELECT Unternehmen.Name FROM Unternehmen WHERE Unternehmen.Name LIKE ?");
        $objPrepared->bind_param("s", $strParameter);
        $objPrepared->execute();
        $objResult = $objPrepared->get_result();
        return $objResult->fetch_all();
    }

    public function quickFindJobTitel($strJobTitel): array
    {
        $strParameter = "%$strJobTitel%";
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare("SELECT Jobangebote.Titel FROM Jobangebote WHERE Jobangebote.Titel LIKE ?");
        $objPrepared->bind_param("s", $strParameter);
        $objPrepared->execute();
        $objResult = $objPrepared->get_result();
        return $objResult->fetch_all();
    }
    public function quickFindOrt($strOrt): array
    {
        $strParameter = "%$strOrt%";
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare("SELECT Jobangebote.Standort FROM Jobangebote WHERE Jobangebote.Standort LIKE ? OR Jobangebote.PLZ LIKE ?");
        $objPrepared->bind_param("ss", $strParameter, $strParameter);
        $objPrepared->execute();
        $objResult = $objPrepared->get_result();
        return $objResult->fetch_all();
    }
}