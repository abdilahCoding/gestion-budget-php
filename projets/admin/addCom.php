<?php


require_once('../config/OperCommande.php');


  
if(!isset($_SESSION["admin"] )){
     
    if(!isset($_SESSION["user"]) ){
        header("location: ../index.php");
        exit;

    }

}elseif(!isset($_SESSION["admin"])){
    header("location: ../index.php");
    exit;

}

 
$commandes = new OperCommandes();
$msg = $commandes->insertCommande();



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
                    
<h3 class="text-center mb-5 bien">Ajouter Commande</h3>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >        
  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Numéro de Commande</label>
      <input type="text" name="Nmcommande" class="form-control" placeholder="Entrer le Numéro de Commande">
    </div>
    <div class="form-group col-md-6">
      <label >Le Nom de produit</label>
      <input type="text" name="description" class="form-control" placeholder="Entrer Le Nom de produit" >
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Prix Unitaire</label>
      <input type="text" name="prixUnit" class="form-control" placeholder="Entrer Le Prix Unitaire">
    </div>
    <div class="form-group col-md-6">
      <label >La Quantité</label>
      <input type="text" name="quantité" class="form-control" placeholder="Entrer La Quantité" >
    </div>
  </div>


  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Total </label>
      <input type="text" name="total" class="form-control" placeholder="Entrer le Total">
    </div>
    <div class="form-group col-md-6">
      <label >Date </label>
      <input type="date" name="date" class="form-control" >
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
    

     <option value="<?php echo $row['Nom'];?>"><?php echo $row['Nom'];?></option>
     
  
  <?php } } ?>

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