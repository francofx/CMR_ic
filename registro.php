<?php require('includes/config.php');

//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: memberpage.php'); }

//if form has been submitted process it
if(isset($_POST['submit'])){

	//very basic validation
	if(strlen($_POST['username']) < 3){
		$error[] = '<div class="alert alert-danger" role="alert">El nombre de usuario es muy corto!</div>';
	} else {
		$stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
		$stmt->execute(array(':username' => $_POST['username']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['username'])){
			$error[] = '<div class="alert alert-danger" role="alert">El nombre de usuario ya está en uso.</div>';
		}

	}

	if(strlen($_POST['password']) < 3){
		$error[] = '<div class="alert alert-danger" role="alert">La contraseña es demasiado corta.</div>';
	}

	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = '<div class="alert alert-danger" role="alert">Confirmar contraseña es demasiado corta.</div>';
	}

	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = '<div class="alert alert-danger" role="alert">Las contraseñas no coinciden.</div>';
	}

	//email validation
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = '<div class="alert alert-danger" role="alert">Por favor, introduce una dirección de correo electrónico válida</div>';
	} else {
		$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['email'])){
			$error[] = '<div class="alert alert-danger" role="alert">El correo electrónico ya está en uso.</div>';
		}

	}


	//if no errors have been created carry on
	if(!isset($error)){

		//hash the password
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

		//create the activasion code
		$activasion = md5(uniqid(rand(),true));

		try {

			//insert into database with a prepared statement
			$stmt = $db->prepare('INSERT INTO members (username,password,email,active) VALUES (:username, :password, :email, :active)');
			$stmt->execute(array(
				':username' => $_POST['username'],
				':password' => $hashedpassword,
				':email' => $_POST['email'],
				':active' => $activasion
			));
			$id = $db->lastInsertId('memberID');

			//send email
			$to = $_POST['email'];
			$subject = "Registro en el sistema Iniciativas, pedidos y propuestas";
			$body = "<p>Gracias por registrarte en el Concejo Municipal de Rosario.</p>
			<p>Para activar su cuenta, haga clic en este enlace: <a href='".DIR."activate.php?x=$id&y=$activasion'>".DIR."activate.php?x=$id&y=$activasion</a></p>
			<p>Saludos</p>";

			$mail = new Mail();
			$mail->setFrom(SITEEMAIL);
			$mail->addAddress($to);
			$mail->subject($subject);
			$mail->body($body);
			$mail->send();

			//redirect to index page
			header('Location: index.php?action=joined');
			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}

	}

}

//define page title
$title = 'Iniciativas, pedidos y propuestas';

//include header template
require('layout/header.php');
?>


<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form role="form" method="post" action="" autocomplete="off">
				<h3>Registrate en el sistema</h3>
				<p>Ya eres usuario? <a href='index.php'>Iniciar sesion</a></p>
				<hr>

				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}

				//if action is joined show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'joined'){
					echo '<div class="alert alert-success" role="alert">Registratio successful, please check your email to activate your account.</div>';

				}
				?>

				<div class="form-group">
					<input type="text" name="username" id="username" class="form-control input-lg" placeholder="Nombre de usuario" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
				</div>
				<div class="form-group">
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Correo electronico" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="2" required>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" name="password" id="password" class="form-control input-lg" placeholder="Contraseña" tabindex="3">
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Confirme contraseña" tabindex="4">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Regístrate" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
				</div>
			</br>
			</form>
		</div>
	</div>

</div>

<?php
//include header template
require('layout/footer.php');
?>
