<?php
    header("content-type:image/jpeg");
    $font = "Arial.ttf";
    $image = imagecreatefromjpeg("Truecertificate.jpg");
    $color = imagecolorallocate($image,19,21,22);
    $name = "Solanki Ram";
    $semester = "6";
    $branch = "CE";
    $enrollment = "210130107027";
    $reason = "For Gaming Pc";


    imagettftext($image,20,0,800,580,$color,$font,$name);
    imagettftext($image,20,0,888,635,$color,$font,$semester);
    imagettftext($image,20,0,1180,635,$color,$font,$branch);
    imagettftext($image,20,0,380,690,$color,$font,$enrollment);
    imagettftext($image,20,0,1180,770,$color,$font,$reason);
    imagejpeg($image,"images/".$name.".jpg");

    imagedestroy($image);   


    require("fpdf.php");
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->Image("images/".$name.".jpg",0,0,210,150);
    $pdf->Output("pdf/".$name.".pdf","F");


    include('smtp/PHPMailerAutoload.php');
    $mail=new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port=587;
    $mail->SMTPSecure='tls';
    $mail->SMTPAuth=true;
    $mail->Username="aayushkukadiya1605@gmail.com";
    $mail->Password= "ljcy nmlc dvum seiw";
    $mail->setFrom("chavdaprayag0@gmail.com");
    $mail->addAddress("chavdaprayag0@gmail.com");
    // $mail->addAddress("aayushkukadiya1605@gmail.com");
    $mail->isHTML(true);  
    $mail->SMTPDebug = 1;  
    $mail->Subject="Certificate Generated";
    $mail->Body="Certificate Generated";
    $mail->addAttachment("pdf/".$name.".pdf");
    $mail->SMTPOptions=array("ssl"=>array(
        "verify_peer"=>false,
        "verify_peer-name"=>false,
        "allow_self_signed"=>false,
        ));
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
            
        }



