



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="../styles/css/dash.css">
    <link rel="stylesheet" href="../styles/css/style.css">
 
    <title>dahsborad</title>
</head>

<body>
    <div class="dash">
        <div class="dash-nav dash-nav-dark">
            <header>
                <a href="#!" class="menu-toggle">
                    <i class="fas fa-bars"></i>  
                </a>
                <a href="dashboard.php" class="easion-logo"><i class="fas fa-money-check-alt"  style="color:rgb(255, 222, 173) "></i> <span> budgets</span></a>
            </header>
            <nav class="dash-nav-list">
        

              <a href="dashboard.php" class="dash-nav-item">
                    <i class="fas fa-home"></i> Dashboard </a>
                    <?php  if(isset($_SESSION["admin"]) ){     // 
               echo ' <div class="dash-nav-dropdown">
                    <a href="#" class="dash-nav-item dash-nav-dropdown-toggle">
                        <i class="fas fa-users"></i> Admin </a>
                
                  <div class="dash-nav-dropdown-menu">
                        <a href="addusers.php" class="dash-nav-dropdown-item">ajouter utilisateur</a>
                    </div>
                    <div class="dash-nav-dropdown-menu">
                        <a href="showusers.php" class="dash-nav-dropdown-item">afficher utilisateur</a>
                    </div>
                </div>

              ';
            
                        }
                ?>
                 <div class="dash-nav-dropdown ">
                <a href="#" class="dash-nav-item dash-nav-dropdown-toggle">
                        <i class="fas fa-hand-holding-usd"></i> budgets </a>
                    <div class="dash-nav-dropdown-menu">
                        <a href="addBudget.php" class="dash-nav-dropdown-item">Ajouté budget</a>
                        <a href="showBudgets.php" class="dash-nav-dropdown-item">Afficher budgets</a>
                    </div>
                    </div>
                <div class="dash-nav-dropdown ">
              
                    <a href="#" class="dash-nav-item dash-nav-dropdown-toggle">
                        <i class="fas fa-file-invoice-dollar"></i> Operations </a>
                   
                    <div class="dash-nav-dropdown-menu">
                        <a href="addEse.php" class="dash-nav-dropdown-item">Ajoute Societé</a>
                        <a href="showEse.php" class="dash-nav-dropdown-item">Affiche Societé</a>
                        <a href="addEns.php" class="dash-nav-dropdown-item">Ajoute Enseignant</a>
                        <a href="showEns.php" class="dash-nav-dropdown-item">Affiche Enseignant</a>


                    </div>
                    </div>
          <div class="dash-nav-dropdown ">
              
              <a href="#" class="dash-nav-item dash-nav-dropdown-toggle">
              <i class="fas fa-history"></i> Historique </a>
              
              <div class="dash-nav-dropdown-menu">
                 <a href="histBudget.php" class="dash-nav-dropdown-item"> Budgets</a>
                  <a href="histCom.php" class="dash-nav-dropdown-item"> Commandes</a>
                  <a href="histDep.php" class="dash-nav-dropdown-item">Deplacements</a>
                  <a href="histOperRubs.php" class="dash-nav-dropdown-item">Operations Rubs</a>


              </div>
          </div>

                    <div class="dash-nav-dropdown ">
              
                    <a href="#" class="dash-nav-item dash-nav-dropdown-toggle">
                        <i class="fas fa-donate"></i> Rubriques </a>
                    
                    <div class="dash-nav-dropdown-menu">
                    
                        <a href="showRub.php" class="dash-nav-dropdown-item">Affiche Runriques</a>
                    </div>
                </div>
                <div class="dash-nav-dropdown ">
              
              <a href="#" class="dash-nav-item dash-nav-dropdown-toggle">
                  <i class="fas fa-donate"></i>Autre Rubriques </a>
              
              <div class="dash-nav-dropdown-menu">
              
                  <a href="displayCmd.php" class="dash-nav-dropdown-item">Commandes </a>
                  <a href="displayDepl.php" class="dash-nav-dropdown-item">Deplacements </a>

              </div>
          </div>
                <div class="dash-nav-dropdown ">
              
              <a href="#" class="dash-nav-item dash-nav-dropdown-toggle">
              <i class="fas fa-shopping-bag"></i> Commandes </a>
              
              <div class="dash-nav-dropdown-menu">
              
                  <a href="addCom.php" class="dash-nav-dropdown-item">Ajoute Commande</a>
                  <a href="showCom.php" class="dash-nav-dropdown-item">Affiche Commande</a>

              </div>
          </div>
               


          <div class="dash-nav-dropdown ">
              
              <a href="#" class="dash-nav-item dash-nav-dropdown-toggle">
              <i class="fas fa-car"></i> Delacement </a>
              
              <div class="dash-nav-dropdown-menu">
                  <a href="addDepl.php" class="dash-nav-dropdown-item">Ajoute Deplacement</a>
                  <a href="showDepl.php" class="dash-nav-dropdown-item">Affiche Deplacement</a>

              </div>
          </div>
          <div class="dash-nav-dropdown ">
              
              <a href="#" class="dash-nav-item dash-nav-dropdown-toggle">
              <i class="fas fa-coins"></i> Operation rubs </a>
              
              <div class="dash-nav-dropdown-menu">
              
                  <a href="addOpRubs.php" class="dash-nav-dropdown-item">Ajoute </a>
                  <a href="showOperRubs.php" class="dash-nav-dropdown-item">Affiche </a>

              </div>
          </div>

         
          <div class="dash-nav-dropdown ">
              
              <a href="#" class="dash-nav-item dash-nav-dropdown-toggle">
              <i class="far fa-folder-open"></i> Documents </a>
              
              
              <div class="dash-nav-dropdown-menu">
              <a href="https://docs.google.com/spreadsheets/d/1hoS3xOGaFY8ITa3Zol0EeTnRwhFvN7MpaobO04-EuE8/edit?usp=sharing" target="_blank" class="dash-nav-item">
          <i class="far fa-file-excel"></i> Exel </a>
          <a href="https://docs.google.com/document/d/1FKeyFTxPm-feu9l58PhlqpiRnrESb5bAPd6NpMHWfEA/edit?usp=sharing" target='_blank' class="dash-nav-item">
          <i class="far fa-file-word"></i> word </a> 

              </div>
          </div>

          
         
               
                
            </nav>
        </div>
        <div class="dash-app">
            <header class="dash-toolbar">
                <a href="#!" class="menu-toggle"> 
                    <i class="fas fa-bars"></i>
                </a>
                <a href="#!" class="searchbox-toggle"> 
                    <i class="fas fa-search"></i>
                </a>
                <div style="color:black;font-size:30px;font-weight:bold">Gestion Financiére</div>
                <!-- <form class="searchbox" action="#!">
                    <a href="#!" class="searchbox-toggle"> <i class="fas fa-arrow-left"></i> </a>
                    <button type="submit" class="searchbox-submit"> <i class="fas fa-search"></i> </button>
                    <input type="text" class="searchbox-input" placeholder="type to search">
                </form> -->
                <div class="tools">
                    <div class="dropdown tools-item">
                        <a href="#" class="" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </header>










            