<?php
include("exam_db.php");
print_r($_POST);
$bookType = $_POST['bookType'];
$bookName = $_POST['bookName'];
$bookCode = $_POST['bookCode'];
$sql = "INSERT INTO library_book_data (book_type, book_name, book_code) VALUES ('$bookType', '$bookName','$bookCode')";
$result = mysqli_query($conn_exam, $sql);
if ($result) {
    echo 1;
} else {
    echo 0;
}



?>