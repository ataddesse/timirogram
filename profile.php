
<?php 
 include ("./inc/connect.inc.php");
include ("./inc/header.inc.php"); 
if ($user_name){

}else{
  die ("You must be loged in in order to view this cairo_pattern_get_extend(pattern)");
}
?>
<div id="wrap">

<?php
if (isset($_GET ['u'])){
  // Get the username of the user
   $username = mysql_real_escape_string($_GET['u']);
   if (ctype_alnum($username)) {
   
   $check = mysql_query("SELECT user_name, f_name FROM susers WHERE user_name = '$username' ");
   if (mysql_num_rows($check)===1){
    $get = mysql_fetch_assoc($check);
    $username = $get['user_name'];
    $f_name = $get['f_name'];
  }
   else
   {
    echo "<script>window.open('index.php','_self')</script>";
    exit();
   }
   }

}
// Get on what position the user is
$check = mysql_query("SELECT position FROM susers WHERE user_name = '$username' ");
   if (mysql_num_rows($check)===1){
    $get = mysql_fetch_assoc($check);
  
    $position = $get['position'];


    $_SESSION['position']=$position;
  }

?>

<?php
//Check whether the user has uploaded a profile picture or not
$check_pic = mysql_query("SELECT user_pic FROM susers where user_name='$username'");
$get_pic_row = mysql_fetch_assoc($check_pic);
$profile_pic_db = $get_pic_row['user_pic'];
if($profile_pic_db == "") {
$profile_pic = "./img/default_pic.jpg";
}else{
$profile_pic = "userdata/profile_pics/".$profile_pic_db; 


  }
 
?> 
<?php


?>


<?php

?>
<?php
if ($user_name!=$username){
   if($position=='teacher'){
echo  "<br/><br/><br/>

<table class= 'table table-striped table-hover'>
<tr ><img src='$profile_pic' height='250' width='200'/> </br>

</tr>";
// start the message coddig


 // starting the follow coding
?><tr>

<script language="javascript">
         function toggle1 () {
           var ele = document.getElementById("toggletext1");
           var text = document.getElementById("displaytext1");
           if (ele.style.display == "block") {
              ele.style.display = "none";
           }
           else
           {
             ele.style.display = "block";
           }
         }
</script>

<?php
  if(isset($_POST['send_msg'])){
      $msg_body = strip_tags(@$_POST['msg_body']);
      $date = date("Y-m-d");
      $opened = "no";
        $deleted = "no";
    


$check_convo = "select * from pvt_convos where (
                user_to = '$username' OR user_to = '$user_name') AND (
                user_from = '$username' OR user_from = '$user_name') ";

  $run = mysql_query($check_convo);


     
  if (mysql_num_rows($run)>0  ){

   $send_msg = mysql_query("INSERT into pvt_messages VALUES ('','$user_name','$username','$msg_body','$date','$opened','$deleted')");
   $update_convo = mysql_query("UPDATE pvt_convos SET  user_from='$user_name', user_to='$username', last_msg='$msg_body'  where (
                user_to = '$user_name' OR user_to = '$username') AND (
                user_from = '$username' OR user_from = '$user_name') ")or die (mysql_error());

      echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>Your message has been sent!</div>';
  }
  else{ 


      $send_msg = mysql_query("INSERT into pvt_messages VALUES ('','$user_name','$username','$msg_body','$date','$opened','$deleted')");
      $insert_convo = mysql_query("INSERT into pvt_convos VALUES('','$user_name','$username','$msg_body','$date','$opened')")or die (mysql_error());
    
     echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>Your message has been sent!</div>';;

  }



    }
?>


<button class = 'btn btn-primary' name='sendmsg' onclick = 'javascript:toggle1()'> Send Msg </button>


</form></tr>
<div id='toggletext1' style='display:none;'>
<form action="#" method="POST" >
<div class="form-group">
    <div class="input-group">

    <input class="form-control" type="text" placeholder="Type your message here..." name="msg_body">
    <span class="input-group-btn">
 <input  type="submit"  name="send_msg" class="post_comment" ></span>

    </span>
  </div>
</div>


</form>
</div>

</table>
<div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title">Downloadable materials</h3>
  </div>
  <div class="panel-body">

<?php
$get_material = mysql_query("SELECT *  FROM posts where added_by='$username'");
while ($get= mysql_fetch_assoc($get_material)){
$date = $get['date_added'];
$downloadable = $get['attachments'];
if (strlen($downloadable)>6){
 echo " <a>$date    $downloadable</a><a href='userdata/attachments/$downloadable' download> <button class='download' ></button></a><br/>" ;
}
}
    ?>

  </div>
</div>
<?php
$get_info = mysql_query("SELECT * FROM susers WHERE user_name = '$username' ");
$get_it = mysql_fetch_assoc($get_info);
$full_name = @$get_it['f_name'].' '.@$get_it['l_name'];
$gender = @$get_it['gender'];
$grade = @$get_it['grade'];
$position = @$get_it['position'];
$subject = @$get_it['subject'];
$birth_date = @$get_it['birth_date'];
$email = @$get_it['email'];
echo '
<div class="panel panel-default">
  <div class="panel-body">
  <form class="form-horizontal">
  <fieldset>
    <legend>Personal Info</legend>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Full name</label>
      <div class="col-lg-10">
      '.$full_name.'
      </div></div>
          <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Position</label>
      <div class="col-lg-10">
      '.$subject.' '.$position .'
      </div></div>
<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Gender</label>
      <div class="col-lg-10">
     '.$gender.'
      </div></div>
      <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Birth date</label>
      <div class="col-lg-10">
      '.$birth_date.'
      </div></div>
  
            <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
      '.$email.'
      </div></div>
 </fieldset>
</form></div></div>';

?>
</div>
<?php
}
if($position=='principal'){
echo  "<br/><br/><br/>

<table class= 'table table-striped table-hover'>
<tr ><img src='$profile_pic' height='250' width='200'/> </br>

</tr>";
// start the message coddig


 // starting the follow coding
?><tr>

<script language="javascript">
         function toggle1 () {
           var ele = document.getElementById("toggletext1");
           var text = document.getElementById("displaytext1");
           if (ele.style.display == "block") {
              ele.style.display = "none";
           }
           else
           {
             ele.style.display = "block";
           }
         }
</script>

<?php
  if(isset($_POST['send_msg'])){
      $msg_body = strip_tags(@$_POST['msg_body']);
      $date = date("Y-m-d");
      $opened = "no";
        $deleted = "no";
    


$check_convo = "select * from pvt_convos where (
                user_to = '$username' OR user_to = '$user_name') AND (
                user_from = '$username' OR user_from = '$user_name') ";

  $run = mysql_query($check_convo);


     
  if (mysql_num_rows($run)>0  ){

   $send_msg = mysql_query("INSERT into pvt_messages VALUES ('','$user_name','$username','$msg_body','$date','$opened','$deleted')");
   $update_convo = mysql_query("UPDATE pvt_convos SET  user_from='$user_name', user_to='$username', last_msg='$msg_body'  where (
                user_to = '$user_name' OR user_to = '$username') AND (
                user_from = '$username' OR user_from = '$user_name') ")or die (mysql_error());

      echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>Your message has been sent!</div>';
  }
  else{ 


      $send_msg = mysql_query("INSERT into pvt_messages VALUES ('','$user_name','$username','$msg_body','$date','$opened','$deleted')");
      $insert_convo = mysql_query("INSERT into pvt_convos VALUES('','$user_name','$username','$msg_body','$date','$opened')")or die (mysql_error());
    
     echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>Your message has been sent!</div>';;

  }



    }
?>


<button class = 'btn btn-primary' name='sendmsg' onclick = 'javascript:toggle1()'> Send Msg </button>


</form></tr>
<div id='toggletext1' style='display:none;'>
<form action="#" method="POST" >
<div class="form-group">
    <div class="input-group">

    <input class="form-control" type="text" placeholder="Type your message here..." name="msg_body">
    <span class="input-group-btn">
 <input  type="submit"  name="send_msg" class="post_comment" ></span>

    </span>
  </div>
</div>


</form>
</div>

</table>

<?php
$get_info = mysql_query("SELECT * FROM susers WHERE user_name = '$username' ");
$get_it = mysql_fetch_assoc($get_info);
$full_name = @$get_it['f_name'].' '.@$get_it['l_name'];
$gender = @$get_it['gender'];
$grade = @$get_it['grade'];
$position = @$get_it['position'];
$subject = @$get_it['subject'];
$birth_date = @$get_it['birth_date'];
$email = @$get_it['email'];
echo '
<div class="panel panel-default">
  <div class="panel-body">
  <form class="form-horizontal">
  <fieldset>
    <legend>Personal Info</legend>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Full name</label>
      <div class="col-lg-10">
      '.$full_name.'
      </div></div>
          <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Position</label>
      <div class="col-lg-10">
     '.$position .'
      </div></div>
<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Gender</label>
      <div class="col-lg-10">
     '.$gender.'
      </div></div>
      <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Birth date</label>
      <div class="col-lg-10">
      '.$birth_date.'
      </div></div>
  
            <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
      '.$email.'
      </div></div>
 </fieldset>
</form></div></div>';
}
?>
</div>
<?php
if($position=='student'){
?><br/><br/><br/>
<div id="wrap">
<div class='well'>
<?php
echo"
<table class= 'table table-striped table-hover'>
<tr ><img src='$profile_pic' height='200' width='160'/> </br>

</tr>";
// start the message coddig


 // starting the follow coding
?><tr>

<script language="javascript">
         function toggle1 () {
           var ele = document.getElementById("toggletext1");
           var text = document.getElementById("displaytext1");
           if (ele.style.display == "block") {
              ele.style.display = "none";
           }
           else
           {
             ele.style.display = "block";
           }
         }
</script>

<?php
  if(isset($_POST['send_msg'])){
      $msg_body = strip_tags(@$_POST['msg_body']);
      $date = date("Y-m-d");
      $opened = "no";
        $deleted = "no";
    


$check_convo = "select * from pvt_convos where (
                user_to = '$username' OR user_to = '$user_name') AND (
                user_from = '$username' OR user_from = '$user_name') ";

  $run = mysql_query($check_convo);


     
  if (mysql_num_rows($run)>0  ){

   $send_msg = mysql_query("INSERT into pvt_messages VALUES ('','$user_name','$username','$msg_body','$date','$opened','$deleted')");
   $update_convo = mysql_query("UPDATE pvt_convos SET  user_from='$user_name', user_to='$username', last_msg='$msg_body'  where (
                user_to = '$user_name' OR user_to = '$username') AND (
                user_from = '$username' OR user_from = '$user_name') ")or die (mysql_error());

      echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>Your message has been sent!</div>';
  }
  else{ 


      $send_msg = mysql_query("INSERT into pvt_messages VALUES ('','$user_name','$username','$msg_body','$date','$opened','$deleted')");
      $insert_convo = mysql_query("INSERT into pvt_convos VALUES('','$user_name','$username','$msg_body','$date','$opened')")or die (mysql_error());
    
     echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>Your message has been sent!</div>';;

  }



    }
?>


<button class = 'btn btn-primary' name='sendmsg' onclick = 'javascript:toggle1()'> Send Msg </button>


</form></tr>
<div id='toggletext1' style='display:none;'>
<form action="#" method="POST" >
<div class="form-group">
    <div class="input-group">

    <input class="form-control" type="text" placeholder="Type your message here..." name="msg_body">
    <span class="input-group-btn">
 <input  type="submit"  name="send_msg" class="post_comment" ></span>

    </span>
  </div>
</div>


</form>
</div></table></div> <?php 
$get_info = mysql_query("SELECT * FROM susers WHERE user_name = '$username' ");
$get_it = mysql_fetch_assoc($get_info);
$full_name = @$get_it['f_name'].' '.@$get_it['l_name'];
$gender = @$get_it['gender'];
$grade = @$get_it['grade'];
$birth_date = @$get_it['birth_date'];
$email = @$get_it['email'];
$status = @$get_it['status'];
if($status == ''){
  $status = 'Empty...';
}
$academic_int = @$get_it['academic_int'];
if($academic_int == ''){
  $academic_int = 'Empty...';
}
$fav_extra = @$get_it['fav_extra'];
if($fav_extra == ""){
  $fav_extra = 'Empty...';
}
  echo '
<div class="panel panel-default">
  <div class="panel-body">
  <form class="form-horizontal">
  <fieldset>
    <legend>Personal Info</legend>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Full name</label>
      <div class="col-lg-10">
      '.$full_name.'
      </div></div>
<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Gender</label>
      <div class="col-lg-10">
     '.$gender.'
      </div></div>
      <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Birth date</label>
      <div class="col-lg-10">
      '.$birth_date.'
      </div></div>
          <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Grade</label>
      <div class="col-lg-10">
      '.$grade.'
      </div></div>
            <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
      '.$email.'
      </div></div>
      <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Status</label>
      <div class="col-lg-10">
   '.$status.'
      </div></div>
      <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Academic Interest</label>
      <div class="col-lg-10">
   '.$academic_int.'
      </div></div>
      <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Favorite extracurricular activity</label>
      <div class="col-lg-10">
     '.$fav_extra.'
      </div></div>
 
  </fieldset>
</form></div></div>';
}
?></div> <?php
}

if($username==$user_name){
  echo "<br/><br/><br/><br/><div class='well'><img src='$profile_pic' height='150' width='150' /></div>";
  if($position=='teacher'){?>
  <div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title">My uploads</h3>
  </div>
  <div class="panel-body">

<?php
$get_material = mysql_query("SELECT *  FROM posts where added_by='$username'");
while ($get= mysql_fetch_assoc($get_material)){
$date = $get['date_added'];
$downloadable = $get['attachments'];
if (strlen($downloadable)>6){
 echo "<a>$date    $downloadable</a> <a href='userdata/attachments/$downloadable' download> <button class='download' ></button></a><br/>" ;
}
}
    ?>

  </div>
</div>

<?php  }
if($position=='principal')
echo  "

";
// start the message coddig


 // starting the follow coding
?><tr>



</table>

<?php
$get_info = mysql_query("SELECT * FROM susers WHERE user_name = '$username' ");
$get_it = mysql_fetch_assoc($get_info);
$full_name = @$get_it['f_name'].' '.@$get_it['l_name'];
$gender = @$get_it['gender'];
$grade = @$get_it['grade'];
$position = @$get_it['position'];
$subject = @$get_it['subject'];
$birth_date = @$get_it['birth_date'];
$email = @$get_it['email'];
echo '
<div class="panel panel-default">
  <div class="panel-body">
  <form class="form-horizontal">
  <fieldset>
    <legend>Personal Info</legend>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Full name</label>
      <div class="col-lg-10">
      '.$full_name.'
      </div></div>
          <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Position</label>
      <div class="col-lg-10">
     '.$position .'
      </div></div>
<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Gender</label>
      <div class="col-lg-10">
     '.$gender.'
      </div></div>
      <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Birth date</label>
      <div class="col-lg-10">
      '.$birth_date.'
      </div></div>
  
            <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
      '.$email.'
      </div></div>
 </fieldset>
</form></div></div>';


if($position=='student'){
  $get_info = mysql_query("SELECT * FROM susers WHERE user_name = '$username' ");
$get_it = mysql_fetch_assoc($get_info);
$full_name = @$get_it['f_name'].' '.@$get_it['l_name'];
$gender = @$get_it['gender'];
$birth_date = @$get_it['birth_date'];
$status = @$get_it['status'];
if($status == ''){
  $status = 'Empty...';
}
$academic_int = @$get_it['academic_int'];
if($academic_int == ''){
  $academic_int = 'Empty...';
}
$fav_extra = @$get_it['fav_extra'];
if($fav_extra == ""){
  $fav_extra = 'Empty...';
}
  $get_info = mysql_query("SELECT * FROM susers where user_name = '$user_name'");
  $get = mysql_fetch_assoc($get_info);
  $pic = $get['user_pic'];
  $_status = $get['status'];
  $_extra = $get['fav_extra'];
  $_int = $get['academic_int'];
  if($pic == ''){
    $pic_num = 0;
  }else{
    $pic_num = 1;
  }
    if($_status == ''){
    $_status_num = 0;
  }else{
    $_status_num = 1;
  }
    if($_extra == ''){
    $_extra_num = 0;
  }else{
    $_extra_num = 1;
  }
    if($_int == ''){
    $_int_num = 0;
  }else{
    $_int_num = 1;
  }
  $average = ((6 + $pic_num + $_status_num + $_extra_num + $_int_num)/10) * 100;

  echo '<h3>Your profile is '.$average.'% done. </h3>
     <div class="progress progress-striped active">
  <div class="progress-bar progress-bar-success" style="width:'.$average.'%"></div>
</div>
 
 <form action="profile.php?u='.$user_name.'#"  method="POST"  class="form-horizontal"><fieldset>
  <div class="form-group">
  <label class="control-label">Status</label>
  <div class="input-group">
      <input class="form-control" name="status" type="text" value="'.$status.'">
    <span class="input-group-btn">
 <input  type="submit"  name="change_status" class="btn btn-default" value="Update" >
    </span>
  </div>
</div>'; 
if (isset($_POST['change_status'])){
  $status = $_POST['status'];
  if($status=='Empty...'){
     echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>You have to write something before changing</strong>.
</div>';
  }else{
  $update_status = mysql_query("UPDATE susers SET status='$status' where user_name='$user_name'");
  echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Successfully Updated!</strong>.
</div>';
}
}


echo ' <div class="form-group">
  <label class="control-label">Academic Interest</label>
  <div class="input-group">
      <input class="form-control" name="academic_int" type="text" value="'.$academic_int.'">
    <span class="input-group-btn">
 <input  type="submit"  name="change_academic_int" class="btn btn-default" value="Change" >
    </span>
  </div>';
if (isset($_POST['change_academic_int'])){
  $academic_int = $_POST['academic_int'];
  if($academic_int=='Empty...'){
     echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>You have to write something before changing</strong>.
</div>';
  }else{
  $update_status = mysql_query("UPDATE susers SET academic_int='$academic_int' where user_name='$user_name'");
  echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Successfully Updated!</strong>.
</div>';
}
}
  echo'
</div> <div class="form-group">
  <label class="control-label">Favorite extracurricular
   activity</label>
  <div class="input-group">
      <input class="form-control" name="fav_extra" type="text" value="'.$fav_extra.'">
    <span class="input-group-btn">
 <input  type="submit"  name="change_fav_extra" class="btn btn-default" value="Update" >
    </span>
  </div>
</div>';
if (isset($_POST['change_fav_extra'])){
  $fav_extra = $_POST['fav_extra'];
  if($fav_extra=='Empty...'){
     echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>You have to write something before changing</strong>.
</div>';
  }else{
  $update_status = mysql_query("UPDATE susers SET fav_extra='$fav_extra' where user_name='$user_name'");
  echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Successfully Updated!</strong>.
</div>';
}
}
echo'
</fieldset></form>

';
  }


}




?>
</div>
<?php
include("inc/footer.inc.php");

?>