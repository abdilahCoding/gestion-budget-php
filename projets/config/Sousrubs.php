<?php
 require_once('dbconfig.php');

$db = new dbconfig();


class Sousrubs{



function listSousRubriques(){   
global $db;

$stmt = $db->connection->prepare("SELECT * FROM sousrubs");
$stmt->execute();
return $stmt->fetchAll();
 }

} //END 
