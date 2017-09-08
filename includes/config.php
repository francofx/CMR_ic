<?php
ob_start();
session_start();

//set timezone
date_default_timezone_set('America/Argentina/Buenos_Aires');


//database credentials
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','root');
//define('DBNAME','usuarios17');
define('DBNAME','itt');

//application address
//define('DIR','http://190.210.183.204/IPR/');
define('DIR','http://www.concejorosario.gov.ar/IPR/');

//define('SITEEMAIL','fpalossi@gmail.com');
define('SITEEMAIL','propuestas@concejorosario.gov.ar');

try {

	//create PDO connection
	$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

//include the user class, pass in the database connection
include('classes/user.php');
include('classes/phpmailer/mail.php');
$user = new User($db);
?>
