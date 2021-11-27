<?php

require_once('../config/Enseignant.php');



if(!isset($_SESSION["admin"] )){
     
  if(!isset($_SESSION["user"])){
      header("location: ../index.php");
      exit();
      

  }

}elseif(!isset($_SESSION["admin"])){
  header("location: ../index.php");
  exit();
  

}



$displayEns = new Enseignant(); //create a object
$data =$displayEns ->displayEnseignant(); //call function from class Enseignant to return resulat 








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
<h3 class="text-center mb-5 bien">Afficher Enseignants</h3>


<table class="table text-center">
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
      <th scope="col">Action</th>
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
      <td> 
      <button class="btn btn-success  mx-auto"><a href="editEns.php?id_Ens=<?php echo $row['id_Ens'] ?>">Edit</a></button>
      <button class="btn btn-danger mx-auto"><a href="delete.php?id_Ens=<?php echo $row['id_Ens'] ?>">Delete</a></button>


    
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