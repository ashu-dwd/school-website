<?php
session_start();
if (isset($_POST['submit'])) {
    $mobile = $_POST['mobile'];
    $sPass = $_POST['password'];
    $sql = "select * from `student_data` where mobile = '$mobile' and s_pass = '$sPass'";
    require "student_db.php";
    $res = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($res);

    if ($num==1) {
        while($row=mysqli_fetch_assoc($res)){
            $id = $row['s_id'];
            $sName = $row['s_name'];
        }
        $_SESSION['s_name'] = $sName;
        $_SESSION['s_pass'] = $sPass;
        $_SESSION['s_id'] = $id;
        header("location: student-profile.php");
    } else {
       $msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Please Check Your Login Password...
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    echo $msg;
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
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
        background-image: url("https://images.unsplash.com/photo-1472289065668-ce650ac443d2?q=80&w=869&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D");
    }

    .login-container {
        max-width: 400px;
        width: 100%;
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
        <h2>Student Login</h2>
        <!-- Login Form -->
        <form method="post" action="">
            <div class="mb-3">
                <input type="text" class="form-control" id="name" name="mobile" placeholder="Enter Your Mobile Number">

            </div>

            <div class="mb-3">
                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>