<?php
//include("../pages/tables/header.inc.php");

if (!function_exists("GetSQLValueString")) {
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
	{
		if (PHP_VERSION < 6) {
			$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
		}

		$theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

		switch ($theType) {
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
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" name="viewport">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php //echo $empresa; ?> :: Agenda</title>
	
	<!-- Google Fonts 	-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">	


    <!-- Bootstrap Core CSS index -->
    <link href="../plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">	

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Preloader Css -->
    <link href="../plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />
	
	<link href="../css/sweet/sweetalert.css" rel="stylesheet" />    

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />	
	
	<!-- Custom CSS -->
    <style>
	 object{
       width:100%;
       height:390px ;  
	}
	
    body {
        padding-top: -10px !important;        
    }
	#calendar {
		max-width: 800px;
	}
	.col-centered{
		float: none;
		margin: 0 auto;
	}	
	
	.mscontenedor{
		width:90px;
		height:240px;
		position:absolute;
		right:150px;
		bottom:0px;
	}
	.botonF1{
		width:60px;
		height:60px;
		border-radius:100%;
		background:#F44336;
		right:0;
		bottom:0;
		position:absolute;
		margin-right:16px;
		margin-bottom:16px;
		border:none;
		outline:none;
		color:#FFF;
		font-size:36px;
		box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
		transition:.3s;  
	}
	span{
		transition:.5s;  
	}		
    </style>

</head>

<body class="theme-red">
    <!-- Page Loader  -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="md-preloader pl-size-md">
                <svg viewbox="0 0 75 75">
                    <circle cx="37.5" cy="37.5" r="33.5" class="pl-red" stroke-width="4" />
                </svg>
            </div>
            <p>Por Favor espere...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars  -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">buscar</i>
        </div>
        <input type="text" placeholder="Inicie ...">
        <div class="close-search">
            <i class="material-icons">cerrar</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand">
                <img src="<?php //echo $LogoInterno; ?>" style="margin-top: -6px;">
                </a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">                        
                        <span id="xNom"><?php //echo $_SESSION["NombreUsuario"]; ?></span>                   
                    </div>

                    <div class="email">                       
                        <span id="xMail"><?php //echo $_SESSION["EmailUsuario"]; ?></span>
                    </div>


                    <!-- <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php //echo trim($nombre); ?></div>
                    <div class="email"><?php //echo trim($email); ?></div> -->
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Perfil</a></li>
                            <li><a href="../pages/tables/close.php"><i class="material-icons">input</i>Salir</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <?php //include('../menu/menu.php'); ?>
            <!-- #Menu -->
			
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2017 <a href="javascript:void(0);">Administrador - <?php //echo $empresa; ?></a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->       
    </section>
	
	<section class="content">
        <div class="container-fluid">


			<!-- Page Content -->
			<div class="container">				
				<?php include('index.php'); ?>
			</div>
			<!-- /.container -->
		
			<div style="display: block !important; clear: both;">
				<div class="mscontenedor">
					<button class="botonF1">
					  <span>+</span>
					</button>
				</div>
			</div>		
	
		</div>
	</section>
	
	<!-- jQuery Version 1.11.1 -->
    <script src="../plugins/jquery/jquery.js"></script> 

    <!-- Bootstrap Core JavaScript -->
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>		
	
	<!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>	
    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>
	<!-- Custom Js -->
    <script src="../js/admin.js"></script>	

    <!-- Demo Js -->
    <script src="../js/demo.js"></script> 



</body>

</html>