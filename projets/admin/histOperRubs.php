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
$data =$displayCommande ->displaySearch(); //call function from class OperRubs  to return resulat 








?>








<!doctype html>
<html lang="en">
<?php
require_once('../includes/header.php');
 ?>
                                     <!--------------------------------------- START Container---------------------------------->

            <main class="dash-content">
                <div class="container-fluid">
  <button onclick="window.print()" class="btn btn-primary rounded-pill">Imprimé</button>
                 



                         <!--------------------------------------- START show all users and admins ---------------------------------->
<h3 class="text-center bien">historique</h3>
<?php if($data == 'Vide'){
           
        
             
            echo "<div class='alert alert-danger alert-dismissible fade show messages' role='alert'>
            <span>$data</span>  
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
       <span aria-hidden='true'>&times;</span>
    </button>
    </div>"; 
         
          
  
      
    }
    
   ?>
  
                
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" class="isnertPatient mb-5 " >        
  
    <div class="form-group col-md-6 mx-auto">
    <select name="years" class="form-control">
      
<?php 

for($i=2021; $i<=2030; $i++)
{

    echo "<option value=".$i.">".$i."</option>";
}
?> 
       
      </select>  </div>
  
      <div class="form-group col-md-6 mx-auto">
    <select name="type" class="form-control">
 
    <option value="MMD">MMD</option>
    <option value="Personne">Personne</option>


       
      </select>  </div>
  
    

 
  
  <button type="submit"  name="search" class="btn btn-outline-success btn-lg d-block mx-auto ">Chercher</button>
</form> 

<table class="table text-center print-tables">
  <thead class="thead-dark">
  
      <th scope="col">Rurique</th>
      <th scope="col">Sous Rubrique</th>
      <th scope="col">prix</th>
      <th scope="col">Date</th>
      <th scope="col">type</th>
      <th scope="col">Rest a payer</th>

      
    </tr>
  </thead>
  <tbody>
<?php if( $data > 0){
 foreach($data as $row){ ?>
      
     
    <tr>
      <td><?php echo $row['RuriqueName']  ?></td>
      <td><?php echo $row['SousRubName']  ?></td>
      <td><?php echo $row['prix']  ?></td>
      <td><?php echo $row['date']  ?></td>
      <td><?php echo $row['type']  ?></td>
      <td><?php echo $row['Rest']  ?></td>
    
    
 
    

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