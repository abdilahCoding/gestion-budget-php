<?php

require_once('../config/operationsRubs.php');



if(!isset($_SESSION["admin"] )){
     
  if(!isset($_SESSION["user"])){
      header("location: ../index.php");
      exit();
      

  }

}elseif(!isset($_SESSION["admin"])){
  header("location: ../index.php");
  exit();
  

}



$displayCommande = new OperRubs(); //create a object
$data =$displayCommande ->displayOperRybs(); //call function from class commandes to return resulat 








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
<h3 class="text-center mb-5 bien">Afficher Les Commandes</h3>


<table class="table text-center">
  <thead class="thead-dark">
  
      <th scope="col">Rurique</th>
      <th scope="col">Sous Rubrique</th>
      <th scope="col">Le Prix </th>
      <th scope="col">La Date </th>
      <th scope="col">Type</th>
      <th scope="col">Rest a payer</th>
      <th scope="col">Action</th>

      
    </tr>
  </thead>
  <tbody>
<?php if( $data){
 foreach($data as $row){ ?>
      
     
    <tr>
      <td><?php echo $row['RuriqueName']  ?></td>
      <td><?php echo $row['SousRubName']  ?></td>
      <td><?php echo $row['prix']  ?></td>
      <td><?php echo $row['date']  ?></td>
      <td><?php echo $row['type']  ?></td>
      <td><?php echo $row['Rest']  ?></td>
      
    
 
      <td> 
      <button class="btn btn-success  mx-auto"><a href="EditOperRubs.php?id_opRubs=<?php echo $row['id_opRubs'] ?>">Edit</a></button>
      <button class="btn btn-danger mx-auto"><a href="delete.php?id_opRubs=<?php echo $row['id_opRubs'] ?>">Delete</a></button>
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