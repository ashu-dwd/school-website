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
                    <a class="nav-link dropdown-toggle" href="#" id="studentTestsDropdown" data-bs-toggle="dropdown">
                        <i class="fas fa-tasks me-1"></i> Student Tests
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../student tests/index.php">Set test</a></li>
                        <li><a class="dropdown-item" href="#">View Result</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="libraryDataDropdown" data-bs-toggle="dropdown">
                        <i class="fas fa-database me-1"></i> Library Data
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action 1</a></li>
                        <li><a class="dropdown-item" href="#">Action 2</a></li>
                    </ul>
                </li>
            </ul>
            <form class="search-form d-flex">
                <input class="form-control me-2" type="search" placeholder="Search books..." aria-label="Search">
                <button class="btn btn-outline-light" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
</nav>