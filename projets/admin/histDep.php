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




$displayDeplac = new OperDeplacement(); //create a object
$data =$displayDeplac ->displaySearch(); //call function from class commandes to return resulat 








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
  
    

 
  
  <button type="submit"  name="search" class="btn btn-outline-success btn-lg d-block mx-auto ">Chercher</button>
</form> 

<table class="table text-center  print-tables">
  <thead class="thead-dark">
      
     <th scope="col">Le Nom</th>
      <th scope="col">Le Prenom</th>
      <th scope="col">Residence</th>
      <th scope="col">Total Deplacement</th>
      <th scope="col">La Date Deplacement</th>
      <th scope="col">Rest a Payer</th>
      

      
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