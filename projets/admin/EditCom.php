<?php

require_once('../config/OperCommande.php');



if(!isset($_SESSION["admin"] )){
     
  if(!isset($_SESSION["user"])){
      header("location: ../index.php");
      exit();
      

  }

}elseif(!isset($_SESSION["admin"])){
  header("location: ../index.php");
  exit();
  

}



$editCommande = new OperCommandes();
$data =$editCommande->editComget();
$msg =$editCommande->editCompost();

  


$stmt = $db->connection->prepare("SELECT Nom FROM `société`");
$stmt->execute();
$resFrs=$stmt->fetchAll();
$rowsFrs =$stmt->rowCount();



?>








<!doctype html>
<html lang="en">
<?php
require_once('../includes/header.php');
 ?>
                                     <!--------------------------------------- START Container---------------------------------->

            <main class="dash-content">
                <div class="container-fluid">
                   


                         <!--------------------------------------- START Edit commandes ---------------------------------->

           <?php  print_r($msg)  ?>
                        <h3 class="text-center mb-5 bien">Edit Commande</h3>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >        
  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Numéro de Commande</label>
      <input type="text" name="Nmcommande" class="form-control" value="<?php if(isset($data)){echo $data['Num_Commande'];} ?>" >
    </div>
    <div class="form-group col-md-6">
      <label >Le Nom de produit</label>
      <input type="text" name="description" class="form-control" value="<?php if(isset($data)){echo $data['Description'];} ?>"  >
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Prix Unitaire</label>
      <input type="text" name="prixUnit" class="form-control" value="<?php if(isset($data)){echo $data['Prix_Unitaire'];} ?>" >
    </div>
    <div class="form-group col-md-6">
      <label >La Quantité</label>
      <input type="text" name="quantité" class="form-control" value="<?php if(isset($data)){echo $data['Quantité'];} ?>"  >
    </div>
  </div>


  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Total </label>
      <input type="text" name="total" class="form-control" value="<?php if(isset($data)){echo $data['Total'];} ?>" >
    </div>
    <div class="form-group col-md-6">
      <label >Date </label>
      <input type="date" name="date" class="form-control" value="<?php if(isset($data)){echo $data['Date'];} ?>"  >
      <input type="hidden" name="id_com" class="form-control" value="<?php if(isset($data)){echo $data['id_Commande'];} ?>"  >
      <input type="hidden" name="rest" class="form-control" value="<?php if(isset($data)){echo $data['Rest_Payer'];} ?>"  >

    </div>
  </div>

  <div class="form-row">
  
    <div class="form-group col-md">
      <label >Fournisseur </label>
      <select name="frs"  class="form-control">
      <option value="">Select..</option>

  <?php if($rowsFrs) {
   foreach($resFrs as $row){ 
    ?>
    <?php if($row['Nom'] == $data['Fournisseur']){ ?> 

     <option value="<?php echo $row['Nom'];?>" selected ><?php echo $row['Nom'];?></option>
     <?php }else{?> 
      <option value="<?php echo $row['Nom'];?>"><?php echo $row['Nom'];?></option>

  
  <?php } } } ?>

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