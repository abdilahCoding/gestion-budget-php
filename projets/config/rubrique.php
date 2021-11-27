<?php
 require_once('dbconfig.php');

$db = new dbconfig();


class Rubrique{




     function displayRubrique(){   
        global $db;

$stmt = $db->connection->prepare("SELECT * FROM rubrique ORDER BY `id_rubrique` DESC ");
  $stmt->execute();
  return $stmt->fetchAll();


     }


     function listRubrique(){   
      global $db;

$stmt = $db->connection->prepare("SELECT * FROM rubrique GROUP BY `Num`");
$stmt->execute();
return $stmt->fetchAll();


   }


} //END class