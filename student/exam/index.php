<?php
session_start();
$class = $_SESSION['class'];
if (!isset($_SESSION['s_name'])) {
    header("location: ../index.php");
}
if (isset($_SESSION['test_completed']) && $_SESSION['test_completed'] === true) {
    // Redirect to another page, like a "test already taken" or home page
    header("Location: already_taken.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Exam System</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            padding-top: 80px;
        }

        .questions-container {
            /* max-height: 100vh;
        overflow-y: auto; */
            padding: 15px;
            max-height: calc(100vh - 100px);
        }

        .question {
            background-color: white;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(3, 4, 5, 2);
            background: #cccc00;
        }

        .submit-btn {
            margin-top: 50px;
            text-align: left;

        }

        .exam-header {
            background-color: black;
            color: white;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 80px;
            box-shadow: 0 2px 5px rgba(3, 5, 10, 20);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .student-info {
            display: flex;
            align-items: center;
        }

        .student-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
            border: 2px solid blue;
        }

        .student-details {
            text-align: left;
        }

        .exam-header {
            /* ... existing styles ... */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .exam-controls {
            text-align: right;
        }

        .timer {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <form method="POST" action="check_answers.php">
        <div class="exam-header">
            <div class="student-info">
                <img src=".../teacher-login/student data/S_Profile_Img/<?php echo $_SESSION['img']; ?>" alt="Student"
                    class="student-image">
                <div class="student-details">
                    <h2><?php echo $_SESSION['s_name']; ?></h2>
                    <p>Class: <?php echo $_SESSION['class']; ?></p>
                </div>
            </div>
            <?php
            include("exam_db.php");
            // Assuming $class is defined earlier in your code
            $sql = "SELECT * FROM `scheduled_exams` WHERE class = '$class' and exam_status='1'";
            $res = mysqli_query($conn_exam, $sql);
            $num = mysqli_num_rows($res);
            if ($num != 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $duration = $row['exam_duration'];
                }
            }
            ?>
            <div class="exam-controls">
                <div class="timer" id="examTimer">Time Remaining: <span
                        id="examtimerspan"><?php echo $duration[0] * 60; ?></span>
                </div>
                <button type="submit" class="btn btn-light">Submit Exam</button>
            </div>
        </div>

        <div class="container mt-4">
            <div class="questions-container">
                <?php
                include("exam_db.php");

                // Assuming $class is defined earlier in your code
                $sql = "SELECT * FROM `scheduled_exams` WHERE class = '$class' and exam_status='1'";
                $res = mysqli_query($conn_exam, $sql);
                $num = mysqli_num_rows($res);
                //echo $sql; 
                
                $i = 0; // Initialize counter
                if ($num > 0) {
                    // Inside the while loop where questions are displayed
                    while ($row = mysqli_fetch_assoc($res)) {
                        $q_id = $row['q_id'];
                        $duration = $row['exam_duration'];
                        $q_sql = "select * from `questions` where id = '$q_id'";
                        $q_res = mysqli_query($conn_exam, $q_sql);
                        while ($ques = mysqli_fetch_assoc($q_res)) {
                            //print_r($ques);
                            $quest = $ques['question_text'];
                            $opt_a = $ques['option_a'];
                            $opt_b = $ques['option_b'];
                            $opt_c = $ques['option_c'];
                            $opt_d = $ques['option_d'];
                            $correct_opt = $ques['correct_answer']; // This variable can be used later for checking answers
                            // Increment counter
                            $i++;
                            // Generate a unique id for each question's radio buttons
                            echo '<div class="question">
            <h4>' . $i . '. ' . $quest . ' </h4>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answers[' . $q_id . ']" value="' . $opt_a . '" id="q' . $q_id . 'a">
                <label class="form-check-label" for="q' . $q_id . 'a">A) ' . $opt_a . '</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answers[' . $q_id . ']" value="' . $opt_b . '" id="q' . $q_id . 'b">
                <label class="form-check-label" for="q' . $q_id . 'b">B) ' . $opt_b . '</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answers[' . $q_id . ']" value="' . $opt_c . '" id="q' . $q_id . 'c">
                <label class="form-check-label" for="q' . $q_id . 'c">C) ' . $opt_c . '</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answers[' . $q_id . ']" value="' . $opt_d . '" id="q' . $q_id . 'd">
                <label class="form-check-label" for="q' . $q_id . 'd">D) ' . $opt_d . '</label>
            </div>
          </div>';
                        }
                    }

                } else {
                    echo '<script>alert("Your teacher has not set your exam yet.");</script>';
                }
                ?>

            </div>

        </div>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>

        </script>
        <script>
            let timeLeft = parseInt(document.getElementById('examtimerspan').textContent); // Time in seconds
            const timerElement = document.getElementById('examTimer');

            function updateTimer() {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                timerElement.textContent =
                    `Time Remaining: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`; // Format seconds with a leading zero if necessary
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    document.forms[0].submit(); // Auto-submit the exam when time runs out
                }
                timeLeft--;
            }

            // Update the timer every second
            const timerInterval = setInterval(updateTimer, 1000);
        </script>
    </form>
</body>

</html>