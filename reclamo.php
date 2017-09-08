<?php require('includes/config.php');

//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); }

//if form has been submitted process it
if(isset($_POST['submit'])){

	//validaciones
			if(strlen($_POST['telefono']) < 3){
				$error[] = '<div class="alert alert-danger" role="alert">Ingrese un numero de telefono valido!</div>';
			}

			//email validation
		 if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
				 $error[] = '<div class="alert alert-danger" role="alert">Por favor, introduce una dirección de correo electrónico válida</div>';
		 } else {
			 $stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
			 $stmt->execute(array(':email' => $_POST['email']));
			 $row = $stmt->fetch(PDO::FETCH_ASSOC);

			 if(!empty($row['email'])){
				 $error[] = '<div class="alert alert-danger" role="alert">El correo electrónico ya está en uso.>/div>';
			 }

		 }

	//fin validaciones

		try {
			//insert into database with a prepared statement
			$stmt = $db->prepare('INSERT INTO reclamos (memberID,email,telefono,tema,direccion,detalle) VALUES (:memberID, :email, :telefono, :tema, :direccion, :detalle)');
			$stmt->execute(array(
        ':memberID' => $_SESSION['memberID'],
				':email' => $_POST['email'],
        ':telefono' => $_POST['telefono'],
        ':tema' => $_POST['tema'],
        ':direccion' => $_POST['direccion'],
        ':detalle' => $_POST['detalle'],
			));
			$id = $db->lastInsertId('reclamoID');

			//redirect to index page
			//header('Location: index.php?action=joined');
			header('Location: memberpage.php?action=joined');

			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}
}
//define page title
$title = 'Reclamo';
//include header template
require('layout/header.php');
?>
<div class="container">
	<div class="row">
	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
			<form role="form" method="post" action="" autocomplete="off">
				<h2>Completá el formulario</h2>
				<?php
				//check for any errors
				if(isset($error)){
					foreach($error as $error){
						echo '<p class="bg-danger">'.$error.'</p>';
					}
				}
				//if action is joined show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'joined'){
					echo '<div class="alert alert-success" role="alert">Gracias por cargar su reclamo</div>';

				}
				?>
				<div class="form-group">
					<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Correo electronico" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="1" required>
				</div>
        <div class="form-group">
					<input type="text" name="telefono" id="telefono" class="form-control input-lg" placeholder="Telefono" value="<?php if(isset($error)){ echo $_POST['telefono']; } ?>" tabindex="2" required>
				</div>
        <select class="form-control input-lg" name="tema" id="tema" tabindex="3" required>
			<option value="">Seleccioná el tema</option>
              <optgroup label="Obras Públicas" required>

                   <option value="Bacheo">Bacheo - Pavimentación - Asfalto</option>
                   <option value="Semaforos">Semáforos (colocación y reparación)</option>
                   <option value="Plazas">Plazas (mantenimiento, reparación, equipamiento y construcción)</option>
                   <option value="Veredas">Veredas (reparación)</option>
                   <option value="Carteleria vial">Señalización vial y cartelería (colocación, reparación y mantenimiento)</option>
                   <option value="Zanja">Zanja (construcción y mantenimiento)</option>
                   <option value="Boca de tormentas">Boca de tormentas (colocación, reparación y mantenimiento)</option>
                   <option value="Instalacion de Luminarias">Instalación de Luminarias</option>
                   <option value="Corte de transito">Corte de transito</option>
                   <option value="Desmalezamiento">Desmalezamiento</option>
                   <option value="vehiculo">Retiro de vahiculo abandonado en la via pública</option>
              </optgroup>
              <optgroup label="Ecologia">
                   <option value="Poda y escamonda de arboles">Poda y escamonda de arboles</option>
              </optgroup>
              <optgroup label="Servicios Publicos">
                  <option value="Eliminacion de basural">Eliminacion de basural</option>
                  <option value="Retiro de escombros">Retiro de escombros</option>
                  <option value="Colocacion de volquete">Colocacion de volquete</option>
                  <option value="Areas de limpieza en general">Areas de limpieza en general</option>
                  <option value="Luminaria">Luminaria (colocación, reparacion y mantenimiento)</option>
                  <option value="cloacas">Desobtrucción, reparación de desagues y bocas de tormenta</option>
              </optgroup>
              <optgroup label="Salud">
                   <option value="Estudio Ambiental">Estudio Ambiental a cargo de asistentes sociales</option>
                   <option value="Desagotamiento de pozos ciegos">Desagotamiento de pozos ciegos</option>
              </optgroup>
              <!--<option value="otros">Otros</option>-->

        </select>
        <br>
        <div class="form-group">
					<input type="text" name="direccion" id="direccion" class="form-control input-lg" placeholder="Direccion exacta" value="<?php if(isset($error)){ echo $_POST['direccion']; } ?>" tabindex="4" required>
				</div>
        <div class="form-group">
					<textarea type="textarea" name="detalle" id="detalle" class="form-control input-lg" placeholder="detalle" value="<?php if(isset($error)){ echo $_POST['detalle']; } ?>" tabindex="5"></textarea>
				</div>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Enviar" class="btn btn-primary btn-block btn-lg" tabindex="6"></div>
				</div>
			</form>
		</div>
	</div>
	<br>
	<p><a href='memberpage.php'>Volver</a></p>
</div>

<?php
//include header template
require('layout/footer.php');
?>
