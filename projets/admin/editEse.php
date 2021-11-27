<?php
require_once('../config/Entreprise.php');

if(!isset($_SESSION["admin"])){
  header("location: ../index.php");
  exit();
}


$editEse = new Entreprise();
$data =$editEse->editEseInfo();
$msg =$editEse->editEsePost();




?>








<!doctype html>
<html lang="en">
<?php
require_once('../includes/header.php');
 ?>
                                     <!--------------------------------------- START Container---------------------------------->

            <main class="dash-content">
                <div class="container-fluid">
                 

                         <!--------------------------------------- START from ---------------------------------->
<h3 class="text-center mb-5 bien">Edit Societé</h3>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >        
  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Le nom</label>
      <input type="text" value="<?php if(isset($data)){echo $data['Nom'];} ?>" name="nom" class="form-control" >
    </div>
    <div class="form-group col-md-6">
      <label >La ville</label>
      <input type="text" value="<?php if(isset($data)){echo $data['Ville'];} ?>" name="ville" class="form-control" >
    </div>
  </div>
  <div class="form-group col-md-6">
      
      <input type="hidden" value="<?php echo $_GET['id_Ese'] ?>" name="id" class="form-control">
    </div>
  </div>
  <div class="form-group">
    <label class="d-block text-center text-danger">Email</label>
    <input type="text" name="email" value="<?php if(isset($data)){echo $data['Email'];} ?>" class="form-control">

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