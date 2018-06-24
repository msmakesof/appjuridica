<?php require_once('../Connections/cnn_kn.php'); 
include 'config.php';
?>
<style>
a{
  text-decoration:none;
  text-align: center;
  font-size: 11px;
}
a:hover{
  text-decoration:none;
}

#popup {
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 1001;
}

.content-popup {
    margin:0px auto;
    margin-top:120px;
    position:relative;
    padding:10px;
    width:500px;
    min-height:250px;
    border-radius:4px;
    background-color:#FFFFFF;
    box-shadow: 0 2px 5px #666666;
}

.content-popup h2 {
    color:#48484B;
    border-bottom: 1px solid #48484B;
    margin-top: 0;
    padding-bottom: 4px;
}

.popup-overlay {
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 999;
    display:none;
    background-color: #777777;
    cursor: pointer;
    opacity: 0.7;
}

.close {
    position: absolute;
    right: 15px;
}
</style>
<link href="../sweet/sweetalert.css" rel="stylesheet">
<script src="<?=$base_url?>js/jquery.min.js"></script>
<script src="<?=$base_url?>js/bootstrap.min.js"></script>
<script src="../sweet/sweetalert.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {    
  var hacer ="";
  $("a[id^='horario*']").bind("click", function() {
      var myid = $(this).attr("data-rel");
      //alert(myid);

      //$('#open').click(function(){
        $('#popup').fadeIn('slow');
        $('.popup-overlay').fadeIn('slow');
        $('.popup-overlay').height($(window).height());
        //return false;
      //});
      
      $('#close').click(function(){
          $('#popup').fadeOut('slow');
          $('.popup-overlay').fadeOut('slow');
          return false;
      });     

      $("#grabar2").on("click", function(){
        var curso = $('#materia').val();
        var nivel = $('#nivel').val();
        myid = myid+'_'+curso+'_'+nivel;
        //alert(myid);
        if( curso == "" && nivel == "")
        {
          swal({
            title: "Error:  Al validar los campos requeridos...",
            text: "un momento por favor.",
            imageUrl: "../sweet/2.gif",
            timer: 2000,
            showConfirmButton: false
          });
        }
        else
        {
          ////***
          $.ajax({
            //this is the php file that processes the data 
            url: "addclase.php",
            //GET method is used
            type: "POST",
            data: "pars="+myid, //$("#form1").serialize(),     +'_'curso+'_'+nivel
            beforeSend: function() {
                // setting a timeout
                swal({
                    title: "Actualizando información...",
                    text: "un momento por favor.",
                    imageUrl: "../sweet/89.gif",
                    timer: 3000,
                    showConfirmButton: false
                });
            },
            success: function (xdata) {
                //if returned 1/true (process success)
                if (xdata.trim() == 'S') 
                {
                    //hide the form
                    $('.form1').fadeOut('slow');
                    //show the success message
                    $('.done').fadeIn('slow');
                    //if process.php returned 0/false (send mail failed)
                    swal({
                      title: "Atención:  Registro grabado correctamente.",
                      text: "un momento por favor.",
                      imageUrl: "../sweet/ok.png",
                      timer: 3000,
                      showConfirmButton: false
                    });
                    $("#form1")[0].reset();

                } 
                else if (xdata.trim() == 'E')                     
                {
                  swal({
                      title: "Error:  Programacion ya Existe...",
                      text: "un momento por favor.",
                      imageUrl: "../sweet/alert.png",
                      timer: 3000,
                      showConfirmButton: false
                    });
                }
                else 
                {
                  swal({
                      title: "Error: campos requeridos no tiene información...",
                      text: "un momento por favor.",
                      imageUrl: "../sweet/2.gif",
                      timer: 3000,
                      showConfirmButton: false
                    });
                }
            },
            error: function () {
                //alert("No");
                //cancel the submit button default behaviours
                swal({
                  title: "Error:  Valide los campos requeridos...",
                  text: "un momento por favor.",
                  imageUrl: "../sweet/2.gif",
                  timer: 3000,
                  showConfirmButton: false
                });
                return false;                       
            }
        });
          ////***
        }
      });
        
  });

});
</script>

<?php
if (!function_exists("GetSQLValueString")) 
{
  function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
  {
    if (PHP_VERSION < 6) 
    {
      $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
    }

    $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) :mysqli_escape_string($theValue);

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

$d1 ="";
if(isset($_POST['dia1'])){
  $d1 = trim($_POST['dia1']);
}
//echo "ideest....$idEstudiante<br>";

$d2 ="";
if(isset($_POST['dia2'])){
  $d2 = trim($_POST['dia2']);
}

$sede ="";
if(isset($_POST['sede'])){
  $sede = trim($_POST['sede']);
}

$profesor ="";
if(isset($_POST['profesor'])){
  $profesor = trim($_POST['profesor']);
}

$salon ="";
if(isset($_POST['salon'])){
  $salon = trim($_POST['salon']);
}

$fi ="";
if(isset($_POST['fi'])){
  $fi = trim($_POST['fi']);
}

$ff ="";
if(isset($_POST['ff'])){
  $ff = trim($_POST['ff']);
}


mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_mattabla = "SELECT IdMateria, NombreMateria FROM materia WHERE Estado = 1 ORDER BY NombreMateria;";
$rs_tipo_mattabla = mysqli_query($cnn_kn,$query_rs_tipo_mattabla) or die(mysqli_error()."$query_rs_tipo_mattabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_mattabla = mysqli_fetch_assoc($rs_tipo_mattabla);

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_nivtabla = "SELECT IdNivel, NombreNivel FROM nivel WHERE Estado = 1 ORDER BY NombreNivel;";
$rs_tipo_nivtabla = mysqli_query($cnn_kn,$query_rs_tipo_nivtabla) or die(mysqli_error()."$query_rs_tipo_nivtabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_nivtabla = mysqli_fetch_assoc($rs_tipo_nivtabla);


mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_hortabla = "SELECT IdHorario, Inicio, Final FROM horario WHERE Estado = 1 ORDER BY Inicio, Final;";
$rs_tipo_hortabla = mysqli_query($cnn_kn,$query_rs_tipo_hortabla) or die(mysqli_error()."$query_rs_tipo_hortabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_hortabla = mysqli_fetch_assoc($rs_tipo_hortabla);

$vi = intval($d1);
//echo $vi;

$difer = $d2 - $vi;

if ($difer <= 5)
{
  $p1 = "
  <table border='1' width='100%'> 
    <thead>
      <tr>
        <th>Horario</th>";
        if ($difer == 0)
        {
          $p1 .= "<th>Lunes " .$vi++. "</th>";
        }
         
        if ($difer == 1)
        {
          $p1 .= "<th>Lunes " .$vi++. "</th>";
          $p1 .= "<th>Martes " .$vi++. "</th>";
        }  

        if ($difer == 2)
        {
          $p1 .= "<th>Lunes " .$vi++. "</th>";
          $p1 .= "<th>Martes " .$vi++. "</th>";
          $p1 .= "<th>Miércoles " .$vi++. "</th>";
        }

        if ($difer == 3)
        {
          $p1 .= "<th>Lunes " .$vi++. "</th>";
          $p1 .= "<th>Martes " .$vi++. "</th>";
          $p1 .= "<th>Miércoles " .$vi++. "</th>";
          $p1 .= "<th>Jueves " .$vi++. "</th>";
        }

        if ($difer == 4)
        {
          $p1 .= "<th>Lunes " .$vi++. "</th>";
          $p1 .= "<th>Martes " .$vi++. "</th>";
          $p1 .= "<th>Miércoles " .$vi++. "</th>";
          $p1 .= "<th>Jueves " .$vi++. "</th>";
          $p1 .= "<th>Viernes " .$vi++. "</th>";
        }   
        if ($difer == 5)
        {
          $p1 .= "<th>Lunes " .$vi++. "</th>";
          $p1 .= "<th>Martes " .$vi++. "</th>";
          $p1 .= "<th>Miércoles " .$vi++. "</th>";
          $p1 .= "<th>Jueves " .$vi++. "</th>";
          $p1 .= "<th>Viernes " .$vi++. "</th>";
          $p1 .= "<th>Sábado " .$vi++. "</th>";
        }      

    $p1 .= "</tr>
    </thead>
      <tbody>        
      "; 
    
    $cc = intval($d1);
    $cadena = "";
    do{                                                                
        $idTablahor = $row_rs_tipo_hortabla['IdHorario'];
        $Inicio = $row_rs_tipo_hortabla['Inicio']; //echo "ini....$Inicio<br>";
        $Final = $row_rs_tipo_hortabla['Final'];   //echo "fin....$Final<br>";    
        //echo $fi;
        $ddd = intval($d1);
        $nombrenivel = "";
        $nombremateria = "";
        //*
        mysqli_select_db($cnn_kn, $database_cnn_kn);
        //$query_rs_clasever = "SELECT IdClase FROM clases WHERE Sede = $sede AND Salon = $salon AND Materia = AND Nivel = AND Horario = $idTablahor AND Profesor = $profesor AND desde = '$Inicio' AND hasta = '$Final' AND Estado = 1 ;";
        $query_rs_clasever = "SELECT IdClase, Sede, Salon, Materia, Profesor, Nivel, Horario, desde, hasta, dia, nivel.NombreNivel, materia.NombreMateria FROM clases JOIN nivel ON clases.Nivel = nivel.IdNivel AND nivel.Estado = 1 JOIN materia ON clases.Materia = materia.IdMateria AND materia.Estado = 1 WHERE Sede = $sede AND Salon = $salon AND Horario = $idTablahor AND Profesor = $profesor AND desde = '$fi' AND hasta = '$ff' AND clases.Estado = 1 ;";
        $rs_clasever = mysqli_query($cnn_kn,$query_rs_clasever) or die(mysqli_error()."Err1...$query_rs_clasever");
        mysqli_set_charset($cnn_kn,"utf8");
        $row_rs_clasever = mysqli_fetch_assoc($rs_clasever);
        //*
       echo "qry ...$query_rs_clasever<br><br>";


        $idclase = $row_rs_clasever['IdClase'];
        $idsede  = $row_rs_clasever['Sede'];
        $idsalon = $row_rs_clasever['Salon'];
        $idhorario  = $row_rs_clasever['Horario'];
        $idprofesor = $row_rs_clasever['Profesor'];
        $iddesde = $row_rs_clasever['desde'];
        $idhasta = $row_rs_clasever['hasta'];
        $iddia  = $row_rs_clasever['dia'];
        $cadena = "horario*".$idhorario.'_'.$idsede.'_'.$idprofesor.'_'.$idsalon.'_'.$iddesde.'_'.$idhasta.'_';
        $diacadena = substr($iddesde,8,2);
        $diacadenan = 0;
        //$diacadenan = intval($diacadena);
        $diacadenan = (int)$diacadena;

        $nombrenivel = $row_rs_clasever['NombreNivel'];
        $nombremateria = $row_rs_clasever['NombreMateria'];

        $pars = "";
        $p1 .= "<tr><td>&nbsp;$Inicio - $Final </td>";
        for ($c=$cc; $c<=$d2; $c++)
        {      
          $pars = "'$idTablahor','$sede','$profesor','$salon','$fi','$ff','$ddd'";
          $parsx = str_replace(",","_", $pars) ;
          $parsx1 = str_replace("'","", $parsx) ;
          $parsx1 = "horario*".$parsx1;
          //echo "$parsx1 <br>";
          $parsx2 = str_replace("'","", $parsx) ;

          //
          echo "cadenan....$diacadenan<br>";
          //$cadena .= (int)$diacadenan; 
          $cadena = "horario*".$idhorario.'_'.$idsede.'_'.$idprofesor.'_'.$idsalon.'_'.$iddesde.'_'.$idhasta.'_'.(int)$diacadenan.'_'.$iddia;                  
          //v
          echo "iso......$cadena = $parsx1<br>";
          if($cadena == $parsx1)
          {
             $p1 .= "<td style='text-align: center;'><a href='#' id=$parsx1 data-rel=$parsx2 ><span style='font-size:10; color:#FFF; background-color:#D0682F;text-decoration:none;-webkit-border-radius: 5px 10px;-moz-border-radius: 5px 10px;padding:3px;'>$nombrenivel</span><br><span style='font-size:10; color:#FFF; background-color:#529AF3;text-decoration:none;-webkit-border-radius: 5px 10px;-moz-border-radius: 5px 10px;padding:3px;'>$nombremateria</span></a></td>"; 
          }
          else
          {
             $p1 .= "<td style='text-align: center;'><a href='#' id=$parsx1 data-rel=$parsx2 >Sin Asignar</a></td>";    
          }
          
          $ddd ++;
          //$diacadena = intval($diacadena)+1;
          $diacadenan ++;
        }
    $p1 .= "</tr>";    
    } while($row_rs_tipo_hortabla = mysqli_fetch_assoc($rs_tipo_hortabla));
  $p1 .= "  </tbody>
    </table>  ";
    
?>
<div id="popup" style="display: none;">
    <div class="content-popup">
        <div class="close"><a href="#" id="close"><img src="images/close.png"/></a></div>        
        <div>
           <h2>Seleccione Tema y Nivel</h2>           

            <label for="tipo">Nivel</label>
            <select class="form-control" name="nivel" id="nivel">
            <option value="">Seleccione Nivel</option>
                <?php 
                    do{                                                                
                        $idTablaniv = $row_rs_tipo_nivtabla['IdNivel'];                                
                        $NombreNivel = $row_rs_tipo_nivtabla['NombreNivel'];                                
                ?>
                <option value="<?php echo $idTablaniv ;?>"><?php echo $NombreNivel ;?></option>
                <?php 
            } while($row_rs_tipo_nivtabla = mysqli_fetch_assoc($rs_tipo_nivtabla));
                ?>
            </select>

            <label for="tipo">Tema</label>
            <select class="form-control" name="materia" id="materia">
            <option value="">Seleccione Curso</option>
              <?php 
                do{                                                                
                    $idTablamat = $row_rs_tipo_mattabla['IdMateria'];                                
                    $NombreMateria = $row_rs_tipo_mattabla['NombreMateria'];    
              ?>
              <option value="<?php echo $idTablamat ;?>"><?php echo $NombreMateria ;?></option>
              <?php 
                  } while($row_rs_tipo_mattabla = mysqli_fetch_assoc($rs_tipo_mattabla));
              ?>
            </select>
            <br>
            <button type="button" class="btn btn-success" id="grabar2"><i class="fa fa-check"></i> Grabar</button>
        </div>
    </div>
</div>

<div class="popup-overlay"></div>
<?php
        
}
else
{
   $p1 = "** No puede seleccionar mas de una Semana. **"; 
}
echo $p1;
?>

<?php 
mysqli_free_result($rs_tipo_hortabla);
mysqli_free_result($rs_clasever);
mysqli_free_result($rs_tipo_mattabla);
mysqli_free_result($rs_tipo_nivtabla);
?>