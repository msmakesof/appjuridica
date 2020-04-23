<?php 
session_start();
include('header.php');
?>
<title>Baulphp : Sistema de Notificación PUSH usando PHP y MySQL</title>
<script src="notification.js"></script>
<?php include('container.php');?>
<div class="container">		
	<h2>Ejemplo: Sistema de Notificación PUSH usando PHP y MySQL</h2>	
	<h3>Cuenta de usuario</h3>
	<?php if(isset($_SESSION['username']) && $_SESSION['username'] == 'admin') { ?>
		<a href="manage_notification.php">Administrar Notificaciones</a> | 
	<?php } ?>
	<?php if(isset($_SESSION['username']) && $_SESSION['username']) { ?>
		<a href="logout.php">Salir</a>
	<?php } else { ?>
		<a href="login.php">Iniciar Sesión</a>
	<?php } ?>
	<hr> 
	<?php if (isset($_SESSION['username'])) { ?>
		<h4>Bienvenido <strong><?php echo $_SESSION['username']; ?></strong></h4>	
	<?php } ?>	
	
	<div style="margin:50px 0px 0px 0px;">
		<a class="btn btn-default read-more" style="background:#3399ff;color:white" href="http://www.baulphp.com/sistema-de-notificacion-push-php-y-mysql/">Volver al Tutorial</a>		
	</div>
</div>	
<?php include('footer.php');?>






