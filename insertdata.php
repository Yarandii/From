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

  // $email = $_POST["email"];

  $emailExistanceCheck = mysqli_query($conn, "SELECT * FROM list WHERE email = '$email'");
    
  if (empty($_POST["email"])) {
    $_SESSION['email'] = "Email is required";
  }
  elseif(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
    $_SESSION['email'] = "Invalid Email Format";
  }elseif(mysqli_num_rows($emailExistanceCheck)){
    $_SESSION['email'] = "This email address is already used!";
  }
  else unset($_SESSION['email']);
  

  // $phone = $_POST['phone'];
  $phoneExistanceCheck = mysqli_query($conn, "SELECT * FROM list WHERE phone = '$phone'");

  if (empty($_POST["phone"])) {
    $_SESSION['phone'] = "Phone is required ";
  } 
  elseif(!preg_match("/^[0-9]{11}+$/",$_POST["phone"])) {
      $_SESSION['phone'] = "InValid Phone Number";

  }elseif(mysqli_num_rows($phoneExistanceCheck)){
    $_SESSION['phone'] = "This phone address is already used!";
  }
  else unset($_SESSION['phone']);


 if(isset($_SESSION) && !empty($_SESSION)){
    header('location:add.php');
    exit;
  }else{

    $firstName = $_POST['first_name'];
    $surName= $_POST['sur_name'];
    $email = $_POST['email']; 
    $phone = $_POST['phone'];

  

       
    // $_SESSION['email'] = "This email address is already used!";
  
    
    // $select = mysqli_query($conn, "SELECT * FROM list WHERE phone = '".$_POST['phone']."'");
    // if(mysqli_num_rows($select)) {
    //  exit('This phone number is already used!');
    // }    //  $_SESSION['phone'] = "This phone number is already used!";

    
        
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


