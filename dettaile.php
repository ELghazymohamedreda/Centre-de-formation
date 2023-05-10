<?php
require 'db.php';

?>


<?php 
session_start();
$id_apprenant = $_SESSION['id_apprenant'];
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
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
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php">HOME</a></li>
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
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">DETTAILE</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
            </section>

            <?php

$id_formation = $_GET['id'];
  
$result = mysqli_query($con, "SELECT * FROM formation WHERE id_formation = '$id_formation'");
$row = mysqli_fetch_assoc($result);

echo'

<section class="">
	<div class="container py-4">
		<h1 class="h1 text-center" id="pageHeaderTitle">'.$row['titre'].'</h1>

		<article class="postcard dark blue">
			<a class="postcard__img_link" href="#">
				<img class="postcard__img" src="'.$row['image'].'" alt="Image Title" " width="100%" />
			</a>
			<div class="postcard__text">
				<p class="paragraph">Description</p>
				<div class="postcard__subtitle small">
					<time datetime="2020-05-25 12:00:00">
						<i class="fas fa-calendar-alt mr-2"></i>Mon, May 25th 2020
					</time>
				</div>
				<div class="postcard__bar"></div>
				<div class="postcard__preview-txt">'.$row['description'].'</div><br>';

                
                    
			
            
$result = mysqli_query($con, "SELECT * FROM sessions WHERE id_formation = '$id_formation'");
// Loop through sessions and display each one in a card
while ($row2 = mysqli_fetch_assoc($result)) {
    ?>
    <form method="post" action="#">
        <div class="card mb-3">
            <div class="card-body">
                <h4 class="card-title">Session number : <?php echo $row2['id_session'];?></h4>
                <h5 class="card-title">Session etat :<?php echo $row2['etat'];?></h5>
                <h6 class="card-subtitle mb-2 text-muted">Start <?php echo $row2['date_debut'];?> - end
                    <?php echo $row2['date_fin'];?></h6>
                <p class="card-text">Nombre de places disponibles: <?php echo $row2['nombre_de_place'];?></p>
                <?php $id_session =  $row2['id_session'];?>
                <?php
                $sql="SELECT * FROM formateurs WHERE id_formateur IN (SELECT id_formateur FROM sessions WHERE id_formation='$id_formation' AND id_session ='$id_session')";
                $results = mysqli_query($con,$sql);
                
                
                while($rows = mysqli_fetch_assoc($results)){
                    ?>
                <p class="card-text">Formateur: <?php echo $rows['nom_formateur'];?><span>
                        <?php echo $rows['prenom_formateur'];?></span></p>

                <?php
                
                }
               
                
                ?>

                <input type="hidden" name="id_session" value="<?php echo $row2['id_session']; ?>">
                <input type="submit" class="btn mt-4 btn btn-success" name="submit" value="S'inscrire">
            </div>
        </div>
    </form>
    <?php
}
echo '</div>';

if (isset($_POST['submit'])) {
    $id_session = $_POST['id_session'];
    $user_id = $_SESSION['id_apprenant'];

    // Check if user is already registered for this session
    $result = mysqli_query($con, "SELECT * FROM inscription WHERE id_session = '$id_session' AND id_apprenant = '$user_id'");
    if (mysqli_num_rows($result) > 0) {

       echo "<div class='alert alert-danger'>Vous êtes déjà inscrit pour cette session!</div>";
    } else {
        // Check if user is already registered for another session
        $result = mysqli_query($con, "SELECT * FROM inscription WHERE id_apprenant = '$user_id'");
        if (mysqli_num_rows($result) > 1) {
            echo "<div class='alert alert-danger'>Vous ne pouvez pas vous inscrire à plus de deux sessions!</div>";
        } else {
            // Insert new registration into the database
            $result = mysqli_query($con, "INSERT INTO inscription(id_session, id_apprenant) VALUES('$id_session', '$user_id')");
            if ($result) {
                echo "<div class='alert alert-success'>Inscription réussie!</div>";
            } else {
                echo "<div class='alert alert-danger'>Erreur lors de l'inscription.</div>";
            }
        }
    }
}

?>

    </article>

    </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>





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
    </body>
</html>