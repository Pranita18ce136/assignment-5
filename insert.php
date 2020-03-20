<?php

$Firstname = $_POST['Firstname'];
$Lastname = $_POST['Lastname'];
$occupation=$_POST['occupation'];
$email = $_POST['email'];
$password = $_POST['password'];
$DOB =$_POST['DOB'];
$gender = $_POST['gender'];
$country=$_POST['country'];
$phone = $_POST['phone'];
if (!empty($Firstname) ||(!empty($Lastname) || !empty($occupation) || !empty($email) || !empty($password) || !empty($DOB) || !empty($gender)  || !empty($country) ||  !empty($phone) )
 {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "assignment 5";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From register Where email = ? Limit 1";
     $INSERT = "INSERT Into register (Firstname,Lastname ,occupation, email,password,DOB ,gender, country,phone) values(?, ?, ?, ?, ?, ?, ?, ?,?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssssssi", $Firstname, $Lastname ,$occupation, $email, $password, $DOB ,$gender,  $country, $phone);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}



?>