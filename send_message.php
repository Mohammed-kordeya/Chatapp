
<?php
include ('db.php');

if(isset($_POST['name']) && isset($_POST['msg'])) {
    $n = mysqli_real_escape_string($con, $_POST['name']);
    $m = mysqli_real_escape_string($con, $_POST['msg']);
    $imagePath = "";

    if(isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); 
        }

        $imageName = time() . "_" . basename($_FILES["image"]["name"]); 
        $imagePath = $targetDir . $imageName;
        $imageFileType = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if(in_array($imageFileType, $allowedTypes)) {
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
            } else {
                error_log("فشل في رفع الصورة.");
                $imagePath = ""; 
            }
        } else {
            error_log("نوع الملف غير مدعوم: $imageFileType");
            $imagePath = ""; 
        }
    }

    $insert = "INSERT INTO chat (name, msg, image) VALUES ('$n', '$m', '$imagePath')";
    if(mysqli_query($con, $insert)) {
        echo "تم الإرسال بنجاح";
    } else {
        error_log("خطأ في إدخال البيانات: " . mysqli_error($con));
    }
}

?>
