<?php include ("./inc/header.inc.php"); 


mysql_connect("localhost","root","");
mysql_select_db("susers_db");
if ($user_name){

}else{
  die ("You must be loged in in order to view this cairo_pattern_get_extend(pattern)");
}
?>
<div id="wrap">
<?php 
$check = mysql_query("SELECT position FROM susers WHERE user_name = '$user_name' ");
   if (mysql_num_rows($check)===1){
    $get = mysql_fetch_assoc($check);
    $position = $get['position'];
    $_SESSION['position']=$position;
  }

?>
<?php
if (isset($_GET ['u'])){
   $username = mysql_real_escape_string($_GET['u']);
   if (ctype_alnum($username)) {
   
   $check = mysql_query("SELECT user_name, f_name FROM susers WHERE user_name = '$username' ");
   if (mysql_num_rows($check)===1){
    $get = mysql_fetch_assoc($check);
    $user_name = $get['username'];
    $first_name = $get['f_name'];
    $user_pic = "userdata/profile_pics/".$profile_pic; 
  }
   else
   {
    echo "<script>window.open('index.php','_self')</script>";
    exit();
   }
   }

}

?>
<?php
echo "<table class= 'table table-striped table-hover'>
<theader>My followers</theader>";

    

  echo "
<tr ><table class= 'table table-striped table-hover'>
<tr ><img src='$user_pic' height='250' width='200'/> </br>

</tr><tr>";
 // starting the follow coding

 if (isset($_POST['follow'])){
   $follow_request=$_POST['follow'];
   $user_to = $username;
   $user_from = $user_name;
   if ($user_to==$user_name){
   	echo "You can't send a follow request to yourself";
   }
   else{
   	$create_request = mysql_query("INSERT into follow_requests VALUES ('','$username','$user_name')");
   	echo "Your follow request has been sent";
   }
 }
 else
 {
 	// Do nothing
 }
 echo"
<form action ='view.php' method='POST'>

<input type='submit' name='follow' value='Send a follow request'/>
<input type='submit' name='sendmsg' value='Send Message'/>

</form></tr>
</table>


  ";
  ?>
</div>



