<?php
require 'db.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="detail.scss">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>detail</title>
</head>

<body>
    <?php
$id_formation = $_GET['id'];
  
$result = mysqli_query($conn, "SELECT * FROM formation WHERE id_formation = '$id_formation'");
$row = mysqli_fetch_assoc($result);

echo'

<section class="">
	<div class="container py-4">
		<h1 class="h1 text-center" id="pageHeaderTitle">'.$row['titre'].'</h1>

		<article class="postcard dark blue">
			<a class="postcard__img_link" href="#">
				<img class="postcard__img" src="'.$row['image'].'" alt="Image Title" />
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

                
                    
			
            
$result = mysqli_query($conn, "SELECT * FROM sessions WHERE id_formation = '$id_formation'");
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
                $results = mysqli_query($conn,$sql);
                
                
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
    $result = mysqli_query($conn, "SELECT * FROM inscription WHERE id_session = '$id_session' AND id_apprenant = '$user_id'");
    if (mysqli_num_rows($result) > 0) {
        ?>
<div class="modal" id="myModals" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-danger">Vous êtes déjà inscrit pour cette session!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
            $(document).ready(function() {
                $("#myModals").modal('show');

            });
            </script>

    <?php
    //    echo "<div class='alert alert-danger'>Vous êtes déjà inscrit pour cette session!</div>";
    } else {
        // Check if user is already registered for another session
        $result = mysqli_query($conn, "SELECT * FROM inscription WHERE id_apprenant = '$user_id'");
        if (mysqli_num_rows($result) > 1) {
            echo "<div class='alert alert-danger'>Vous ne pouvez pas vous inscrire à plus de deux sessions!</div>";
        } else {
            // Insert new registration into the database
            $result = mysqli_query($conn, "INSERT INTO inscription(id_session, id_apprenant) VALUES('$id_session', '$user_id')");
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
</body>

</html>