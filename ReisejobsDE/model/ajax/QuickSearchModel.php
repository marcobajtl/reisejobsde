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
        $strSQLStatement = "SELECT Unternehmen.Name FROM Unternehmen WHERE Unternehmen.Name LIKE '%$strUnternehmen%'";
        return Model::returnSQLData($strSQLStatement);
    }

    public function quickFindJobTitel($strJobTitel): array
    {
        $strSQLStatement = "SELECT Jobangebote.Name FROM Jobangebote WHERE Jobangebote.Name LIKE '%$strJobTitel%'";
        return Model::returnSQLData($strSQLStatement);
    }
    public function quickFindOrt($strOrt): array
    {
        $strSQLStatement = "SELECT Jobangebote.Standort, Jobangebote.PLZ FROM Jobangebote WHERE Jobangebote.Standort LIKE '%$strOrt%'  OR Jobangebote.PLZ LIKE '%$strOrt%'";
        return Model::returnSQLData($strSQLStatement);
    }
}