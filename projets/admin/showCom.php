<?php

require_once('../config/OperCommande.php');



if(!isset($_SESSION["admin"] )){
     
  if(!isset($_SESSION["user"])){
      header("location: ../index.php");
      exit();
      

  }

}elseif(!isset($_SESSION["admin"])){
  header("location: ../index.php");
  exit();
  

}



$displayCommande = new OperCommandes(); //create a object
$data =$displayCommande ->displayCommande(); //call function from class commandes to return resulat 








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
  
      <th scope="col">Numéro de Commande</th>
      <th scope="col">Le Nom de produit</th>
      <th scope="col">Prix Unitaire</th>
      <th scope="col">La Quantité</th>
      <th scope="col">Total</th>
      <th scope="col">Date</th>
      <th scope="col">Fournisseur</th>
      <th scope="col">Rest a payer</th>
      <th scope="col">Action</th>

      
    </tr>
  </thead>
  <tbody>
<?php if( $data){
 foreach($data as $row){ ?>
      
     
    <tr>
      <td><?php echo $row['Num_Commande']  ?></td>
      <td><?php echo $row['Description']  ?></td>
      <td><?php echo $row['Prix_Unitaire']  ?></td>
      <td><?php echo $row['Quantité']  ?></td>
      <td><?php echo $row['Total']  ?></td>
      <td><?php echo $row['Date']  ?></td>
      <td><?php echo $row['Fournisseur']  ?></td>
      <td><?php echo $row['Rest_Payer']  ?></td>
    
 
      <td> 
      <button class="btn btn-success  mx-auto"><a href="EditCom.php?id_Commande=<?php echo $row['id_Commande'] ?>">Edit</a></button>
      <button class="btn btn-danger mx-auto"><a href="delete.php?id_Commande=<?php echo $row['id_Commande'] ?>">Delete</a></button>
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