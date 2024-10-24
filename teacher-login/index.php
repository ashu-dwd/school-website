<?php
session_start();
if(isset($_POST['btn'])){
       include("teacher_db.php");
       $id = $_POST['teacherName'];
       $pass = $_POST['password'];
       $sql = "select * from `teacher_data` where t_id = '$id' and t_pass ='$pass'";
       $res = mysqli_query($teacher_conn,$sql);
       $num = mysqli_num_rows($res);
       if ($num==0) {
        $_SESSION['t_id'] = $id;
        $_SESSION['t_name'] = $name;
        header("location: HOME_NEW.php");
       } else {
        echo '<div class="alert alert-danger alert-dismissible">Please Check Your Credentials</div>';
       }
       
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS for additional styling -->
    <style>
    body {
        background-color: #f4f4f9;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-image: url("https://images.unsplash.com/photo-1475669698648-2f144fcaaeb1?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D");
    }

    .login-container {
        max-width: 400px;
        width: 100%;
        /* padding: 2rem;
        background-color: #fff; */
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        /* border-radius: 10px; */
        border-radius: 0.75rem;
        background-color: rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(5px);
        padding: 20px;
    }

    .login-container .admin-icon {
        width: 80px;
        height: 80px;
        background-color: #007bff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        color: #fff;
    }

    .login-container h2 {
        text-align: center;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
        color: #333;
    }

    .login-container .form-control {
        border-radius: 20px;
    }

    .login-container .btn {
        width: 100%;
        padding: 0.75rem;
        border-radius: 20px;
        background-color: #007bff;
        color: white;
    }
    </style>
</head>

<body>

    <div class="login-container">
        <!-- Admin Icon -->
        <div class="admin-icon">
            <i class="bi bi-person-circle"><img src="https://img.icons8.com/?size=100&id=110479&format=png&color=000000"
                    alt=""></i> <!-- Admin icon -->
        </div>
        <!-- Title -->
        <h2>Teacher Login</h2>
        <!-- Login Form -->
        <form method="post" action="">
            <div class="mb-3">
                <label for="teacherName" class="form-label">Select Your Name</label>
                <select name="teacherName" id="teacherName" class="form-select">
                    <option value="" disabled selected>Select Your Name</option>
                    <?php
                       include("teacher_db.php");
                       $sql_check = "select * from `teacher_data`";
                       $res_check = mysqli_query($teacher_conn,$sql_check);
                       $num_check = mysqli_num_rows($res_check);
                       if ($num_check>0) {
                        while ($row=mysqli_fetch_assoc($res_check)) {
                            $name= $row['t_name'];
                            echo '<option value="'.$row['t_id'].'">'.$row['t_id'].'. '.$row['t_name'].'</option>';
                        }
                       } else {
                        echo '<option value="#">No Teachers Found</option>';
                       }
                       
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <input type="password" class="form-control" id="password" placeholder="Password">
            </div>

            <button type="submit" name="btn" class="btn btn-success pb-2 mt-3">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>