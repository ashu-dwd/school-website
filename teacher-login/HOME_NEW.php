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
    <title>Teacher Dashboard - Ashu's Classroom</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #34495e;
        --accent-color: #3498db;
        --success-color: #2ecc71;
        --warning-color: #f1c40f;
        --danger-color: #e74c3c;
    }

    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .navbar {
        background-color: var(--primary-color) !important;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .welcome-section {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 2rem;
        border-radius: 10px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .stats-card {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
    }

    .notification-card {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        border-left: 4px solid var(--accent-color);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .quick-actions {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .action-button {
        padding: 1rem;
        border-radius: 8px;
        border: none;
        background-color: var(--accent-color);
        color: white;
        transition: all 0.3s ease;
    }

    .action-button:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
    }

    .footer {
        background-color: var(--primary-color);
        color: white;
        padding: 1.5rem 0;
        margin-top: 3rem;
    }

    .alert-success {
        border-left: 4px solid var(--success-color);
    }

    .notification-date {
        color: #666;
        font-size: 0.9rem;
    }

    .icon-stat {
        font-size: 2rem;
        color: var(--accent-color);
    }
    </style>
</head>

<body>
    <header>
        <?php include("nav.php"); ?>
    </header>

    <main>
        <div class="container mt-4">
            <!-- Success Alert -->
            <?php
            if ($_GET) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" id="btn"></button>
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Exam Set Successfully!</strong> Students can now start the test.
                </div>';
            }
            ?>

            <!-- Welcome Section -->
            <div class="welcome-section">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1><i class="fas fa-chalkboard-teacher me-3"></i>Welcome, <?php echo $_SESSION['t_id']; ?>!
                        </h1>
                        <p class="lead mb-0">Manage your virtual classroom and track student progress</p>
                    </div>
                    <!-- <div class="col-md-4 text-end">
                        <button class="btn btn-light action-button" >
                            <i class="fas fa-plus me-2"></i>Create New Exam
                        </button>
                    </div> -->
                </div>
            </div>

            <!-- Stats Section -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0">24</h3>
                                <p class="text-muted mb-0">Absent Students</p>
                            </div>
                            <i class="fas fa-users icon-stat"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0">5</h3>
                                <p class="text-muted mb-0">Active Exams</p>
                            </div>
                            <i class="fas fa-file-alt icon-stat"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stats-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-0">89%</h3>
                                <p class="text-muted mb-0">Average Score</p>
                            </div>
                            <i class="fas fa-chart-line icon-stat"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions mb-4">
                <h4 class="mb-3"><i class="fas fa-bolt me-2"></i>Quick Actions</h4>
                <div class="row g-3">
                    <div class="col-md-3">
                        <button class="btn btn-primary w-100">
                            <i class="fas fa-plus-circle me-2"></i>New Assignment
                        </button>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-info w-100 text-white">
                            <i class="fas fa-video me-2"></i>Start Class
                        </button>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-success w-100">
                            <i class="fas fa-chart-bar me-2"></i>View Reports
                        </button>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-warning w-100">
                            <i class="fas fa-bell me-2"></i>Announcements
                        </button>
                    </div>
                </div>
            </div>

            <!-- Notifications Section -->
            <div class="notifications-section">
                <h4 class="mb-3"><i class="fas fa-bell me-2"></i>Recent Notifications</h4>
                <?php
                include("teacher_db.php");
                $sql = "SELECT * FROM `notifications` ORDER BY `date` ASC";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="notification-card">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Notification From Admin</h5>
                                <span class="notification-date"><i class="fas fa-calendar-alt me-2"></i>' . $row['date'] . '</span>
                            </div>
                            <p class="mb-0">' . $row['notifi_text'] . '</p>
                        </div>';
                    }
                }
                ?>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="container text-center">
            <p class="mb-0">© 2024 Ashu's Classroom | All Rights Reserved</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
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

        // Add smooth scrolling
        $('a[href*="#"]').on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $($(this).attr('href')).offset().top
            }, 500, 'linear');
        });

        // Add hover effect to cards
        $('.stats-card').hover(
            function() {
                $(this).addClass('shadow-lg');
            },
            function() {
                $(this).removeClass('shadow-lg');
            }
        );
    });
    </script>
</body>

</html>