<?php
 //session_start();

$servername = "localhost";
$username = "yarandi";
$password = "1234";
$dbname = "data";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  session_start();

  if (empty($_POST["first_name"])) {
    $_SESSION['first_name'] = "Firstname is required";
  } 
  elseif(!preg_match("/^[a-zA-Z-' ]*$/",$_POST["first_name"])) {
     $_SESSION['first_name'] = "Only letters and white space are Allowed";
  }
  else unset($_SESSION['first_name']);


  if (empty($_POST["sur_name"])) {
    $_SESSION['sur_name'] = "Surname is required";
  } 
  elseif(!preg_match("/^[a-zA-Z-' ]*$/",$_POST["sur_name"])){ 
    $_SESSION['sur_name'] = "Only letters and white space are Allowed";
  }
  else unset($_SESSION['sur_name']);


  if (empty($_POST["email"])) {
    $_SESSION['email'] = "Email is required";
  }
  elseif(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
    $_SESSION['email'] = "Invalid Email Format";
  }
  else unset($_SESSION['email']);
  

  if (empty($_POST["phone"])) {
    $_SESSION['phone'] = "Phone is required ";
  } 
  elseif(!preg_match("/^[0-9]{11}+$/",$_POST["phone"])) {
      $_SESSION['phone'] = "InValid Phone Number";
  }
  else unset($_SESSION['phone']);
  unset($_SESSION['msg']);

 if(isset($_SESSION) && !empty($_SESSION)){
    header('location:add.php');
    exit;
  }else{
    
    $firstName = $_POST['first_name'];
    $surName= $_POST['sur_name'];
    $email = $_POST['eamil'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO list (first_name, sur_name, email, phone) VALUES ('$firstName', '$surName', '$email', '$phone')";
    
    if ($conn->query($sql) === TRUE){
      $_SESSION['msg']="New record created successfuly";
       header('location: add.php');
       exit;
  
    }else{
      echo "Error: " . $sql . "<br>" . $conn->error;
  
    }
  }

$conn->close();
} 

?>


