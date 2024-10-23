<?php
session_start();
$id = $_SESSION['s_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Homework</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container py-5">
        <h1 class="text-center mb-5">View Your Solved Doubts</h1>
        <hr>

        <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="subject" class="form-label">Select Subject:</label>
                <select class="form-select form-select-lg" name="subject" id="subject" required>
                    <option value="" disabled selected>Select Subject</option>
                    <option value="Physics">Physics</option>
                    <option value="Chemistry">Chemistry</option>
                    <option value="Maths">Maths</option>
                    <option value="Hindi">Hindi</option>
                    <option value="English">English</option>
                </select>
            </div>
            <div class="mb-3">
                <lable for="date">Select Date:</lable>
                <input type="date" name="search_date" id="search_date">
            </div>
            <div class="d-grid gap-2">
                <button type="submit" name="btn" class="btn btn-success btn-lg">Submit</button>
            </div>
        </form>
        <br>
        <hr>
        <?php
        if (isset($_POST['btn'])) {
            include("../student_db.php");
            $subject = $_POST['subject'];
            $date = $_POST['search_date'];
            // Basic SQL query without injection prevention
            $sql = "SELECT * FROM `problems` WHERE s_id = '$id' AND subject = '$subject'";
            // echo $sql;
            $res = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($res);

            if ($num > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    echo '<div class="d-flex justify-content-center align-items-center" style="height: 100vh;"><div class="card mb-4">
                            <div class="card-body"><span>' . $row['date'] . '
                                <img src="hw/' . $row['img'] . '" class="img-fluid" alt="Homework">
                            </div>
                          </div></div>';
                }
            } else {
                echo '<div class="alert alert-warning text-center">No homework found for the selected subject.</div>';
            }
        }
        ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>