<?php
session_start();
if (!isset($_SESSION['s_name'])) {
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }

        .alert {
            animation: fadeIn 1s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .block {
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            color: white;
            font-weight: bold;
            position: relative;
        }

        .block img {
            max-width: 70%;
            max-height: 70%;
            margin-bottom: 10px;
        }

        .text {
            font-size: 1.2rem;
        }

        .header {
            background-color: orange;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .header img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <div class="header">
        <img src="<?php echo '../teacher-login/student data/S_Profile_Img/' . htmlspecialchars($_SESSION['img']); ?>"
            alt="Student Profile Image">
        <h2>Student Name: <?php echo $_SESSION['s_name']; ?></h2>
        <p>Class: <?php echo $_SESSION['class']; ?> </p>
        <a name="" id="" class="btn btn-danger" href="logout.php" role="button">Logout</a>

    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4 mb-4">
                <a href="exam/" class="card block" style="background-color: #007bff;">
                    <img src="https://cdn-icons-png.freepik.com/512/9686/9686388.png?ga=GA1.1.2089459258.1727335392"
                        alt="Start Exam">
                    <div class="text">Start Exam</div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="result/" class="card block" style="background-color: #28a745;">
                    <img src="https://cdn-icons-png.freepik.com/512/7074/7074922.png?ga=GA1.1.2089459258.1727335392"
                        alt="View Result">
                    <div class="text">View Result</div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="homework/" class="card block" style="background-color: #dc3545;">
                    <img src="https://cdn-icons-png.freepik.com/512/10975/10975828.png?ga=GA1.1.2089459258.1727335392"
                        alt="Upload Homework">
                    <div class="text">Upload Homework</div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="homework/" class="card block" style="background-color: #ffc107;">
                    <img src="https://cdn-icons-png.freepik.com/512/10316/10316565.png?ga=GA1.1.2089459258.1727335392"
                        alt="See Homework">
                    <div class="text">See Homework</div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="doubts/upload_doubts.php" class="card block" style="background-color: #17a2b8;">
                    <img src="https://cdn-icons-png.freepik.com/512/445/445601.png?ga=GA1.1.2089459258.1727335392"
                        alt="Upload Doubts">
                    <div class="text">Upload Doubts</div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="doubts/see_solution_of_doubts.php" class="card block" style="background-color: #6610f2;">
                    <img src="https://cdn-icons-png.freepik.com/512/15836/15836872.png?ga=GA1.1.2089459258.1727335392"
                        alt="See Solution of Doubts">
                    <div class="text">See Solution of Doubts</div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="homework/todays_homework.php" class="card block" style="background-color: #e83e8c;">
                    <img src="https://cdn-icons-png.freepik.com/512/12966/12966081.png?ga=GA1.1.2089459258.1727335392"
                        alt="Today's Homework">
                    <div class="text">Today's Homework</div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="feedback/feedback_of_teacher.php" class="card block" style="background-color: #fd7e14;">
                    <img src="https://cdn-icons-png.freepik.com/512/2065/2065161.png?ga=GA1.1.2089459258.1727335392"
                        alt="Feedback of Teacher">
                    <div class="text">Feedback of Teacher</div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="result/see_your_wrong_questions.php" class="card block" style="background-color: #20c997;">
                    <img src="https://cdn-icons-png.freepik.com/512/17791/17791874.png?ga=GA1.1.2089459258.1727335392"
                        alt="See Your Wrong Questions">
                    <div class="text">See Your Wrong Questions</div>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>