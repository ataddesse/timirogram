<?php include ("./inc/header.inc.php"); 


 include ("./inc/connect.inc.php");
if ($user_name){

}else{
  die ("You must be loged in in order to view this cairo_pattern_get_extend(pattern)");
}
?><html><body>

<div id = "wrap"><br/></br>
<?php
  $senddata = @$_POST['senddata'];
  //Password variables 
  $old_password = @$_POST['old_password'];
    $new_password = @$_POST['new_password'];
      $new_password2 = @$_POST['new_password2'];
      mysql_connect("localhost","root","");
mysql_select_db("susers_db");

  if ($senddata){ $password_query = mysql_query("SELECT * FROM susers WHERE user_name = '$user_name' ");
   while ($row = mysql_fetch_assoc($password_query)) {
         $db_password = $row['user_pass'];

         
//Confirm the two passes are the same
         if ($old_password == $db_password ) {
          // check the new passwords are the same
           if ($new_password == $new_password2){
                       if (strlen($new_password) <= 4){
            echo "Your new password must be atleast 5 characters long";
           }
else
{
// continue the changing processs
     $password_update_query = mysql_query("UPDATE susers set user_pass='$new_password' where user_name = '$user_name' ");
     echo "Succesfuly updated";
              }
           }
           else
           {
            echo "Your passwords don't match!!";
           }
         }
         else
         {   
          echo " $ab";
         }

   }
  }
  else
  {
    echo "Please submit some data";
  }
?><?php
  $updateinfo = @$_POST['updateinfo'];
  // First Name, Last name nad about the user query
  $get_info = mysql_query("SELECT f_name,l_name,user_name FROM susers where user_name = '$user_name'  " );
  $get_row = mysql_fetch_assoc($get_info);
  $db_f_name = $get_row['f_name'];
  $db_l_name = $get_row['l_name']; 
  $db_user_name = $get_row['user_name']; 
  mysql_connect("localhost","root","");
mysql_select_db("susers_db");

  // submit what the user types in the form
if ($updateinfo) {
  // what to do if the form is sumbitted
  $f_name = @$_POST['fname'];
    $l_name = @$_POST['lname'];
    $username = @$_POST['username']; 
  
  if (strlen($f_name) < 3) {
    echo "Your first name must be 3 or more characters long";
  }
  else
    if 
  (strlen($l_name) < 5) {
    echo "Your Last name must be 5 or more characters long";

    }  
    // SUbmit the data to the data base
    else
    {
 $info_update_query = mysql_query("UPDATE susers set f_name='$f_name', l_name='$l_name', user_name='$username' where user_name = '$user_name' "); 
  echo "User info successfuly updated";
  header("Location: $user_name");  

    }

}
else
{
  echo "failed!!!!!!!!!";
}
//Check whether the user has uploaded a profile picture or not
$check_pic = mysql_query("SELECT user_pic FROM susers where user_name='$user_name'");
$get_pic_row = mysql_fetch_assoc($check_pic);
$profile_pic_db = $get_pic_row['user_pic'];
if($profile_pic_db == "") {
$profile_pic = "./img/default_pic.jpg";
}else{
$profile_pic = "userdata/profile_pics/".$profile_pic_db; 
}
//Profile Image upload
 if (isset($_FILES['profilepic'])) {
  if (((@$_FILES["profilepic"]["type"]=="image/jpeg" || (@$_FILES["profilepic"]["type"]=="image/png") || (@$_FILES["profilepic"]["type"]=="image/gif")) && (@$_FILES["profilepic"]["size"]< 5048576)) ) {
$chars = "abcdefghijklmnopqrtuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
   $rand_dir_name = substr(str_shuffle($chars), 0,15);
   mkdir("userdata/profile_pics/$rand_dir_name");
   if (file_exists("userdata/profile_pics/$rand_dir_name". $_FILES["profilepic"]["name"]))
   {
    echo @$_FILES["profilepic"]["name"]. "Already exists";
   }
   else
   {
    move_uploaded_file(@$_FILES["profilepic"]["tmp_name"],"userdata/profile_pics/$rand_dir_name/".$_FILES["profilepic"]["name"]);
   // echo "Uploaded and stored: ".@$_FILES["profilepic"]["name"];
    mysql_connect("localhost","root","");
mysql_select_db("susers_db");
   $profile_pic_name = @$_FILES["profilepic"]["name"];
   $profile_pic_query = mysql_query("UPDATE susers SET user_pic='$rand_dir_name/$profile_pic_name' WHERE user_name='$user_name'");
   header("Location: account_settings.php");
   }
   }
else{


echo "Invalid File! Your image must be no larger than 1MB and must be either a .jpg, .jpeg, .png or .jif file";



}


}
?>


<h2>Edit your settings below</h2>
</hr>
<p>UPLOAD YOUR PROFILE PHOTO </p>
<form action="" method="POST" enctype="multipart/form-data">
<img src='<?php echo $profile_pic; ?>' width="70">
<input type="file" name="profilepic"></br>
<input type="submit" name="uploadpic" value="Upload Image">
</form>
</hr>
<form action="account_settings.php" method="POST" class="form-horizontal">
<fieldset>
  <legend>Change your password</legend>
  <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">Old Password</label>
    <div class="col-lg-10">
    <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Old Password">
    </div>
     <label for="inputPassword" class="col-lg-2 control-label">New Password</label>
    <div class="col-lg-10">
    <input type="password" name="new_password" class="form-control" id="new_password" placeholder="New Password">
    </div>
     <label for="inputPassword" class="col-lg-2 control-label">Repeat Password</label>
    <div class="col-lg-10">
    <input type="password" name="new_password2" class="form-control" id="new_password2" placeholder="Repeat Password"></p>
    </div>
 <div class="col-lg-10 col-lg-offset-2">
<button type = "submit" name="senddata"  id="senddata" value="Update Info"  class="btn btn-primary">Submit</button>
 </div>
  </div>
</fieldset>
</form>

<form class="form-horizontal">
<fieldset>
  <legend>Change your Profile Info</legend>
  <div class="form-group">
    <label for="inputPassword" class="col-lg-2 control-label">First Password</label>
    <div class="col-lg-10">
    <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name">
    </div>
     <label for="inputPassword" class="col-lg-2 control-label">Last Name</label>
    <div class="col-lg-10">
    <input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name">
    </div>
     <label for="inputPassword" class="col-lg-2 control-label">Username</label>
    <div class="col-lg-10">
    <input type="text" name="username" class="form-control" id="username" placeholder="Username"></p>
    </div>
 <div class="col-lg-10 col-lg-offset-2">
<button type = "submit" name="updateinfo"  id="updateinfo" value="Update Info"  class="btn btn-primary">Submit</button>
 </div>
  </div>
</fieldset>
</form>
<?php
include("inc/footer.inc.php");

?>
</body>

</html>



<?php
include("inc/footer.inc.php");

?>