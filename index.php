
<?php include ("./inc/connect.inc.php"); ?><html><body>
<?php include ("./inc/header.inc.php"); ?>
<title>Timirogram | Login</title>

<body class="body1">
<div id = "wrap">
<br/><br><br/><br/>
<div class="panel panel-default">
  <div class="panel-body">
<h3>Login below</h3>

<form action="index.php" class="form-horizontal" method="POST">

   <input type='text' name='username' size='50' class='form-control' placeholder='Username'></p>

         <input type='password' name='pass' size="25" class='form-control' placeholder='Password'></p>
          
          <input type='submit' name='login' value='login' class="btn btn-primary"> 
  </div>
</div>
</form>


<?php


if (isset($_POST['login'])){
// decalaring  variables for the form
  $user_name = $_POST['username'];
    $password = $_POST['pass'];

 
 // check whether the account exists or not

 $check_user = "select * from susers where 
                user_pass = '$password' && user_name = '$user_name' ";

  $run = mysql_query($check_user);

     
  if (mysql_num_rows($run)>0){
 echo "<script>window.open('home.php','_self')</script>";
   $_SESSION['user_name']=$user_name;

  }
  else{ 
echo
    "<script>alert('Username or Password is incorrect')</script>";
  }





}

?>
</div>
<?php
include("inc/footer.inc.php");

?>
</div></div>
</body>

</html>


 