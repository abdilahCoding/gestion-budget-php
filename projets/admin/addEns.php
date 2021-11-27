<?php


require_once('../config/Enseignant.php');


  
if(!isset($_SESSION["admin"] )){
     
    if(!isset($_SESSION["user"]) ){
        header("location: ../index.php");
        exit;

    }

}elseif(!isset($_SESSION["admin"])){
    header("location: ../index.php");
    exit;

}

 
$enseignant = new Enseignant();
$msg = $enseignant->insertEnseignant();


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
                    
<h3 class="text-center mb-5 bien">Ajouter Enseignant</h3>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >        
  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Nom</label>
      <input type="text" name="nom" class="form-control" placeholder="Entrer le Nom">
    </div>
    <div class="form-group col-md-6">
      <label >Prenom</label>
      <input type="text" name="prenom" class="form-control" placeholder="Entrer le Prenom" >
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Grade</label>
      <input type="text" name="grade" class="form-control" placeholder="Entrer la Grade">
    </div>
    <div class="form-group col-md-6">
      <label >Echelle</label>
      <input type="text" name="echelle" class="form-control" placeholder="Entrer Echelle" >
    </div>
  </div>


  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Residence </label>
      <input type="text" name="residence" class="form-control" placeholder="Entrer la Residence">
    </div>
    <div class="form-group col-md-6">
      <label >Groupe </label>
      <input type="text" name="groupes" class="form-control" placeholder="Entrer Groupe" >
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label >puissance de voiture </label>
      <input type="text" name="puissance" class="form-control" placeholder="Entrer la puissance de voiture">
    </div>
    <div class="form-group col-md-6">
      <label >la marque </label>
      <input type="text" name="marque" class="form-control" placeholder="Entrer la Marque de voiture" >
    </div>
  </div>
  <div class="form-row">
  
    <div class="form-group col-md">
      <label >Date </label>
      <input type="date" name="date" class="form-control" >
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