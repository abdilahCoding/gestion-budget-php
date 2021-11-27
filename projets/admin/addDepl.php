<?php


require_once('../config/Enseignant.php');
require_once('../config/OperDeplacement.php');


  
if(!isset($_SESSION["admin"] )){
     
    if(!isset($_SESSION["user"]) ){
        header("location: ../index.php");
        exit;

    }

}elseif(!isset($_SESSION["admin"])){
    header("location: ../index.php");
    exit;

}

 
$Searchenseignant = new Enseignant();
$data = $Searchenseignant->searchEns();

$isertDepl = new OperDeplacement();
$msg=$isertDepl->insertDeplacement();


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

                     if(isset($_GET["error"])){
      $error =$_GET["error"];
        if($error == "Not Found"){
            echo "<div class='alert alert-danger alert-dismissible fade show messages' role='alert'>
            <span>$error</span>  
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
       <span aria-hidden='true'>&times;</span>
    </button>
    </div>";
  }else{
    echo "<div class='alert alert-danger alert-dismissible fade show messages' role='alert'>
    <span>$error</span>  
<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
<span aria-hidden='true'>&times;</span>
</button>
</div>";

  }
  
  
  }  ?>


<?php

                     if(isset($_GET["msg"])){
      $msg =$_GET["msg"];
        if($msg == "Success"){
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
</div>";

  }
  
  
  }  ?>



                   
                     
                      <!--------------------------------------- END print message ---------------------------------->
                      <h3 class="text-center mb-5 bien">Afficher les Enseignants</h3>
           
      
              
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

 
  
  <button type="submit"  name="search" class="btn btn-outline-success btn-lg d-block mx-auto ">Chercher</button>
</form>   
             <!--------------------------------------- START table ---------------------------------->
        
             <?php   if($data){ ?>



<table class="table text-center mt-3">
  <thead class="thead-dark">
  
      <th scope="col">Nom</th>
      <th scope="col">Prenom</th>
      <th scope="col">Grade</th>
      <th scope="col">Echelle</th>
      <th scope="col">Residence</th>
      <th scope="col">Groupe</th>
      <th scope="col">Puissance</th>
      <th scope="col">Marque</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
<?php if( $data){
 foreach($data as $row){ ?>
      
     
    <tr>
      <td><?php echo $row['Nom']  ?></td>
      <td><?php echo $row['Prenom']  ?></td>
      <td><?php echo $row['Grade']  ?></td>
      <td><?php echo $row['Echelle']  ?></td>
      <td><?php echo $row['Residence']  ?></td>
      <td><?php echo $row['Groupe']  ?></td>
      <td><?php echo $row['Puissance']  ?></td>
      <td><?php echo $row['Marque']  ?></td>
      <td><?php echo $row['Date']  ?></td>
  
      

    </tr>
    
    <?php
    }
  } 
  ?>



  </tbody>
</table>
<?php } ?>

             <!--------------------------------------- ENd table ---------------------------------->

                         <!--------------------------------------- START from ---------------------------------->
                    

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >        
  <div class="form-row">
    <div class="form-group col-md-6">
      <label >frais de transport</label>
      <input type="text" name="frais_transp" class="form-control" placeholder="Entrer frais de transport">
    </div>
    <div class="form-group col-md-6">
      <label >le prix de decoucher</label>
      <input type="text" name="decoucher" class="form-control" placeholder="Entrer le prix de decoucher" >
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label >le prix de repas de midi</label>
      <input type="text" name="repas_midi" class="form-control" placeholder="Entrer le prix de repas de midi">
    </div>
    <div class="form-group col-md-6">
      <label >le prix de repas de soir</label>
      <input type="text" name="repas_soir" class="form-control" placeholder="Entrer le prix de repas de soir" >
    </div>
  </div>


  <div class="form-row">
    <div class="form-group col-md-6">
      <label >prix total de la route  </label>
      <input type="text" name="route_kms" class="form-control" placeholder="prix de la route ">
    </div>
    <div class="form-group col-md-6">
      <label >le prix total de deplacement </label>
      <input type="text" name="total_depl" class="form-control" placeholder="Entrer le prix total de deplacement" >
      <input type="hidden"  class="form-control" name='id' value="<?php if(isset($data)){echo $data[0]['id_Ens'];} ?>" >

    </div>
  </div>
  <div class="form-group col-md">
      <label >Date </label>
      <input type="date" name="date" class="form-control" >
    </div>
  </div>
  
  
  <button type="submit"  name="send" class="btn btn-outline-success btn-lg d-block mx-auto ">Ajouté</button>
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