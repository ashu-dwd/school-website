<?php
$q_id = $_POST['id'];
$subject = $_POST['subject'];
$class = $_POST['s_class'];
$teacher = $_POST['teacher'];
$exam_id = $_POST['exam_id'];
$correct_ans = $_POST['corr_ans'];
//print_r($_POST);
include('exam_db.php');
$sql = "INSERT INTO `scheduled_exams` (`exam_id`,`q_id`,`correct_ans`,`exam_duration`, `subject`, `scheduled_by`, `class`, `date`, `exam_status`) VALUES ('$exam_id','$q_id','$correct_ans','0', '$subject', '$teacher', '$class', current_timestamp(), '0')";
$result = mysqli_query($conn_exam, $sql);
if ($result) {
    echo 1;
} else {
    echo 0;
}

?>