<?php
session_start();
error_reporting(0);
require_once 'database.php';

if (isset($_SESSION['email'])) {
    if ($_SESSION['email'] != NULL) {
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM `signup`.`student_data` WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
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
        <style>body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .mainbox {
            width: 400px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .innerform {
            padding: 20px;
        }

        .heading {
            color: gray;
            text-align: center;
            margin-bottom: 20px;
        }

        .inputbox {
            margin-bottom: 20px;
        }

        .inputbox input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .alerts {
            margin-bottom: 20px;
        }

        .btn {
            width: 100%;
            margin: auto;
            margin-top: 10px;
            text-align: center;
        }

        .linktogootherpage {
            color: rgb(10, 150, 201);
            text-decoration: none;
            text-align: center;
        }

        .lower {
            margin-top: 50px;
            justify-content: space-between;
        }
    </style>
    </style>

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Apply For Bonafide</title>
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
                <li><a href="http://localhost/login/dashboardstudent.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Student Dahsboard</span>
                    </a></li>
                <li><a href="http://localhost/login/Bonafideform.php">
                        <i class="uil uil-files-landscapes"></i>
                        <span class="link-name">Apply for Bonafide</span>
                    </a>
                </li>
                <li><a href="http://localhost/login/viewhistorystudent.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">View Bonafide Application History</span>
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
            <img src="./images/<?php echo $user['file']; ?>" alt>
        </div>
        <div class="dash-content">
            <div class="container">
            <form action="Bonafideform.php" method="post">

<div class="innerform">

    <div class="heading">
        <h2>Apply for Bonafide</h2>
    </div>

    <!-- 
php start
-->
    <div class="alerts">
        <?php

        if (isset($_POST['submit'])) {

            $server = "localhost";
            $user = "root";
            $password = "";

            $conn = mysqli_connect($server, $user, $password);

            if (!$conn) {
                echo " there is a error in db connection";
            } else {
                // echo " db connected successfully ";
            }

            $enrollment = $_POST['enrollment'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $number = $_POST['number'];
            $sem = $_POST['sem'];
            $branch = $_POST['branch'];
            $facultyid = $_POST['facultyid'];
            $facultyemail = $_POST['facultyemail'];
            $reason = $_POST['reason'];


            $errors = array();

            if (empty($name) or empty($email)) {
                array_push($errors, "All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }
            // if (strlen($password)<8) {
            //     array_push($errors,"Password must be at least 8 charactes long");
            // }
        


            $sqll = "SELECT * FROM signup.faculty_data WHERE email = '$facultyemail'";
            $sqlq = "SELECT * FROM signup.faculty_data WHERE facultyid = '$facultyid'";

            $result = mysqli_query($conn, $sqll);
            $resultid = mysqli_query($conn, $sqlq);
            $rowCount = mysqli_num_rows($result);
            $rowCountid = mysqli_num_rows($resultid);
            if ($rowCount > 0) {

            } else {
                array_push($errors, "Email does not exists!");
            }

            if ($rowCountid > 0) {

            } else {
                array_push($errors, "facultyid does not exists!");
            }

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {

                $sql = "INSERT INTO `signup`.`bonafide_data` (`enrollment`, `name`, `number`, `sem`, `branch`, `email`, `facultyid`, `facultyemail`, `reason`, `date`, `status`) VALUES ('$enrollment', '$name', '$number', '$sem', '$branch', '$email', '$facultyid', '$facultyemail', '$reason', current_timestamp(), 'Pending');";

                if ($conn->query($sql) == true) {
                    ?><?php
                    echo "<script>window.location.href='http://localhost/login/viewhistorystudent.php';</script>";
                    exit;
                    ?>
                    <?php

                } else {
                    echo "failed to apply bonafide certificate";
                }

                echo "<div class='alert alert-success'>Form submitted</div>";
                mysqli_close($conn);
            }

        }

        ?>

        <!-- INSERT INTO `faculty_data` (`facultyid`, `name`, `email`, `number`, `password`, `role`) VALUES ('1', 'sssss', 'ss@gmail.com', '23232332323', 'aa', 'faculty'); -->

    </div>


    <div class="inputbox">
        Enrollment:<input type="text" name="enrollment" id="enrollment"
            placeholder="Enter Your enrollment" value="<?php echo $user["enrollment"]; ?>" required>
    </div>

    <div class="inputbox">
        Name:<input class="inputtags" type="text" name="name" id="name" placeholder="Enter Your Name"
            value="<?php echo $user["name"]; ?>" required>
    </div>


    <div class="inputbox">
        Email:<input type="email" name="email" id="email" placeholder="Enter Your Email"
            value="<?php echo $user["email"]; ?>" required>
    </div>

    <div class="inputbox">
        Mobile No.:<input type="number" name="number" id="number" placeholder="Enter Your Mobile No."
            value="<?php echo $user["number"]; ?>" required>
    </div>

    <div class="inputbox">
        Semester:<input type="number" name="sem" id="sem" placeholder="Enter Your Semester"
            value="<?php echo $user["sem"]; ?>" required>
    </div>


    <div class="inputbox">
        Branch Name:<input type="text" name="branch" id="branch" placeholder="Enter Your Branch"
            value="<?php echo $user["branch"]; ?>" required>
    </div>

    <div class="inputbox">
        Faculty ID:<input type="text" name="facultyid" id="facultyid"
            placeholder="Enter Your Faculty ID" required>
    </div>

    <div class="inputbox">
        Faculty Email:<input type="text" name="facultyemail" id="facultyemail"
            placeholder="Enter Your Faculty Email" required>
    </div>

    <div class="inputbox">
        Reason for Bonafide::<input type="text" name="reason" id="reason"
            placeholder="Enter Your Reason" required>
    </div>

    <div>
        <input class="btn" type="submit" value="Apply" name="submit" id="submit"
            style="cursor:pointer; background-color: rgb(10, 150, 201) ; color : white ; margin-top: 20px; padding: 10px; ">
    </div>
</div>

</form>
            </div>
            
            <script src="js/script1.js"></script>
</body>

</html>