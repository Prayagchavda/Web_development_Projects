<?php
session_start();
error_reporting(0);
if (isset($_SESSION["email"])) {
    header("Location: dashboardstudent.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Student Registration</title>
    <style>
        body {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</head>

<body style="background-color: rgb(10, 150, 201)">

    <div class="mainbox">

        <form action="registrationstudent.php" method="post" enctype="multipart/form-data">

            <div class="innerform">

                <div class="heading">
                    <h1>Student Sign Up</h1>
                </div>

                <!-- 
                    php start
                 -->
                <div class="alerts">

                    <?php

                    $msg = "";

                    // If upload button is clicked ...
                    if (isset($_POST['submit'])) {





                        // Get all the submitted data from the form
                    

                        // Execute query
                    

                        // Now let's move the uploaded image into the folder: image
                        // if (move_uploaded_file($tempname, $folder)) {
                        //     echo "<h3>  Image uploaded successfully!</h3>";
                        // } else {
                        //     echo "<h3>  Failed to upload image!</h3>";
                        // }
                    }
                    ?>


                </div>

                <!-- INSERT INTO `student_data` (`enrollment`, `name`, `email`, `number`, `password`, `sem`, `branch`) VALUES ('210130107001', 'Vraj shah', 'vs@gmail.com', '99999999999', 'vs', '6', 'computer'); -->


                <div class="inputbox">
                    Enrollment:<input type="text" name="enrollment" id="enrollment"
                        placeholder="Enter Your Enrollment number">
                </div>

                <div class="inputbox">
                    Name:<input class="inputtags" type="text" name="name" id="name" placeholder="Enter Your Name">
                </div>


                <div class="inputbox">
                    Email:<input type="email" name="email" id="email" placeholder="Enter Your email">
                </div>

                <div class="inputbox">
                    Mobile No.:<input type="text" name="number" id="number" placeholder="Enter Mobile Number">
                </div>

                <div class="inputbox">
                    Password:<input type="password" name="password" id="password" placeholder="Password">
                </div>


                <div class="inputbox">
                    Re-Enter:<input type="password" name="repeat_password" id="repeat_password"
                        placeholder="ReEnter Password">
                </div>

                <div class="inputbox">
                    Semester:<input type="text" name="sem" id="sem" placeholder="Enter Current Semester">
                </div>

                <div class="inputbox">
                    Branch:<input type="text" name="branch" id="branch" placeholder="Enter Branch">
                </div>
                <div class=" ">
                    Upload Photo:<input type="file" name="uploadfile" id="uploadfile">
                </div>

                <?php
                if (isset($_POST['submit'])) {


                    $server = "localhost";
                    $user = "root";
                    $password = "";

                    $conn = mysqli_connect($server, $user, $password);

                    if (!$conn) {
                        // echo " there is a error in db connection";
                    } else {
                        // echo " db connected successfully ";
                    }

                    $enrollment = $_POST['enrollment'];
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $number = $_POST["number"];
                    $sem = $_POST["sem"];
                    $branch = $_POST["branch"];
                    $repeat_password = $_POST["repeat_password"];
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);


                    // file upload part
                    $filename = $_FILES["uploadfile"]["name"];
                    $tempname = $_FILES["uploadfile"]["tmp_name"];
                    $folder = "./images/" . $filename;

                    $errors = array();

                    if (empty($name) or empty($email) or empty($password) or empty($repeat_password)) {
                        array_push($errors, "All fields are required");
                    }
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        array_push($errors, "Email is not valid");
                    }
                    // if (strlen($password)<8) {
                    //     array_push($errors,"Password must be at least 8 charactes long");
                    // }
                    if ($password !== $repeat_password) {
                        array_push($errors, "Password does not match");
                    }


                    $sqll = "SELECT * FROM signup.student_data WHERE email = '$email'";
                    $sqlq = "SELECT * FROM signup.student_data WHERE enrollment = '$enrollment'";

                    $result = mysqli_query($conn, $sqll);
                    $resultid = mysqli_query($conn, $sqlq);
                    $rowCount = mysqli_num_rows($result);
                    $rowCountid = mysqli_num_rows($resultid);

                    if ($rowCount > 0) {
                        array_push($errors, "Email already exists!");
                    }

                    if ($rowCountid > 0) {
                        array_push($errors, "enrollment  already exists!");
                    }

                    if (count($errors) > 0) {
                        foreach ($errors as $error) {
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                    } else {



                        $sql = "INSERT INTO `signup`.`student_data` (`enrollment`, `name`, `email`, `number`, `password`, `sem`, `branch`,`file`) VALUES ('$enrollment', '$name','$email','$number','$passwordHash', '$sem','$branch','$filename');";

                        if ($conn->query($sql) == true) {
                            ?>

                            <?php
                                echo "<script>alert('Sign Up Successfully...');</script>";
                            ?>
                            <?php
                            echo "<script>window.location.href='http://localhost/login/loginstudent.php';</script>";
                            exit;
                            ?>

                            <?php
                        } else {
                            echo "failed to registration";
                        }

                        echo "<div class='alert alert-success'>Form submitted</div>";
                        mysqli_close($conn);
                    }

                }

                ?>

                <div>
                    <input class="btn" type="submit" value="Register" name="submit" id="submit"
                        style="cursor:pointer; background-color: rgb(10, 150, 201) ; color : white ; margin-top: 20px; padding: 10px; ">
                </div>

                <div style="text-align: center">
                    <br>
                    Already Register?<a class="linktogootherpage" href="http://localhost/login/loginstudent.php"
                        id="linktogootherpage"> Login? </a>
                    <br>
                    Are You Faculty?<a class="linktogootherpage" href="http://localhost/login/loginfaculty.php"
                        id="linktogootherpage"> Faculty Login? </a>
                </div>

            </div>

        </form>

    </div>

    <script src="script.js"></script>

</body>

</html>