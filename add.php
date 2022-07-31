<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informatiom Form</title>
    <link rel="stylesheet" href="style.css"/>

</head>
<body>

<div style="text-align:center;background-color:#d7d9d7">
<form action="insertdata.php" method="post">
<br><br>
 Name:     <input type="text" name="first_name"><br><br>
 <span style="color:#c94b49"><?php if(isset($_SESSION['first_name']))  echo $_SESSION['first_name']. "</br>" ?></span>

 Surname:  <input type="text" name="sur_name"><br><br>
 <span style="color:#c94b49"><?php if(isset($_SESSION['sur_name'])) echo $_SESSION['sur_name']. "</br>" ?></span>

 E-mail:   <input type="text" name="email"><br><br>
 <span style="color:#c94b49"><?php if(isset($_SESSION['email'])) echo $_SESSION['email']. "</br>" ?></span>

 P-number: <input type="text" name="phone"><br><br>
 <span style="color:#c94b49"><?php if(isset($_SESSION['phone']))  echo $_SESSION['phone']. "</br>" ?></span>

 <button name="submit" name="submit" type="submit" class="btn success">send</button></br>
 </br>
<span style="color:green"> <?php if(isset($_SESSION['msg'])) echo $_SESSION['msg'];?> </span></br>

<?php
//session_destroy();if(isset($_SESSION['msg']))
?>

</form>
</div>

</body>
</html>