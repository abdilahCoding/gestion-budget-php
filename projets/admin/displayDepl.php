<?php

require_once('../config/deplacement.php');



if(!isset($_SESSION["admin"] )){
     
  if(!isset($_SESSION["user"])){
      header("location: ../index.php");
      exit();
      

  }

}elseif(!isset($_SESSION["admin"])){
  header("location: ../index.php");
  exit();
  

}



$displayAutRub = new Deplacement(); //create a object
$data =$displayAutRub ->displayDeplacement(); //call function from class deplacement to return resulat 








?>








<!doctype html>
<html lang="en">
<?php
require_once('../includes/header.php');
 ?>
                                     <!--------------------------------------- START Container---------------------------------->

            <main class="dash-content">
                <div class="container-fluid">
                   



                         <!--------------------------------------- START show all users and admins ---------------------------------->
<h3 class="text-center mb-5 bien">Afficher budget deplacement</h3>


<table class="table text-center">
  <thead class="thead-dark">
  
     
      <th scope="col">Deplacement</th>
      <th scope="col">budget</th>
      <th scope="col">Date</th>
      <th scope="col">Action</th>

     
      
    </tr>
  </thead>
  <tbody>
<?php if( $data){
 foreach($data as $row){ ?>
      
     
    <tr>
      <td><?php echo $row['tarifDep']  ?> Dhs</td>
      <td><?php echo $row['budget']  ?> Dhs</td>
      <td><?php echo $row['date']  ?></td>
      
    
      <td> 
      <button class="btn btn-danger mx-auto"><a href="delete.php?id_Deps=<?php echo $row['id_Deps'] ?>">Delete</a></button>
    
      </td>
      

    </tr>
    
    <?php
    }
  } 
  ?>



  </tbody>
</table>
       




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