<?php require('includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

//define page title
$title = 'Iniciativas, pedidos y propuestas';

//include header template
require('layout/header.php');

//if action is joined show sucess
if(isset($_GET['action']) && $_GET['action'] == 'joined'){
	echo '<div class="alert alert-success" role="alert">Gracias por cargar tu iniciativa! Se la haremos llegar a la comision correspondiente, quien tramitará ante el Poder Ejecutivo</div>';

}
?>
			<div class="jumbotron">

				<h2 class="display-3">Hola <?php echo $_SESSION['username']; ?> </h2>
        <p class="lead">Esta es una herramienta más de participación ciudadana, con la cual tu propuesta sera gestionada por Concejo Municipal ante al Departamento Ejecutivo. Además vas a poder  realizar una gran variedad de trámites de forma sencilla y con un considerable ahorro de tiempo.</p>
        <p><a class="btn btn-lg btn-success" href="reclamo.php" role="button">Completa el formulario &raquo;</a></p>
      </div>
<p><a href='logout.php'>Salir</a></p>
<?php
//include header template
require('layout/footer.php');
?>
