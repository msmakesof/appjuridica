<?php
//include('connect.php');
include("../Connections/DataConex.php");
if (isset($_POST['view'])) {
    
    if ($_POST["view"] != '') {
        $update_query = "UPDATE comments SET comment_status = 1 WHERE comment_status=0";
        mysqli_query($con, $update_query);
    }
    
    $query  = "SELECT * FROM comments ORDER BY comment_id DESC LIMIT 5";
    $result = mysqli_query($con, $query);
    $output = '';
    
    if (mysqli_num_rows($result) > 0) {
        
        while ($row = mysqli_fetch_array($result)) {
            
            $output .= '' . $row["comment_text"] .'';
        }
    }    
    else { //No hay notificaciones
        $output .= '';  
    }
    
    $status_query = "SELECT * FROM comments WHERE comment_status=0";
    $result_query = mysqli_query($con, $status_query);
    $count        = mysqli_num_rows($result_query);
    
    $data = array(
        'notification' => $output,
        'unseen_notification' => $count
    );
    
    echo json_encode($data);
}
?>