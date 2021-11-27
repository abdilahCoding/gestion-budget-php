<?php
 require_once('dbconfig.php');

$db = new dbconfig();


class Commande{

     function displayCommande(){   
        global $db;

$stmt = $db->connection->prepare("SELECT * FROM commande ORDER BY `id_Cmd` DESC ");
  $stmt->execute();
  return $stmt->fetchAll();


     }



} //END class