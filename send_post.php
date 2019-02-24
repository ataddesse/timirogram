
<?php 

 include ("./inc/connect.inc.php");
?>
<?php
$check = mysql_query("SELECT subject FROM susers WHERE user_name = '$user_name' ");
   if (mysql_num_rows($check)===1){
   	// Get the teacher's subject
    $get = mysql_fetch_assoc($check);
  
    $subject = $get['subject'];
    
 
  }
?>
<?php
if(!$_SESSION['user_name']){
	header("location: index.php");
}
// Declare variable for the post form
 if (isset($_POST['send'])){
	$body = @$_POST['post'];
	$tobe_uploaded = @$_POST['file'];
	$date_addeed = date("Y-m-d");
  $date_added = strtotime("$date_addeed");
	$added_by = $user_name;
	$for_grade = @$_POST['select_grade'];
	$_subject = $subject;
  $sumbmitted_deadline = @$_POST['deadline'];

  $deadline = strtotime($sumbmitted_deadline);
      $date = date("Y-m-d");

  $file = rand(1000,100000)."-".@$_FILES['file']['name'];
  $file_location = @$_FILES['file']['tmp_name'];
  $file_size = @$_FILES['file']['size'];
  $file_size = @$_FILES['file']['size'];
  $folder="userdata/attachments/";

if ($body=="")
{
echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Oops! </strong>You must enter something in post field.
</div>';
}else if($for_grade==""){
echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Oops! </strong>You must choose the grade you want.
</div>';
}else if($deadline==""){
echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Oops! </strong>You must enter a deadline.
</div>';
}
else if($deadline < strtotime($date)){
echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Oops! </strong>Invalid deadline.
</div>';
}
else
{

  move_uploaded_file($file_location, $folder.$file);
 
// If the is an attachment provide a folder for storage


$sqlCommand = "INSERT INTO posts VALUES('','$body','$date_added','$added_by','$for_grade','$_subject','$deadline','','$file')";

$query = mysql_query($sqlCommand) or die (mysql_error());
$getposts = mysql_query("SELECT * FROM posts WHERE body='$body' ") ;
$row = mysql_fetch_assoc($getposts);
    $id = $row['id'];
$insertPost = mysql_query("INSERT INTO post_comments VALUES ('','','','','0','$id')");

$check_t_ranking = mysql_query("SELECT * from t_ranking where user_name = '$user_name'");
$check = mysql_num_rows($check_t_ranking);
if($check == 0){
$post = '1';
if (strlen($file) > 6){
  $upload = '1';
}else{
  $upload = '0';
}
$total = $post + $upload;

$inertto_ranking = mysql_query("INSERT into t_ranking VALUES('','$user_name','$post','$upload','$total')") or die (mysql_error());
}
else{
  $get_no = mysql_query("SELECT * FROM t_ranking WHERE user_name='$user_name' ") ;
$row = mysql_fetch_assoc($get_no);
    $post = $row['posts'];
    $upload = $row['uploads'];
    $new_post = $post + 1;
   if (strlen($file) > 6){
  $new_upload = $upload +1;
}else{
  $new_upload = $upload;
}  
  $new_total = $new_post + $new_upload ;
  $inertto_ranking = mysql_query("UPDATE t_ranking SET posts='$new_post', uploads='$new_upload', total='$new_total' where user_name='$user_name'") or die (mysql_error());
}

echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Successfully posted!</strong>.
</div>';
}


}
?>