<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding-top: 20px;
        }

        h2 {
            color: #007bff;
        }

        .list-group-item {
            border: none;
        }
    </style>
</head>

<body>

    <?php
    session_start();
    include("../student_db.php"); // Include your database connection file
    include("exam_db.php");

    // Check if the student is logged in
    if (!isset($_SESSION['s_name'])) {
        header("location: ../index.php");
        exit;
    }

    $class = $_SESSION['class'];
    $id = $_SESSION['s_id'];
    $name = $_SESSION['s_name'];
    $_SESSION['test_completed'] = true;

    // Retrieve user answers
    $user_answers = $_POST['answers'] ?? []; // Use null coalescing operator to handle unset answers
    
    // Fetch questions and correct answers from the database
    $stmt = $conn_exam->prepare("SELECT * FROM `scheduled_exams` WHERE class = ?");
    $stmt->bind_param("s", $class);
    $stmt->execute();
    $res = $stmt->get_result();
    $num = $res->num_rows;

    // Initialize score
    $score = 0;

    // Store questions and correct answers in an associative array
    $questions = [];

    if ($num > 0) {
        while ($row = $res->fetch_assoc()) {
            $q_id = $row['q_id'];
            $correct_ans = trim($row['correct_ans']);
            $subject = $row['subject'];
            $questions[$q_id] = [
                'question' => $row['question'],
                'correct_ans' => $correct_ans
            ];

            // Check if the user answered the question
            if (isset($user_answers[$q_id])) {
                $user_answer = trim($user_answers[$q_id]);
                // Compare the user's answer with the correct answer
                if (strcasecmp($user_answer, $correct_ans) === 0) {
                    $score++; // Increment score for each correct answer
                }
            }
        }

        // Check if the student's score already exists in the database
        $sql_check = "SELECT * FROM `student_exam_score` WHERE s_id = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $id);
        $stmt_check->execute();
        $res_check = $stmt_check->get_result();
        $numrows = $res_check->num_rows;

        if ($numrows == 0) {
            // Insert the student's score into the database
            $sql = "INSERT INTO `student_exam_score` (`s_id`, `s_name`, `exam_score`, `exam_subject`, `total_score`) VALUES (?, ?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($sql);
            $stmt_insert->bind_param("ssssi", $id, $name, $score, $subject, $num);
            $res_insert = $stmt_insert->execute();

            if ($res_insert) {
                displayResults($score, $num, $user_answers, $questions);
            } else {
                echo '<div class="container mt-5">';
                echo '<div class="alert alert-danger">Error saving the score. Please try again later.</div>';
                echo '</div>';
            }
        } else {
            displayResults($score, $num, $user_answers, $questions);
        }

    } else {
        echo '<div class="container mt-5">';
        echo '<div class="alert alert-warning">No exam data found for your class.</div>';
        echo '</div>';
    }

    // Close the database connections
    $stmt->close();
    $conn->close();

    // Function to display results
    function displayResults($score, $num, $user_answers, $questions)
    {
        echo '<div class="container">';
        echo '<h2 class="text-center mt-5">Your Exam Results</h2>';
        echo '<div class="alert alert-success mt-3">';
        echo "Your Score: <strong>$score/$num</strong>";
        echo '</div>';
        echo '<h3 class="mt-4">Feedback:</h3>';
        echo '<ul class="list-group">';
        foreach ($user_answers as $key => $value) {
            // Check if the question exists in the stored questions
            if (isset($questions[$key])) {
                $question_text = $questions[$key]['question'];
                $correct_ans = $questions[$key]['correct_ans'];
                $user_answer = trim($value);
                // Check if the answer was correct
                if (strcasecmp($user_answer, $correct_ans) === 0) {
                    echo '<li class="list-group-item list-group-item-success">Q: ' . $question_text . ' - Your answer: <strong>' . $user_answer . '</strong> (Correct)</li>';
                } else {
                    echo '<li class="list-group-item list-group-item-danger">Q: ' . $question_text . ' - Your answer: <strong>' . $user_answer . '</strong> (Incorrect, Correct answer: <strong>' . $correct_ans . '</strong>)</li>';
                }
            } else {
                echo '<li class="list-group-item list-group-item-warning">Question ID ' . $key . ' does not exist.</li>';
            }
        }
        echo '</ul>';
        echo '</div>';
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
</body>

</html>