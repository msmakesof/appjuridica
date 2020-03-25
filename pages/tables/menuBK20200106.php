<?php 
//include('../../Connections/cnn_kn.php'); 
//require('../../Connections/config2.php'); 
if(!isset($_SESSION)) 
{ 
  session_start(); 
}
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
?>   
   
<div class="menu">
    <ul class="list">
        <li class="header">MENÚ de NAVEGACIÓN</li>
        <li>
            <a href="../../header/index.php">
                <i class="material-icons">home</i>
                <span>Inicio</span>
            </a>
        </li>
		
		<li>
            <a href="#" class="menu-toggle">
                <i class="material-icons">assignment_ind</i>
                <span>Empresas Cliente</span>
            </a>
			
            <ul class="ml-menu">
                <li>
                    <a href="emp_empresa.php" class="menu-toggle">
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
            <a href="cli_cliente.php" class="menu-toggle">
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
				<a href="usu_usuario.php">
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

					for($i=0; $i<count($mmenu['menu']); $i++)    
					{
						$NombreTablaMenu = trim($mmenu['menu'][$i]['TAB_Nombre_Tabla']);                
						$NombreMostrar = trim($mmenu['menu'][$i]['TAB_NombreMostrar']);							
						$archivo = $NombreTablaMenu.".php";	
						
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
							<a href="<?php echo $archivo; ?>"><?php echo $NombreMostrar; ?></a>
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
                    <a href="pro_proceso.php" id ="np" name="np" class="menu-toggle active">
                        <span>Nuevo Proceso</span>
                    </a>
					<a href="pro_procesoc.php" id ="cp" name="cp" class="menu-toggle active">
                        <span>Procesos Cerrados</span>
                    </a>
					<!-- 
                    <a href="pro_actuacionprocesal.php" class="menu-toggle active">
                        <span>Actuaci&oacute;n Procesal</span>
                    </a>
					-->
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
                    <a href="../../agenda/inde.php" class="menu-toggle">
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
                  <a href="https://procesojudicial.ramajudicial.gov.co/Justicia21/Administracion/InicioAplicaciones/InicioJusticia21Web.aspx" class="menu-toggle" target="_blank">
                        <span>Rama Judicial TYBA</span>
                    </a>
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