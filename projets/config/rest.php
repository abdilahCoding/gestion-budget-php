<?php



require_once('dbconfig.php');

$db = new dbconfig();



function commande(){
    global $db;

$Curdate = date('Y');
$Lastdate = date('Y') - 1;
$stmt = $db->connection->prepare("SELECT id_Commande,Rest_Payer FROM `opercommande` where Rest_Payer > ? AND Year(Date) = ? OR Year(Date) = ? ");
$stmt->execute(array(0,$Curdate,$Lastdate));
    $lent= $stmt->fetchAll();
   
    $si= count($lent);
//       //  $lent[1][0];
     
    
    $sql = $db->connection->prepare("SELECT * FROM `commande` where tarifCmd > ? AND Year(Date) = ?   ");
    $sql->execute(array(0,$Curdate));
    $data= $sql->fetch();
     $budget= $data[2];
    $id= $data[0];
     

  for ($i=0; $i < $si ; $i++) { 
    if($lent[$i][1] <= $budget){
      $sql = $db->connection->prepare("UPDATE `commande` SET tarifCmd = tarifCmd - ? WHERE id_Cmd = ?   ");
      $sql->execute(array($lent[$i][1],$id));
      $st = $db->connection->prepare("UPDATE `opercommande` SET Rest_Payer = ? WHERE id_Commande = ?  ");
      $st->execute(array(0,$lent[$i][0]));
      return 'succes';
    }
  }    
}




function deplacement(){
  global $db;
  $Curdate = date('Y');
  $Lastdate = date('Y') - 1;
  $stmt = $db->connection->prepare("SELECT id_dep,Rest_Payer FROM `operdeplacement` where Rest_Payer > ? AND Year(Date) = ? OR Year(Date) = ?  ");
  $stmt->execute(array(0,$Curdate,$Lastdate));
  $lent= $stmt->fetchAll();
 
  $si= count($lent);
    //  $lent[1][0];
   
  
  $sql = $db->connection->prepare("SELECT * FROM `deplacement` where tarifDep > ? AND Year(Date) = ?  ");
  $sql->execute(array(0,$Curdate));
  $data= $sql->fetch();
   $budget= $data[2];
   $id= $data[0];
   

for ($i=0; $i < $si ; $i++) { 
  if($lent[$i][1] <= $budget){
    $sql = $db->connection->prepare("UPDATE `deplacement` SET tarifDep = tarifDep - ? WHERE id_Deps  = ?   ");
    $sql->execute(array($lent[$i][1],$id));
    $st = $db->connection->prepare("UPDATE `operdeplacement` SET Rest_Payer = ? WHERE id_dep = ?  ");
    $st->execute(array(0,$lent[$i][0]));
    return 'succes';
  }
}

}




function operRubs(){
global $db;
$Curdate = date('Y');
$lastdate = date('Y') - 1;
$stmt = $db->connection->prepare("SELECT id_opRubs,RuriqueName,Rest FROM `operrubs` where Rest > ? AND Year(Date) = ? OR Year(Date) = ?  ");
$stmt->execute(array(0,$Curdate,$lastdate));
$lent= $stmt->fetchAll();

$si= count($lent);
  //  $lent[1][0];
 

$sql = $db->connection->prepare("SELECT `id_rubrique`,`Description`,`tarifFix` FROM `rubrique` where tarifFix > ? AND Year(Date) = ?   ");
$sql->execute(array(0,$Curdate));
$data= $sql->fetchAll();
//  $budget= $data[2];
//  $id= $data[0];
 $rub= count($data);
 

for ($i=0; $i < $si ; $i++) { 
 $rest = $lent[$i][2];
 $Rbname = $lent[$i][1];
for ($y=0; $y < $rub ; $y++) { 
 
if($rest <= $data[$y][2]){
  if ($Rbname == $data[$y][1]) {
    
    // echo $data[$y][1];
    // return "good";
    $id =$data[$y][0];
    $sql = $db->connection->prepare("UPDATE `rubrique` SET tarifFix = tarifFix - ? WHERE `Description`= ? AND id_rubrique = ?    ");
    $sql->execute(array($lent[$i][2],$data[$y][1],$data[$y][0]));
    $st = $db->connection->prepare("UPDATE `operrubs` SET Rest = ? WHERE id_opRubs = ?  ");
    $st->execute(array(0,$lent[$i][0]));
    return 'succes';
  }
 
}

}
}

}




$date = date('Y');
$lastdate = date('Y') - 1;

$stmt = $db->connection->prepare("SELECT Rest_Payer FROM `opercommande` where Rest_Payer > ? AND Year(Date) = ?  OR Year(Date) = ? ");
$stmt->execute(array(0,$date,$lastdate));
$row =$stmt->rowCount();
if($row > 0){
 print_r(commande());
}


$qr = $db->connection->prepare("SELECT Rest_Payer FROM `operdeplacement` where Rest_Payer > ? AND Year(Date) = ?  OR Year(Date) = ? ");
$qr->execute(array(0,$date,$lastdate));
$rowdep =$qr->rowCount();
if($rowdep > 0){
 print_r(deplacement());
}



$qry = $db->connection->prepare("SELECT Rest FROM `operrubs` where Rest > ? AND Year(Date) = ?  OR Year(Date) = ? ");
$qry->execute(array(0,$date,$lastdate));
$rowOpRub =$qry->rowCount();
if($rowOpRub > 0){
 print_r(operRubs());
}























