<?php
include ('db.php');

if(isset($_POST['name']) && isset($_POST['msg'])) {
    $n = $_POST['name'];
    $m = $_POST['msg'];
    $insert = "INSERT INTO chat (name, msg) VALUES ('$n', '$m')";
    mysqli_query($con, $insert);
}
?>
