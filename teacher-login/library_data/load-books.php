<?php
include("exam_db.php");
$book = $_POST['book'];
$sql = "SELECT * FROM `library_book_data` WHERE  `book_id` LIKE '%{$book}%'";

$result = mysqli_query($conn_exam, $sql);
$num = mysqli_num_rows($result);
if ($num != 0) {
    $output = "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        $book_id = $row['book_id'];
        $output .= "<li>'.$book_id.'</li>";
    }
    $output = "</ul>";
} else {
    $output = "<ul><li>Book Not Found</li></ul>";
}
//

echo $output;

?>