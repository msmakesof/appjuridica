<?php require_once('../Connections/cnn_kn.php'); 
include 'config.php';
$ParID = 0;
$idclase_arr = "";
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
//var ParID ="";
$(document).ready(function() {    
  var hacer =""; 
  $("a[id^='horario*']").bind("click", function() {
      var myid = $(this).attr("data-rel");
      //alert("horario..."+myid);
      var ParID = $(this).attr("data-materia")+'-'+$(this).attr("data-nivel");
      //alert(ParID);
      //var ParID = myid ;     
      

      //$('#open').click(function(){
        //$("#lbl").attr("value","lbl"+ParID);
        if( ParID != "")
        {
          $('#popup').fadeIn('slow');
          $('.popup-overlay').fadeIn('slow');
          $('.popup-overlay').height($(window).height());
        }  
        //return false;
      //});
      

      $('#close').click(function(){
          $('#popup').fadeOut('slow');
          $('.popup-overlay').fadeOut('slow');          
          return false;
      });

      $("#nivel").on("change", function(){
        var x = $("#nivel").val();         
        $.ajax({
            //this is the php file that processes the data 
            url: "vertemaxnivel.php",
            //GET method is used
            type: "POST",
            data: "pars="+x, 
            beforeSend: function() {
              $("#selmateria").html("cargando...");
            },
            success: function (lista) {
                $("#materia").html(lista);
            },
            error: function () {            
                swal({
                  title: "Error:  No se pudo establecer comunicación...",
                  text: "un momento por favor.",
                  imageUrl: "../sweet/2.gif",
                  timer: 2000,
                  showConfirmButton: false
                });
                return false;                       
            }  
        });
      });  
      


      $("#grabar2").on("click", function(){
        var curso = $('#materia').val();
        var nivel = $('#nivel').val();
        myid = myid+'_'+curso+'_'+nivel;
        //alert("grabar2...."+myid);
        if( curso == "" && nivel == "")
        {
          swal({
            title: "Error:  Al validar los campos requeridos Nivel y Tema...",
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
                if (xdata.trim() == 'S') 
                {                    
                    $('.done').fadeIn('slow');                    
                    swal({
                      title: "Atención:  Registro grabado correctamente.",
                      text: "un momento por favor.",
                      imageUrl: "../sweet/ok.png",
                      timer: 3000,
                      showConfirmButton: false
                    });                    
                    $("#formx1")[0].reset();
                    $("#oc").trigger("click");                   

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
                  $("#formx1")[0].reset();
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
                  $("#formx1")[0].reset();
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

// $fechadia = $fi;
//     $fdY = substr($fechadia,0,4);
//     $fdm = substr($fechadia,5,2);
//     $fdd = $dia;
//     $unefec = $fdY.'-'.$fdm.'-'.$fdd;
//     $fecdia = date('Y-m-d', strtotime($unefec));
// $numerodia = date("w",mktime(0,0,0,$fdm,$fdd,$fdY));
// ///echo "dia...$numerodia";
// AND Horario = $idTablahor AND dia = $numerodia

mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_xclasever = "SELECT IdClase, Sede, Salon, Materia, Profesor, Nivel, Horario, desde, hasta, dia, nivel.NombreNivel, materia.NombreMateria FROM clases JOIN nivel ON clases.Nivel = nivel.IdNivel AND nivel.Estado = 1 JOIN materia ON clases.Materia = materia.IdMateria AND materia.Estado = 1 WHERE Sede = $sede AND Salon = $salon  AND Profesor = $profesor AND desde = '$fi' AND hasta = '$ff' AND clases.Estado = 1  ;";            
$rs_xclasever = mysqli_query($cnn_kn,$query_rs_xclasever) or die(mysqli_error()."Err1...$query_rs_clasever");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_xclasever = mysqli_fetch_assoc($rs_xclasever);
$totalRows_rs_xclasever = mysqli_num_rows($rs_xclasever);


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
  $p1 = "<div id='tablahora'>
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
    $diaEvento = "";
    //echo $d2;
    do{                                                                
        $idTablahor = $row_rs_tipo_hortabla['IdHorario'];
        $Inicio = $row_rs_tipo_hortabla['Inicio']; //echo "ini....$Inicio<br>";
        $Final = $row_rs_tipo_hortabla['Final'];   //echo "fin....$Final<br>";    
        //echo $fi;
        $ddd = intval($d1);
        $nombrenivel = "";
        $nombremateria = "";
        $numerodia = 1;
        $pars = "";
        $p1 .= "<tr><td>&nbsp;$Inicio - $Final </td>";        
        $diacadenan = 1;
        //$diaEvento = $Inicio;
        $diaEvento = strtotime ( '+0 day' , strtotime ( $fi ) ) ;
        $diaEvento = date ( 'Y-m-j' , $diaEvento );
        for ($c=$cc; $c<=$d2; $c++) 
        { // Ini for     
            
            $pars = "'$idTablahor','$sede','$profesor','$salon','$fi','$ff','$numerodia','$diaEvento'";
            $parsx = str_replace(",","_", $pars) ;
            $parsx1 = str_replace("'","", $parsx) ;
            //$parsx1 = "horario*".$parsx1.'_'.$diaEvento;
            $parsx1 = "horario*".$parsx1;           
            $parsx2 = str_replace("'","", $parsx) ;            
            //**echo "<br><br>parsx2 ....$parsx2 <br>";
            //*
            mysqli_select_db($cnn_kn, $database_cnn_kn);
            $query_rs_clasever = "SELECT IdClase, Sede, Salon, Materia, Profesor, Nivel, Horario, desde, hasta, dia, IdEvento, nivel.NombreNivel, materia.NombreMateria FROM clases JOIN nivel ON clases.Nivel = nivel.IdNivel AND nivel.Estado = 1 JOIN materia ON clases.Materia = materia.IdMateria AND materia.Estado = 1 WHERE Sede = $sede AND Salon = $salon AND Horario = $idTablahor AND Profesor = $profesor AND desde = '$fi' AND hasta = '$ff' AND clases.Estado = 1  AND dia = $numerodia ;";            
            $rs_clasever = mysqli_query($cnn_kn,$query_rs_clasever) or die(mysqli_error()."Err1...$query_rs_clasever");
            mysqli_set_charset($cnn_kn,"utf8");
            $row_rs_clasever = mysqli_fetch_assoc($rs_clasever);
            $totalRows_rs_clasever = mysqli_num_rows($rs_clasever);       
            //echo "qry $numerodia...$query_rs_clasever<br><br>";  
            $idclase = 0;          
            if($totalRows_rs_clasever > 0)
            {               
              do{
                  $idclase = $row_rs_clasever['IdClase'];
                  $idsede  = $row_rs_clasever['Sede'];
                  $idsalon = $row_rs_clasever['Salon'];
                  $idhorario  = $row_rs_clasever['Horario'];
                  $idprofesor = $row_rs_clasever['Profesor'];
                  $iddesde = $row_rs_clasever['desde'];
                  $idhasta = $row_rs_clasever['hasta'];
                  $iddia  = $row_rs_clasever['dia'];
                  $idEvento  = $row_rs_clasever['IdEvento'];
                  $cadena = "horario*".$idhorario.'_'.$idsede.'_'.$idprofesor.'_'.$idsalon.'_'.$iddesde.'_'.$idhasta.'_'.$iddia.'_'.$diaEvento;
                  $diacadena = substr($iddesde,8,2);
                  $nombrenivel = $row_rs_clasever['NombreNivel'];
                  $nombremateria = $row_rs_clasever['NombreMateria'];
                  $idmateria_arr = $row_rs_clasever['Materia'];
                  $idnivel_arr  = $row_rs_clasever['Nivel'];
                   

                  if( $cadena == $parsx1 && $diacadenan == $iddia )
                  {           
                    //**echo "iso.... $diacadenan .... $iddia<br>"; 
                    if($idclase > 0)
                    {
                       $parsx2 = $idclase;  // "$idmateria_arr-$idnivel_arr"; //;
                       $idclase_arr = $parsx2;
                    }
                    //$p1 .= "<td style='text-align: center;'><a href='#' id=$parsx1 data-rel=$parsx2 data-materia=$idmateria_arr data-nivel=$idnivel_arr ><span style='font-size:10; color:#FFF; background-color:#D0682F;text-decoration:none;-webkit-border-radius: 5px 10px;-moz-border-radius: 5px 10px;padding:3px;'>$nombrenivel</span><br><span style='font-size:10; color:#FFF; background-color:#529AF3;text-decoration:none;-webkit-border-radius: 5px 10px;-moz-border-radius: 5px 10px;padding:3px;'>$nombremateria</span></a></td>";
                    $p1 .= "<td style='text-align: center;font-size:10;'><span style='font-size:10; color:#FFF; background-color:#D0682F;text-decoration:none;-webkit-border-radius: 5px 10px;-moz-border-radius: 5px 10px;padding:3px;'>$nombrenivel</span><br><span style='font-size:10; color:#FFF; background-color:#529AF3;text-decoration:none;-webkit-border-radius: 5px 10px;-moz-border-radius: 5px 10px;padding:3px;'>$nombremateria</span></td>"; 
                    }
                    else
                    {
                       $p1 .= "<td style='text-align: center;'><a href='#' id=$parsx1 data-rel=$parsx2 >Sin Asignar</a></td>";    
                       //**echo "NO iso......$cadena = $parsx1<br>";
                    }  

                }  while($row_rs_clasever = mysqli_fetch_assoc($rs_clasever)); 
              
              } // fin si totrows
              else
              {
                $p1 .= "<td style='text-align: center;'><a href='#' id=$parsx1 data-rel=$parsx2 >Sin Asignar $c</a></td>";    
              }

              $numerodia ++;
              $diacadenan ++;
              $diaEvento = strtotime ( '+1 day' , strtotime ( $diaEvento ) ) ;
              $diaEvento = date ( 'Y-m-j' , $diaEvento );

        } // fin for
        mysqli_free_result($rs_clasever);
    $p1 .= "</tr>";    
     
    } while($row_rs_tipo_hortabla = mysqli_fetch_assoc($rs_tipo_hortabla));
  $p1 .= "  </tbody>
    </table> </div>";
    
?>
<div id="popup" style="display: none;">
  <form id="formx1" name ="formx1" method="post">    
  <div id="lbl" name="lbl"></div>
    <div class="content-popup">
        <div class="close"><a href="#" id="close"><img src="images/close.png"/></a></div>  

        <div>
           <h2>Seleccione Nivel y Tema</h2>           
            <?php  
                //echo "$idclase_arr<br>";
                //if($idclase_arr != "")
                //{
                    //$idclase_arr = "<script> alert('x...'+document.getElementById('lbl').value); </script>";
                    
                //}  
                //echo "x";
                //$doc = new DOMDocument(); 
                //$html = '<div id="lbl" name ="lbl"></div>'; //$idclase_dom->getElementById('lbl');
                //$doc->loadHTML($html);
                //echo $doc->saveHTML();
                //echo $doc;
                //$list = $doc->getElementsByTagName('lbl'); //->item(0); 
                //$list = $doc->saveHTML(); //->item(0); 
                //echo "list...$list<br>pr...";
                //print_r($list);
                //echo $list;
                //foreach ($doc->saveHTML() as $attr) { 
                //    echo 'Key: '.$attr->name.' && value='.$attr->nodeValue.'<br>';
                //} 


                //echo "idclase_arr en modal......".print_r($idclase_arr)."<br>";                                   

                  /*
                // busco el IdClase
                mysqli_select_db($cnn_kn, $database_cnn_kn);
$query_rs_tipo_hortabla = "SELECT IdHorario, Inicio, Final FROM horario WHERE Estado = 1 ORDER BY Inicio, Final;";
$rs_tipo_hortabla = mysqli_query($cnn_kn,$query_rs_tipo_hortabla) or die(mysqli_error()."$query_rs_tipo_hortabla");
mysqli_set_charset($cnn_kn,"utf8");
$row_rs_tipo_hortabla = mysqli_fetch_assoc($rs_tipo_hortabla);
*/

            ?>
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

            <label for="tipo">Topic</label>            
              <select class="form-control" name="materia" id="materia">
              </select>            
            <br>
            <button type="button" class="btn btn-success" id="grabar2"><i class="fa fa-check"></i> Grabar</button>
        </div>
    </div>
    </form>
</div>

<div class="popup-overlay"></div>
<?php
        
}
else
{
   $p1 = "** No puede seleccionar m&aacute;s de una Semana. **"; 
}
echo $p1;
?>

<?php 
mysqli_free_result($rs_tipo_hortabla);
mysqli_free_result($rs_xclasever);
mysqli_free_result($rs_tipo_mattabla);
mysqli_free_result($rs_tipo_nivtabla);
?>