<?php
 require_once('dbconfig.php');

$db = new dbconfig();


class Enseignant{


    function insertEnseignant(){
        global $db;

      
$error =array();
if(isset($_POST['send'])){
   

  $Nom = $_POST['nom'];
  $Prenom = $_POST['prenom'];
 $Grade = $_POST['grade'];
 $Echelle = $_POST['echelle'];
 $Residence = $_POST['residence'];
 $Groupe = $_POST['groupes'];
 $Puissance = $_POST['puissance'];
 $Marque = $_POST['marque'];
 $Date = $_POST['date'];


if(empty($Nom) && empty($Prenom) && empty($Grade) && empty($Echelle) && empty($Residence) && empty($Groupe)  && empty($Date)){
 return $error = "fill the fields";
}elseif( empty($Nom) ){
    return $error= "Entrer le Nom";


}elseif(empty($Prenom)){
    return $error = "Entrer le prenom";

}elseif(empty($Grade)){
    return $error= "Entrer Grade";
}elseif(empty($Echelle)){
    return $error = "Entrer Echelle";
}elseif(empty($Residence)){
    return $error = "Entrer la Residence";
}elseif(empty($Groupe)){
        return $error = "Entrer le Goupe";
 }elseif(empty($Date)){
        return $error = "Entrer la Date";
    }else{


        $stmt = $db->connection->prepare("INSERT INTO `enseignant` (`id_Ens`, `Nom`, `Prenom`, `Grade`,`Echelle`,`Puissance`,`Marque`, `Residence`, `Groupe`, `Date`) VALUES (NULL,?,?,?,?,?,?,? ,?,?)");
        $stmt->execute(array($Nom,$Prenom,$Grade,$Echelle,$Puissance,$Marque,$Residence,$Groupe ,$Date));
   if($stmt){
    return $error = "insert success";
   }else{
    return $error = "not insert success";
   }  
}
}
} 

   
function displayEnseignant(){   
    global $db;

$stmt = $db->connection->prepare("SELECT * FROM `enseignant` ORDER BY `id_Ens` DESC");
$stmt->execute();
return $stmt->fetchAll();


 }



     function editEnsInfo(){
        global $db;
  if(isset($_GET['id_Ens'])){
  
      $id_Ens = $_GET['id_Ens'];

  $stmt = $db->connection->prepare("SELECT * FROM enseignant WHERE id_Ens= ? ");
  $stmt->execute(array($id_Ens));
  return $stmt->fetch();

   
  }  
     }


         function editEnsPost(){
                

  global $db;
  if(isset($_POST['send'])){
  
    $Nom = $_POST['nom'];
    $Prenom = $_POST['prenom'];
   $Grade = $_POST['grade'];
   $Echelle = $_POST['echelle'];
   $Residence = $_POST['residence'];
   $Groupe = $_POST['groupes'];
   $Date = $_POST['date'];
   $id=$_POST['id'];
//    return   $Nom ." " .  $Prenom ." " . $Grade ." " . $Echelle ." " . $Residence ." " .  $Groupe ." " . $Date ." " . $id;
   
  
  $stmt = $db->connection->prepare("UPDATE `enseignant` SET `Nom`= ?,`Prenom`= ?,`Grade`= ? ,`Echelle`= ?,`Residence`= ?, `Groupe`= ?,`Date`= ? WHERE id_Ens= ?");
  $stmt->execute(array($Nom,$Prenom,$Grade,$Echelle,$Residence,$Groupe,$Date,$id));
  if($stmt){
      // $error['success'] = "insert success";
      header("location: showEns.php");
     }else{
        // $error = "not insert success";
     }  
}
 }
                   

   function searchEns(){
    global $db;
    if(isset($_POST['search'])){
  
        $Nom = $_POST['nom'].'%'; 
        $Prenom = $_POST['prenom'].'%'; 
       
        if(empty($_POST['nom']) && empty($_POST['prenom'])){
             $error="fill the fields";
             header("Location:addDepl.php?error=$error");

           }elseif( empty($_POST['nom']) ){
                $error = "Entrer le nom";
                header("Location:addDepl.php?error=$error");
                   exit();
           
           }elseif(empty($_POST['prenom'])){
                $error = "Entrer le prenom";
                header("Location:addDepl.php?error=$error");
                exit();
           }else{
        
  $stmt = $db->connection->prepare("SELECT * FROM enseignant WHERE `Nom` LIKE ? AND `Prenom` LIKE ? ");
  $stmt->execute(array($Nom,$Prenom));
   $data = $stmt->fetchAll();
  $rows = $stmt->rowCount();

if($rows > 0){
    return $data;

   }else{
    $error = "Not found";
    header("Location:addDepl.php?error=$error");
    exit();


   }
}

   }
}



} //END class