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
    <nav class="sidebar">
        <div class="py-3 px-4 border-bottom">
            <h5 class="mb-0"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</h5>
        </div>
        <ul class="nav flex-column py-2">
            <li class="nav-item">
                <a class="nav-link active" href="index.php">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add-new-book.php">
                    <i class="fas fa-plus-circle"></i> Add New Book
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-history"></i> Book History
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-edit"></i> Update Book Data
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-money-bill"></i> Student Fine Data
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-card">
            <h2 class="mb-4">Add New Book</h2>
            <form action="" method="post">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="book_name" class="form-label">Book Name</label>
                        <input type="text" class="form-control" name="book_name" id="book_name"
                            placeholder="Enter book name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="book_type" class="form-label">Book Type</label>
                        <select class="form-select" name="book_type" id="book_type">
                            <option selected disabled>Select Book Type</option>
                            <optgroup label="General">
                                <option value="reference">Reference Book</option>
                                <option value="dictionary">Dictionary</option>
                                <option value="fiction">Fiction</option>
                                <option value="biography">Biography</option>
                            </optgroup>
                            <optgroup label="Academic">
                                <option value="mathematics">Mathematics</option>
                                <option value="science">Science</option>
                                <option value="physics">Physics</option>
                                <option value="chemistry">Chemistry</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="book_code" class="form-label">Book Code</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="book_code" id="book_code"
                                placeholder="Book code will be generated" readonly>
                            <button class="btn btn-outline-secondary" onclick="code()" type="button">
                                <i class="fas fa-sync-alt"></i> Generate
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" id="submit" class="btn btn-submit">
                        <i class="fas fa-save me-2"></i> Submit Book
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

        function generateBookCode(subject) {
            // Generate the randomized structure
            const part1 = Math.random().toString(36).substring(2, 4).toUpperCase(); // 2 characters
            const part2 = Math.floor(Math.random() * 10); // 1 digit
            const part3 = Math.floor(Math.random() * 10); // 1 digit
            const part4 = Math.random().toString(36).substring(2, 4).toUpperCase(); // 2 characters

            // Get the first word of the subject
            const firstWord = subject.split(" ")[0].toUpperCase();

            // Combine all parts
            return `${part1}${part2}${part3}${part4}-${firstWord}`;
        }

        // Get the select element by its ID
        var bookTypeSelect = document.getElementById('book_type');

        // Add an event listener to handle changes
        bookTypeSelect.addEventListener('change', function () {
            // Get the selected value
            var subject = bookTypeSelect.value;

            // Call the code function with the selected subject
            return code(subject);
        });

        // Function to generate and set the book code
        function code(subject) {
            // Generate the book code using the selected subject
            var bookCode = generateBookCode(subject);

            // Set the generated book code in the input field with ID 'book_code'
            document.getElementById('book_code').value = bookCode;
        }
    </script>
    <script>
        $(document).ready(function () {
            $('#submit').click(function (e) {
                e.preventDefault();
                var bookTypeSelect = $('#book_type').val();
                var bookCodeInput = $('#book_code').val();
                var bookName = $('#book_name').val();
                alert(bookCodeInput + " " + bookTypeSelect);
                $.ajax({
                    type: "post",
                    url: "adding-book.php",
                    data: {
                        bookType: bookTypeSelect,
                        bookCode: bookCodeInput,
                        bookName: bookName
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