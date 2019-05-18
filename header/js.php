<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
echo "<script type='text/javascript'>
		sessionStorage.setItem('_utmworker', '".$_SESSION['user_id']."');
	</script>";
?>