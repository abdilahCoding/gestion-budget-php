<?php

require_once('../config/OperDeplacement.php');



if(!isset($_SESSION["admin"] )){
     
  if(!isset($_SESSION["user"])){
      header("location: ../index.php");
      exit();
      

  }

}elseif(!isset($_SESSION["admin"])){
  header("location: ../index.php");
  exit();
  

}



$editDepl = new OperDeplacement();
$data =$editDepl->editComget();
$msg =$editDepl->editCompost();





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
      <label >frais de transport</label>
      <input type="text" name="frais_transp" class="form-control" value="<?php if(isset($data)){echo $data['frais_transport'];} ?>" >
    </div>
    <div class="form-group col-md-6">
      <label >le prix de decoucher</label>
      <input type="text" name="decoucher" class="form-control" value="<?php if(isset($data)){echo $data['decoucher'];} ?>"  >
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label >le prix de repas de midi</label>
      <input type="text" name="repas_midi" class="form-control" value="<?php if(isset($data)){echo $data['repas_midi'];} ?>" >
    </div>
    <div class="form-group col-md-6">
      <label >le prix de repas de soir</label>
      <input type="text" name="repas_soir" class="form-control" value="<?php if(isset($data)){echo $data['repas_soir'];} ?>"  >
    </div>
  </div>


  <div class="form-row">
    <div class="form-group col-md-6">
      <label >prix total de la route  </label>
      <input type="text" name="route_kms" class="form-control" value="<?php if(isset($data)){echo $data['route_kms'];} ?>" >
    </div>
    <div class="form-group col-md-6">
      <label >le prix total de deplacement  </label>
      <input type="text" name="total_depl" class="form-control" value="<?php if(isset($data)){echo $data['total_depl'];} ?>"  >
      <input type="hidden" name="id_dep" class="form-control" value="<?php if(isset($data)){echo $data['id_dep'];} ?>"  >
      <input type="hidden" name="id_ens" class="form-control" value="<?php if(isset($data)){echo $data['id_ens'];} ?>"  >
      <input type="hidden" name="rest" class="form-control" value="<?php if(isset($data)){echo $data['Rest_Payer'];} ?>"  >

    </div>
  </div>

  <div class="form-group col-md">
      <label >Date </label>
      <input type="date" value="<?php if(isset($data)){echo $data['Date'];} ?>" name="date" class="form-control" >
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