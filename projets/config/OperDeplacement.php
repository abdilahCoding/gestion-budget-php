<?php
 require_once('dbconfig.php');

$db = new dbconfig();


class OperDeplacement{


    function insertDeplacement(){
        global $db;

      
$error =array();
if(isset($_POST['send'])){
    $id_Ens = $_POST['id'];
 $frais_transp =filter_var($_POST['frais_transp'], FILTER_VALIDATE_FLOAT);   
 $decoucher = filter_var($_POST['decoucher'], FILTER_VALIDATE_FLOAT);    
 $repas_midi  = filter_var($_POST['repas_midi'], FILTER_VALIDATE_FLOAT);   
 $repas_soir = filter_var($_POST['repas_soir'], FILTER_VALIDATE_FLOAT);   
 $route_kms  = filter_var($_POST['route_kms'], FILTER_VALIDATE_FLOAT);   
 $total_depl =filter_var($_POST['total_depl'], FILTER_VALIDATE_FLOAT);   
 $date = $_POST['date']; 

if(empty($_POST['id']) && empty($_POST['frais_transp']) && empty($_POST['decoucher']) && empty($_POST['repas_midi']) && empty($_POST['repas_soir']) && empty($_POST['route_kms']) && empty($_POST['total_depl'])){
  $msg= "fill the fields";
  header("Location:addDepl.php?msg=$msg");
}elseif ( $_POST['frais_transp'] == "" ){
     $msg= "Entrer frais de transport";
  header("Location:addDepl.php?msg=$msg");


}elseif ($_POST['decoucher'] == ""){
    $msg= "Entrer le prix de decoucher";
    header("Location:addDepl.php?msg=$msg");

}elseif ($_POST['repas_midi'] == ""){
    $msg= "Entrer le prix de repas de midi";
    header("Location:addDepl.php?msg=$msg");
}elseif ($_POST['repas_soir']== ""){
        $msg= "Entrer le prix de repas de soir";
        header("Location:addDepl.php?msg=$msg");
 }elseif ($_POST['route_kms'] ==""){
        $msg= "Entrer le prix route aller et retour";
        header("Location:addDepl.php?msg=$msg");    
    }elseif ($_POST['total_depl'] == ""){
            $msg= "Entrer le prix total de deplacement";
            header("Location:addDepl.php?msg=$msg");   
        }elseif ($_POST['id'] ==""){
                $msg= "il faut chercher ";
                header("Location:addDepl.php?msg=$msg"); 
            }elseif ($_POST['date'] ==""){
                    $msg= "Entrer la Date ";
                    header("Location:addDepl.php?msg=$msg");
                }elseif ($total_depl ===false){
                    $msg= "Entrer un nombre dans le champ Total ";
                    header("Location:addDepl.php?msg=$msg");      
          
    }else{

        // $dates = date('Y'); 
        
         $sq = $db->connection->prepare("SELECT tarifDep  FROM deplacement WHERE Year(Date) = ? ");
         $sq->execute(array($date));
         $res = $sq->fetch();
         $res[0];
         if($res[0] > $total_depl){
            $stmt = $db->connection->prepare("INSERT INTO `operdeplacement`(`id_dep`, `id_ens`, `frais_transport`, `decoucher`,`repas_midi`, `repas_soir`, `route_kms`,`total_depl`,`Date`) VALUES (NULL,?,?,?,?,?,?,?,? )");
            $stmt->execute(array($id_Ens,$frais_transp,$decoucher,$repas_midi,$repas_soir,$route_kms,$total_depl,$date));
           
            $sql = $db->connection->prepare("UPDATE `deplacement` SET tarifDep = tarifDep - $total_depl WHERE Year(Date) = ?  ");
            $sql->execute(array($date));
         }else{
            $cal = $total_depl - $res[0] ;
            
            $sql = $db->connection->prepare("UPDATE `deplacement` SET tarifDep = 0 WHERE Year(Date) = ?  ");
            $sql->execute(array($date));

            $stmt = $db->connection->prepare("INSERT INTO `operdeplacement`(`id_dep`, `id_ens`, `frais_transport`, `decoucher`,`repas_midi`, `repas_soir`, `route_kms`,`total_depl`,`Date`,`Rest_Payer`) VALUES (NULL,?,?,?,?,?,?,?,?,? )");
            $stmt->execute(array($id_Ens,$frais_transp,$decoucher,$repas_midi,$repas_soir,$route_kms,$total_depl,$date,$cal));
         }if ($stmt){
    $msg= "Success";
            header("Location:addDepl.php?msg=$msg");  
            exit(); 
   }else{
    $msg= "Not insert success";
            header("Location:addDepl.php?msg=$msg"); 
            exit();  
   }
}
 }
  }  



  function displayDeplacement(){   
    global $db;

    $stmt = $db->connection->prepare("SELECT * FROM operdeplacement,enseignant WHERE operdeplacement.id_ens = enseignant.id_Ens ORDER BY `operdeplacement`.`id_dep` DESC ");
    $stmt->execute();$stmt->execute();
return $stmt->fetchAll();


 }




  function displaySearch(){   
    global $db;
    if(isset($_POST['search'])){

$year = $_POST['years'];
      

 $stmt = $db->connection->prepare("SELECT * FROM operdeplacement,enseignant WHERE operdeplacement.id_ens = enseignant.id_Ens AND Year(operdeplacement.Date)= $year ORDER BY `operdeplacement`.`id_dep` DESC ");
 $stmt->execute();
 $rows = $stmt->rowCount();     
if ($rows > 0){
    return $stmt->fetchAll(); 
}else{

    return $error['eroror'] = "Vide";
}              

}
}




function editComget(){
    global $db;
if(isset($_GET['id_Depl'])){

 $IdDep = $_GET['id_Depl'];

 $stmt = $db->connection->prepare("SELECT * FROM operdeplacement,enseignant WHERE operdeplacement.id_ens = enseignant.id_Ens AND operdeplacement.id_dep = ?  ");
 $stmt->execute(array($IdDep));
return $stmt->fetch();


}  
 }


     function editCompost(){
            

global $db;
if(isset($_POST['send'])){

$frais_transp =filter_var($_POST['frais_transp'], FILTER_VALIDATE_FLOAT);   
$decoucher = filter_var($_POST['decoucher'], FILTER_VALIDATE_FLOAT);    
$repas_midi  = filter_var($_POST['repas_midi'], FILTER_VALIDATE_FLOAT);   
$repas_soir = filter_var($_POST['repas_soir'], FILTER_VALIDATE_FLOAT);   
$route_kms  = filter_var($_POST['route_kms'], FILTER_VALIDATE_FLOAT);   
$total_depl =filter_var($_POST['total_depl'], FILTER_VALIDATE_FLOAT);   
$date = $_POST['date']; 
$id=$_POST['id_dep'];
$id_ens=$_POST['id_ens'];
$rest=$_POST['rest'];


$sl = $db->connection->prepare("SELECT * FROM `operdeplacement` WHERE id_dep = $id");
$sl->execute();
$data = $sl->fetch();
 $rows = $sl->rowCount();

if($rows){
   
if($total_depl > $data[7]){
    
 if($rest > 0){
     $r=$total_depl - $data[7];
    
     $sql = $db->connection->prepare("UPDATE `operdeplacement` SET `frais_transport`= ?,`decoucher`= ?,`repas_midi`= ?,`repas_soir`= ?,`route_kms`=?,`total_depl`= ? ,`Date`=?,`Rest_Payer`= `Rest_Payer`+ ? WHERE id_dep = ? ");
        $sql->execute(array($frais_transp,$decoucher,$repas_midi,$repas_soir,$route_kms,$total_depl,$date,$r,$id));
        header("Location:showDepl.php");      

        //  return 0;
          exit();
 }

}

if($total_depl < $data[7]) {
    if($rest > 0){
        $re= $data[7]- $total_depl;
         if($re >= $rest){
             $deplaceCalc= $re - $rest;
            $stm = $db->connection->prepare("UPDATE `operdeplacement` SET `frais_transport`= ?,`decoucher`= ?,`repas_midi`= ?,`repas_soir`= ?,`route_kms`=?,`total_depl`= ? ,`Date`=?,`Rest_Payer`=  ? WHERE id_dep = ? ");
            $stm->execute(array($frais_transp,$decoucher,$repas_midi,$repas_soir,$route_kms,$total_depl,$date,0,$id));
            $sql = $db->connection->prepare("UPDATE `deplacement` SET tarifDep = tarifDep + $deplaceCalc WHERE Year(Date) = ?  ");
           $sql->execute(array($date));
           header("Location:showDepl.php");      
        //    return "1";
        exit();  
         }elseif($re < $rest) {
            $stm = $db->connection->prepare("UPDATE `operdeplacement` SET `frais_transport`= ?,`decoucher`= ?,`repas_midi`= ?,`repas_soir`= ?,`route_kms`=?,`total_depl`= ? ,`Date`=?,`Rest_Payer`=  ? WHERE id_dep = ? ");
            $stm->execute(array($frais_transp,$decoucher,$repas_midi,$repas_soir,$route_kms,$total_depl,$date,$re,$id));
            header("Location:showDepl.php");      
           
            // return "2";
            exit();  
         }
    }

}
if($rest == 0) {
    
    $sq = $db->connection->prepare("SELECT tarifDep FROM deplacement WHERE Year(Date) = ? ");
    $sq->execute(array($date));
    $res = $sq->fetch();
     
    if($data[7] <= $total_depl){
        $cal= $total_depl - $data[7] ;
        if($res[0]>= $cal){
            $stm = $db->connection->prepare("UPDATE `operdeplacement` SET `frais_transport`= ?,`decoucher`= ?,`repas_midi`= ?,`repas_soir`= ?,`route_kms`=?,`total_depl`= ? ,`Date`=? WHERE id_dep = ? ");
            $stm->execute(array($frais_transp,$decoucher,$repas_midi,$repas_soir,$route_kms,$total_depl,$date,$id));
            $sql = $db->connection->prepare("UPDATE `deplacement` SET tarifDep = tarifDep - $cal WHERE Year(Date) = ?  ");
            $sql->execute(array($date));
            header("Location:showDepl.php");      
 
            // return "3";
            exit();  
        }elseif ($cal >= $res[0]) {
            // $cal= $total_depl - $data[7];
            // $res =$cal - $rest;
            // $res= $data[7] % $cal;
            $re=$cal - $res[0];
            $stm = $db->connection->prepare("UPDATE `operdeplacement` SET `frais_transport`= ?,`decoucher`= ?,`repas_midi`= ?,`repas_soir`= ?,`route_kms`=?,`total_depl`= ? ,`Date`=?,`Rest_Payer`=  ? WHERE id_dep = ? ");
            $stm->execute(array($frais_transp,$decoucher,$repas_midi,$repas_soir,$route_kms,$total_depl,$date,$re,$id));
            $sql = $db->connection->prepare("UPDATE `deplacement` SET tarifDep = ? WHERE Year(Date) = ?  ");
            $sql->execute(array(0,$date));
            header("Location:showDepl.php");      
            // return "4";
            exit();  
        }
       
        
    }if($data[7] >= $total_depl){
        $cal=  $data[7] - $total_depl;
        $stm = $db->connection->prepare("UPDATE `operdeplacement` SET `frais_transport`= ?,`decoucher`= ?,`repas_midi`= ?,`repas_soir`= ?,`route_kms`=?,`total_depl`= ? ,`Date`=? WHERE id_dep = ? ");
        $stm->execute(array($frais_transp,$decoucher,$repas_midi,$repas_soir,$route_kms,$total_depl,$date,$id));
        $sql = $db->connection->prepare("UPDATE `deplacement` SET tarifDep = tarifDep + $cal WHERE Year(Date) = ?  ");
        $sql->execute(array($date));
        header("Location:showDepl.php");      
        // return "5";
        exit();  
        
    }  
}
}//AND if  rowCount
}
}
} //END class