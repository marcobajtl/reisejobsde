<?php

namespace model\ajax;

use model\Model;

class UnternehmenBenutzerbereichAjaxModel extends Model
{
    public static function changeInDatabase($strUname, $strUort, $strUbeschreibung, $intUnternehmenID): void
    {
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare(
            "UPDATE `reisejobs`.`Unternehmen`
            SET `Name`=?, `Ort`=?, `Beschreibung`=?
            WHERE  `UnternehmenID`=?;"
        );
        $objPrepared->bind_param("sssi", $strUname, $strUort, $strUbeschreibung, $intUnternehmenID);
        $objPrepared->execute();
    }
}