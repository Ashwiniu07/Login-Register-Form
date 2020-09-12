<?php

$uname1 = $_POST['name1'];
$email  = $_POST['email'];
$upswd1 = $_POST['pwd1'];
$upswd2 = $_POST['pwd2'];




if (!empty($name1) || !empty($email) || !empty($pwd1) || !empty($pwd2) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "Ash";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From register Where email = ? Limit 1";
  $INSERT = "INSERT Into register (name1 , email ,pwd1, pwd2 )values(?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssss", $name1,$email,$pwd1,$pwd2);
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