<?php
 require_once('dbconfig.php');

$db = new dbconfig();


class Entreprise{


    function insertEntreprise(){
        global $db;

      
$error =array();
if(isset($_POST['send'])){

 $Nom = $_POST['nom'];
 $Ville = $_POST['ville'];
 $Email = $_POST['email'];

if(empty($_POST['nom']) && empty($_POST['ville'])){
 return $error= "fill the fields";
}elseif( empty($_POST['nom']) ){
    return $error= "Entrer un nom";


}elseif(empty($_POST['ville'])){
    return $error= "Entrer la ville";

}elseif(empty($_POST['email'])){
    return $error= "Entrer Email";

}else{


        $stmt = $db->connection->prepare("INSERT INTO `société` (`Ids`, `Nom`, `Ville`,`Email`) VALUES (NULL,?, ?, ? )");
         $stmt->execute(array($Nom,$Ville,$Email));
   if($stmt){
    return $error= "insert success";
   }else{
    return $error= "not insert success";
   }  
}}}  
   

function displayEses(){   
    global $db;

$stmt = $db->connection->prepare("SELECT * FROM société");
$stmt->execute();
return $stmt->fetchAll();


 }


     function editEseInfo(){
        global $db;
  if(isset($_GET['id_Ese'])){
  
      $id_Ese = $_GET['id_Ese'];

  $stmt = $db->connection->prepare("SELECT * FROM `société` WHERE Ids = ? ");
  $stmt->execute(array($id_Ese ));
  return $stmt->fetch(); 
  }  
     }

         function editEsePost(){
                

  global $db;
  if(isset($_POST['send'])){
  
   $nom = $_POST['nom'];
   $ville = $_POST['ville'];
   $email = $_POST['email'];
   $id=$_POST['id'];
   
  
  
  $stmt = $db->connection->prepare("UPDATE `société` SET `Nom`= ?,`Ville`= ?,`Email`= ? WHERE Ids = ?");
  $stmt->execute(array($nom,$ville,$email,$id));
  if($stmt){
    //   $error['success'] = "insert success";
      header("location: showEse.php");
     }else{
        // $error = "not insert success";
     }
     
  
}
         }



  


} //END class