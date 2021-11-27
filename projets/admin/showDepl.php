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



$displayDepl = new OperDeplacement(); //create a object
$data =$displayDepl ->displayDeplacement(); //call function from class deplacement to return resulat 








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
<h3 class="text-center mb-5 bien">Afficher Les Déplacements</h3>



<table class="table text-center">
  <thead class="thead-dark">
      
     <th scope="col">Le Nom</th>
      <th scope="col">Le Prenom</th>
      <th scope="col">Residence</th>
      <th scope="col">Total Deplacement</th>
      <th scope="col">La Date Deplacement</th>
      <th scope="col">Rest a Payer</th>
      <th scope="col">Action</th>
      

      
    </tr>
  </thead>
  <tbody>
<?php if( $data > 0){
 foreach($data as $row){ ?>
      
     
    <tr>
      <td><?php echo $row['Nom']  ?></td>
      <td><?php echo $row['Prenom']  ?></td>
      <td><?php echo $row['Residence']  ?></td>
      <td><?php echo $row['total_depl']  ?></td>
      <td><?php echo $row[8]  ?></td>
      <td><?php echo $row['Rest_Payer']  ?></td>
      
      <td> 
      <button class="btn btn-success  mx-auto"><a href="EditDepl.php?id_Depl=<?php echo $row['id_dep'] ?>">Edit</a></button>
      <button class="btn btn-danger mx-auto"><a href="delete.php?id_Depl=<?php echo $row['id_dep'] ?>">Delete</a></button>
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