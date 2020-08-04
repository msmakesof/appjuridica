<?php
require_once ('../../Connections/DataConex.php'); 
require_once('../../Connections/config2.php'); 
?>
<table  class="table table-striped" id="tabtermino">
    <tr scope="col">
        <th>Dias</th>
        <th>Recordatorio</th>
        <th>Periodicidad</th>
        <th>Repetición</th>
        <th>Dias Repite</th>
        <th>Borrar</th>
    </tr>
    
    <?php
        if(isset($parIdTabla))
        {
            
            $parIdTabla = $parIdTabla; 
        }
        else
        {
            $parIdTabla = $_GET['parIdTabla'];
        }
        
        $idTabla = $parIdTabla ; 
        require_once('../../apis/proceso/terminos.php');
        for($i=0; $i<count($mterminos['pro_terminos']); $i++)                                                        
        {
            $vrNotifica="No";
            $vrRepite="No";
            $IdTermino = $mterminos['pro_terminos'][$i]['TER_IdTermino'];
            $DiasHabiles = $mterminos['pro_terminos'][$i]['TER_DiasHabiles'];
            $Notifica = $mterminos['pro_terminos'][$i]['TER_Notifica'];
            $IdPeriodo = $mterminos['pro_terminos'][$i]['TER_IdPeriodo'];
            $Repite = $mterminos['pro_terminos'][$i]['TER_Repite'];
            $DiasRep = $mterminos['pro_terminos'][$i]['TER_DiasRep'];
            $NombrePeriodo = $mterminos['pro_terminos'][$i]['NombrePeriodo'];
            $IdTipoActProcesal = $mterminos['pro_terminos'][$i]['TER_IdTipoActProcesal'];
            if($Notifica == 1){$vrNotifica = "Si";}
            if($Repite == 1){$vrRepite = "Si";}
    ?>
        <tr id="fila<?php echo $IdTermino; ?>">
            <td><?php echo $DiasHabiles ;?></td>
            <td><?php echo $vrNotifica ;?></td>
            <td><?php echo $NombrePeriodo ;?></td>
            <td><?php echo $vrRepite ;?></td>
            <td><?php echo $DiasRep ;?></td>
            <td><a href='#' onClick='del("<?php echo $IdTermino; ?>")'><img src='../../images/borrar.png' id="<?php echo $IdTermino; ?>"></a></td>
        </tr>
    <?php 
        }
    ?>    
</table>