<?php
session_start();
$id = $_SESSION['s_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="table-responsive-sm">
        <table class="table table-striped-columns table-hover table-borderless table-primary align-middle">
            <thead class="table-light">
                <caption>
                    Your Exam Result
                </caption>
                <tr>
                    <th>Subject</th>
                    <th>Your score</th>
                    <th>Total score</th>
                    <th>Exam Date</th>
                </tr>
            </thead>

            <?php
    include("../student_db.php");
    $sql = "SELECT * FROM `student_exam_score` WHERE s_id = '$id'";
    $res = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($res);
    if ($num>0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $s_name = $row['s_name'];
            $exam_score = $row['exam_score'];
            $total_score = $row['total_score'];
            $subject = $row['exam_subject'];
            $date = $row['exam_date'];
        }
        echo '<tbody class="table-group-divider">
                <tr class="table-primary">
                    <td>'.$subject.'</td>
                    <td>'.$exam_score.'</td>
                    <td>'.$total_score.'</td>
                    <td>'.$date.'</td>
                </tr>
            </tbody>';
    }else{
        echo 'You have given no tests yet';
    }
    
    
    ?>




        </table>
    </div>
</body>

</html>