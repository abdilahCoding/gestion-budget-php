<?php
require_once('../config/Enseignant.php');

if(!isset($_SESSION["admin"])){
  header("location: ../index.php");
  exit();
}


$editEns = new Enseignant();
$data =$editEns->editEnsInfo();
$msg =$editEns->editEnsPost();




?>








<!doctype html>
<html lang="en">
<?php
require_once('../includes/header.php');
 ?>
                                     <!--------------------------------------- START Container---------------------------------->

            <main class="dash-content">
                <div class="container-fluid">
                 <?php  if($msg){ echo $msg; }  ?>

                         <!--------------------------------------- START from ---------------------------------->
<h3 class="text-center mb-5 bien">Edit Enseignant</h3>


<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >        
 
           <div class="form-row">
    <div class="form-group col-md-6">
      <label >Nom</label>
      <input type="text" name="nom" class="form-control" value="<?php if(isset($data)){echo $data['Nom'];} ?>" >
    </div>
    <div class="form-group col-md-6">
      <label >Prenom</label>
      <input type="text" name="prenom" class="form-control" value="<?php if(isset($data)){echo $data['Prenom'];} ?>" >
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Grade</label>
      <input type="text" name="grade" class="form-control" value="<?php if(isset($data)){echo $data['Grade'];} ?>" >
    </div>
    <div class="form-group col-md-6">
      <label >Echelle</label>
      <input type="text" name="echelle" class="form-control" value="<?php if(isset($data)){echo $data['Echelle'];} ?>" >
    </div>
  </div>

  

  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Residence </label>
      <input type="text" name="residence" class="form-control" value="<?php if(isset($data)){echo $data['Residence'];} ?>" >
    </div>
    <div class="form-group col-md-6">
      <label >Groupe </label>
      <input type="text" name="groupes" class="form-control" value="<?php if(isset($data)){echo $data['Groupe'];} ?>" >
    </div>
  </div>
  <div class="form-row">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Puissance de la voiture</label>
      <input type="text" name="puissance" class="form-control" value="<?php if(isset($data)){echo $data['Puissance'];} ?>" >
    </div>
    <div class="form-group col-md-6">
      <label >la Marque de la voiture</label>
      <input type="text" name="marque" class="form-control" value="<?php if(isset($data)){echo $data['Marque'];} ?>" >
    </div>
  </div>

  
    <div class="form-group col-md">
      <label >Date </label>
      <input type="date" name="date" class="form-control" value="<?php if(isset($data)){echo $data['Date'];} ?>" >
    </div>
  </div>
  <div class="form-group col-md">
      <label >Date </label>
      <input type="hidden" value="<?php echo $_GET['id_Ens'] ?>" name="id" >
    </div>
  </div>
  
  <button type="submit"  name="send" class="btn btn-outline-danger btn-lg d-block mx-auto">Edit</button>
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