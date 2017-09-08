<?php
//include config
require_once('includes/config.php');

//check if already logged in move to home page
if( $user->is_logged_in() ){ header('Location: index.php'); }

//process login form if submitted
if(isset($_POST['submit'])){

	$username = $_POST['username'];
	$password = $_POST['password'];

	if($user->login($username,$password)){
		$_SESSION['username'] = $username;
		header('Location: memberpage.php');
		exit;

	} else {
		$error[] = '<div class="alert alert-danger" role="alert">El nombre de usuario o la contraseña son incorrectos o la cuenta no se ha activado.
</div>';
	}

}//end if submit

//define page title
$title = 'Inicio de sesión';

//include header template
require('layout/header.php');


?>


<div class="container">

	<div class="row">
		<div class="col-lg-6">
			<?php
			//if action is joined show sucess
			if(isset($_GET['action']) && $_GET['action'] == 'joined'){
				echo '<div class="alert alert-success" role="alert">Gracias por registrarse le llegara un correo electronico para que pueda activar su cuenta</div>';

			}
			 ?>
		<h2>Bienvenidos!</h2>
		<p>Con esta herramienta podrás acercarnos tus propuestas para gestionar ante el Departamento Ejecutivo a través de las distintas Comisiones.</p>
		<p>Sólo <a href='registro.php' class="text-info">registrándote</a> con algunos de tus datos podrás solicitar de manera rápida y sencilla desde un bacheo hasta la reparación de un semáforo.</p> 
		<p>Muy pronto, cuando terminemos de desarrollar el sistema, vas a poder presentar tus propios proyectos al Cuerpo. </p>
		</div>

	  <div class="col-lg-6">
			<form role="form" method="post" action="" autocomplete="off">
				<h2>Inicio de sesión</h2>
				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				if(isset($_GET['action'])){

					//check the action
					/*
					switch ($_GET['action']) {
						case 'active':
							echo "<div class="alert alert-success" role="alert">Tu cuenta está activa, ahora puedes iniciar sesión.</div>";
							break;
						case 'reset':
							echo "<div class="alert alert-success" role="alert">Por favor, compruebe en su correo un enlace de restablecimiento.</div>";
							break;
						case 'resetAccount':
							echo "<div class="alert alert-success" role="alert">Se ha cambiado la contraseña.</div>";
							break;
					}
					*/

				}

				?>

				<div class="form-group">
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Nombre de Usuario" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
				</div>

				<div class="form-group">
					<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Contraseña" tabindex="3">
				</div>

				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Ingreso" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
				</div>
				<br>
				<div class="row">
					<div class="col-xs-9 col-sm-9 col-md-9">
						<p>Tenés cuenta? <a href='registro.php' class="text-info">Registrate</a>
						<a href='reset.php' class="text-info">Olvidaste tu contraseña?</a></p>
					</div>
				</div>
			</form>
		</div>

	</div>
</div>

<?php
//include header template
require('layout/footer.php');
?>
