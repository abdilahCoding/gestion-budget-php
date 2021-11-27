<?php
 require_once('dbconfig.php');

$db = new dbconfig();





class OperCommandes{


    function insertCommande(){
        global $db;

      
$error =array();
if(isset($_POST['send'])){


 $NmCommande = filter_var($_POST['Nmcommande'], FILTER_SANITIZE_STRING);
 $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
 $prix_unit = filter_var($_POST['prixUnit'], FILTER_VALIDATE_FLOAT);
 $quantité = filter_var($_POST['quantité'], FILTER_VALIDATE_INT);
 $total = filter_var($_POST['total'], FILTER_VALIDATE_FLOAT);
 $date = $_POST['date'];
 $frs = filter_var($_POST['frs'], FILTER_SANITIZE_STRING);

 $stmt = $db->connection->prepare("SELECT Ids FROM `société`");
 $stmt->execute();
$resFrs=$stmt->fetch();

 $id_Frs = $resFrs['Ids'];

if(empty($_POST['Nmcommande']) && empty($_POST['description']) && empty($_POST['prixUnit']) && empty($_POST['quantité']) && empty($_POST['total']) && empty($_POST['total']) && empty($_POST['date']) && empty($_POST['frs'])){
 return $error= "fill the fields";
}elseif( empty($_POST['Nmcommande']) ){
    return $error= "Entrer la numéro de commande";

}elseif(empty($_POST['description'])){
    return $error= "Entrer la Descrition";

}elseif(empty($_POST['prixUnit'])){
    return $error= "Entrer le prix Unitaire";
}elseif(empty($_POST['quantité'])){
    return $error= "Entrer la quantité";
}elseif(empty($_POST['total'])){
    return $error= "Entrer total";
   
    
}elseif(empty($_POST['date'])){
    return $error= "Entrer la date"; 
}elseif(empty($_POST['frs'])){
    return $error= "Entrer la Frs";
    }elseif($total ===false){
        return $error= "Entrer un nombre dans le champ Total";
        
    }elseif($quantité ===false){
        return $error= "Entrer un nombre dans le champ Quantité>";
        
    }elseif($prix_unit ===false){
        return $error= "Entrer un nombre dans le champ prix unitaire";
    
        
    }else{
    

       
         $sq = $db->connection->prepare("SELECT tarifCmd FROM commande WHERE Year(Date) = ? ");
         $sq->execute(array($date));
         $res = $sq->fetch();
        
         if($res[0] > $total){
            $stmt = $db->connection->prepare("INSERT INTO `opercommande` (`id_Commande`,`id_Fr`,`Num_Commande`,`Description`,`Prix_Unitaire`,`Quantité`,`Total`,`date`,`Fournisseur`) VALUES (NULL,?,?,?,?,?,?,?,? )");
            $stmt->execute(array($id_Frs,$NmCommande,$description,$prix_unit,$quantité,$total,$date,$frs));
            $sql = $db->connection->prepare("UPDATE `commande` SET tarifCmd = tarifCmd - $total WHERE Year(Date) = ?  ");
            $sql->execute(array($date));
         }else{
            $cal = $total - $res[0] ;
            $sql = $db->connection->prepare("UPDATE `commande` SET tarifCmd = 0 WHERE Year(Date) = ?  ");
            $sql->execute(array($date));
            
            $stmt = $db->connection->prepare("INSERT INTO `opercommande` (`id_Commande`,`id_Fr`,`Num_Commande`,`Description`,`Prix_Unitaire`,`Quantité`,`Total`,`date`,`Fournisseur`,`Rest_Payer`) VALUES (NULL,?,?,?,?,?,?,?,?,? )");
            $stmt->execute(array($id_Frs,$NmCommande,$description,$prix_unit,$quantité,$total,$date,$frs,$cal));

        }if ($stmt){
    return $error= "insert success";
   }else{
    return $error= "not insert success";
   }
   
}


}

}  



function displayCommande(){   
    global $db;

    $stmt = $db->connection->prepare("SELECT * FROM opercommande ORDER BY `id_Commande` DESC ");
    $stmt->execute();$stmt->execute();
return $stmt->fetchAll();


 }

     function editComget(){
        global $db;
  if(isset($_GET['id_Commande'])){
  
     $IdComm = $_GET['id_Commande'];

  $stmt = $db->connection->prepare("SELECT * FROM `opercommande` WHERE id_Commande = ? ");
  $stmt->execute(array($IdComm));
   return $stmt->fetch();
   
   
  }  
     }


         function editCompost(){
                

  global $db;
  if(isset($_POST['send'])){
  
 
    $NmCommande = filter_var($_POST['Nmcommande'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $prix_unit = filter_var($_POST['prixUnit'], FILTER_VALIDATE_FLOAT);
    $quantité = filter_var($_POST['quantité'], FILTER_VALIDATE_INT);
    $total = filter_var($_POST['total'], FILTER_VALIDATE_FLOAT);
    $date = $_POST['date'];
    $frs = filter_var($_POST['frs'], FILTER_SANITIZE_STRING);
   $id=$_POST['id_com'];
   $rest=$_POST['rest'];
   if($total ===false){
    return $error= "Entrer un nombre dans le champ Total";
    
}elseif($quantité ===false){
    return $error= "Entrer un nombre dans le champ Quantité>";
    
}elseif($prix_unit ===false){
    return $error= "Entrer un nombre dans le champ prix unitaire";

    
}else{



   $sl = $db->connection->prepare("SELECT * FROM opercommande WHERE id_Commande = $id");
   $sl->execute();
    $data = $sl->fetch();
     $rows = $sl->rowCount();
    
   if($rows){
       
    if($total > $data[6]){
        
     if($rest > 0){
         $r=$total -  $data[6];
        
         $sql = $db->connection->prepare("UPDATE `opercommande` SET `Num_Commande`= ?,`Description`= ?,`Prix_Unitaire`= ?,`Quantité`= ?,`Total`= ?,`date`= ?,`Fournisseur`=?,`Rest_Payer`= `Rest_Payer` + ? WHERE id_Commande = ? ");
            $sql->execute(array($NmCommande,$description,$prix_unit,$quantité,$total,$date,$frs,$r,$id));
            header("Location:showCom.php");      
            // return "0";
            exit(); 
     }
   
    }
    
    if($total <  $data[6]) {
        if($rest > 0){
            $re=  $data[6]- $total;
             if($re >= $rest){
                 $commandeCalc= $re - $rest;
                $stm = $db->connection->prepare("UPDATE `opercommande` SET `Num_Commande`= ?,`Description`=?,`Prix_Unitaire`=?,`Quantité`=?,`Total`=  ?,`date`=?,`Fournisseur`=?,`Rest_Payer`= ? WHERE id_Commande = ? ");
                $stm->execute(array($NmCommande,$description,$prix_unit,$quantité,$total,$date,$frs,0,$id));
                $sql = $db->connection->prepare("UPDATE `commande` SET tarifCmd = tarifCmd + $commandeCalc WHERE Year(Date) = ?  ");
               $sql->execute(array($date));
               header("Location:showCom.php");      
               // return "1";
               exit(); 
             }elseif($re < $rest) {
                $stm = $db->connection->prepare("UPDATE `opercommande` SET `Num_Commande`= ?,`Description`=?,`Prix_Unitaire`=?,`Quantité`=?,`Total`=  ?,`date`=?,`Fournisseur`=?,`Rest_Payer`= ? WHERE id_Commande = ? ");
                $stm->execute(array($NmCommande,$description,$prix_unit,$quantité,$total,$date,$frs,$re,$id));
                header("Location:showCom.php");      
                // return "2";
                exit(); 
             }
        }

    }
    if($rest == 0) {
        
        $sq = $db->connection->prepare("SELECT tarifCmd FROM commande WHERE Year(Date) = ? ");
        $sq->execute(array($date));
        $res = $sq->fetch();
         
        if( $data[6] <= $total){
            $cal= $total - $data[6] ;
            if($res[0]>= $cal){
                $stm = $db->connection->prepare("UPDATE `opercommande` SET `Num_Commande`= ?,`Description`= ?,`Prix_Unitaire`= ?,`Quantité`= ?,`Total`=  ?,`date`= ?,`Fournisseur`=?  WHERE id_Commande = ? ");
                $stm->execute(array($NmCommande,$description,$prix_unit,$quantité,$total,$date,$frs,$id));
                $sql = $db->connection->prepare("UPDATE `commande` SET tarifCmd = tarifCmd - $cal WHERE Year(Date) = ?  ");
                $sql->execute(array($date));
                header("Location:showCom.php");      
                // return "3";
                exit(); 
            }elseif ($cal >= $res[0]) {
                // $cl= $total - $data[5];
                // $res =$cal - $rest;
                // $res= $data[5] % $cl;
                $re=$cal -$res[0];
                $stm = $db->connection->prepare("UPDATE `opercommande` SET `Num_Commande`= ?,`Description`= ?,`Prix_Unitaire`= ?,`Quantité`= ?,`Total`=  ?,`date`= ?,`Fournisseur`=? ,`Rest_Payer`= ? WHERE id_Commande = ? ");
                $stm->execute(array($NmCommande,$description,$prix_unit,$quantité,$total,$date,$frs,$re,$id));
                $sql = $db->connection->prepare("UPDATE `commande` SET tarifCmd = ? WHERE Year(Date) = ?  ");
                $sql->execute(array(0,$date));
                header("Location:showCom.php");      
                // return "4";
                exit(); 
               
            }
           
            
        }if($data[6] >= $total){
            $cal=  $data[6] - $total;
            $stm = $db->connection->prepare("UPDATE `opercommande` SET `Num_Commande`= ?,`Description`= ?,`Prix_Unitaire`= ?,`Quantité`= ?,`Total`=  ?,`date`= ?,`Fournisseur`=?  WHERE id_Commande = ? ");
            $stm->execute(array($NmCommande,$description,$prix_unit,$quantité,$total,$date,$frs,$id));
            $sql = $db->connection->prepare("UPDATE `commande` SET tarifCmd = tarifCmd + $cal WHERE Year(Date) = ?  ");
            $sql->execute(array($date));
            header("Location:showCom.php");      
            // return "5";
            exit(); 
           
        }
        
        
        
    }
    

}//AND if  rowCount
}//AND Filter Input
  
  
     
  
}
 }



    

     function displaySearch(){   
        global $db;
        if(isset($_POST['search'])){

 $year = $_POST['years'];
          
   
     $stmt = $db->connection->prepare("SELECT * FROM `opercommande` WHERE Year(Date) = $year ORDER BY `id_Commande` DESC ");
     $stmt->execute();
     $rows = $stmt->rowCount();     
    if ($rows > 0){
        return $stmt->fetchAll(); 
    }else{
    
        return $error= "Vide";
  }              

 }
}
     

} //END class