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



$displayEses = new Entreprise(); //create a object
$data =$displayEses ->displayEses(); //call function from class admin to return resulat 








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
<h3 class="text-center mb-5 bien">Afficher les Societés</h3>


<table class="table text-center">
  <thead class="thead-dark">
  
      <th scope="col">Nom</th>
      <th scope="col">Ville</th>
      <th scope="col">email</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
<?php if( $data){
 foreach($data as $row){ ?>
      
     
    <tr>
      <td><?php echo $row['Nom']  ?></td>
      <td><?php echo $row['Ville']  ?></td>
      <td><?php echo $row['Email']  ?></td>
      <td> 
      <button class="btn btn-success  mx-auto"><a href="editEse.php?id_Ese=<?php echo $row['Ids'] ?>">Edit</a></button>
      <button class="btn btn-danger mx-auto"><a href="delete.php?id_Ese=<?php echo $row['Ids'] ?>">Delete</a></button>


    
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