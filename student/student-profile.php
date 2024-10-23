<?php
session_start();
if (isset($_SESSION['s_name'])) {
    $id = $_SESSION['s_id'];
    include("student_db.php");
    $sql = "select * from `student_data` where s_id = '$id'";
    $res = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($res);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($res)) {
            $s_name = $row['s_name'];
            $class = $row['class'] . "" . $row['section'];
            $father = $row['father'];
            $mother = $row['mother'];
            $mobile = $row['mobile'];
            $email = $row['email'];
            $age = 18;
            $s_img = $row['s_img'];
        }
        $_SESSION['class'] = $class;
        $_SESSION['img'] = $s_img;
    }
} else {
    header("location: index.php");
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile Card</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS for additional styling -->
    <style>
        body {
            background-color: yellow;
        }

        .student-card {
            max-width: 350px;
            margin: 20px auto;
            border-radius: 15px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            background: tan;
        }

        .student-card:hover {
            transform: scale(1.0);
        }

        .student-img {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="card student-card">
            <img src="<?php echo '../teacher-login/student data/S_Profile_Img/' . $s_img; ?>"
                alt="Student Profile Image" class="card-img-top student-img">

            <div class="card-body">
                <h5 class="card-title"><?php echo $s_name; ?></h5>
                <p class="card-text">Grade: <?php echo $class; ?></p>
                <p class="card-text">Age: <?php echo $age; ?></p>
                <p class="card-text">Email: <?php echo $email; ?></p>
                <p class="card-text">Father: <?php echo $father; ?></p>
                <p class="card-text">Mother: <?php echo $mother; ?></p>
                <p class="card-text">Mobile: <?php echo $mobile; ?></p>
                <a href="home.php" class="btn btn-primary">View Profile</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>