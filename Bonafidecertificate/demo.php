<?php 
        session_start();
        require_once 'database.php';

        if (isset($_SESSION['email'])){
        if ($_SESSION['email'] != NULL){
          $email=$_SESSION['email'];
          $sql="SELECT * FROM `signup`.`student_data` WHERE email = '$email'";
          $result = mysqli_query($conn, $sql);
          $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
          $rowCount = mysqli_num_rows($result);
      
        
        }
          }else{
            echo "not set a session email";
          }
      
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Enrollment Records</title>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
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
</head>
<body>

<h2>Enrollment Records</h2>

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
   if ($user["email"]!=null) {
     
           $sqlall = "SELECT * FROM `signup`.`bonafide_data` WHERE email = '{$user["email"]}'";
           $resultall = mysqli_query($conn, $sqlall);


           $rowCountall = mysqli_num_rows($resultall);


          
            while( $allrowsone = mysqli_fetch_array($resultall, MYSQLI_ASSOC)){
                
            
        
          

          
        echo "<tbody>";
           if($rowCountall>0){
                echo " <tr>
                <td>{$allrowsone["enrollment"]}</td>
                <td>{$allrowsone["date"]}</td>
                <td>{$allrowsone["reason"]}</td>
                <td>{$allrowsone["status"]}</td>
              </tr>";

            
           
            
           }
        }

        echo "</tbody>";
  
   }else{
       echo "<div class='alert alert-danger'>Email does not match</div>";
   }


  ?>
 
</table>

</body>
</html>
