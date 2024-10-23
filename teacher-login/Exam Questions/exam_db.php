<?php
$conn_exam = mysqli_connect("localhost","root","","exam_system");
if(!$conn_exam){
    echo "exam db connect error";
}
?>