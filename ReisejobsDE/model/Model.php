<?php

namespace model;

abstract class Model
{
    /** Führt angegebene Befehle in der Datenbank aus und gibt das Ergebnis zurück
     *
     * @param $strSQL
     *
     * @return array */
    public static function returnSQLData($strSQL): array
    {
        $objDb_con    = mysqli_connect("localhost", "root", "", "reisejobs", "3306");
        $arrDB_return = mysqli_query($objDb_con, $strSQL);
        return mysqli_fetch_all($arrDB_return);
    }

    /** Gibt ein Assoziatives Array zurück.
     *
     * @param $strSQL
     *
     * @return array
     */
    public static function returnSQLArray($strSQL): array
    {
        $arrRows = [];
        $objDb_con    = mysqli_connect("localhost", "root", "", "reisejobs", "3306");
        $arrDB_return = mysqli_query($objDb_con, $strSQL);
        while($arrRow = $arrDB_return->fetch_array(MYSQLI_ASSOC))
        {
            $arrRows[] = $arrRow;
        }
        return $arrRows;
    }

    /** Gibt die Verbindung für die MYSQL Datenbank zurück */
    public static function returnConnection(): object
    {
        return mysqli_connect("localhost", "root", "", "reisejobs", "3306");
    }

    /** Führt ein Statement aus und gibt keinen Wert zurück */
    public static function executeStatement($strSQL): void
    {
        $objDb_con    = mysqli_connect("localhost", "root", "", "reisejobs", "3306");
        mysqli_query($objDb_con, $strSQL);
    }

}