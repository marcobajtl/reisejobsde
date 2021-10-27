<?php

namespace model;

abstract class Model
{
    /** Führt angegebene Befehle in der Datenbank aus
     *
     * @param $strSQL
     *
     * @return array
     */
    protected static function returnSQLData($strSQL): array
    {
        $objDb_con    = mysqli_connect("localhost", "root", "", "reisejobs", "3306");
        $arrDB_return = mysqli_query($objDb_con, $strSQL);
        return mysqli_fetch_all($arrDB_return);
    }

    /** Gibt die Verbindung für die MYSQL Datenbank zurück */
    protected static function returnConnection(): object
    {
        return mysqli_connect("localhost", "root", "", "reisejobs", "3306");
    }
}