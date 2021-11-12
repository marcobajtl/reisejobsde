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
        $arrRandomJobs = Model::returnSQLArray("SELECT Jobangebote.JobID, Unternehmen.Name, Unternehmen.UnternehmenID, Jobangebote.Titel, Jobangebote.Standort, Jobangebote.Beschreibung
                                                      FROM Jobangebote
                                                      INNER JOIN Unternehmen on Jobangebote.FKUnternehmenID = Unternehmen.UnternehmenID
                                                      ORDER BY RAND() 
                                                      LIMIT 5");
        foreach($arrRandomJobs as $arrJob){
            $obJobModel = new JobModel();
            $obJobModel->setIntJobID(htmlentities($arrJob['JobID']));
            $obJobModel->setStrUnternehmenName(htmlentities($arrJob['Name']));
            $obJobModel->setStrJobName(htmlentities($arrJob['Titel']));
            $obJobModel->setStrJobStandort(htmlentities($arrJob['Standort']));
            $obJobModel->setStrJobBeschreibung(htmlentities($arrJob['Beschreibung']));
            $obJobModel->setIntUnternehmenID(htmlentities($arrJob['UnternehmenID']));
            $arrJobList[] = $obJobModel;

        }
        return $arrJobList;
    }
}