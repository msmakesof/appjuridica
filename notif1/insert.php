<?php
$ipAddress = $_SERVER['REMOTE_ADDR'];
if (isset($_POST["subject"])) {
    //include("connect.php");
    include("../Connections/DataConex.php");
    $subject = mysqli_real_escape_string($con, $_POST["subject"]);
    $comment = mysqli_real_escape_string($con, $_POST["comment"]);
    $query   = "
 INSERT INTO comments(comment_subject, comment_text, comment_ip)
 VALUES ('$subject', '$comment', '$ipAddress')";
    mysqli_query($con, $query);
}
?>