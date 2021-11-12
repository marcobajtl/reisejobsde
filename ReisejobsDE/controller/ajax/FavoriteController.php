<?php

namespace controller\ajax;

use controller\Controller;
use model\Model;

class FavoriteController extends Controller
{

    public function verarbeiteDaten()
    {
        if(isset($_GET['ID'])){
            $intSelectedJob = $_GET['ID'];
            $currentList = Model::returnSQLArray("SELECT `FavoritenID`, `FKUserID`, `FKJobID` FROM `reisejobs`.`Favoriten` WHERE  `FKUserID`=" . $_SESSION['user_id']);
            $objDatabase = Model::returnConnection();
            if (in_array($intSelectedJob, array_column($currentList, 'FKJobID'), true) === false) {
                $objPrepared = $objDatabase->prepare(
                    "INSERT INTO `reisejobs`.`Favoriten` (`FKUserID`, `FKJobID`) VALUES (?, ?);"
                );
                $objPrepared->bind_param("ss", $_SESSION['user_id'], $intSelectedJob);
            }else{
                $objPrepared = $objDatabase->prepare(
                    "DELETE FROM `reisejobs`.`Favoriten` WHERE `FKJobID`= ? AND `FKUserID`= ?");
                $objPrepared->bind_param("ss",$intSelectedJob, $_SESSION['user_id']);
            }
            $objPrepared->execute();

        }
    }
}