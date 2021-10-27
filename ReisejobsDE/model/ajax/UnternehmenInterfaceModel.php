<?php

namespace model\ajax;

use model\Model;

class UnternehmenInterfaceModel extends Model
{
    public static function changeInDatabase($strUname, $strUort, $strUbeschreibung, $intUnternehmenID)
    {
        $objDatabase = Model::returnConnection();
        $objPrepared = $objDatabase->prepare(
            "UPDATE `reisejobs`.`Unternehmen`
            SET `Name`=?, `Ort`=?, `Beschreibung`=?
            WHERE  `ID`=?;"
        );
        $objPrepared->bind_param("sssi", $strUname, $strUort, $strUbeschreibung, $intUnternehmenID);
        $objPrepared->execute();
    }
}