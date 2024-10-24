<?php
session_start();
include("exam_db.php");

$exam_id = $_SESSION['exam_id'] . "-" . $_SESSION['class'] . "-" . $_SESSION['subject'] . "-" . $_SESSION['t_id'];

if (isset($_POST['duration'])) {  // Ensure 'duration' is set in POST request
    $duration = $_POST['duration'] . ":00";

    // Update exam duration and status
    $sql = "UPDATE scheduled_exams SET `exam_duration` = '$duration', `exam_status` = '1' WHERE exam_id = '$exam_id'";
    echo $sql;
    $result = mysqli_query($conn_exam, $sql);

    if ($result) {
        $teacher_id = $_SESSION['t_id'];  // Save t_id before session destroy

        // Clear session and destroy it
        session_unset();
        session_destroy();

        // Redirect with success message
        header("Location: ../HOME_NEW.php?t_id=$teacher_id&msg=success");
        exit(); // Ensures no further code is executed after the redirect
    } else {
        // Handle failed query, possibly redirect with an error message
        header("Location: ../HOME_NEW.php?msg=error");
        exit();
    }
}
?>