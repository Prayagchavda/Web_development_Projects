<?php
session_start();
error_reporting(0);
if (!isset ($_SESSION["emailfaculty"])) {
    header("Location: loginfaculty.php");
}
?>


<?php

require_once 'database.php';

if (isset ($_SESSION['emailfaculty'])) {
    if ($_SESSION['emailfaculty'] != NULL) {
        $emailfaculty = $_SESSION['emailfaculty'];
        $sql = "SELECT * FROM signup.faculty_data WHERE email = '$emailfaculty'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $rowCount = mysqli_num_rows($result);

    }
} else {
    echo "not set a session email";
}

?>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset ($_POST['accept'])) {

        $sno = $_POST['sno'];

        $sqlupdate = "UPDATE signup.bonafide_data SET status = 'accept' WHERE bonafide_data.serialnumber = '{$sno}'";
        $resultupdate = mysqli_query($conn, $sqlupdate);

        $enrollment = $_POST['enrollmentnumber'];

        $sqlphoto = "SELECT * FROM signup.student_data WHERE enrollment = '{$enrollment}'";
        $resultphoto = mysqli_query($conn, $sqlphoto);
        $userphoto = mysqli_fetch_array($resultphoto, MYSQLI_ASSOC);
        echo '$userphoto["file"]';

        $sqlcertificate = "SELECT * FROM signup.bonafide_data WHERE serialnumber = '{$sno}'";
        $resultcertificate = mysqli_query($conn, $sqlcertificate);
        $usercertificate = mysqli_fetch_array($resultcertificate, MYSQLI_ASSOC);


        if ($usercertificate && $resultupdate && $userphoto) {

            $font = "Arial.ttf";
            $image = imagecreatefromjpeg("Truecertificate.jpeg");
            ;
            $photo = imagecreatefromjpeg("images/" . $userphoto["file"]);

            $photoWidth = imagesx($photo);
            $photoHeight = imagesy($photo);


            $newPhotoWidth = 142; // Adjust as needed
            $newPhotoHeight = 142; // Adjust as needed
            $resizedPhoto = imagecreatetruecolor($newPhotoWidth, $newPhotoHeight);
            imagecopyresampled($resizedPhoto, $photo, 0, 0, 0, 0, $newPhotoWidth, $newPhotoHeight, $photoWidth, $photoHeight);

            // $positionX = 690; // Adjust as needed
            // $positionY = 315; // Adjust as needed
            imagecopy($image, $resizedPhoto, 690, 310, 0, 0, $newPhotoWidth, $newPhotoHeight);
            imagecopy($image, $resizedPhoto, 693, 838, 0, 0, $newPhotoWidth, $newPhotoHeight);
            $color = imagecolorallocate($image, 19, 21, 22);
            $name = $usercertificate["name"];
            $semester = $usercertificate["sem"];
            $branch = $usercertificate["branch"];
            $enrollment = $usercertificate["enrollment"];
            $reason = $usercertificate["reason"];

            imagettftext($image, 10, 0, 460, 483, $color, $font, $name);
            imagettftext($image, 10, 0, 400, 999, $color, $font, $name);
            imagettftext($image, 10, 0, 470, 506, $color, $font, $semester);
            imagettftext($image, 10, 0, 535, 506, $color, $font, $branch);
            imagettftext($image, 10, 0, 250, 1075, $color, $font, $branch);
            imagettftext($image, 10, 0, 185, 527, $color, $font, $enrollment);
            imagettftext($image, 10, 0, 362, 1036, $color, $font, $enrollment);
            imagettftext($image, 10, 0, 680, 565, $color, $font, $reason);
            imagettftext($image, 10, 0, 260, 1113, $color, $font, $reason);


            imagejpeg($image, "certificate/" . $usercertificate["serialnumber"] . ".jpg");

            $imagecertificate = "certificate/" . $usercertificate["serialnumber"] . ".jpg";
            imagedestroy($image);

            echo "image generated!!";

            include ('smtp/PHPMailerAutoload.php');
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = "gecgian28@gmail.com";
            $mail->Password = "ywtk mnkz dqhd ccub";
            $mail->setFrom("gecgian28@gmail.com");
            // $mail->addAddress("parmarbrijesh2054@gmail.com");
            // $mail->addAddress("chavdaprayag0@gmail.com");
            // $mail->addAddress("blurxslr11@gmail.com");
            $mail->addAddress($usercertificate["email"]);
            $mail->isHTML(true);
            // $mail->SMTPDebug = 1;  
            $mail->Subject = "Certificate Generated";
            $mail->Body = "Certificate Generated";
            $imagefilepath = "certificate/" . $usercertificate["serialnumber"] . ".jpg";
            $mail->addAttachment($imagecertificate);
            $mail->SMTPOptions = array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer-name" => false,
                    "allow_self_signed" => false,
                )
            );

            if (!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {

                echo 'Message has been sent';

            }

        }
    }

    if (isset ($_POST['reject'])) {
        $sno = $_POST['sno'];
        $sqlupdate = "UPDATE signup.bonafide_data SET status = 'reject' WHERE bonafide_data.serialnumber = '{$sno}'";

        $resultallupdate = mysqli_query($conn, $sqlupdate);

        if ($resultallupdate) {

        }
    }

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

        * {
            margin: 0;
            padding: 0;
        }
    </style>

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Bonafide Application</title>
</head>

<body style="background-color: white;">
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
            <h1 style="text-align:center;">Bonafide Applications</h1>
            <br>
            <table>
                <thead>
                    <tr>
                        <th>Enrollment</th>
                        <th>Date and Time</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <?php
                if ($user["email"] != null) {

                    $sqlall = "SELECT * FROM signup.bonafide_data WHERE facultyemail = '{$user["email"]}'";
                    $resultall = mysqli_query($conn, $sqlall);


                    $rowCountall = mysqli_num_rows($resultall);



                    while ($allrowsone = mysqli_fetch_array($resultall, MYSQLI_ASSOC)) {

                        echo "<tbody>";
                        ?>

                        <?php
                        if ($rowCountall > 0 && ($allrowsone["status"] != "accept" && $allrowsone["status"] != "reject")) {
                            echo " <tr>
                <td>{$allrowsone["enrollment"]}</td>
                <td>{$allrowsone["date"]}</td>
                <td>{$allrowsone["reason"]}</td>
                <td>{$allrowsone["status"]}</td>
                <td>";
                            ?>

                            <form action="acceptrequest.php" method="post">

                                <input type="hidden" name="sno" value="<?php
                                echo $allrowsone['serialnumber'];
                                ?>">

                                <input type="hidden" name="enrollmentnumber" value="<?php
                                echo $allrowsone['enrollment'];
                                ?>">


                                <?php

                                if ($allrowsone['status'] == "pending" || $allrowsone['status'] == "Pending") {

                                    ?>

                                    <input type="submit" value="accept" id="accept" name="accept">
                                    <input type="submit" value="reject" id="reject" name="reject">

                                    <?php
                                }

                                ?>

                                <?php

                                if ($allrowsone['status'] == "reject") {

                                    echo 'rejected';

                                }

                                ?>

                                <?php

                                if ($allrowsone['status'] == "accept") {

                                    echo 'accepted';
                                }

                                ?>

                            </form>

                            <?php
                            echo "</td>

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