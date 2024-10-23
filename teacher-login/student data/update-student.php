<?php
include("student_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $id = $_POST['student_id'];
    $s_name = $_POST['s_name'];
    $class = $_POST['class'];
    $section = $_POST['section'];
    $father = $_POST['father'];
    $mother = $_POST['mother'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $s_pass = $_POST['s_pass'];

    // Update student details
    $sql = "UPDATE `student_data` SET s_name = '$s_name', class = '$class', section = '$section', 
            father = '$father', mother = '$mother', mobile = '$mobile', email = '$email', 
            dob = '$dob', s_pass = '$s_pass' WHERE s_id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Student details updated successfully!";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>