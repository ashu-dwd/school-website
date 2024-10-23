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
    //echo $sql;
    if (mysqli_query($conn_exam, $sql)) {
        $message = "<div class='alert alert-success alert-dismissible fade show'> Question added successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger alert-dismissible fade show'>Error: " . mysqli_error($conn_exam) . "</div>";
    }
    mysqli_close($conn_exam); // Close connection after query
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Add Questions</title>
    <!-- Required meta tags -->
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
                echo $message; ?>
            <form action="" method="post" class="form-control bg-dark-subtle">
                <div class="container mt-3">
                    <div class="mb-3">
                        <label for="question" class="form-label text-dark">Enter Question</label>
                        <input type="text" class="form-control" name="question" autocomplete="off" id="question"
                            placeholder="Enter Question" required />
                    </div>

                    <div class="mb-3">
                        <label for="opt_a" class="form-label">Enter First Option</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <input type="radio" name="correct_opt" id="radio_a" value="opt_a" required />
                            </div>
                            <input type="text" oninput="updateRadioValue('opt_a', 'radio_a')" class="form-control"
                                name="opt_a" id="opt_a" autocomplete="off" placeholder="Enter First Option" required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="opt_b" class="form-label">Enter Second Option</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <input type="radio" name="correct_opt" id="radio_b" value="opt_b" required />
                            </div>
                            <input type="text" class="form-control" name="opt_b" id="opt_b" autocomplete="off"
                                oninput="updateRadioValue('opt_b', 'radio_b')" placeholder="Enter Second Option"
                                required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="opt_c" class="form-label">Enter Third Option</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <input type="radio" name="correct_opt" id="radio_c" value="opt_c" required />
                            </div>
                            <input type="text" class="form-control" name="opt_c" id="opt_c" autocomplete="off"
                                oninput="updateRadioValue('opt_c', 'radio_c')" placeholder="Enter Third Option"
                                required />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="opt_d" class="form-label">Enter Fourth Option</label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <input type="radio" name="correct_opt" id="radio_d" value="opt_d" required />
                            </div>
                            <input type="text" class="form-control" name="opt_d" id="opt_d" autocomplete="off"
                                placeholder="Enter Fourth Option" oninput="updateRadioValue('opt_d', 'radio_d')"
                                required />
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" name="btn" id="btn" class="btn btn-info">Add Question</button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <footer></footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.alert').fadeOut(2000);
        });

        function updateRadioValue(inputId, radioId) {
            var inputVal = document.getElementById(inputId).value;
            document.getElementById(radioId).value = inputVal;
        }
    </script>
</body>

</html>