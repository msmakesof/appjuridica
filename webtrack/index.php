<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
$var2 = $_COOKIE['_gus'] ;

if($var2 == null || $var2 == "")
{
    $var2 = $_SESSION["user_id"];
}
if( !isset($var2) || $var2 != "" || !is_null($vercook) )
{
?>
<script type='text/javascript'>
    sessionStorage.setItem("_utmworker", "<?php echo $var2; ?>");
</script>
<?php
}

header("location: ../header/");
?>