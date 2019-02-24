<?php
include ("./inc/connect.inc.php");
?>

 <link rel="stylesheet" href="css/bootstrap.css" media="screen">
<?php
session_start();
if (!isset($_SESSION["user_name"])){

}
else
{
  $user_name = $_SESSION["user_name"];
}
$get_id = $_GET['id'];
?>
<script language="javascript">
         function toggle () {
           var ele = document.getElementById("toggle");
           var text = document.getElementById("display");
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
if (isset($_POST['postComment' . $get_id . ''])) {
 $post_body = $_POST['post_body'];
$getposts = mysql_query("SELECT * FROM posts WHERE id='$get_id' ") ;
$row = mysql_fetch_assoc($getposts);
    $posted_to = $row['added_by'];
 $insertPost = mysql_query("INSERT INTO post_comments VALUES ('','$post_body','$posted_to','$user_name','0','$get_id')");
 echo "Comment Posted!<p />";
}
?>


<div>
<form action="comment_frame.php?id=<?php echo $get_id; ?>" method="POST" >
<div class="form-group">
    <div class="input-group">
    <input class="form-control" type="text" name="post_body">
    <span class="input-group-btn">
 <button  type="submit"  name="postComment<?php echo $get_id; ?>" class="post_comment" ></button></span>

    </span>
  </div>
</div>


</form>
</div>
<?php



$get_comments = mysql_query("SELECT * FROM post_comments where post_id  = '$get_id'");
$count = mysql_num_rows($get_comments);
if ($count != 0) {
while ($comment = mysql_fetch_assoc($get_comments)){
      $comment_body = $comment['body'];
    $posted_to = $comment['posted_to'];
    $posted_by = $comment['posted_by'];
    $removed = $comment['post_removed'];
    if(strlen($comment_body)>=1){
     echo "<b>
    
   $posted_by</b></br>
   <div class='well well-sm'>$comment_body</div>  ";}
}
}
else
{
  echo "No comments to display";
}
?>
</div>