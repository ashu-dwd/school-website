<?php
session_start();

if ($_GET) {
    $t_id = $_GET['t_id'];
    $msg = $_GET['msg'];
    $_SESSION['t_id'] = $t_id;
} else {
    if (!isset($_SESSION["t_id"])) {
        header("location: index.php");
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Teacher-Home</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <!-- Navbar -->
        <?php include("nav.php"); ?>
    </header>

    <main>
        <!-- Main content goes here -->
        <div class="container mt-4">
            <?php
            if ($_GET) {
                echo '<div
                        class="alert alert-success alert-dismissible fade show"
                        role="alert"
                    >
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close" id="btn"
                        ></button>
                    
                        <strong>Exam Set Successfully! </strong> Now Students Can Start Test.
                    </div>';

            }
            ?>
            <h1>Welcome to Ashu's Classroom, <?php echo $_SESSION['t_id']; ?></h1>
            <p>This is your dashboard where you can manage your classes, assignments, and more.</p>
        </div>
        <div class="container mt-3 bg-success">
            <?php
            include("teacher_db.php");
            $sql = "SELECT * FROM `notifications` ORDER BY `date` DESC";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="alert alert-info" role="alert">
        <h4 class="alert-heading">Notification By Admin</h4>
        <p>' . $row['date'] . '</p>
        <hr />
        <p class="mb-0">' . $row['notifi_text'] . '</p>
    </div>';
                }
            }
            ?>
        </div>
    </main>


    <footer class="mt-5">
        <!-- Footer -->
        <div class="text-center py-3" style="background-color: #f1f1f1;">
            © 2024 Ashu's Classroom | All Rights Reserved
        </div>
    </footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#btn').click(function() {
            function removeURLParameters(url, parameters) {
                var urlObj = new URL(url);
                parameters.forEach(function(parameter) {
                    urlObj.searchParams.delete(parameter);
                });
                return urlObj.href;
            }
            var currentUrl = window.location.href;
            var updatedUrl = removeURLParameters(currentUrl, ['t_id', 'msg']);
            window.history.pushState({}, document.title, updatedUrl);
        });
    });
    </script>
</body>

</html>