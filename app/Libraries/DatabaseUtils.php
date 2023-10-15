<?php

namespace App\Libraries;

class DatabaseUtils
{
    public static function insertVisit($page)
    {
        if(!isset($_POST['isLanguageChanged'])){

        $db = db_connect();
        $jour = date('Y-m-d H:i:s');
        $result = $db->query("SELECT id FROM Page WHERE nom = '$page'");

        if ($result->getNumRows() > 0) {
            $row = $result->getRow();
            $id_page = $row->id;

            $sql = "INSERT INTO `Visite` (`jour`, `id_page`) VALUES ('{$jour}', '{$id_page}')";
            $db->query($sql);
        }
    }
    }

    public static function selectVisitByMonth()
    {
        $db = db_connect();
        $data = array();

        $isEmpty = true;

        for ($i = 1; $i <= 12; $i++) {
            $result = $db->query("SELECT COUNT(*) AS nombre FROM Visite WHERE id_page = 13 AND MONTH(jour) = $i;");
            $row = $result->getRow();
            $data[] = $row->nombre;
            if($row->nombre != 0){
                $isEmpty = false;
            }
        }

        if($isEmpty){
            return null;
        } else {
            return $data;
        }
    }

    public static function selectVisitByYear()
    {
        $db = db_connect();
        $data = array();

        $isEmpty = true;

        $years = $db->query("SELECT DISTINCT YEAR(jour) AS nombre FROM Visite WHERE id_page = 13");
           
        foreach($years -> getResult() as $year) {
            $annee = $year->nombre;
            $result = $db->query("SELECT COUNT(*) AS nombre FROM Visite WHERE id_page = 13 AND YEAR(jour) = '$annee';");
            $row = $result->getRow();
            $data[] = $row->nombre;
            if($row->nombre != 0){
                $isEmpty = false;
            }
        }

        if($isEmpty){
            return null;
        } else {
            return $data;
        }
    }

    public static function selectYearsVisits()
    {
        $db = db_connect();
        $data = array();

        $years = $db->query("SELECT DISTINCT YEAR(jour) AS nombre FROM Visite WHERE id_page = 13");
           
        foreach($years -> getResult() as $year) {
            $data[] = $year->nombre;
        }

        return $data;
    }

    //Fonction qui permet à travers une requête SQl de récupérer le nom des pages
    public static function selectNameOfPage()
    {
        $db = db_connect();
        $data = array();

        $result2 = $db->query("SELECT description AS Nom_des_pages FROM Page WHERE id  <> '13';");
        if ($result2->getNumRows() > 0) {
            foreach($result2 -> getResult() as $row){
                $nom = $row->Nom_des_pages;
                $data[] = $nom;
            }
            return $data;
        }
    }

    //Fonction qui permet à travers une requête SQl de récupérer le nombre de consultation de chaque pages
    public static function selectNumberOfVisitOfPage()
    {
        $db = db_connect();
        $data = array();

        
            for ($i = 1; $i <= 10; $i++) {
                $result3 = $db->query("SELECT COUNT(V.id) AS nombre from Page P, Visite V WHERE V.id_page = P.id AND P.id <> '13' AND P.id = $i;");
                $row = $result3->getRow();
                $data[] = $row->nombre;
            }
            return $data;
        
    }

    public static function selectVisitByDay($date)
    {
        $db = db_connect();
        $data = array();

        $result = $db->query("SELECT COUNT(*) AS nombre FROM Visite WHERE id_page = 13 AND SUBSTR(jour, 1, 10) = '$date'");
        $row = $result->getRow();

        return $row->nombre;
    }
}
