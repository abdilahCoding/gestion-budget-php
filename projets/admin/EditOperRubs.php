<?php

require_once('../config/operationsRubs.php');
require_once('../config/rubrique.php');
require_once('../config/Sousrubs.php');


if(!isset($_SESSION["admin"] )){
     
  if(!isset($_SESSION["user"])){
      header("location: ../index.php");
      exit();
      

  }

}elseif(!isset($_SESSION["admin"])){
  header("location: ../index.php");
  exit();
  

}



$editOperRub = new OperRubs();
$data =$editOperRub->editOperRubsget();
$msg =$editOperRub->editOperRubspost();

 
$listRubriques = new Rubrique();
$dataListRbs = $listRubriques->listRubrique();
 
$listSousRb = new Sousrubs();
$listSousRbs = $listSousRb->listSousRubriques();






?>








<!doctype html>
<html lang="en">
<?php
require_once('../includes/header.php');
 ?>
                                     <!--------------------------------------- START Container---------------------------------->

            <main class="dash-content">
                <div class="container-fluid">
                   
                <?php  print_r($msg)  ?>

                         <!--------------------------------------- START Edit commandes ---------------------------------->
                  
                         <h3 class="text-center mb-5 bien">Edit Operation Rubs</h3>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >        
  
<div class="form-row">
    <div class="form-group col-md-6">
      <label >choisi une rubrique</label>
      <select name="rubrique"  class="form-control">
  
  <?php if($dataListRbs) {
  
   foreach($dataListRbs as $row){ 

     if( $row['Description'] == $data['RuriqueName']){
       $rub = $row['Description'];
        
    ?> 
       
     <option value="<?php echo $row['Description'];?>" selected ><?php echo $row['Description'];?></option>

     <?php
    

     }else{
    ?> 
  
         <option value="<?php echo $row['Description'];?>" ><?php echo $row['Description'];?></option>

  <?php } } }?>

</select>      
  </div>
    <div class="form-group col-md-6">
      <label >choisi une sous rubrique</label>
      <select name="SousRub"  class="form-control">
  
  <?php if($listSousRbs) {
  
   foreach($listSousRbs as $row){ 

     if( $row['Nom'] == $data['SousRubName']){
        
    ?> 
       
     <option value="<?php echo $row['Nom'];?>" selected ><?php echo $row['Nom'];?></option>

     <?php
    

     }else{
    ?> 
  
         <option value="<?php echo $row['Nom'];?>" ><?php echo $row['Nom'];?></option>

  <?php } } }?>

</select>      
  </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Prix total</label>
      <input type="text" name="prix"  class="form-control"  value="<?php if(isset($data)){echo $data['prix'];} ?>">
    </div>
    <div class="form-group col-md-6">
      <label >Le Date</label>
      <input type="date" name="date"  class="form-control" value="<?php if(isset($data)){echo $data['date'];} ?>"  >
      <input type="hidden" name="id_opRubs"  class="form-control" value="<?php if(isset($data)){echo $data['id_opRubs'];} ?>"  >
      <input type="hidden" name="rest"  class="form-control" value="<?php if(isset($data)){echo $data['Rest'];} ?>"  >

    </div>
  </div>

  <div class="form-row">
  
    <div class="form-group col-md">
      <label >Type </label>
      <select name="type"  class="form-control">
     
     
    <?php if($data['type'] == "MMD"){ ?> 

     <option value="MMD" selected >MMD</option>
     <option value="Personne">Personne</option>
     <?php }else{?> 
      <option value="Personne" selected>Personne</option>
      <option value="MMD" >MMD</option>

  
  <?php }  ?>
  
  </select>
    </div>
  </div>
  
  <button type="submit"  name="send" class="btn btn-outline-success btn-lg d-block mx-auto ">Edit</button>
</form> 




      

  



       




     <!--------------------------------------- END  show all users and admins ---------------------------------->


                </div>
            </main>

           <!--------------------------------------- START Container---------------------------------->

        </div>
    </div>
    <?php
    require_once('../includes/script.php');
   ?>
</body>

</html>