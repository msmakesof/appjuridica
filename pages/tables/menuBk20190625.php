<?php 
//include('../../Connections/cnn_kn.php'); 
//require('../../Connections/config2.php'); 
if(!isset($_SESSION)) 
{ 
  session_start(); 
}
$ruta = __FILE__;
?>
<?php
if (!function_exists("GetSQLValueString")) 
{
    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
    {
        if (PHP_VERSION < 6) 
        {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
        }

        $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

        switch ($theType) 
        {
            case "text":
            $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;    
            case "long":
            case "int":
            $theValue = ($theValue != "") ? intval($theValue) : "NULL";
            break;
            case "double":
            $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
            break;
            case "date":
            $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;
            case "defined":
            $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
            break;
        }
        return $theValue;
    }
}
$empresa = "AppJuridica";
if( isset($_POST['ƒ¤']) && !empty($_POST['ƒ¤']) )
{    
    $clave = trim($_POST['ƒ¤']);
}
else
{
    $clave ="";
}

$opcMenu= $_SESSION["opcMenu"] ;
if( isset($_POST['ƒ×'])  && !empty($_POST['ƒ×']) )
{    
    $usuario = trim($_POST['ƒ×']);
}
else
{
    $usuario ="";
}
//header('Location: ../../');
if($usuario == "")
{
    $usuario = $_SESSION["IdUsuario"];
}
//echo $ruta."<br>" ;
//echo $_SERVER['SERVER_NAME']."<br>";
$rutax= dirname($_SERVER['PHP_SELF'] ); //$_SERVER['PHP_SELF'];
//echo $rutax."<br>";
//echo basename($_SERVER['PHP_SELF'])."<br>";
//echo $_SERVER['REQUEST_URI']."<br>";
//echo "__FILE__ : " . __FILE__ . "<br>";  
//echo $_SERVER['DOCUMENT_ROOT']. "<br>";
//echo dirname( $ruta). "<br>";
//echo dirname($_SERVER['PHP_SELF'] ). "<br>";
?>   
   
<div class="menu">
    <ul class="list">
        <li class="header">MENÚ de NAVEGACIÓN</li>
        <li>
            <a href="../../header/">
                <i class="material-icons">home</i>
                <span>Inicio</span>
            </a>
        </li>
		
		<li>
            <a href="#" class="menu-toggle">
                <i class="material-icons">assignment_ind</i>
                <span>Empresas Cliente >>></span>
            </a>
			
            <ul class="ml-menu">
                <li>
                    <a href="<?php echo dirname($_SERVER['PHP_SELF']) ?>/emp_empresa.php" class="menu-toggle">
                        <span>Empresas</span>
                    </a>  
                </li>
				
				<!--
                <li>
                    <a href="emp_contacto.php" class="menu-toggle">
                        <span>Contactos por Empresas</span>
                    </a>  
                </li> -->
            </ul>
			         
        </li>
		
		<li>
            <!-- <a href="cli_cliente.php" class="menu-toggle"> -->
			<a href="<?php if($rutax != "/appjuridica/cliente/"){ echo "/appjuridica/";} ?>cliente/" class="menu-toggle">
                <i class="material-icons">assignment_ind</i>
                <span>Clientes</span>
            </a>
            <!--
			<ul class="ml-menu">
                <li>
                    <a href="cli_cliente.php" class="menu-toggle">
                        <span>Clientes</span>
                    </a>  
                </li>
            </ul>
			-->            
        </li>
		<?php if($_SESSION["TipoUsuario"] == 1) {?>
			<li>
				<a href="javascript:void(0);">
					<i class="material-icons">text_fields</i>
					<span>Módulo Usuarios</span>
				</a>
			</li>
		<?php } ?>

		<?php if($_SESSION["TipoUsuario"] == 1) { ?>
			<li>
				<a href="javascript:void(0);" class="menu-toggle">
					<i class="material-icons">view_list</i>
					<span>Módulo de Administración</span>
				</a>
				<ul class="ml-menu">
					<?php
					include('menuInclude.php');
					$NombreArchivo = basename($_SERVER['PHP_SELF'],".php");
					$rutadm = dirname($_SERVER['PHP_SELF']) ;
					$arx= "";
					for($i=0; $i<count($mmenu['menu']); $i++)    
					{												
						$NombreTablaMenu = trim($mmenu['menu'][$i]['TAB_Nombre_Tabla']);                
						$NombreMostrar = trim($mmenu['menu'][$i]['TAB_NombreMostrar']);							
						$archivo = trim($NombreTablaMenu).".php";												
						$arx= $rutadm."/".$archivo;
						if( strtoupper($NombreArchivo) == strtoupper($NombreTablaMenu) )
						{ 
							$clase = "class='active'"; 
						}
						else
						{
							$clase = "";	
						}
						?>

						<li <?php echo $clase ;?> >
							<a href="<?php echo $arx; ?>"><?php echo $NombreMostrar; ?></a>
						</li>
						<?php                          
					}             
					?>				   
				</ul>
			</li>
		<?php } ?>

        <li <?php if($opcMenu =="P") { echo "class='active'"; }?> >
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">work</i>
                <span>Gesti&oacute;n Procesos</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="<?php echo dirname($_SERVER['PHP_SELF']) ?>/pro_proceso.php" id ="np" name="np" class="menu-toggle active">
                        <span>Nuevo Proceso</span>
                    </a>
					<a href="<?php echo dirname($_SERVER['PHP_SELF']) ?>/pro_procesoc.php" id ="cp" name="cp" class="menu-toggle active">
                        <span>Procesos Cerrados</span>
                    </a>
                    <a href="<?php dirname($_SERVER['PHP_SELF']) ?>/pro_actuacionprocesal.php" class="menu-toggle active">
                        <span>Actuaci&oacute;n Procesal</span>
                    </a>
                </li>
            </ul>
        </li>        

        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">today</i>
                <span>AGENDA</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="<?php if($rutax != "/appjuridica/agenda/"){ echo "/appjuridica/";}?>agenda/inde.php" class="menu-toggle">
                        <span>Agenda</span>
                    </a>  
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">widgets</i>
                <span>Siglo XXI</span>
            </a>
            <ul class="ml-menu">
                <li>
                   <!--  <a href="../kal/sample.php" class="menu-toggle">
                        <span>Comparaci&oacute;n de Cajas</span>
                    </a>  --> 
                </li>
            </ul>
        </li>
        
        
        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">pie_chart</i>
                <span>Módulo de Recursos.</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="javascript:void(0);">Indicadores</a>
                </li>
                <li>
                    <a href="javascript:void(0);">Gráficas</a>
                </li>
                <li>
                    <a href="javascript:void(0);">Estadísticas</a>
                </li>
                <li>
                    <a href="javascript:void(0);">Reportes</a>
                </li>
                <li>
                    <a href="javascript:void(0);">Otros</a>
                </li>                            
            </ul>
        </li>
       
    </ul>
</div>