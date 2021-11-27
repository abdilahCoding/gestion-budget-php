<?php
header('Content-Type: application/json');
require_once('dbconfig.php');

$db = new dbconfig();



$stmt = $db->connection->prepare("SELECT * FROM budget");
$stmt->execute();
$info =$stmt->fetchAll();
$data =array();
foreach($info as $row){
   $data[]=$row;
}

 echo json_encode($data);
 

