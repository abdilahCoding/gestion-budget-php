<?php


require_once('../config/admin.php');

require_once('../config/rest.php');

  
if(!isset($_SESSION["admin"] )){
     
    if(!isset($_SESSION["user"]) ){
        header("location: ../index.php");
        exit;

    }

}elseif(!isset($_SESSION["admin"])){
    header("location: ../index.php");
    exit;

}

$date = date('Y'); 
$stmt = $db->connection->prepare("SELECT Budget FROM budget WHERE Year(Date) = ? ");
$stmt->execute(array($date));
$resBudget =$stmt->fetch();
$rowsBudget =$stmt->rowCount();

$query = $db->connection->prepare("SELECT  COUNT(id_admin) FROM admins ");
$query->execute();
$resAdmins =$query->fetch();
$rowsAdmins =$query->rowCount();

$Ens = $db->connection->prepare("SELECT  COUNT(id_Ens) FROM enseignant ");
$Ens->execute();
$resEnseg =$Ens->fetch();
$rowsEnseg =$Ens->rowCount();


 
?>



<!doctype html>
<html lang="fr">

<?php 
    
    require_once('../includes/header.php');

?>




                                     <!--------------------------------------- START Container---------------------------------->

            <main class="dash-content">
            <h3 class="text-center mb-5 bien"> Bienvenue  </h3>
            <div class="row dash-row d-flex justify-content-center">
           
                        <div class="col-xl-4">
                         <a href="showBudgets.php"  >
                            <div class="stats stats-primary" style="background: rgba(0, 0, 0, 0) linear-gradient(to right, rgb(18, 194, 233), rgb(196, 113, 237), rgb(246, 79, 89)) repeat scroll 0% 0%;">
                                <h7 class="stats-title"> Budget </h7>
                                <div class="stats-content">
                                    <div class="stats-icon">
                                        <i class="fas fa-hand-holding-usd"></i>
                                    </div>
                                    <div class="stats-data">

                                        <div class="stats-number"><?php if($rowsBudget > 0){ echo $resBudget[0]; }?> Dhs </div>
                                      
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-xl-4">
                        <a href="showusers.php"  >
                            <div class="stats stats-success " style="background: rgba(0, 0, 0, 0) linear-gradient(to right, rgb(122, 244, 216), rgb(68, 140, 130), rgb(208, 101, 90)) repeat scroll 0% 0%">
                                <h7 class="stats-title"> Admins </h7>
                                <div class="stats-content">
                                    <div class="stats-icon">       
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="stats-data">
                                        <div class="stats-number"><?php if($rowsAdmins > 0){ echo $resAdmins[0]; }?> Admins</div>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>



                        <div class="col-xl-4">
                         <a href="showEns.php"  >
                            <div class="stats stats-primary" style="background: rgba(0, 0, 0, 0) linear-gradient(to right, rgb(18, 194, 233), rgb(196, 113, 237), rgb(246, 79, 89)) repeat scroll 0% 0%;">
                                <h7 class="stats-title"> Enseignants </h7>
                                <div class="stats-content">
                                    <div class="stats-icon">
                                    <i class="fas fa-user-friends"></i>
                                    </div>
                                    <div class="stats-data">

                                        <div class="stats-number"><?php if($rowsEnseg > 0){ echo $resEnseg[0]; }?> Enseignants </div>
                                      
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>


    
              

                <div class="container-fluid pt-5">

               
              
          <div style="width: 900px;height:300px;margin: auto;">

<canvas id="Chart" style="display: block;" width="1538" height="320"></canvas>
</div>
        

  





        </div>
    </div>
    <?php
    require_once('../includes/script.php');
   ?>
     
  <script>



let ajax = new XMLHttpRequest(); // Create an XMLHttpRequest object
ajax.open("GET", "http://127.0.0.1/projet/config/budgetInfo.php", true);

ajax.onload = function() { // Define a callback function
  
let data = this.responseText; //  Data from budgetInfo.php
console.log(data);
name(data); //dawzna data l function
};

ajax.send();


function name(xdata) {

   let parsess = JSON.parse(xdata) //convert json data to javascript object

  let labels = parsess.map(e => e.Date);
//   console.log(labels)
//   let data = xdata.map(e => e.Quantité);
  let budgets = parsess.map(e => e.Budget);
  console.log(budgets)


  let ctx = document.getElementById('Chart');
let myChart = new Chart(ctx, {
type: 'bar',
data: {


labels:labels,
datasets: [{

  label: "Budgets",
  data: budgets,
  backgroundColor: 'rgb(255, 99, 132)',
 borderColor: 'rgb(255, 99, 132)',
 
  borderWidth: 1
}

]
  
},
options: {
scales: {
  yAxes: [{
      ticks: {
          beginAtZero: true
      }
  }]
}
}
});

  
}
</script>
</body>

</html>