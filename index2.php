<?php include ("./inc/header.inc.php"); ?>


<div id = "wrap">






<form action="index2.php" class="form-horizontal" method="POST">
  
    <legend>Login here:</legend>
    <a href="index.php"> To Login as a Student click here... </a> 
   <input type='text' name='username' size='50' class='form-control' placeholder='Username'></p>
         <input type='password' name='pass' size="25" class='form-control' placeholder='Password'></p>
          
          <input type='submit' name='login' value='login' class="btn btn-primary"> 
</form>


<?php

mysql_connect("localhost","root","");
mysql_select_db("susers_db");

if (isset($_POST['login'])){

	$user_name = $_POST['username'];
		$password = $_POST['pass'];
$_SESSION['user_name']=$user_name;

 

 $check_user = "select * from tusers where 
                user_pass = '$password' AND user_name = '$username' ";

  $run = mysql_query($check_user);
  $_SESSION['user_name']=$user_name;

      echo "<script>window.open('home2.php','_self')</script>";
  if (mysql_num_rows($run)>0){

  }
  else{ 
echo
  	"<script>alert('Username or Password is incorrect')</script>";
  }
exit ();




}

?>


</html>