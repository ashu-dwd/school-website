<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 250px;
            --header-height: 60px;
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #3498db;
        }

        body {
            min-height: 100vh;
            background-color: #f8f9fa;
            margin: 0;
            /* Added to remove default margin */
            padding: 0;
            /* Added to remove default padding */
        }

        /* Header Styles */
        .main-header {
            height: var(--header-height);
            background: var(--primary-color);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            /* Added to ensure header starts from top */
            left: 0;
            /* Added to ensure header starts from left */
            right: 0;
            /* Added to ensure header spans full width */
            width: 100%;
            z-index: 1000;
        }

        .navbar {
            padding-top: 0 !important;
            /* Override Bootstrap padding */
            padding-bottom: 0 !important;
            /* Override Bootstrap padding */
            min-height: var(--header-height);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 600;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background: white;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: var(--header-height);
            bottom: 0;
            left: 0;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 900;
        }

        .sidebar .nav-link {
            color: var(--secondary-color);
            padding: 0.8rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #f8f9fa;
            color: var(--accent-color);
        }

        .sidebar .nav-link.active {
            background-color: #e9ecef;
            color: var(--accent-color);
            font-weight: 600;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            padding: 2rem;
            min-height: calc(100vh - var(--header-height));
        }

        .content-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 2rem;
        }

        /* Form Styles */
        .form-control,
        .form-select {
            border: 1px solid #dee2e6;
            padding: 0.75rem;
            border-radius: 6px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .btn-submit {
            background-color: var(--accent-color);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 6px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #2980b9;
            transform: translateY(-1px);
        }

        /* Search Bar Styles */
        .search-form {
            max-width: 300px;
        }

        .search-form .form-control {
            border-radius: 20px;
            padding-left: 1rem;
        }

        .search-form .btn {
            border-radius: 20px;
        }

        /* Responsive Styles */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .navbar-toggler {
                display: block;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="main-header">
        <nav class="navbar navbar-expand-lg navbar-dark h-100">
            <div class="container-fluid">
                <button class="navbar-toggler border-0" type="button" id="sidebarToggle">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <i class="fas fa-book-reader me-2"></i>
                    Ashu's Library
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="studentTestsDropdown"
                                data-bs-toggle="dropdown">
                                <i class="fas fa-tasks me-1"></i> Student Tests
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../student tests/index.php">Set test</a></li>
                                <li><a class="dropdown-item" href="#">View Result</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="libraryDataDropdown"
                                data-bs-toggle="dropdown">
                                <i class="fas fa-database me-1"></i> Library Data
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action 1</a></li>
                                <li><a class="dropdown-item" href="#">Action 2</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="search-form d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search books..."
                            aria-label="Search">
                        <button class="btn btn-outline-light" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-card">
            <h1 class="text-center mb-4">Allot Book To Student</h1>
            <form>
                <div class="row">
                    <!-- Class Selection -->
                    <div class="col-md-6 mb-3">
                        <label for="s_class" class="form-label">Select Class</label>
                        <select class="form-select" name="s_class" id="s_class">
                            <option selected disabled>Select Class</option>
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Section Selection -->
                    <div class="col-md-6 mb-3">
                        <label for="section" class="form-label">Select Section</label>
                        <select class="form-select" name="section" id="section">
                            <option selected disabled>Select Section</option>
                            <option value="A">Section A</option>
                            <option value="B">Section B</option>
                            <option value="C">Section C</option>
                            <option value="D">Section D</option>
                        </select>
                    </div>

                    <!-- Student Selection -->
                    <div class="col-md-6 mb-3">
                        <label for="s_name" class="form-label">Student Name</label>
                        <select class="form-select" name="s_name" id="s_name">
                            <option selected disabled>Select Student</option>
                        </select>
                    </div>

                    <!-- Book Code with Autocomplete -->
                    <div class="col-md-6 mb-3">
                        <label for="book" class="form-label">Book Code</label>
                        <div class="position-relative">
                            <input type="text" class="form-control" name="book" id="book" placeholder="Enter Book Code"
                                autocomplete="off" />
                            <div id="list" class="position-absolute w-100 mt-1 bg-white border rounded shadow-sm"
                                style="display: none; z-index: 1000;">
                                <ul class="list-group list-group-flush">
                                    <!-- Autocomplete items will be inserted here -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-4">
                    <button type="submit" name="btn" id="btn" class="btn btn-submit w-100">
                        <i class="fas fa-book me-2"></i>Allot Book
                    </button>
                </div>
            </form>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function () {
            document.querySelector('.sidebar').classList.toggle('show');
        });

        // Hide sidebar when clicking outside on mobile
        document.addEventListener('click', function (event) {
            const sidebar = document.querySelector('.sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');

            if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                sidebar.classList.remove('show');
            }
        });
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
            $("#list li").click(function (e) {
                e.preventDefault();
                var book = $('#book').val(this);
            });

            $('#book').keyup(function () {
                var book = $(this).val();
                console.log(book)
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

            $('#btn').click(function (e) {
                e.preventDefault();
                var s_name = $('#s_name').val();
                var class_id = $('#s_class').val();
                var section = $('#section').val();
                var book_code = $('#book').val();
                $.ajax({
                    type: "Post",
                    url: "allot_book.php",
                    data: {
                        s_name: s_name,
                        class: class_id,
                        section: section,
                        book_code: book_code
                    },
                    success: function (response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
</body>

</html>