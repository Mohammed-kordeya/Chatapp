
<?php
include ('db.php');

$query = "SELECT * FROM chat ORDER BY id DESC";
$run = mysqli_query($con, $query);

while ($row = mysqli_fetch_array($run)) {
    $name = $row['name'];
    $msg = $row['msg'];
    $data = $row['data'];
    $image = isset($row['image']) ? $row['image'] : ''; 

    echo "<div id='chatdata'>
            <span>$name</span>:
            <span>$msg</span>
            <span style='float:right; font-size:12px; color:gray;'>$data</span>";
    
    if (!empty($image)) {
        echo "<br><img src='$image' alt='User Image' style='max-width: 150px; max-height: 150px;'>";
    }

    echo "</div>";
}
