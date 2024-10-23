<?php
$conn_exam = mysqli_connect("localhost", "root", "", "students");
if (!$conn_exam) {
    echo "exam db connect error";
}
?>