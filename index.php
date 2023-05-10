<?php 
session_start();
$id_apprenant = $_SESSION['id_apprenant'];
if(isset($_POST['inscription'])){
    $con = mysqli_connect("localhost","Root","","Application");
    $id_formation=$_POST['formations'];
    $sql = "SELECT id_session FROM sessions WHERE id_formation='$id_formation'";
    $resulte = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($resulte);
    $id_session = $row['id_session'];
    if(mysqli_num_rows($resulte) > 0){
        $query="INSERT INTO `inscription`(`id_apprenant`, `id_session`, `resultat`, `date_valu`) VALUES ('$id_apprenant','$id_session',NULL,NULL)";
        echo $query;
        if(mysqli_query($con,$query)){
            header("location:historique.php");

        }
    }


}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Freelancer - Start Bootstrap Theme</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="dist/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top">wanheda</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="">HOME</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="historique.php">HISTORIQUE</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="profil.php">PROFIL</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="Login.php">Logout</a></li>   
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <!-- <header>
            <img src="assets/img/shelf-12.jpg" alt="" style="width: 50%; margin-left:25%;">
        </header> -->
           <!-- Portfolio Section-->
           <section class="page-section portfolio" id="portfolio" style="margin-top: 10%;  padding-bottom:2%;">
            <div class="container">
                <!-- Portfolio Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Centre Formation</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
 </section>

        <div class="top-nav-right container" >
        <form class="form-inline" action="" method="post" style="display: flex; margin-left: 28%;">
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" class="form-control" name="search" placeholder="Search" style="width:100%; transition: width 0.4s ease-in-out;">
            </div>
            <div class="form-group mx-sm-3 mb-3">
                <select class="form-select" aria-label="Default select example" name="etat">
                    <option selected name="etat">Catégories</option>
                    <option value="Développement Web" >Développement Web</option>
                    <option value="Développment Mobile" >Développment Mobile</option>
                    <option value="Designe Graphique" >Designe Graphique</option>
                    <option value="Bases de données" >Bases de données</option>
                </select>
            </div>

            <div style="margin: bottom 10px; width: 20%;">
            <button type="submit" name="recherche" class="btn btn-success mb-2"
                style="background-color: #DFF3FC;border:1px solid #000;color:#000; "
                id="btn">SEARCH</button>
            </div>
        </form>
        </div>

        <!-- partial:index.partial.html -->
        <section>
	<div class="row">
        <?php 
          $con = mysqli_connect("localhost","Root","","Application");

         if(isset($_POST['recherche'])){
        
          $titre = $_POST['search'];
          $Categorie = $_POST['etat'];
          $query="";
          $result ="";
        
         
          if($titre!=""){
              $query="SELECT * FROM `formation` WHERE titre = '$titre'";
              $result= mysqli_query($con,$query);
          }elseif($Categorie !="" ){
             $query="SELECT * FROM `formation` WHERE categorie = '$Categorie'";
             $result= mysqli_query($con,$query);
          }
          if(mysqli_query($con,$query)){
           
          }
          
          
        }else{
            $query = "SELECT * FROM formation";
            $result = mysqli_query($con,$query);
           
        }
        while($row=mysqli_fetch_assoc($result)){
            ?>
                   <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="card">
                            <div class="cover item-a">
                                <img src="<?php echo $row["image"]; ?>" width="460vw" >
                                <h1><?php echo $row["titre"]; ?></h1>
                                <p><?php echo $row["description"]; ?></p>
                                <p><?php echo $row["masse_horaire"]; ?> Heure</p>
                            </div>
                            <form action="" method="post">
                                <input type="hidden" name="formations" value="<?php echo $row["id_formation"];?>">
                                <button type="submit" name="inscription">Inscription</button>
                           </form>
                        </div>
                        
                   </div>
                
            <?php
    
        }
          
       
        
        
        ?>
	</div>
</section>


     
        <!-- Footer-->
        <footer class="footer text-center">
            <div class="container">
                <div class="row">
                    <!-- Footer Location-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Location</h4>
                        <p class="lead mb-0">
                            2215 John Daniel Drive
                            <br />
                            Clark, MO 65243
                        </p>
                    </div>
                    <!-- Footer Social Icons-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Around the Web</h4>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-dribbble"></i></a>
                    </div>
                    <!-- Footer About Text-->
                </div>
            </div>
        </footer>
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright &copy; Your Website 2022</small></div>
        </div>
        <!-- Portfolio Modals-->
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
        <script  src="dist/script.js"></script>
    </body>
</html>