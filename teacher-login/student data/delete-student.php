<?php
include("student_db.php");

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Sanitize the input to prevent SQL injection
    //$id = mysqli_real_escape_string($conn, $id);

    // Prepare the SQL delete statement
    $sql = "DELETE FROM `student_data` WHERE s_id='$id'";
    
    // Execute the query
    if ($res = mysqli_query($conn, $sql)) {
        echo 1; // Deletion successful
    } else {
        echo 0; // Deletion failed
    }
} else {
    echo 2; // No ID provided
}
?>