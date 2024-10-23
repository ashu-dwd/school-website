<?php
include("dbconn.php");
if (isset($_POST['submit'])) {
    $nText = $_POST['nText'];
    $nType = $_POST['nFor'];
    $sql = "INSERT INTO `notifications` (`id`, `notifi_text`,`notification_type`, `created_by`) VALUES (NULL, '$nText','$nType', 'Admin')";
    $result = mysqli_query($conn, $sql);

}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Add Notifications</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <?php include("nav.php"); ?>
    </header>
    <main><?php
    if ($result) {
        echo
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            <strong>Success!</strong> Notification Added Successfully
        </div>';

    } else {
        echo
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            <strong>Error!</strong> Notification Uploading Failed
        </div>';
    }
    ?>
        <div class="container mt-3">
            <form action="" method="post" class="form-control">
                <div class="mb-3">
                    <label for="notification" class="form-label">Notification Text:</label>
                    <textarea class="form-control" required name="nText" id="nText" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="Notification For" class="form-label">Notification For</label>
                    <select required class="form-select form-select-lg" name="nFor" id="nFor">
                        <option selected>Select one</option>
                        <option value="Students">Students</option>
                        <option value="Teachers">Teachers</option>

                    </select>
                </div>
                <input name="submit" id="submit" class="btn btn-success" type="submit" value="Upload Notification" />

            </form>

        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
</body>

</html>