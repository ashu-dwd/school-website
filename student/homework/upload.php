<?php
session_start();

if (isset($_POST['btn'])) {
    if (isset($_FILES['img']) && $_FILES['img']['error'] == 0) {
        // Get session ID and input data
        $id = $_SESSION['s_id'];
        $subject = $_POST['subject']; // No sanitization

        // Extract the file name and target path
        $file_name = basename($_FILES['img']['name']);
        $path = "./hw/" . $file_name;

        // Database connection
        include("../student_db.php");

        // SQL query to check if the file already exists for the student
        $check_sql = "SELECT * FROM `homework` WHERE `img` = '$file_name' AND `s_id` = '$id'";
        $check_res = mysqli_query($conn, $check_sql);

        // Get the number of rows that match
        if (mysqli_num_rows($check_res) == 0) {
            // Move uploaded file to the target folder
            if (move_uploaded_file($_FILES['img']['tmp_name'], $path)) {
                // Insert file data into the database
                $insert_sql = "INSERT INTO `homework` (`s_id`, `img`, `subject`, `date`) 
                               VALUES ('$id', '$file_name', '$subject', current_timestamp())";
                $res = mysqli_query($conn, $insert_sql);

                // Check if the query was successful
                if ($res) {
                    echo '<div class="container"><div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Uploaded!</strong> Your ' . $subject . ' homework has been uploaded successfully.
                          </div></div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Error!</strong> There was a problem uploading your ' . $subject . ' homework. Please try again.
                          </div>';
                }
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Error!</strong> File upload failed.
                      </div>';
            }
        } else {
            // File already exists for the student
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Duplicate!</strong> The homework image for ' . $subject . ' has already been uploaded.
                  </div>';
        }
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Error!</strong> No file was uploaded or an error occurred.
              </div>';
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Upload Your Homework</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <header>
        <!-- Add your navbar here -->
    </header>

    <main>
        <div class="container mt-4">
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="subject" class="form-label">Select Subject:</label>
                    <select class="form-select form-select-lg" name="subject" id="subject" required>
                        <option value="" disabled selected>Select Subject</option>
                        <option value="Physics">Physics</option>
                        <option value="Chemistry">Chemistry</option>
                        <option value="Maths">Maths</option>
                        <option value="Hindi">Hindi</option>
                        <option value="English">English</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="img" class="form-label">Upload Homework Image:</label>
                    <input type="file" class="form-control" name="img" id="img" required />
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" name="btn" class="btn btn-success">Upload</button>
                </div>
            </form>
        </div>
    </main>

    <footer>
        <!-- Add your footer here -->
    </footer>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>