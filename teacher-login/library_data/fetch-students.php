<?php
$s_class = $_POST['s_class'];
$section = $_POST['section'];

include("exam_db.php");
$sql = "SELECT * FROM student_data where class = '$s_class' and section  = '$section'";
$result = mysqli_query($conn_exam, $sql);
$options = '<option selected>Select one</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $options .= '<option value="' . $row['s_name'] . '">' . $row['s_name'] . '</option>';
}

echo $options;
?>