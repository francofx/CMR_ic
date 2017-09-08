
<?php
//include config
require_once('includes/config.php');

//define page title
$title = 'Acerca del sistema';

//include header template
require('layout/header.php');
?>


<div class="container">

	<div class="row">
		<div class=".col-xl-4">
		<h2>Acerca del sistema</h2>
		<p>
			Este sitio permite ingresar todo tipo de trámites y propuestas de los ciudadanos, para que el Concejo Municipal haga la gestión ante el Departamento Ejecutivo.
			Registrándote con tus datos podrás presentar tu solicitud o ingresar tu iniciativa. La Mesa de Entradas del Concejo le asignará un número de Expediente, como si lo hubieras presentado personalmente en la oficina del Concejo Municipal.
			Vas a recibir por mail los datos del expediente para que puedas seguir desde la Web del Concejo Municipal el avance del trámite.
			En el próximo paso encontrarás un formulario que permite un trámite simplificado para los siguientes asuntos:
		</p>
		  <p>OBRAS PÚBLICAS</p>
			<p>Bacheo, pavimentación asfalto. Semáforos (colocación, reparación). Plazas (reparación, mantenimiento, equipamiento, construcción). Veredas (reparación). Señalización vial y cartelería (colocación, reparación y mantenimiento). Zanjas (construcción y mantenimiento). . Bocas de tormenta (colocación, reparación y mantenimiento). Instalación de luminarias. Corte de tránsito. Desmalezamiento. Retiro de vehículos abandonados en vía pública.</p>
			<p>ECOLOGÍA</p>
			<p>Poda y escamonda de árboles</p>
			<p>SERVICIOS PÚBLICOS</p>
			<p>Eliminación de basural. Retiro de escombros. Colocación de volquete. Áreas de limpieza general. Luminaria (colocación, reparación, mantenimiento).</p>
			<p>SALUD</p>
			<p>Estudio ambiental a cargo de asistentes sociales. Desagote de pozos ciegos</p>
			<p>OTROS</p>
			<p>Iniciativas, pedidos y propuestas que no están previstas en los temas anteriores.</p>

		</div>
		<p><a href='index.php'>Volver</a></p>


	</div>



</div>


<?php
//include header template
require('layout/footer.php');
?>
