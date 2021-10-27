<?php

namespace model;

class IndexModel extends Model
{
    /** Wählt 5 zufällige Jobs aus der Datenbank
     * @return array
     */
    public function loadRandomJobs(): array
    {
        $arrJobList = [];
        $arrRandomJobs = Model::returnSQLData("SELECT Jobangebote.ID, Unternehmen.Name, Jobangebote.Name, Jobangebote.Standort, Jobangebote.Beschreibung
                                                      FROM Jobangebote
                                                      INNER JOIN Unternehmen on Jobangebote.FKUnternehmenID = Unternehmen.ID
                                                      ORDER BY RAND() 
                                                      LIMIT 5");
        foreach($arrRandomJobs as $arrJob){
            $arrJobList[] = new JobModel($arrJob[0], $arrJob[1],$arrJob[2],$arrJob[3],$arrJob[4]);
        }
        return $arrJobList;
    }
}