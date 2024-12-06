<!doctype html>
<html lang="en">

<head>
    <title>Student Data</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <?php include("../nav.php"); ?>
    </header>
    <main>
        <div class="container mt-1">
            <div class="mb-3 d-flex align-items-center">
                <div class="me-3">
                    <label for="class" class="form-label">Class:</label>
                    <select class="form-select form-select-lg" name="class" id="class">
                        <option selected>Select one</option>
                        <?php
                        for ($i = 1; $i < 13; $i++) {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="me-3">
                    <label for="section" class="form-label">Section:</label>
                    <select class="form-select form-select-lg" name="section" id="section">
                        <option selected>Select one</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
                <div class="me-3">
                    <label for="search_term" class="form-label">Search Students</label>
                    <input type="search" class="form-control" name="search_term" id="search_term"
                        aria-describedby="helpId" placeholder="Search Student" />
                </div>
                <div>
                    <button type="button" id="viewBtn" class="btn btn-primary mt-4 me-3">
                        View Students
                    </button>
                    <button type="button" class="btn btn-success mt-4">
                        <a href="add-students.php" class="text-light">Add Students</a>
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <div id="table" class="table-data mt-3">
            <!-- Table content will be loaded here -->
        </div>

        <!-- Modal for updating student info -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="" id="update-form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="s_id" class="form-label">Student Id</label>
                                    <input type="number" class="form-control" disabled name="student_id" id="s_id"
                                        required />
                                </div>
                                <div class=" col-md-6 mb-3">
                                    <label for="s_name" class="form-label">Student Name</label>
                                    <input type="text" class="form-control" name="s_name" id="s_name"
                                        placeholder="Enter Student Name" required />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="class" class="form-label">Class</label>
                                    <select class="form-select" name="class" id="class_update" required>
                                        <option value="">Select Class</option>
                                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                                        <option value="<?php echo $i; ?>">
                                            <?php echo $i; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="section" class="form-label">Section</label>
                                    <select class="form-select" name="section" id="section_update" required>
                                        <option value="">Select Section</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="s_pass" class="form-label">Password</label>
                                    <input type="text" class="form-control input-group" name="s_pass" id="s_pass"
                                        placeholder="Enter New Password (leave blank to keep current)" />
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
                                        placeholder="Enter Mother's Name" " required />
                                </div>
                            </div>
                            <div class=" row">
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
                                        <input type="file" class="form-control" name="image" id="image"
                                            accept="image/*" />
                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" id="update-btn" class="btn btn-success">Update
                                        Student</button>
                                </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <!-- Footer content here -->
    </footer>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        // Load student table on button click
        $('#viewBtn').click(function(e) {
            e.preventDefault();
            var classVal = $('#class').val();
            var sectionVal = $('#section').val();
            $.ajax({
                type: "POST",
                url: "student-load.php",
                data: {
                    class: classVal,
                    section: sectionVal
                },
                success: function(response) {
                    $('#table').html(response);
                }
            });
        });

        // Live search for students
        $("#search_term").on("keyup", function() {
            let search_term = $(this).val();
            $.ajax({
                url: "student-search.php",
                type: "POST",
                data: {
                    search: search_term
                },
                success: function(data) {
                    $("#table").html(data);
                },
            });
        });

        // Delete student
        $(document).on("click", ".delete-btn", function() {
            if (confirm("Do you really want to delete this record?")) {
                let userId = $(this).data("id");

                var btn = this;
                $.ajax({
                    url: "delete-student.php",
                    type: "POST",
                    data: {
                        id: userId
                    },
                    success: function(data) {
                        if (data == 1) {
                            $(btn).closest("tr").fadeOut();
                        } else if (data == 2) {
                            console.log("User ID not provided");
                        } else {
                            console.log("Failed to delete");
                        }
                    }
                });
            }
        });

        // Populate modal with student data for updating
        $(document).on("click", ".update-btn", function() {
            var updateModal = new bootstrap.Modal(document.getElementById('updateModal'));
            updateModal.show();

            var studentId = $(this).data("id");
            alert(studentId);

            $.ajax({
                url: "fetch-student.php", // This file fetches student data based on ID
                type: "POST",
                data: {
                    student_id: studentId
                },
                success: function(response) {
                    let student = JSON.parse(response);
                    $('#s_id').val(student.id);
                    $('#s_name').val(student.s_name);
                    $('#class_update').val(student.class);
                    $('#section_update').val(student.section);
                    $('#father').val(student.father);
                    $('#mother').val(student.mother);
                    $('#email').val(student.email);
                    $('#mobile').val(student.mobile);
                    $('#dob').val(student.date);
                    $('#s_pass').val(student.s_pass);
                    $('#updateModal').modal('show');
                }
            });
        });
        $("#update-form").submit(function(e) {
            e.preventDefault(); // Prevent form submission
            // Display serialized form data
            var studentId = $(this).data("id");
            //alert(studentId);
            $.ajax({
                url: "update-student.php",
                type: "POST",
                data: $('#update-form').serialize(),
                success: function(data) {
                    $('#update-form').trigger('reset');
                    console.log(data);
                }
            })
        })


    });
    </script>
</body>

</html>