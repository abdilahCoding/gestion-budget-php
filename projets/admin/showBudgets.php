
<?php

require_once('../config/budget.php');


if(!isset($_SESSION["admin"] )){
     
  if(!isset($_SESSION["user"])){
      header("location: ../index.php");
      exit();
      

  }

}elseif(!isset($_SESSION["admin"])){
  header("location: ../index.php");
  exit();
  

}


 
$Budget = new Budget();
$data =$Budget->displayAllBudgets();


   


?>







<!doctype html>
<html lang="en">
<?php
require_once('../includes/header.php');
 ?>
                                     <!--------------------------------------- START Container---------------------------------->

            <main class="dash-content">
                <div class="container-fluid">
       




                         <!--------------------------------------- START show patients---------------------------------->
<h3 class="text-center mb-5 bien">Budgets</h3>


<?php if( $data){ ?>
<table class="table text-center mt-5">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Budget</th>
      <th scope="col">Date</th>
      <th scope="col">Action</th>
     
    
    </tr>
  </thead>
  <tbody>

 <?php foreach($data as $row) { ?>
      
     
    <tr>
    
      <td><?php echo $row['Budget']  ?></td>
      <td><?php echo $row['Date']  ?></td>

     
      <td> <button class="btn btn-success mx-auto"><a href="editBudget.php?id_budget=<?php echo $row['id_budget'] ?>">Modifier</a></button>
      <button class="btn btn-danger  mx-auto"><a href="delete.php?id_budget=<?php echo $row['id_budget'] ?>">Supprimer</a></button>
        
      </td>
      
    </tr>
    <?php
    }
  } 
  ?>


  </tbody>
</table>
       




     <!--------------------------------------- END  show all patients ---------------------------------->


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