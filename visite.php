<?php
require 'config.php';

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Welcome to our center</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets2/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css2/styles.css" rel="stylesheet" />
    </head>
    <body>
    <nav class="navbar navbar-expand-lg">
        <div class="container px-4 px-lg-5">
            <img src="pic/e-learning.png" alt=""style="width:15%;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                </ul>
                <a class="btn btn-outline-dark mt-auto" href="login.php"><i class="fa-solid fa-user">Login/Signup</i></a>
                </div>
            </div>
        </div>
    </nav>
  
    <header>
        <div>
            <img class="img" src="pic/centre-de-formation.png" alt="" style="width: 100%;">

        </div>
    </header><br>
        <!-- Section-->
       
        <section class="py-5" id="services">
        <div class="top-nav-right">
        <form class="form-inline" action="#" method="post" style="display: flex;">
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" class="form-control" name="titre" placeholder="Search" style="width:10vw;">
            </div>
            <div class="form-group mx-sm-3 mb-3">
                <select class="form-select" aria-label="Default select example" name="Categorie">
                    <option selected name="etat">Categorie</option>
                    <option value="informatique" name="informatique">informatique</option>
                    <option value="Marketing" name="Marketing">Marketing</option>
                    <option value="Gestion de projet" name="Gestion de projet">Gestion de projet</option>
                </select>
            </div>
            <div class="form-group mx-sm-3 mb-3">
                <select class="form-select" aria-label="Default select example" name="Masse horaire">
                    <option selected>Masse horaire</option>
                    <option value="30" name="30">30</option>
                    <option value="40" name="40">40</option>
                    <option value="50" name="50">50</option>
                    
                </select>
            </div>
            <button type="submit" name="recherche" class="btn btn-dark mb-2" id="btn">SEARCH</button>
        </form>
    </div>
                    <div class="container px-4 px-lg-5 mt-5">
                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                            <?php
                                $result = mysqli_query($conn, 'SELECT * FROM `formation`');
                                // $row = mysqli_fetch_assoc($result);
                                while ($row = mysqli_fetch_assoc($result)){
                                    ?>
                                        <div class="col mb-5">
                                            <div class="card h-100">
                                                <!-- Product image-->
                                                <img class="card-img-top" src="<?php echo $row['image'];?>" alt="..." />
                                                <!-- Product details-->
                                                <div class="card-body p-4">
                                                    <div class="text-center">
                                                        <!-- Product name-->
                                                        <h5 class="fw-bolder"> <?php echo $row['titre'];?></h5>
                                                    </div>
                                                </div>
                                                <!-- Product actions-->
                                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" name="id" href="login.php?id=<?php echo $row['id_formation'];?>">Join</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                
                                }
                    
                            ?>
                </section>
                <?php
                if(isset($_POST['recherche'])){
                $titre = $_POST['titre'];
                $Categorie = $_POST['Categorie'];
                $Masse_horaire = $_POST['Masse_horaire'];
                $result ="";
                if($titre!=""){
                    $titre_escaped = mysqli_real_escape_string($conn, $titre);
                    $query="SELECT * FROM `formation` WHERE titre = '$titre_escaped'";
                    $result= mysqli_query($conn,$query);
                }     
                elseif($Categorie!=""){
                    $query="SELECT * FROM `formation` WHERE `Categorie` = '$Categorie'";
                    $result= mysqli_query($conn,$query);
                }
                elseif($titre!="" && $Categorie!=""){
                    $query="SELECT * FROM `formation` WHERE titre = $titre_escaped and 'Categorie' = $Categorie ";
                    $result= mysqli_query($conn,$query);
                    }
                while($row3=mysqli_fetch_assoc($result)){
                    echo'
                    <section class="py-5 style="display: flex;"">
                    <div class="container px-4 px-lg-5 mt-5">
                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                        
                                        <div class="col mb-5">
                                            <div class="card h-100">
                                                <!-- Product image-->
                                                <img class="card-img-top" src="'.$row3['image'].'" alt="..." />
                                                <!-- Product details-->
                                                <div class="card-body p-4">
                                                    <div class="text-center">
                                                        <!-- Product name-->
                                                        <h5 class="fw-bolder">'.$row3['titre'].'</h5>
                                                    </div>
                                                </div>
                                                <!-- Product actions-->
                                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" name="id" href="login.php?id= '.$row3['id_formation'].'">Join</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                
                                
                    
                            
                </section>'
                ;}}


?>
<?php 
 
 
  if(isset($_POST['recherche'])){
  $titre = $_POST['titre'];
  $Categorie = $_POST['Categorie'];
  $Masse_horaire = $_POST['Masse_horaire'];
  $result ="";
 
  if($Masse_horaire!=""){
      $Masse_horaire = mysqli_real_escape_string($conn, $Masse_horaire);
      $query="SELECT * FROM `formation` WHERE Masse_horaire = '$Masse_horaire'";
      $result= mysqli_query($conn,$query);
  }     
  while($row3=mysqli_fetch_assoc($result)){
    echo'
    <section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        
                        <div class="col mb-5">
                            <div class="card h-100">
                                <!-- Product image-->
                                <img class="card-img-top" src="'.$row3['image'].'" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder">'.$row3['titre'].'</h5>
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" name="id" href="login.php?id= '.$row3['id_formation'].'">Join</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                
                
    
            
</section>'
;}}



?>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; OUR CENTER 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js2/scripts.js"></script>
    </body>
</html>