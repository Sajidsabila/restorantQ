<?php
include ("../config/database.php");

session_start();
//ini bukan $_GET tapi $_SESSION
if (!isset($_SESSION["user_id"])) {
    header('Location: ../auth?status=akses_denied');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <style>
        .hilang {
            display: none;
        }
    </style>
    <title>RestaurantQ</title>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">ResataurantQ</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body bg-dark">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link  <?= str_contains($_SERVER['REQUEST_URI'], 'dashboard') ? 'active' : ""; ?>"
                                aria-current="page" href="../dashboard">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link  <?= str_contains($_SERVER['REQUEST_URI'], 'user') || str_contains($_SERVER['REQUEST_URI'], 'category') ? 'active' : ""; ?> dropdown-toggle"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Master Data
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../user">User</a></li>
                                <li><a class="dropdown-item" href="../category">Category</a></li>
                                <li><a class="dropdown-item" href="../menus">Menus</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link  <?= str_contains($_SERVER['REQUEST_URI'], 'receipt') || str_contains($_SERVER['REQUEST_URI'], 'recipts') ? 'active' : ""; ?> dropdown-toggle"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Transaction
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../receipt">receipts</a></li>
                                <li><a class="dropdown-item" href="../report">Report</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../auth/logout-process.php">Logout</a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </nav>