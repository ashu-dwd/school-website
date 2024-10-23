<!doctype html>
<html lang="en">

<head>
    <title>Unset Test</title>
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
        <div class="container mt-3">
            <h1 class="text-center">Unset Test</h1>
            <div class="table-responsive-sm">
                <table class="table table-success table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Running Tests</th>
                            <th scope="col">Class</th>
                            <th scope="col">Scheduled by</th>
                            <th scope="col">Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("exam_db.php");
                        $sql = "select DISTINCT `exam_id` from `scheduled_exams` where `exam_status` = '1'";
                        $res = mysqli_query($conn_exam, $sql);
                        $num = mysqli_num_rows($res);
                        if ($num > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                $exam_id_full = $row['exam_id'];
                                $strToArr = explode("-", $exam_id_full);
                                $exam_id = $strToArr[0];
                                $class = $strToArr[1];
                                $subject = $strToArr[2];
                                $teacher_id = $strToArr[3];
                                $t_sql = "SELECT `t_name` from `teacher_data` where  `t_id` = '$teacher_id'";
                                $t_res = mysqli_query($conn_exam, $t_sql);
                                $t_row = mysqli_fetch_assoc($t_res);
                                $teacher = $t_row['t_name'];

                                echo '<tr>
                                        <td>' . $subject . '</td>
                                        <td>' . $class . '</td>
                                        <td>' . $teacher . '</td>
                                        <td>
                                            <button type="button" class="unset-btn btn btn-danger me-2" data-id="' . $exam_id_full . '">
                                                Unset
                                            </button>
                                            <button type="button" class="reschedule-btn btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="' . $exam_id_full . '">
                                                Reschedule Test
                                            </button>
                                        </td>
                                      </tr>';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Rescheduling Test</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="class" class="form-label">Class</label>
                                    <select class="form-select form-select-lg" name="class" id="class">
                                        <option selected>Select Class</option>
                                        <?php for ($i = 1; $i < 13; $i++) {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        } ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Section:</label>
                                    <select class="form-select form-select-lg" name="section" id="section">
                                        <option selected>Select Section</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="reschedule_test" class="btn btn-primary">Reschedule</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // Unset button event handler
            $('.unset-btn').on('click', function () {
                var id = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "unset-test.php",
                    data: {
                        exam_id: id
                    },
                    success: function (response) {
                        console.log(response);
                        location.reload(); // Reload the page after unset
                    }
                });
            });

            // Set exam_id in modal for rescheduling
            $('.reschedule-btn').on('click', function () {
                var id = $(this).data('id');
                $('#reschedule_test').data('id', id); // Store exam_id in button for rescheduling
            });

            // Reschedule test event handler
            $('#reschedule_test').click(function () {
                var exam_id = $(this).data('id');
                var class_val = $('#class').val();
                var section = $('#section').val();
                //alert(exam_id);
                // AJAX call to reschedule the test
                $.ajax({
                    type: "POST",
                    url: "reschedule-test.php",
                    data: {
                        exam_id: exam_id,
                        class: class_val,
                        section: section
                    },
                    success: function (response) {
                        console.log(response);
                        location.reload(); // Reload after rescheduling
                    }
                });
            });
        });
    </script>
</body>

</html>