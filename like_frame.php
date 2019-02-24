<?php


 include ("./inc/connect.inc.php");
session_start();
if (!isset($_SESSION["user_name"])){

}
else
{
  $user_name = $_SESSION["user_name"];
}
$get_id = $_GET['id'];
?>
<?php
// Get likes
$get_likes = mysql_query("SELECT * FROM posts WHERE id='$get_id'");

if (mysql_num_rows($get_likes)===1) {
	$get = mysql_fetch_assoc($get_likes);
	$get_likes = $get['likes'];
		$liked_to = $get['added_by'];
	$total_likes = $get_likes + 1;
	$remove_likes = $total_likes - 2;
	} 
	else
	{
        die("Error ...");
        }





?>
<link rel="stylesheet" href="./css/bootstrap.css" media="screen">

<?php
if (isset($_POST['likepost' . $get_id . ''])) {
	// To like
 $like = mysql_query("UPDATE posts SET likes='$total_likes' WHERE id='$get_id'");
 $post_likes = mysql_query("INSERT INTO post_likes VALUES ('','$liked_to','$user_name','$get_id')");
  header("Location: like_frame.php?id=$get_id");
}
if (isset($_POST['unlikepost' . $get_id . ''])) {
	//To unlike
 $like = mysql_query("UPDATE posts SET likes='$remove_likes' WHERE id='$get_id'") or die (mysql_error());
 $remove_user = mysql_query("DELETE FROM post_likes WHERE like_id='$get_id' AND liked_by='$user_name'") or die (mysql_error());
 header("Location: like_frame.php?id=$get_id");



}
?>
<?php
//Check for previous likes
$check_for_likes = mysql_query("SELECT * FROM post_likes WHERE liked_by='$user_name' AND like_id='$get_id'");
$numrows_likes = mysql_num_rows($check_for_likes);
?>

<?php
if ($numrows_likes >=1){
 echo '<form action="like_frame.php?id='.$get_id.'" method="POST" name="unlikepost'.$get_id.'">

<input type="submit" class="unlike" name="unlikepost'.$get_id.'" value=""><span class="badge">'.$get_likes.'</span>
</form>' 
;
}
else if ($numrows_likes == 0) {
echo '
<form action="like_frame.php?id='.$get_id.'" method="POST" name="likepost'.$get_id.'">

<input type="submit" class="like" name="likepost'.$get_id.'" value=""><span class="badge">'.$get_likes.'
</span></form>' ;
}
?>



