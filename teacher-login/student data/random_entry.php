<?php
include("student_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    for ($i = 0; $i < 50; $i++) {
        // Generate random student data
        $s_name = "Student_" . rand(1000, 9999); // Random name
        $class = rand(1, 12); // Random class between 1 and 12
        $section = chr(rand(65, 68)); // Random section A, B, C, or D
        $s_pass = "1"; // Password is always "1"
        $father = "Father_" . rand(1000, 9999); // Random father's name
        $mother = "Mother_" . rand(1000, 9999); // Random mother's name
        $mobile = rand(6000000000, 9999999999); // Random mobile number
        $email = "student" . rand(1000, 9999) . "@example.com"; // Random email
        $dob = date('Y-m-d', rand(strtotime('2000-01-01'), strtotime('2010-12-31'))); // Random DOB between 2000 and 2010
        $dateofRagister = date('Y-m-d'); // Current date
        
        // Image placeholder (you might want to implement actual image uploads)
        $image = "default.png"; // Use a default image

        // Check for duplicate entries by email or mobile
        $duplicate_check = "SELECT * FROM student_data WHERE email = '$email' OR mobile = '$mobile'";
        $result = mysqli_query($conn, $duplicate_check);

        if (!$result) {
            echo "Error querying the database: " . mysqli_error($conn) ;
            exit;
        }

        if (mysqli_num_rows($result) > 0) {
            echo "Error: Duplicate entry! A student with the same email or mobile already exists.";
        } else {
            // SQL to insert the data including dob and image fields
            $sql = "INSERT INTO student_data (s_name, class, section, s_pass, father, mother, mobile, email, dob, s_img, dateofRagister) 
                    VALUES ('$s_name', '$class', '$section', '$s_pass', '$father', '$mother', '$mobile', '$email', '$dob', '$image', '$dateofRagister')";

            if (!mysqli_query($conn, $sql)) {
                echo "Error adding data: " . mysqli_error($conn) ;
            }
        }
    }
    echo "50 Student records added successfully!";
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Add Random Student</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <?php include("nav.php"); ?>
    </header>
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Generate Random Student Data</h4>
                        </div>
                        <div class="card-body mt-5">
                            <form method="post" action="">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-success">Enter 50 Random Student Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="text-center mt-4">
        <!-- Place footer here -->
    </footer>

    <!-- Bootstrap JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>