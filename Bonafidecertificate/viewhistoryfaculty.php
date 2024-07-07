<?php
session_start();
if (!isset ($_SESSION["emailfaculty"])) {
    header("Location: loginfaculty.php");
}
?>

<?php

require_once 'database.php';

if (isset ($_SESSION['emailfaculty'])) {
    if ($_SESSION['emailfaculty'] != NULL) {
        $email = $_SESSION['emailfaculty'];
        $sql = "SELECT * FROM `signup`.`faculty_data` WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        echo "$user";
        $rowCount = mysqli_num_rows($result);

    }
} else {
    echo "not set a session email";
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="css/style1.css">
    <style>
        .dashboard .dash-content{
                padding-top: 0px;
            }
        body {
            background-color: white;
            font-family: Arial, sans-serif;
        }

        .heading {
            color: gray;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
    </style>

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>View Bonafide Application History</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo.png" alt>
            </div>
            <span class="logo_name">Government Engineering College
                Sector-28</span>
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
            <h2 style="text-align:center;">Bonafide Application History</h2>
            <br>

            <table>
                <thead>
                    <tr>
                        <th>Enrollment</th>
                        <th>Date and Time</th>
                        <th>Reason</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <?php
                if ($user["email"] != null) {
                    // echo $user["email"]."end here of name";
                    $sqlall = "SELECT * FROM `signup`.`bonafide_data` WHERE facultyemail = '{$user['email']}'";
                    $resultall = mysqli_query($conn, $sqlall);
                    $rowCountall = mysqli_num_rows($resultall);

                    // echo $rowCountall."end here of count";
                

                    while (($allrowsone = mysqli_fetch_array($resultall, MYSQLI_ASSOC)) && $rowCountall > 0) {
                        // echo "$allrowsone";
                
                        echo "<tbody>";
                        if ($rowCountall > 0) {
                            echo " <tr>
                        <td>{$allrowsone["enrollment"]}</td>
                        <td>{$allrowsone["date"]}</td>
                        <td>{$allrowsone["reason"]}</td>
                        <td>{$allrowsone["status"]}</td> 

                        </tr>";

                        }
                    }

                    echo "</tbody>";

                } else {
                    echo "<div class='alert alert-danger'>Email does not match</div>";
                }


                ?>

            </table>
            <script src="js/script1.js"></script>
</body>

</html>