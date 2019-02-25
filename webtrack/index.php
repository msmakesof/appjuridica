<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
//session_start();  // se deja en comentario 20190225 por mks

//require_once('./Connections/cnn_kn.php');	
$var2 = $_COOKIE['_gus'] ;
//echo "<br><br><br><br><br> antes.....".$var2;
if($var2 == null || $var2 == "")
{
    $var2 = $_SESSION["user_id"];
}
//echo "<br><br><br><br><br> cookie.....".$var2."<br><br>";
if( !isset($var2) || $var2 != "" || !is_null($vercook) )
{
?>
<script type='text/javascript'>
    sessionStorage.setItem("_utmworker", "<?php echo $var2; ?>");
</script>
<?php
}
//echo "usulocal....".$_SESSION['Usuario'] ."<br>";
//echo "cookie....$var2";
//header("location: ../header/index.php");
require ('../header/index.php');
?>