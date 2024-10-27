<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Vertical Navbar with Header</title>
    <style>
        body {
            display: flex;
            height: 100vh;
        }

        #list {
            width: 100%;
            position: absolute;
            border: 1px solid #4d6e87;
            display: none;
        }

        #list ul {
            list-style: none;
            background: #fff;
            margin: 0;
            padding: 0;
            text-align: left;

        }

        #list ul li {
            padding: 2px 10px;
            cursor: pointer;
        }

        #list ul li:hover {
            background: #d0e4f4;
        }

        .sidebar {
            min-width: 200px;
            background-color: #f8f9fa;
            padding: 20px;
            position: fixed;
            height: 100%;
            overflow-y: auto;
        }

        .content {
            margin-left: 220px;
            margin-top: 70px;
            padding: 20px;
        }

        header {
            width: 100%;
            z-index: 1;
            position: fixed;
            top: 0;
            left: 0;
        }

        .navbar {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #343a40;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Ashu's Classroom</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="studentTestsDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Student Tests
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="studentTestsDropdown">
                                <li><a class="dropdown-item" href="../student tests/index.php">Set test</a></li>
                                <li><a class="dropdown-item" href="#">View Result</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="libraryDataDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Library Data
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="libraryDataDropdown">
                                <li><a class="dropdown-item" href="#">Action 1</a></li>
                                <li><a class="dropdown-item" href="#">Action 2</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="studentDataDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Student Data
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="studentDataDropdown">
                                <li><a class="dropdown-item" href="#">Action 1</a></li>
                                <li><a class="dropdown-item" href="#">Action 2</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="examQuestionsDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Exam Questions
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="examQuestionsDropdown">
                                <li><a class="dropdown-item" href="Exam Questions/index.php">Add Questions</a></li>
                                <li><a class="dropdown-item" href="Exam Questions/">Rate and Edit Questions</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <nav class="sidebar">
        <h3>Dashboard</h3>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add_book.php">Add New Book</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">View Book Old owner</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Update Book Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">View Student Fine Data</a>
            </li>
        </ul>
    </nav>

    <div class="container">
        <div class="content">
            <h1 class="text-center">Allot Book To Student</h1>
            <div class="mb-3">
                <label for="class" class="form-label">Select Class</label>
                <select class="form-select form-select-lg" name="s_class" id="s_class">
                    <option selected>Select Class</option>
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="section" class="form-label">Select Section</label>
                <select class="form-select form-select-lg" name="section" id="section">
                    <option selected>Select Section</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="student" class="form-label">Student Name</label>
                <select class="form-select form-select-lg" name="s_name" id="s_name">
                    <option selected>Select one</option>
                </select>
            </div>
            <div class="mb-3" id="autocomplete">
                <label for="" class="form-label">Book Code</label>
                <input type="text" class="form-control" name="book" id="book" aria-describedby="helpId"
                    placeholder="Enter Book Code" autocomplete="off" />
                <div class="list" id="list"></div>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" name="btn" id="btn" class="btn btn-primary">
                    Allot Book
                </button>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#s_class, #section').on('change', function () {
                var class_id = $('#s_class').val();
                var section = $('#section').val();

                if (class_id && section) {
                    $.ajax({
                        type: "POST",
                        url: "fetch-students.php",
                        data: {
                            s_class: class_id,
                            section: section
                        },
                        success: function (response) {
                            console.log(response)
                            $('#s_name').html(response);
                        }
                    });
                } else {
                    $('#s_name').html('<option selected>Select one</option>');
                }
            });
            $('#book').keyup(function () {
                var book = $(this).val();
                if (book != '') {
                    $.ajax({
                        type: "post",
                        url: "load-books.php",
                        data: {
                            book: book
                        },

                        success: function (response) {
                            console.log(response);
                            $('#list').fadeIn("fast").html(response);
                        }
                    });
                } else {
                    $('#list').fadeOut();
                }
            })
        });
    </script>
</body>

</html>