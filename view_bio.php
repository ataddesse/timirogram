<?php include ("./inc/header.inc.php"); 




?>
<?php

 include ("./inc/connect.inc.php");
?>
<div id = "wrap">
<div class="panel panel-success">
<div class="panel-heading">

    <h3 class="panel-title">Biology check list</h3></div>

<?php
$check = mysql_query("SELECT grade FROM susers WHERE user_name = '$user_name' ");
   if (mysql_num_rows($check)===1){
    $get = mysql_fetch_assoc($check);
  
    $grade = $get['grade'];
    
  
  }

$grab_things = mysql_query("SELECT * FROM posts where for_grade= '$grade' && subject='biology'");
$numrows = mysql_numrows($grab_things);
if($numrows != 0) {
while($get = mysql_fetch_assoc($grab_things)){
	$id =$get['id'];
	$added_by =$get['added_by'];
	$body =$get['body'];
    $date_added =$get['date_added'];
   

   $get_poster_pic = mysql_query("SELECT user_pic from susers where user_name = '$added_by'");
  $get_pic_row = mysql_fetch_assoc($get_poster_pic);
$profile_pic_db1 = $get_pic_row['user_pic'];
if($profile_pic_db1 == "") {
$profile_pic1 = "./img/default_pic.jpg";
}else{
$profile_pic1 = "userdata/profile_pics/".$profile_pic_db1; 
}


?>


<?php
echo "<table><tr><td><img src='$profile_pic1' height='90' width='60'></td><td><blockquote><p>$added_by</p><small>$body</br>$date_added </small></blockquote></td></tr></table><hr/>";
}
}
else
{
 echo  "You have nothing to do";
}
?>
</div>
</div>












