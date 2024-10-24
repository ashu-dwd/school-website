<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <title>Set Test</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .accordion-button:focus {
            box-shadow: none;
        }

        .accordion-button:not(.collapsed) {
            color: #007bff;
            background-color: #f8f9fa;
        }

        .question-number {
            font-weight: bold;
            margin-right: 10px;
            color: #007bff;
        }

        .correct-answer {
            background-color: #d4edda;
            border-radius: 5px;
            padding: 5px;
        }

        .upload-icon {
            margin-left: 10px;
            color: #6c757d;
        }

        .progress {
            height: 5px;
        }

        .accordion-item {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <header>
        <?php include("../nav.php"); ?>
    </header>
    <main>
        <div class="container mt-4">
            <h1 class="text-center mb-4">Set Test Questions</h1>
            <form action="final-auth.php" method="post">
                <div class="d-flex align-items-center text-center">
                    <label for="duration" class="form-label me-2">Enter Exam Duration:</label>
                    <input type="number" class="form-control me-2" name="duration" id="duration"
                        placeholder="Exam Duration in Minutes" style="max-width: 300px;" />
                    <button type="submit" class="btn btn-success" name="btn">
                        Set Test
                    </button>

                </div>
            </form>
            <br>

            <?php
            include("exam_db.php");
            $class = $_SESSION['class'];
            $subject = $_SESSION['subject'];
            $teacher = $_SESSION['t_id'];
            $exam_id = $_SESSION['exam_id'] . "-" . $_SESSION['class'] . "-" . $_SESSION['subject'] . "-" . $_SESSION['t_id'];
            $sql = "SELECT * FROM `questions` WHERE class ='$class' AND subject = '$subject'";
            $res = mysqli_query($conn_exam, $sql);
            if (mysqli_num_rows($res) > 0) {
                echo '<div class="accordion accordion-flush" id="accordionFlushExample">';
                $i = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                    echo '<div class="accordion-item">
                        <h2 class="accordion-header" id="flush-heading' . $i . '">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse' . $i . '" aria-expanded="false"
                                aria-controls="flush-collapse' . $i . '" data-id="' . $row['id'] . '">
                                <span class="question-number">' . $i . '.</span>
                                ' . $row['question_text'] . '
                                <span class="upload-icon" id="set"><i class="fa-solid fa-upload"></i></span>
                            </button>
                        </h2>
                        <div id="flush-collapse' . $i . '" class="accordion-collapse collapse"
                            aria-labelledby="flush-heading' . $i . '" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>A.</strong> ' . $row['option_a'] . '</li>
                                    <li class="list-group-item"><strong>B.</strong> ' . $row['option_b'] . '</li>
                                    <li class="list-group-item"><strong>C.</strong> ' . $row['option_c'] . '</li>
                                    <li class="list-group-item"><strong>D.</strong> ' . $row['option_d'] . '</li>
                                </ul>
                                <p class="mt-3 correct-answer"><strong>Correct Answer:</strong> <span id="corr_ans">' . $row['correct_answer'] . '</span></p>
                            </div>
                        </div>
                    </div>';
                    $i++;
                }
                echo '</div>';
            } else {
                echo '<div class="alert alert-warning">No Questions Found Related to Class</div>';
            }
            ?>
        </div>
    </main>
    <footer class="mt-4 text-center">

        <p>&copy; 2024 Your Company Name. All rights reserved.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).on("click", ".upload-icon", function (e) {
            e.preventDefault();

            // Retrieve data-id from the clicked button's parent
            var qId = $(this).closest('.accordion-button').data('id');

            // Use PHP-echoed values directly in JavaScript
            var correct_ans = $(this).closest('p').text();
            var subject = <?php echo json_encode($subject); ?>;
            var s_class = <?php echo json_encode($class); ?>; // Corrected variable name
            var teacher = <?php echo json_encode($teacher); ?>;
            var exam_id = <?php echo json_encode($exam_id); ?>;
            // Use 'this' to refer to the clicked element
            var clickedElement = $(this);

            $.ajax({
                type: "POST",
                url: "uploading-questions.php",
                data: {
                    id: qId,
                    corr_ans: correct_ans,
                    exam_id: exam_id,
                    subject: subject,
                    s_class: s_class,
                    teacher: teacher
                },
                success: function (response) {
                    console.log("AJAX Response:", response); // Log the full response
                    if (response == 1) {
                        clickedElement.closest(".accordion-item").slideUp();
                    } else if (response == 2) {
                        console.log("User ID not provided");
                    } else {
                        console.log("Failed to upload question");
                        console.log(response);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX request failed: ", error);
                }
            });
        });
    </script>

</body>

</html>