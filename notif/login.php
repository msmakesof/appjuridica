<?php 
session_start();
include('header.php');
$loginError = '';
if (!empty($_POST['username']) && !empty($_POST['pwd'])) {
	include ('Push.php');
	$push = new Push();
	$user = $push->loginUsers($_POST['username'], $_POST['pwd']); 
	if(!empty($user)) {
		$_SESSION['username'] = $user[0]['username'];
		header("Location:index.php");
	} else {
		$loginError = "Invalido el usuario o contraseña!";
	}
}

?>
<title>Baulphp.com : Sistema de Notificación PUSH usando PHP y MySQL</title>
<?php include('container.php');?>
<div class="container">		
	<h2>Iniciar Sesión:</h2>
	<div class="row">
		<div class="col-sm-4">
			<form method="post">
				<div class="form-group">
				<?php if ($loginError ) { ?>
					<div class="alert alert-warning"><?php echo $loginError; ?></div>
				<?php } ?>
				</div>
				<div class="form-group">
					<label for="username">Usuario:</label>
					<input type="username" class="form-control" name="username" required>
				</div>
				<div class="form-group">
					<label for="pwd">Contraseña:</label>
					<input type="password" class="form-control" name="pwd" required>
				</div>  
				<button type="submit" name="login" class="btn btn-default">Iniciar Sesion</button>
			</form><br>
			<strong>Datos demo:</strong><br>
			<strong>Usuario:</strong> baulphp <br>
			<strong>Contraseña:</strong> 12345
		</div>
	</div>
</div>	
<?php include('footer.php');?>






