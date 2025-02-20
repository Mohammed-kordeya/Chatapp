<?php
include ('db.php');

$query = "SELECT * FROM chat ORDER BY id DESC";
$run = mysqli_query($con, $query);

while ($row = mysqli_fetch_array($run)) {
    $name = $row['name'];
    $msg = $row['msg'];
    $data = $row['data'];
    echo "<div id='chatdata'>
            <span>$name</span>
            <span>:</span>
            <span>$msg</span>
            <span style='float:right; font-size:12px; color:gray;'>$data</span>
          </div>";
}
?>
