<?php

require_once('../config/rubrique.php');



if(!isset($_SESSION["admin"] )){
     
  if(!isset($_SESSION["user"])){
      header("location: ../index.php");
      exit();
      

  }

}elseif(!isset($_SESSION["admin"])){
  header("location: ../index.php");
  exit();
  

}



$displayRub = new Rubrique(); //create a object
$data =$displayRub ->displayRubrique(); //call function from class Enseignant to return resulat 








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
<h3 class="text-center mb-5 bien">Afficher les Rubriques</h3>


<table class="table text-center">
  <thead class="thead-dark">
  
      <th scope="col">Numéro</th>
      <th scope="col">Description</th>
      <th scope="col">Tarif</th>
      <th scope="col">budget</th>
      <th scope="col">Date</th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody>
<?php if( $data){
 foreach($data as $row){ ?>
      
     
    <tr>
      <td><?php echo $row['Num']  ?></td>
      <td><?php echo $row['Description']  ?></td>
      <td><?php echo $row['tarifFix']  ?> Dhs</td>
      <td><?php echo $row['budget']  ?> Dhs</td>
      <td><?php echo $row['Date']  ?></td>
    
      <td> 
      <button class="btn btn-danger mx-auto"><a href="delete.php?id_rubrique=<?php echo $row['id_rubrique'] ?>">Delete</a></button>
    
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <?php
    require_once('../includes/script.php');
   ?>
</body>

</html>