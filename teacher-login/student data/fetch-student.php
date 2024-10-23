<?php
include("student_db.php");
$id = $_POST['id'];
$sql = "select * from `student_data` where s_id = '$id'";
   $res = mysqli_query($conn, $sql);
   if (mysqli_num_rows($res)>0 ) {
    
    while ($row = mysqli_fetch_assoc($res)) {
        $student = [
            's_id' => $row['s_id'],
            's_name' => $row['s_name'],
            's_pass' => $row['s_pass'],
            's_img' => $row['s_img'],
            'class' => $row['class'],
            'section' => $row['section'],
            'father' => $row['father'],
            'mother' => $row['mother'],
            'mobile' => $row['mobile'],
            'email' => $row['email'],
            'date' => $row['dateofRagister'],
        ];
    
    }
    echo json_encode($student);
}else{

}

?>