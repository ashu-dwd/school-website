<?php
include("exam_db.php");
//print_r($_POST);
$bookType = $_POST['bookType'];
$bookName = $_POST['bookName'];
$bookCode = $_POST['bookCode'];

$fetch_sql = "select * from `library_book_data` where book_code = '$bookCode'";
$fetch_query = mysqli_query($conn_exam, $fetch_sql);
if (mysqli_num_rows(($fetch_query)) > 1) {
    echo 2;
} else {
    $sql = "INSERT INTO library_book_data (book_type, book_name, book_code) VALUES ('$bookType', '$bookName','$bookCode')";
    $result = mysqli_query($conn_exam, $sql);
    if ($result) {
        echo 1;
    } else {
        echo 0;
    }
}





?>