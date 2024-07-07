<?php
session_start();
if (!isset($_SESSION["emailfaculty"])) {
    header("Location: loginfaculty.php");
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="css/style1.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Faculty Dashboard Panel</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo.png" alt="">
            </div>
            <span class="logo_name">Government Engineering College Sector-28</span>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="http://localhost/login/dashboardfaculty.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Faculty Dashboard</span>
                    </a></li>
                    <li><a href="http://localhost/login/acceptrequest.php">
                        <i class="uil uil-files-landscapes"></i>
                        <span class="link-name">View Bonafide Application</span>
                    </a>
                </li>
                    <li><a href="http://localhost/login/viewhistoryfaculty.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">View History</span>
                    </a>
                </li>
            </ul>

            <ul class="logout-mode">
                <li><a href="http://localhost/login/logout.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a></li>
                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <!-- <span class="link-name">Dark Mode</span> -->
                    </a>
                    <div class="mode-toggle">
                        <!-- <span class="switch"></span> -->
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

        </div>
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Faculty Dashboard</span>
                </div>
                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-user"></i>
                        <span class="text">Name</span>
                        <h3>
                            <?php

                            require_once 'database.php';

                            if (isset($_SESSION['emailfaculty'])) {
                                if ($_SESSION['emailfaculty'] != NULL) {
                                    $email = $_SESSION['emailfaculty'];
                                    $sql = "SELECT * FROM `signup`.`faculty_data` WHERE email = '$email'";
                                    $result = mysqli_query($conn, $sql);
                                    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                    $rowCount = mysqli_num_rows($result);
                                    echo $user["name"];
                                }
                            } else {
                                echo "not set a session email";
                            }

                            ?>
                        </h3>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-info-circle"></i>
                        <span class="text">Faculty Id</span>
                        <h3>
                            <?php

                            if (isset($_SESSION['emailfaculty'])) {
                                if ($_SESSION['emailfaculty'] != NULL) {

                                    echo $user["facultyid"];

                                }
                            } else {
                                echo "not set a session email";
                            }

                            ?>
                        </h3>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-envelopes"></i>
                        <span class="text">Email</span>
                        <h3>
                            <?php


                            if (isset($_SESSION['emailfaculty'])) {
                                if ($_SESSION['emailfaculty'] != NULL) {

                                    echo $user["email"];
                                }
                            } else {
                                echo "not set a session email";
                            }

                            ?>
                        </h3>
                    </div>
                    <div class="box box1">
                        <i class="uil uil-phone"></i>
                        <span class="text">Contact No</span>
                        <h3>
                            <?php

                            if (isset($_SESSION['emailfaculty'])) {
                                if ($_SESSION['emailfaculty'] != NULL) {

                                    echo $user["number"];
                                }
                            } else {
                                echo "not set a session email";
                            }

                            ?>
                        </h3>
                    </div>
                </div>
            </div>
            <script src="js/script1.js"></script>
</body>

</html>