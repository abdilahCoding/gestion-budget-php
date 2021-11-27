<?php



require_once('dbconfig.php');

$db = new dbconfig();


class Budget {
 


     function addBudget(){

      global $db;

      if(isset($_POST['send'])){
      
       $budget = $_POST['budget'];
       $date = $_POST['date'];
      
      if(empty($budget) && empty($date)){
      $error= "fill the fields";
      header("Location:addBudget.php?error=$error");

      }elseif( empty($budget) ){
      $error= "enterr budget";
      header("Location:addBudget.php?error=$error");
    
      }elseif(empty($date)){
              $error= "entrer la date";
              header("Location:addBudget.php?error=$error");

       }
      else{
            
$stmt = $db->connection->prepare("SELECT * FROM budget WHERE Year(Date) = ? ");
$stmt->execute(array($date));
$rows = $stmt->rowCount();

if($rows > 0){
   $stmt = $db->connection->prepare("UPDATE budget SET Budget = Budget + ? , `Date`= ? WHERE Year(Date) = ? ");
      $stmt->execute(array($budget,$date,$date));
      if($stmt){
   $devBudget = $budget/7;
   // $dates = date('Y');                    
     
  $query = $db->connection->prepare("UPDATE `rubrique` SET tarifFix = tarifFix + $devBudget,budget = budget + $devBudget WHERE Year(Date) = ?  ");
  $query->execute(array($date));
  $sql = $db->connection->prepare("UPDATE `commande` SET tarifCmd = tarifCmd + $devBudget,budget = budget + $devBudget WHERE Year(Date) = ?  ");
  $sql->execute(array($date));
  $sqldep = $db->connection->prepare("UPDATE `deplacement` SET tarifDep = tarifDep + $devBudget,budget = budget + $devBudget WHERE Year(Date) = ?  ");
  $sqldep->execute(array($date));
        $error= "update it";
         header("Location:addBudget.php?error=$error");
              exit();
      }
   
}else{
   $stmt = $db->connection->prepare("INSERT INTO `budget` (`id_budget`, `Budget`, `Date`) VALUES (NULL, ?,?)");
      $stmt->execute(array($budget,$date));
      $id_bgt=$db->connection->lastInsertId();
    
    $budRub= $budget/7;
   // $age = array("907"=>"Enseignement Supperieur", "908"=>"Recherche Scientifique et Technologique", "908"=>"Appui sociale aux étudiants", "911"=>"Formation continue et Traveaux de recherche et prestation de service", "908"=>"Appui sociale aux étudiants", "920"=>"Pilotage et Gouverance");
   $age = array('907'=>'Enseignement Supperieur', '908'=>'Recherche Scientifique et Technologique','909' =>'Appui sociale aux étudiants', '911'=>'Formation continue et Traveaux de recherche et prestation de service','920'=>'Pilotage et Gouverance');
   
   foreach($age as $x => $x_value) {
      
       $k="'".$x."'";
       $v="'".$x_value."'";
       $query = $db->connection->prepare("INSERT INTO `rubrique` (`id_rubrique`,`id_bgt`,`Num`,`Description`,`tarifFix`,`budget`,`Date`) VALUES (NULL,$id_bgt,$k,$v,$budRub,$budRub,?)");
       $query->execute(array($date));
     
   }


   $sql = $db->connection->prepare("INSERT INTO `commande` (`id_Cmd`,`id_bgts`,`tarifCmd`,`budget`,`Date`) VALUES (NULL,$id_bgt,$budRub,$budRub,?)");
   $sql->execute(array($date));
 
   $qry = $db->connection->prepare("INSERT INTO `deplacement` (`id_Deps`,`id_bgts`,`tarifDep`,`budget`,`Date`) VALUES (NULL,$id_bgt,$budRub,$budRub,?)");
   $qry->execute(array($date));
   
      if($stmt){
        $error= "Save it";
              header("Location:addBudget.php?error=$error");
       }else{
        $error= "not insert success";
        header("Location:addBudget.php?error=$error");
        exit();
       } 
}

      
      
    
      }
        }
         }


   function displayAllBudgets(){
      global $db;
     
      
      $stmt = $db->connection->prepare("SELECT * FROM budget ORDER BY `id_budget` DESC");
      $stmt->execute();
      return $data = $stmt->fetchAll();
      $rows = $stmt->rowCount();
    
   }
 

      function editBudget(){

          
if(isset($_GET['id_budget'])){
   global $db;
   $id_Budget = $_GET['id_budget'];
   


$stmt = $db->connection->prepare("SELECT * FROM budget WHERE id_budget = $id_Budget ");
$stmt->execute(array($id_Budget));
return $stmt->fetch();
   
}
}


     function editBudgetRow(){
      global $db;
      
if(isset($_POST['send'])){
   
$budget = $_POST['budget'];
$date = $_POST['date'];
$id=$_POST['id'];

$sl = $db->connection->prepare("SELECT * FROM budget WHERE id_budget = $id");
$sl->execute();
 $data = $sl->fetch();
$rows = $sl->rowCount();
if($rows){
 if($data[1]<= $budget){
   $res = ($budget - $data[1])/7 ;
   
   $stmt = $db->connection->prepare("UPDATE `budget` SET `Budget`= ?,`Date`= ? WHERE id_budget= ?");
   $stmt->execute(array($budget,$date,$id));

   // $dates = date('Y');                    
     
  $query = $db->connection->prepare("UPDATE `rubrique` SET tarifFix = tarifFix + $res,budget = budget + $res WHERE Year(Date) = ?  ");
  $query->execute(array($date));
 
  $sql = $db->connection->prepare("UPDATE `commande` SET tarifCmd = tarifCmd + $res,budget = budget + $res WHERE Year(Date) = ?  ");
  $sql->execute(array($date));
  $sqldep = $db->connection->prepare("UPDATE `deplacement` SET tarifDep = tarifDep + $res,budget = budget + $res WHERE Year(Date) = ?  ");
  $sqldep->execute(array($date));
 }else{
   // $dates = date('Y');   
   $res = ($data[1]-$budget)/7 ;
   $stmt = $db->connection->prepare("UPDATE `budget` SET `Budget`= ?,`Date`= ? WHERE id_budget= ?");
   $stmt->execute(array($budget,$date,$id));

   $query = $db->connection->prepare("UPDATE `rubrique` SET tarifFix = tarifFix - $res,budget = budget - $res WHERE Year(Date) = ?  ");
  $query->execute(array($date));
  $sql = $db->connection->prepare("UPDATE `commande` SET tarifCmd = tarifCmd - $res,budget = budget - $res WHERE Year(Date) = ?  ");
  $sql->execute(array($date));
  $sqldep = $db->connection->prepare("UPDATE `deplacement` SET tarifDep = tarifDep - $res,budget = budget - $res WHERE Year(Date) = ?  ");
  $sqldep->execute(array($date));
 }

}


if($stmt){
   // $error['success'] = "insert success";
   header("location: showBudgets.php");
  }else{
   $error= "not insert success";
  }  
}
}


function displaySearch(){   
   global $db;
   if(isset($_POST['search'])){

$year = $_POST['years'];
     

$stmt = $db->connection->prepare("SELECT * FROM `budget` WHERE Year(Date) = $year ");
$stmt->execute();
$rows = $stmt->rowCount();     
if ($rows > 0){
   return $stmt->fetchAll(); 
}else{

   return $error['eroror'] = "Vide";
}              

}
}



} //END class
