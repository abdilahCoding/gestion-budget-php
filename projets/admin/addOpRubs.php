<?php

require_once('../config/operationsRubs.php');
require_once('../config/rubrique.php');
require_once('../config/Sousrubs.php');


  
if(!isset($_SESSION["admin"] )){
     
    if(!isset($_SESSION["user"]) ){
        header("location: ../index.php");
        exit;

    }

}elseif(!isset($_SESSION["admin"])){
    header("location: ../index.php");
    exit;

}

 
$OpeRubs = new OperRubs();
$msg = $OpeRubs->insertOperRubs();
 
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
                     <!--------------------------------------- START print message ---------------------------------->


   
                      <?php
 if($msg){
          
        if($msg == "insert success"){
            echo "<div class='alert alert-success alert-dismissible fade show messages' role='alert'>
            <span>$msg</span>  
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
       <span aria-hidden='true'>&times;</span>
    </button>
    </div>";
        }else{

            echo "<div class='alert alert-danger alert-dismissible fade show messages' role='alert'>
            <span>$msg</span>  
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
       <span aria-hidden='true'>&times;</span>
    </button>
    </div>";        }
        

    }
  
 ?> 




               
    
 

                      <!--------------------------------------- END print message ---------------------------------->



                         <!--------------------------------------- START from ---------------------------------->
                    
<h3 class="text-center mb-5 bien">Ajouter Operation Rubs</h3>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >        
  
<div class="form-row">
    <div class="form-group col-md-6">
      <label >choisi une rubrique</label>
      <input list="rubriques" name="rubrique" autocomplete="off">

<datalist id="rubriques">
  
  <?php if($dataListRbs) {
   foreach($dataListRbs as $row){ 
    ?>
    
    
     <option value="<?php echo $row['Description'];?>">
     
  
  <?php } } ?>

</datalist>      
  </div>
    <div class="form-group col-md-6">
      <label >choisi une sous rubrique</label>
      <input list="SRs" name="SousRub" autocomplete="off">

<datalist id="SRs">

<?php if($listSousRbs) {
   foreach($listSousRbs as $row){ 
    ?>
    

     <option value="<?php echo $row['Nom'];?>">
     
  
  <?php } } ?>


</datalist>   
  </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label >total</label>
      <input type="text" name="prix" class="form-control" placeholder="Entrer le prix total">
    </div>
    <div class="form-group col-md-6">
      <label >Le Date</label>
      <input type="date" name="date" class="form-control"  >
    </div>
  </div>

  <div class="form-row">
  
    <div class="form-group col-md">
      <label >Type </label>
      <select name="type"  class="form-control">
      <option value="">Select..</option>
     <option value="MMD">MMD</option>
     <option value="Personne">Personne</option>
  
  </select>
    </div>
  </div>
  
  <button type="submit"  name="send" class="btn btn-outline-danger btn-lg d-block mx-auto ">ajouté</button>
</form> 





     <!--------------------------------------- END from ---------------------------------->


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
