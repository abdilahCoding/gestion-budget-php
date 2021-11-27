<?php


require_once('dbconfig.php');

$db = new dbconfig();

class Delete {



function delete(){
    global $db;
  
      //Delete admins and users by  id
  if (isset($_GET['id_admin'])){
  
       $id_admin = $_GET['id_admin'];
      
  $stmt = $db->connection->prepare("DELETE FROM `admins` WHERE id_admin = ? ");
  $stmt->execute(array($id_admin));
   if ($stmt){
      header("location:showusers.php");
      exit();
   }
  
   
  }elseif(isset($_GET['id_budget'])){  //Delete Budget by id
      

    $id_budget = $_GET['id_budget'];
  
$stmt = $db->connection->prepare("DELETE FROM `budget` WHERE id_budget = ? ");
$stmt->execute(array($id_budget));

if($stmt){
   header("location:showBudgets.php");
   exit();
}
}

elseif(isset($_GET['id_Ese'])){  //Delete Etreprise by id
      

  $id_Ese = $_GET['id_Ese'];

$stmt = $db->connection->prepare("DELETE FROM `société` WHERE Ids = ? ");
$stmt->execute(array($id_Ese));

if($stmt){
 header("location:showEse.php");
 exit();
}
}




elseif(isset($_GET['id_Ens'])){  //Delete Etreprise by id
      

  $id_Ens = $_GET['id_Ens'];

$stmt = $db->connection->prepare("DELETE FROM `enseignant` WHERE id_Ens = ? ");
$stmt->execute(array($id_Ens));

if($stmt){
 header("location:showEns.php");
 exit();
}
}
elseif(isset($_GET['id_Commande'])){  //Delete Commande by id
      

  $id_Com= $_GET['id_Commande'];

$stmt = $db->connection->prepare("DELETE FROM `opercommande` WHERE id_Commande = ? ");
$stmt->execute(array($id_Com));

if($stmt){
 header("location:showCom.php");
 exit();
}
}elseif(isset($_GET['id_rubrique'])){  //Delete rubrique by id
  
  $id_Rub= $_GET['id_rubrique'];

$stmt = $db->connection->prepare("DELETE FROM `rubrique` WHERE id_rubrique = ? ");
$stmt->execute(array($id_Rub));

if($stmt){
 header("location:showRub.php");
 exit();
}
}
elseif(isset($_GET['id_Depl'])){  //Delete rubrique by id
  
  $id_depl= $_GET['id_Depl'];

$stmt = $db->connection->prepare("DELETE FROM `operdeplacement` WHERE id_dep= ? ");
$stmt->execute(array($id_depl));

if($stmt){
 header("location:showDepl.php");
 exit();
}
}elseif(isset($_GET['id_Cmd'])){  //Delete rubrique by id
  
  $id_Cmd= $_GET['id_Cmd'];

$stmt = $db->connection->prepare("DELETE FROM `commande` WHERE id_Cmd= ? ");
$stmt->execute(array($id_Cmd));

if($stmt){
 header("location:displayCmd.php");
 exit();
}
}
elseif(isset($_GET['id_Deps'])){  //Delete rubrique by id
  
  $id_Depls= $_GET['id_Deps'];

$stmt = $db->connection->prepare("DELETE FROM `deplacement` WHERE id_Deps= ? ");
$stmt->execute(array($id_Depls));

if($stmt){
 header("location:displayDepl.php");
 exit();
}
}
elseif(isset($_GET['id_opRubs'])){  //Delete rubrique by id
  
  $id_opRubs= $_GET['id_opRubs'];

$stmt = $db->connection->prepare("DELETE FROM `operrubs` WHERE id_opRubs= ? ");
$stmt->execute(array($id_opRubs));

if($stmt){
 header("location:showOperRubs.php");
 exit();
}
}


}//End  delete Function

  
    } //End Class