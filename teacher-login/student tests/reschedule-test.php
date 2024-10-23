<?php
session_start();
include("exam_db.php");

// Check if required POST variables and SESSION variables are set
if (isset($_POST['exam_id'], $_POST['class'], $_POST['section']) && isset($_SESSION['t_id'])) {

    // Get exam details from POST
    $exam_id = $_POST['exam_id'];
    $class = $_POST['class'] . $_POST['section'];
    $teacher = $_SESSION['t_id'];

    // Fetch the exam data from the scheduled_exams table
    $sql = "SELECT * FROM `scheduled_exams` WHERE `exam_id` = '$exam_id'";
    $result = mysqli_query($conn_exam, $sql);

    if (mysqli_num_rows($result) > 0) {
        $arr = [];
        $subject_arr = [];

        // Fetch all rows from the query
        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row['q_id'];
            $subject_arr[] = $row['subject'];
        }

        // Generate a new exam ID
        $exam_id_new = rand(10000, 99999) . "-" . $class . "-" . $subject_arr[0] . "-" . $_SESSION['t_id'];

        // Prepare the values for batch insert
        $values = [];
        for ($i = 0; $i < count($arr); $i++) {
            $values[] = "('$exam_id_new', '$arr[$i]', '$subject_arr[0]', '$teacher', '$class', current_timestamp(), '1')";
        }

        // Convert array to a comma-separated string for the SQL query
        $values_string = implode(", ", $values);

        // Insert the new exam entries in one query
        $insert_sql = "INSERT INTO `scheduled_exams` (`exam_id`, `q_id`, `subject`, `scheduled_by`, `class`, `date`, `exam_status`) 
        VALUES $values_string";
        $insert_result = mysqli_query($conn_exam, $insert_sql);

        if ($insert_result) {
            echo 1; // Successfully inserted
        } else {
            echo 0; // Insert query failed
        }

    } else {
        echo "No exam found with the provided exam ID.";
    }

} else {
    echo "Required data not provided.";
}
?>