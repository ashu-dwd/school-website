<?php
session_start();
if (!isset($_SESSION['class'])) {
    header("location: ./index.php");
    exit();
}

// Include database connection
include("exam_db.php");

// Define an array of subjects
$subjects = [
    "Math",
    "Physics",
    "Chemistry",
    "English",
    "Hindi",
    // Add more subjects as needed
];

$message = ''; // Initialize message variable

// Function to fill subjects
if (isset($_POST['fill_subjects'])) {
    // Query to select all questions from the questions table
    $query = "SELECT id FROM questions";
    $result = mysqli_query($conn_exam, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Randomly select a subject from the subjects array
            $random_subject = $subjects[array_rand($subjects)];

            // Update the subject column for the current question
            $update_query = "UPDATE questions SET subject = '$random_subject' WHERE id = " . $row['id'];
            mysqli_query($conn_exam, $update_query);
        }

        $message = "<div class='alert alert-success'>Subjects updated successfully for all questions!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error retrieving questions: " . mysqli_error($conn_exam) . "</div>";
    }
}

// Function to clear subjects
if (isset($_POST['clear_subjects'])) {
    // Update the subject column to NULL for all questions
    $update_query = "UPDATE questions SET subject = NULL";
    if (mysqli_query($conn_exam, $update_query)) {
        $message = "<div class='alert alert-success'>All subjects cleared successfully!</div>";
    } else {
        $message = "<div class='alert alert-danger'>Error clearing subjects: " . mysqli_error($conn_exam) . "</div>";
    }
}

// Close the database connection
mysqli_close($conn_exam);
?>

<!doctype html>
<html lang="en">

<head>
    <title>Manage Subjects</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <?php include("../nav.php"); ?>
    </header>

    <main>
        <div class="container mt-5">
            <?php if ($message) echo $message; ?>
            <form action="" method="post" class="form-control bg-dark-subtle">
                <div class="d-grid gap-2">
                    <button type="submit" name="fill_subjects" class="btn btn-info">Fill Subjects for All
                        Questions</button>
                    <button type="submit" name="clear_subjects" class="btn btn-danger">Clear All Subjects</button>
                </div>
            </form>
        </div>
    </main>

    <footer></footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>