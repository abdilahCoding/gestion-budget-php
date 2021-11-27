<?php
 require_once('dbconfig.php');

$db = new dbconfig();


class Deplacement{




     function displayDeplacement(){   
        global $db;

$stmt = $db->connection->prepare("SELECT * FROM deplacement ORDER BY `id_Deps` DESC ");
  $stmt->execute();
  return $stmt->fetchAll();


     }



} //END class