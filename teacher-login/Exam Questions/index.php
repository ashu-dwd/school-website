<?php
session_start();
if (!isset($_SESSION['t_id'])) {
    header("location: ../index.php");
}
if (isset($_POST['btn'])) {
    $_SESSION['class']= $_POST['class'];
    header("location: add-questions.php");
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Question Data</title>
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
    <main>
        <div class="container mt-2">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="class" class="form-label">Select Class</label>
                    <select class="form-select form-select-lg" name="class" id="class">
                        <option selected>Select one</option>
                        <?php
                    for ($i=1; $i <=12 ; $i++) { 
                        echo '<option value="'.$i.'">'.$i.'</option>';
                    }
                    ?>

                    </select>
                </div>
                <div class="d-grid gap-3">
                    <button type="submit" name="btn" id="btn" class="btn btn-success">
                        Enter
                    </button>
                </div>
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