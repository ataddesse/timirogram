 

<?php
// Get posts from the database
$getposts = mysql_query("SELECT * FROM posts WHERE added_by='$user_name' ORDER BY id DESC LIMIT 10") ;
while($row = mysql_fetch_assoc($getposts)){
    $id = $row['id'];
    $body = $row['body']; 
    $date_added = $row['date_added'];
    $added_by = $row['added_by'];
    $user_posted_to = $row['for_grade'];
    $attachment = $row['attachments'];
    $deadline = $row['deadline'];
    $date = date("d-m-y");
// Get poster's pro_pic
  $get_poster_pic = mysql_query("SELECT user_pic from susers where user_name = '$added_by'");
  $get_pic_row = mysql_fetch_assoc($get_poster_pic);
$profile_pic_db1 = $get_pic_row['user_pic'];
if($profile_pic_db1 == "") {
$profile_pic1 = "./img/default_pic.jpg";
}else{
$profile_pic1 = "userdata/profile_pics/".$profile_pic_db1; 
}
?>

<script language="javascript">
// Toggle function for comment box
         function toggle<?php echo $id; ?> () {
           var ele = document.getElementById("togglecomment<?php echo $id ?>");
           var text = document.getElementById("displaycomment<?php echo $id ?>");
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


 echo $deadline. "-----".strtotime($date). "
  
  <div class='panel panel-default'>
  <div class='panel-heading'><table><tr><td><img class='img-circular' src='$profile_pic1' height='90' width='90'></td><td><p style='  font-size: 20px;'><b>$added_by</b></td></tr></table></div>
  <div class='panel-body'>
<table><tr><td></p><td></tr><tr><td></td><td><p/>
$body<br/>";

if(strlen($attachment) > 6){
  // If attachments exists
  echo "<div class='panel panel-default'>
  <div class='panel-body'> $attachment
  <a href='userdata/attachments/$attachment' download> <img width='37px' height='37px' src='img/IMG_2601.ICO'></img> </a>
  </div></div>";
}
else
{
  // do nothing
}
 echo"</br><p style='  font-size: 14px;'><a href='#'>$date_added</a> </p></blockquote></br></td></tr></table>
" ;


echo "  

<iframe src='./like_frame.php?id=$id' frameborder='0' style='max-width: 80px; max-height: 70px;'></iframe>

   <div style='float: left; display: inline;'><button onClick='javascript:toggle$id()' class='comment' ></button></div>";
  
  // Get relevant comment 
  $get_comments = mysql_query("SELECT * from post_comments where post_id = $id");
  while($comment = mysql_fetch_assoc($get_comments)){
   $comment_body = $comment['body'];
    $posted_to = $comment['posted_to'];
    $posted_by = $comment['posted_by'];
    $removed = $comment['post_removed'];
?>


<?php
    echo "<div id='togglecomment$id' style='display:none;'>
<iframe src='./comment_frame.php?id=$id' frameborder='0' style='max-height: 100%; width: 100%; min-height: 10px;'></iframe>
</div>";
      }
  ?>

  
<?php


echo "</div></div></table></br>"; 

 echo "";
}





"
?>

 