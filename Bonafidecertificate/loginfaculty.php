<?php
session_start();
error_reporting(0);
if (isset($_SESSION["emailfaculty"])) {
    header("Location: dashboardfaculty.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Faculty</title>
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
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>

<body style="background-color: rgb(10, 150, 201)">

    <div class="mainbox">

        <form action="loginfaculty.php" method="post">

            <div class="innerform">

                <div class="heading">
                    <h1> Faculty Login</h1>
                </div>

                <!-- 
                    php start
                 -->
                <div class="alerts">
                    <?php
                    if (isset($_POST['submit'])) {
                        $facultyid = $_POST["facultyid"];
                        $password = $_POST["password"];
                        // echo "$password";
                        // echo "$ids";
                        require_once "database.php";
                        $sql = "SELECT * FROM `signup`.`faculty_data` WHERE facultyid = '$facultyid';";


                        $result = mysqli_query($conn, $sql);
                        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

                        if ($user) {
                            // echo password_verify($password, $user["password"]);
                    

                            if (password_verify($password, $user["password"])) {

                                session_start();
                                // echo " suceessfull";
                                $_SESSION["user"] = "yes";
                                $_SESSION["emailfaculty"] = $user["email"];
                                ?>

                    <?php
                                echo "<script>alert('Login Successfully...');</script>";
                                ?>
                    <?php
                                echo "<script>window.location.href='http://localhost/login/dashboardfaculty.php';</script>";
                                exit;
                                ?>

                    <?php
                                die();
                            } else {
                                echo "<div class='alert alert-danger'>Password does not match</div>";
                            }

                            
                            
                        } else {
                             echo "<div class='alert alert-danger'>Email does not match</div>";
                        }

                    }

                    ?>

                </div>


                <div class="inputbox">
                    Faculty Id:<input type="text" name="facultyid" id="facultyid" placeholder="Enter Your Faculty ID">
                </div>

                <div class="inputbox">
                    Enter Password:<input type="password" name="password" id="password" placeholder="Enter Password">
                </div>

                <div>
                    <input class="btn" type="submit" value="Login" name="submit" id="submit"
                        style="cursor:pointer; background-color: rgb(10, 150, 201) ; color : white ; padding: 10px; ">
                </div>

                <div style="text-align: center">
                    <br>
                    Don't have an account?<a class="linktogootherpage"
                        href="http://localhost/login/registrationfaculty.php" id="linktogootherpage"> New Faculty?</a>
                    <br>
                    Are You Student?<a class="linktogootherpage" href="http://localhost/login/loginstudent.php"
                        id="linktogootherpage"> Student Login?</a>
                </div>

            </div>

        </form>
    </div>

</body>

</html>