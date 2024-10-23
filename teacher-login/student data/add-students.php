<?php
include("student_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $s_name = $_POST['s_name'];
    $class = $_POST['class'];
    $section = $_POST['section'];
    $s_pass = $_POST['s_pass'];
    $father = $_POST['father'];
    $mother = $_POST['mother'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $dob = $_POST['dob']; // New field for Date of Birth
    $dateofRagister = date('Y-m-d'); // Automatically add current date

    // Image upload handling
    $target_dir = "S_Profile_Img/";
    $image = $_FILES['image']['name'];
    $target_file = $target_dir . basename($image);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a valid image type
    $check = getimagesize($_FILES['image']['tmp_name']);
    if ($check !== false) {
        // Valid image, proceed with the file upload
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // File uploaded
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
            exit;
        }
    } else {
        echo "<script>alert('File is not an image.');</script>";
        exit;
    }

    // Check for duplicate entries by email or mobile
    $duplicate_check = "SELECT * FROM student_data WHERE email = '$email' OR mobile = '$mobile'";
    $result = mysqli_query($conn, $duplicate_check);

    if (!$result) {
        echo "<script>alert('Error querying the database: " . mysqli_error($conn) . "');</script>";
        exit;
    }

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Error: Duplicate entry! A student with the same email or mobile already exists.');</script>";
    } else {
        // SQL to insert the data including dob and image fields
        $sql = "INSERT INTO student_data (s_name, class, section, s_pass, father, mother, mobile, email, dob, s_img, dateofRagister) 
                VALUES ('$s_name', '$class', '$section', '$s_pass', '$father', '$mother', '$mobile', '$email', '$dob', '$image', '$dateofRagister')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Student data added successfully!');</script>";
        } else {
            echo "<script>alert('Error adding data: " . mysqli_error($conn) . "');</script>";
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Add Student</title>
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
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Add New Student</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="s_name" class="form-label">Student Name</label>
                                        <input type="text" class="form-control" name="s_name" id="s_name"
                                            placeholder="Enter Student Name" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="class" class="form-label">Class</label>
                                        <select class="form-select" name="class" id="class" required>
                                            <option value="" selected>Select Class</option>
                                            <?php for ($i=1; $i <= 12; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="section" class="form-label">Section</label>
                                        <select class="form-select" name="section" id="section" required>
                                            <option value="" selected>Select Section</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="s_pass" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="s_pass" id="s_pass"
                                            placeholder="Enter Password" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="father" class="form-label">Father's Name</label>
                                        <input type="text" class="form-control" name="father" id="father"
                                            placeholder="Enter Father's Name" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="mother" class="form-label">Mother's Name</label>
                                        <input type="text" class="form-control" name="mother" id="mother"
                                            placeholder="Enter Mother's Name" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="mobile" class="form-label">Mobile Number</label>
                                        <input type="text" class="form-control" name="mobile" id="mobile"
                                            placeholder="Enter Mobile Number" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Enter Email Address" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" name="dob" id="dob" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="image" class="form-label">Upload Image</label>
                                        <input type="file" class="form-control" name="image" id="image" accept="image/*"
                                            required />
                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-success">Add Student</button>
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