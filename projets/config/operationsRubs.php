<?php
 require_once('dbconfig.php');

$db = new dbconfig();


class OperRubs{



   function insertOperRubs(){   
      global $db;
     
      
      if(isset($_POST['send'])){
      
      
       $rubrique = filter_var($_POST['rubrique'], FILTER_SANITIZE_STRING);
       $SousRub = filter_var($_POST['SousRub'], FILTER_SANITIZE_STRING);
       $prix = filter_var($_POST['prix'], FILTER_VALIDATE_FLOAT);
       $type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
       $date = $_POST['date'];
      
      if(empty($_POST['rubrique']) && empty($_POST['SousRub']) && empty($_POST['prix']) && empty($_POST['date']) && empty($_POST['type'])){
       return $error['fill'] = "fill the fields";
      }elseif( empty($_POST['rubrique']) ){
          return $error = "Entrer la rubrique";
      
      }elseif(empty($_POST['SousRub'])){
          return $error= "Entrer la Sous Rubrique";
      
      }elseif(empty($_POST['prix'])){
          return $error = "Entrer le prix total";
     
      }elseif(empty($_POST['date'])){
          return $error= "Entrer la date"; 
      }elseif(empty($_POST['type'])){
          return $error= "Entrer le type";              
          }elseif($prix ===false){
              return $error = "Entrer un nombre dans le champ prix";
              
          }else{

        $sq = $db->connection->prepare("SELECT tarifFix FROM rubrique WHERE `Description` = ? AND Year(Date) = ? ");
        $sq->execute(array($rubrique,$date));
     $res = $sq->fetch();
       
        if($res[0] > $prix){
             $stmt = $db->connection->prepare("INSERT INTO `operrubs` (`id_opRubs`, `RuriqueName`, `SousRubName`, `prix`, `date`, `type`) VALUES (NULL,?,?,?,?,?)");
             $stmt->execute(array($rubrique,$SousRub,$prix,$date,$type));
           $sql = $db->connection->prepare("UPDATE `rubrique` SET tarifFix = tarifFix - $prix WHERE `Description` = ? AND Year(Date) = ?  ");
           $sql->execute(array($rubrique,$date));
        }else{
           $cal = $prix - $res[0] ;
           $sql = $db->connection->prepare("UPDATE `rubrique` SET tarifFix = 0 WHERE `Description` = ? AND Year(Date) = ?  ");
           $sql->execute(array($rubrique,$date));
           
          $stmt = $db->connection->prepare("INSERT INTO `operrubs` (`id_opRubs`, `RuriqueName`, `SousRubName`, `prix`, `date`, `type`,`Rest`) VALUES (NULL,?,?,?,?,?,?)");
                  $stmt->execute(array($rubrique,$SousRub,$prix,$date,$type,$cal));

       }if ($stmt){
   return $error['success'] = "insert success";
  }else{
   return $error['eroror'] = "not insert success";
  }
         
      }
    }
      

   } //end function



   
   function editOperRubsget(){
    global $db;
if(isset($_GET['id_opRubs'])){

 $opRubs = $_GET['id_opRubs'];

$stmt = $db->connection->prepare("SELECT * FROM `operrubs` WHERE id_opRubs  = ? ");
$stmt->execute(array($opRubs));
return $stmt->fetch();


}  
 }


     function editOperRubspost(){
            

global $db;
if(isset($_POST['send'])){


    $rubrique = filter_var($_POST['rubrique'], FILTER_SANITIZE_STRING);
    $SousRub = filter_var($_POST['SousRub'], FILTER_SANITIZE_STRING);
    $prix = filter_var($_POST['prix'], FILTER_VALIDATE_FLOAT);
    $type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
    $date = $_POST['date'];
    $id=$_POST['id_opRubs'];
    $rest=$_POST['rest'];
if($prix ===false){
return $error = "Entrer un nombre dans le champ Total";

}else{

$sl = $db->connection->prepare("SELECT * FROM `operrubs` WHERE id_opRubs= $id");
$sl->execute();
$data = $sl->fetch();
 $rows = $sl->rowCount();

if($rows){
   
if($prix > $data[3]){
    
 if($rest > 0){
     $r=$prix - $data[3];
    
     $sql = $db->connection->prepare("UPDATE `operrubs` SET `RuriqueName`= ?,`SousRubName`= ?,`prix`= ?,`date`= ?,`type`= ?,`Rest`= `Rest` + ? WHERE id_opRubs = ? ");
        $sql->execute(array($rubrique,$SousRub,$prix,$date,$type,$r,$id));
        header("Location:showOperRubs.php");      
        // return "0";
        exit(); 
 }

}

if($prix < $data[3]) {
    if($rest > 0){
        $re= $data[3]- $prix;
         if($re >= $rest){
             $commandeCalc= $re - $rest;
        
            $stm = $db->connection->prepare("UPDATE `operrubs` SET `RuriqueName`= ?,`SousRubName`= ?,`prix`= ?,`date`= ?,`type`= ?,`Rest`=  ? WHERE id_opRubs = ? ");
        $stm->execute(array($rubrique,$SousRub,$prix,$date,$type,0,$id));
            $sql = $db->connection->prepare("UPDATE `rubrique` SET tarifFix = tarifFix + $commandeCalc WHERE `Description` = ? AND Year(date) = ?  ");
           $sql->execute(array($rubrique,$date));
           header("Location:showOperRubs.php");      
        // return "1";
        exit(); 
         }elseif($re < $rest) {
            
            $stm = $db->connection->prepare("UPDATE `operrubs` SET `RuriqueName`= ?,`SousRubName`= ?,`prix`= ?,`date`= ?,`type`= ?,`Rest`= ? WHERE id_opRubs = ? ");
           $stm->execute(array($rubrique,$SousRub,$prix,$date,$type,$re,$id));
           header("Location:showOperRubs.php");      
           // return "2";
           exit(); 
         }
    }

}
if($rest == 0) {
    
    $sq = $db->connection->prepare("SELECT tarifFix FROM rubrique WHERE `Description` = ? AND Year(date) = ? ");
    $sq->execute(array($rubrique,$date));
    $res = $sq->fetch();
     
    if($data[3] <= $prix){
        $cal= $prix - $data[3];
        if($res[0]>= $cal){
            $stm = $db->connection->prepare("UPDATE `operrubs` SET `RuriqueName`= ?,`SousRubName`= ?,`prix`= ?,`date`= ?,`type`= ? WHERE id_opRubs = ? ");
            $stm->execute(array($rubrique,$SousRub,$prix,$date,$type,$id));
            $sql = $db->connection->prepare("UPDATE `rubrique` SET tarifFix = tarifFix - $cal WHERE `Description` = ? AND Year(date) = ?  ");
            $sql->execute(array($rubrique,$date));
            return "3";
        }elseif ($cal >= $res[0]) {
            // $cl= $total - $data[5];
            // $res =$cal - $rest;
            // $res= $data[5] % $cl;
            $re=$cal -$res[0];
            $stm = $db->connection->prepare("UPDATE `operrubs` SET `RuriqueName`= ?,`SousRubName`= ?,`prix`= ?,`date`= ?,`type`= ? ,`Rest`= ? WHERE id_opRubs = ? ");
            $stm->execute(array($rubrique,$SousRub,$prix,$date,$type,$re,$id));
            $sql = $db->connection->prepare("UPDATE `rubrique` SET tarifFix = 0 WHERE `Description` = ? AND Year(date) = ?  ");
            $sql->execute(array($rubrique,$date));
            header("Location:showOperRubs.php");      
            // return "4";
            exit(); 
        }
       
        
    }if($data[3] >= $prix){
        $cal=  $data[3] - $prix;
        $stm = $db->connection->prepare("UPDATE `operrubs` SET `RuriqueName`= ?,`SousRubName`= ?,`prix`= ?,`date`= ?,`type`= ? WHERE id_opRubs = ? ");
         $stm->execute(array($rubrique,$SousRub,$prix,$date,$type,$id));
        $sql = $db->connection->prepare("UPDATE `rubrique` SET tarifFix = tarifFix + $cal WHERE `Description` = ? AND Year(date) = ?  ");
        $sql->execute(array($rubrique,$date));
        header("Location:showOperRubs.php");      
        // return "5";
        exit(); 
    }
    
}


}//AND if  rowCount
}//AND Filter Input

}
}


     function displayOperRybs(){   
        global $db;

$stmt = $db->connection->prepare("SELECT * FROM `operrubs` ORDER BY `id_opRubs` DESC ");
$stmt->execute();
return $stmt->fetchAll();

     }


     

     function displaySearch(){   
        global $db;
        if(isset($_POST['search'])){

 $year = $_POST['years'];
 $type = $_POST['type'];
 

    $stmt = $db->connection->prepare("SELECT * FROM `operrubs` WHERE `type`= ? AND Year(Date) = ? ORDER BY `id_opRubs` DESC ");
    $stmt->execute(array($type,$year));
    $rows = $stmt->rowCount();     
   if ($rows > 0){
       return $stmt->fetchAll(); 
   }else{
   
       return $error= "Vide";
 }              
}
}  



} //END class