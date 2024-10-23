<?php
include("exam_db.php");
$exam_id = $_POST['exam_id'];
$sql = "UPDATE `scheduled_exams`SET exam_status = '0' WHERE exam_id = '$exam_id'";
$result = mysqli_query($conn_exam, $sql);
if ($result) {
    echo 1;
} else {
    echo 0;
}
?>