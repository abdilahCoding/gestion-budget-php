<?php
require_once('../config/Entreprise.php');



if(!isset($_SESSION["admin"] )){
     
  if(!isset($_SESSION["user"])){
      header("location: ../index.php");
      exit();
      

  }

}elseif(!isset($_SESSION["admin"])){
  header("location: ../index.php");
  exit();
  

}



$Ese = new Entreprise();
$msg =$Ese->insertEntreprise(); //call function from class Entreprise to insert data and the sametimes return error 
 

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
                    
<h3 class="text-center mb-5 bien">Ajouter Société</h3>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >        
  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Le Nom</label>
      <input type="text" name="nom" class="form-control" placeholder="Entrer le Nom">
    </div>
    <div class="form-group col-md-6">
      <label >La ville</label>
      <input type="text" name="ville" class="form-control" placeholder="Entrer la Ville">
    </div>
  
  </div>
  <div class="form-group">
    <label>Email</label>
    <input type="text" name="email" class="form-control" placeholder="Entrer Email">

     </div>
  
  
  <button type="submit"  name="send" class="btn btn-outline-danger btn-lg d-block mx-auto ">Save</button>
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