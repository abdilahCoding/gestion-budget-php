<?php

require_once('../config/Budget.php');

  
if(!isset($_SESSION["admin"] )){
     
  if(!isset($_SESSION["user"])){
      header("location: ../index.php");
      exit;

  }

}elseif(!isset($_SESSION["admin"]) ){
  header("location: ../index.php");
  exit;

}

   $editBudget = new Budget();
   $data = $editBudget->editBudget();
   $editBudget->editBudgetRow();





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
                        
<h3 class="text-center mb-5 bien">Modifier Budget</h3>

<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient " >        
  <div class="form-row">
    <div class="form-group col-md-6">
      <label >Budget</label>
      <input type="text" value="<?php if(isset($data)){echo $data['Budget'];} ?>" name="budget" class="form-control" placeholder="Enter a Name">
    </div>
    <div class="form-group col-md-6">
      <label >La date</label>
      <input type="date" value="<?php if(isset($data)){echo $data['Date'];} ?>" name="date" class="form-control" placeholder="Enter a Last Name">
    </div>
  </div>
  <div class="form-group col-md-6">
      
      <input type="hidden" value="<?php echo $_GET['id_budget'] ?>" name="id" class="form-control" >
    </div>
   
  
  <button type="submit"  name="send" class="btn btn-danger btn-lg d-block mx-auto">Modifier</button>
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