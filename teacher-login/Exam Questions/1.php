<?php
session_start();
if (!isset($_SESSION['class'])) {
    header("location: ./index.php");
    exit();
}

if (isset($_POST['btn'])) {
    include("exam_db.php");

    // Use mysqli_real_escape_string to prevent SQL Injection
    $ques = mysqli_real_escape_string($conn_exam, $_POST['question']);
    $opt_a = mysqli_real_escape_string($conn_exam, $_POST['opt_a']);
    $opt_b = mysqli_real_escape_string($conn_exam, $_POST['opt_b']);
    $opt_c = mysqli_real_escape_string($conn_exam, $_POST['opt_c']);
    $opt_d = mysqli_real_escape_string($conn_exam, $_POST['opt_d']);
    $correct_answer = mysqli_real_escape_string($conn_exam, $_POST['correct_opt']);
    $class = $_SESSION['class'];

    $sql = "INSERT INTO `questions` 
            (`id`, `exam_id`, `question_text`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `class`, `date`) 
            VALUES (NULL, NULL, '$ques', '$opt_a', '$opt_b', '$opt_c', '$opt_d', '$correct_answer', '$class', CURRENT_TIMESTAMP())";

    if (mysqli_query($conn_exam, $sql)) {
        $message = "<div class='alert alert-success alert-dismissible fade show'> Question added successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger alert-dismissible fade show'>Error: " . mysqli_error($conn_exam) . "</div>";
    }
    mysqli_close($conn_exam); // Close connection after query
}

// Generate random questions
if (isset($_POST['generate_questions'])) {
    include("exam_db.php");

    // Sample questions and options
    $sample_questions = [
        "What is the capital of France?",
        "What is 2 + 2?",
        "What is the color of the sky?",
        "Which planet is known as the Red Planet?",
        "Who wrote 'Romeo and Juliet'?",
        // Add more sample questions as needed
    ];

    $options_list = [
        ["Paris", "London", "Berlin", "Madrid"],
        ["3", "4", "5", "6"],
        ["Blue", "Green", "Red", "Yellow"],
        ["Earth", "Mars", "Jupiter", "Venus"],
        ["Shakespeare", "Hemingway", "Tolkien", "Austen"],
        // Add corresponding options for each question
    ];

    // Class integer mapping
    $classes = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]; // Integer representation of classes

    for ($i = 0; $i < 100; $i++) {
        // Select a random question and options
        $rand_index = rand(0, count($sample_questions) - 1);
        $ques = mysqli_real_escape_string($conn_exam, $sample_questions[$rand_index]);
        $options = $options_list[$rand_index];

        // Select a random class (integer)
        $random_class = $classes[rand(0, count($classes) - 1)];

        // Prepare options for database
        $opt_a = mysqli_real_escape_string($conn_exam, $options[0]);
        $opt_b = mysqli_real_escape_string($conn_exam, $options[1]);
        $opt_c = mysqli_real_escape_string($conn_exam, $options[2]);
        $opt_d = mysqli_real_escape_string($conn_exam, $options[3]);
        $correct_answer = mysqli_real_escape_string($conn_exam, $options[0]); // Assuming the first option is the correct one

        $sql = "INSERT INTO `questions` 
                (`id`, `exam_id`, `question_text`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`, `class`, `date`) 
                VALUES (NULL, NULL, '$ques', '$opt_a', '$opt_b', '$opt_c', '$opt_d', '$correct_answer', '$random_class', CURRENT_TIMESTAMP())";

        // Execute the query
        mysqli_query($conn_exam, $sql);
    }

    $message = "<div class='alert alert-success alert-dismissible fade show'> 100 Questions added successfully!</div>";
    mysqli_close($conn_exam); // Close connection after queries
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Add Questions</title>
    <!--   meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <?php include("../nav.php"); ?>
    </header>

    <main>
        <div class="container mt-5">
            <?php if (isset($message))
                echo $message . $sql; ?>
            <form action="" method="post" class="form-control bg-dark-subtle">
                <div class="container mt-3">
                    <div class="mb-3">
                        <label for="question" class="form-label text-dark">Enter Question</label>
                        <input type="text" class="form-control" name="question" autocomplete="off" id="question"
                            placeholder="Enter Question" />
                    </div>

                    <div class="mb-3">
                        <label for="opt_a" class="form-label">Enter First Option</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <input type="radio" name="correct_opt" id="radio_a" value="opt_a" />
                            </div>
                            <input type="text" oninput="updateRadioValue('opt_a', 'radio_a')" class="form-control"
                                name="opt_a" id="opt_a" autocomplete="off" placeholder="Enter First Option" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="opt_b" class="form-label">Enter Second Option</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <input type="radio" name="correct_opt" id="radio_b" value="opt_b" />
                            </div>
                            <input type="text" class="form-control" name="opt_b" id="opt_b" autocomplete="off"
                                oninput="updateRadioValue('opt_b', 'radio_b')" placeholder="Enter Second Option" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="opt_c" class="form-label">Enter Third Option</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <input type="radio" name="correct_opt" id="radio_c" value="opt_c" />
                            </div>
                            <input type="text" class="form-control" name="opt_c" id="opt_c" autocomplete="off"
                                oninput="updateRadioValue('opt_c', 'radio_c')" placeholder="Enter Third Option" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="opt_d" class="form-label">Enter Fourth Option</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <input type="radio" name="correct_opt" id="radio_d" value="opt_d" />
                            </div>
                            <input type="text" class="form-control" name="opt_d" id="opt_d" autocomplete="off"
                                oninput="updateRadioValue('opt_d', 'radio_d')" placeholder="Enter Fourth Option" />
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" name="btn" id="btn" class="btn btn-info">Add Question</button>
                        <button type="submit" name="generate_questions" id="generate_btn"
                            class="btn btn-primary">Generate 100 Questions</button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script>
        function updateRadioValue(optValue, radioId) {
            document.getElementById(radioId).value = optValue;
        }
    </script>
</body>

</html>