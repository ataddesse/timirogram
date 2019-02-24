
<?php 
include ("./inc/header.inc.php"); 
include ("./inc/connect.inc.php");
?>

<title>Teachingram</title>

<div id = "wrap">

<br/><br/><br/><br/>

<?php 
$check = mysql_query("SELECT grade FROM susers WHERE user_name = '$user_name' ");
   if (mysql_num_rows($check)===1){
    $get = mysql_fetch_assoc($check);
  // Checking which grade the user is in
    $grade = $get['grade'];
    
  
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
?>


<?php 
// Get on what position the user is
$check = mysql_query("SELECT position FROM susers WHERE user_name = '$user_name' ");
   if (mysql_num_rows($check)===1){
    $get = mysql_fetch_assoc($check);
  
    $position = $get['position'];

    $_SESSION['position']=$position;
  }
?>
<?php 
// Get the first and last name of the user
$check = mysql_query("SELECT f_name FROM susers WHERE user_name = '$user_name' ");
   if (mysql_num_rows($check)===1){
    $get = mysql_fetch_assoc($check);
  
    $f_name = $get['f_name'];
  }
?>
<?php 
// Get the first and last name of the user
$check = mysql_query("SELECT l_name FROM susers WHERE user_name = '$user_name' ");
   if (mysql_num_rows($check)===1){
    $get = mysql_fetch_assoc($check);
  
    $l_name = $get['l_name'];
  }
?>
<?php include ("send_post.php"); ?>
<?php
if(isset($_POST['follow'])){
    $follow_request = $_POST['follow'];
    $user_to = $user_name;
}
else
 
{

}
// Things to do counter
$date = strtotime(date("m/d/y"));



$get_math_query = mysql_query("SELECT subject from posts where for_grade = '$grade' && subject='math' && deadline>='$date' ");
  $get_math = mysql_fetch_assoc($get_math_query);
  $count_undone_math = mysql_num_rows($get_math_query);

$get_english_query = mysql_query("SELECT subject from posts where for_grade = '$grade' && subject='english' && deadline>='$date'");
  $get_english = mysql_fetch_assoc($get_english_query);
  $count_undone_english = mysql_num_rows($get_english_query);
$get_chemistry_query = mysql_query("SELECT subject from posts where for_grade = '$grade' && subject='chemistry' && deadline>='$date'");
  $get_chemistry = mysql_fetch_assoc($get_chemistry_query);
  $count_undone_chemistry = mysql_num_rows($get_chemistry_query);
$get_physics_query = mysql_query("SELECT subject from posts where for_grade = '$grade' && subject='physics' && deadline>='$date'");
  $get_physics = mysql_fetch_assoc($get_physics_query);
  $count_undone_physics = mysql_num_rows($get_physics_query);
$get_amharic_query = mysql_query("SELECT subject from posts where for_grade = '$grade' && subject='amharic' && deadline>='$date'");
  $get_amharic = mysql_fetch_assoc($get_amharic_query);
  $count_undone_amharic = mysql_num_rows($get_amharic_query);
$get_geography_query = mysql_query("SELECT subject from posts where for_grade = '$grade' && subject='geography' && deadline>='$date'");
  $get_geography = mysql_fetch_assoc($get_geography_query);
  $count_undone_geography = mysql_num_rows($get_geography_query);  
$get_bio_query = mysql_query("SELECT subject from posts where for_grade = '$grade' && subject='biology' && deadline>='$date'");
  $get_bio = mysql_fetch_assoc($get_bio_query);
  $count_undone_biology = mysql_num_rows($get_bio_query);   
$get_civics_query = mysql_query("SELECT subject from posts where for_grade = '$grade' && subject='civics' && deadline>='$date'");
  $get_civics = mysql_fetch_assoc($get_civics_query);
  $count_undone_civics = mysql_num_rows($get_civics_query);         
$get_history_query = mysql_query("SELECT subject from posts where for_grade = '$grade' && subject='history' && deadline>='$date'");
  $get_history = mysql_fetch_assoc($get_history_query);
  $count_undone_history = mysql_num_rows($get_history_query);



?>

<?php 
if($position=="principal"){
  if (isset($_POST['schedule'])){
// Declare variable for the meeting scheduling form
  $for_grade = $_POST['select_grade'];
  $date_added = date('d-m-y');
    $place = $_POST['place'];


$sumbmitted_deadline = @$_POST['date'];

  $date = strtotime($sumbmitted_deadline);


$time = $_POST['time'];
$reason = $_POST['reason'];
// Send it to the database
if($place == ""){
echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Oops! </strong>No place is given.
</div>';
}
else if($date == "DD/MM/YYYY"){
echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Oops! </strong>No date is given.
</div>';
}
else if($date < strtotime(date("y-m-d")) ){
echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Oops! </strong>Invalid date.
</div>';
}
else if($time ==""){
echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Oops! </strong>No time is given.
</div>';
}
else if($reason == "") {
echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Oops! </strong>You have to tell the reason.
</div>';
}else
{

$run = mysql_query("INSERT into meeting VALUES('','$date_added','$user_name','$for_grade','$place','$date','$time','$reason','no')");
echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>You have successfuly scheduled a meeting</strong>.
</div>';
}}


include ("./inc/connect.inc.php");include ("./inc/connect.inc.php");
echo "
<div class='well'><img src='$profile_pic' height='150' width='150' /></div></br> Welcome to teachgram ".$user_name ."....
  <div class='panel panel-info'><div class='panel-heading'>
  <h3 class='panel-title'>Schedule a meeting below</h3></div>
  <div class='wrap'>
  <form action='home.php'  method='post'  class='form-horizontal'><fieldset>
      <label for='select' class='col-lg-2 control-label'>For Grade:</label>
  <select class='form-control' name='select_grade'>
  <option>Everyone</option>
  <option>All teachers</option>
  <option>Physics teachers</option>
  <option>Math teachers</option>
  <option>All students</option>
  <option>11<sup>th</sup> grade students</option>
  <option>12<sup>th</sup> grade students</option>
  </select></p>
<input type='text' name='place' size='70' class='form-control' placeholder='Place'></p>
<input id='datepicker' class='form-control' name='date' value='MM/DD/YYYY' /></p>
<input type='text' name='time' size='70' class='form-control' placeholder='Time'></p>
<textarea class='form-control' name='reason'   rows='4' cols='58' id='textArea'></textarea>
<input type='submit' name='schedule' value='SCHEDULE'    class='btn btn-primary' placeholder='SCHEDULE'></fieldset>
  </form>
</div></div>

";



// Get posts from the database
$getposts = mysql_query("SELECT * FROM posts ORDER BY id DESC LIMIT 10") ;
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


 echo "
  
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


echo '  

<div class="btn-group">
  <a href="#" class="btn btn-default">Liked by</a>
  <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
  <ul class="dropdown-menu">';
  
$get_likers = mysql_query("SELECT * from post_likes where like_id ='$id'");
  while($get = mysql_fetch_assoc($get_likers)){
$liker = $get['liked_by'];
   echo' <li><a href="http://localhost:8080/teachgram/profile.php?u='.$liker.'">'.$liker.'</a></li>';}
echo'
  </ul>
</div>
'
; echo "

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
echo '<h2>Top 10 Active Teachers</h2>
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Number of posts</th>
      <th>Number of uploads</th>
      <th>Total</th>
    </tr>
  </thead><tbody>
';
$get_rank = mysql_query("SELECT * FROM t_ranking ORDER BY total DESC");
$no_get_rank = mysql_num_rows($get_rank);


 for( $i=1; $i<=$no_get_rank; $i++){
$get = mysql_fetch_assoc($get_rank);
 $username =  $get['user_name'];
 $posts = $get['posts'];
 $uploads = $get['uploads'];
 $total = $get['total'];
echo '
<tr>
<td>'.$i.'</td>
<td>'.$username.'</td>
<td>'.$posts.'</td>
<td>'.$uploads.'</td>
<td>'.$total.'</td>
</tr>
';
}


echo'
  </tbody>
  </table>
';
echo"  <div class='panel panel-info'><div class='panel-heading'>
  <h3 class='panel-title'>Recieved lessonplans</h3></div> ";

  // Grab lessonplan that are submitted by a teacher
$grab_lessonplans = mysql_query("SELECT * FROM lessonplans where approved='no' ");
$numrows = mysql_numrows($grab_lessonplans);
if($numrows != 0) {
while($get_lessonplans = mysql_fetch_assoc($grab_lessonplans)){
  $id =$get_lessonplans['id'];
  $from =$get_lessonplans['from'];
  $subject =$get_lessonplans['subject'];
  $grade =$get_lessonplans['grade'];
    $unit =$get_lessonplans['unit'];
      $topic =$get_lessonplans['topic'];
   $date =$get_lessonplans['date_submitted'];
    $m1 =$get_lessonplans['m1'];
    $m2 =$get_lessonplans['m2'];
    $m3 =$get_lessonplans['m3'];
    $m4 =$get_lessonplans['m4'];
    $m5 =$get_lessonplans['m5']; 
        $m6 =$get_lessonplans['m6'];  
      $tu1 =$get_lessonplans['tu1'];
    $tu2 =$get_lessonplans['tu2'];
    $tu3 =$get_lessonplans['tu3'];
    $tu4 =$get_lessonplans['tu4'];
    $tu5 =$get_lessonplans['tu5']; 
        $tu6 =$get_lessonplans['tu6']; 
      $w1 =$get_lessonplans['w1'];
    $w2 =$get_lessonplans['w2'];
    $w3 =$get_lessonplans['w3'];
    $w4 =$get_lessonplans['w4'];
    $w5 =$get_lessonplans['w5']; 
        $w6 =$get_lessonplans['w6']; 
      $th1 =$get_lessonplans['th1'];
    $th2 =$get_lessonplans['th2'];
    $th3 =$get_lessonplans['th3'];
    $th4 =$get_lessonplans['th4'];
    $th5 =$get_lessonplans['th5'];
        $th6 =$get_lessonplans['th6'];
      $f1 =$get_lessonplans['f1'];
    $f2 =$get_lessonplans['f2'];
    $f3 =$get_lessonplans['f3'];
    $f4 =$get_lessonplans['f4'];
    $f5 =$get_lessonplans['f5'];  
        $f6 =$get_lessonplans['f6'];  
    
    ?>
<script language="javascript">
         function toggle<?php echo $id; ?> () {
           var ele = document.getElementById("toggletext<?php echo $id ?>");
           var text = document.getElementById("displaytext<?php echo $id ?>");
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
  if (@$_POST['approved_' . $id. '']){

$m1 =  @$_POST['m1'];
$m2 =  @$_POST['m2'];
$m3 =  @$_POST['m3'];
$m4 =  @$_POST['m4'];
$m5 =  @$_POST['m5'];
$m6 =  @$_POST['m6'];

$tu1 =  @$_POST['tu1'];
$tu2 =  @$_POST['tu2'];
$tu3 =  @$_POST['tu3'];
$tu4 =  @$_POST['tu4'];
$tu5 =  @$_POST['tu5'];
$tu6 =  @$_POST['tu6'];

$w1 =  @$_POST['w1'];
$w2 =  @$_POST['w2'];
$w3 =  @$_POST['w3'];
$w4 =  @$_POST['w4'];
$w5 =  @$_POST['w5'];
$w6 =  @$_POST['w6'];

$th1 =  @$_POST['th1'];
$th2 =  @$_POST['th2'];
$th3 =  @$_POST['th3'];
$th4 =  @$_POST['th4'];
$th5 =  @$_POST['th5'];
$th6 =  @$_POST['th6'];

$f1 =  @$_POST['f1'];
$f2 =  @$_POST['f2'];
$f3 =  @$_POST['f3'];
$f4 =  @$_POST['f4'];
$f5 =  @$_POST['f5'];
$f6 =  @$_POST['f6'];

$approve_query = mysql_query("UPDATE lessonplans SET approved='yes' , m1='$m1', m2='$m2', m3='$m3', m4='$m4', m5='$m5', m6='$m6', tu1='$tu1', tu2='$tu2', tu3='$tu3', tu4='$tu4', tu5='$tu5', tu6='$tu6', w1='$w1', w2='$w2', w3='$w3', w4='$w4', w5='$w5', w6='$w6', th1='$th1', th2='$th2', th3='$th3', th4='$th4', th5='$th5', th6='$th6', f1='$f1', f2='$f2', f3='$f3', f4='$f4', f5='$f5', f6='$f6' where id = '$id'");
  echo ' <div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>You have successfuly approved this lesson plan</strong> 
</div>

 
';

  }

  echo "
   <form method='POST' action='home.php'>

<input type='button' name='openmsg' value='$from- $subject- $grade ($date)' onclick = 'javascript:toggle$id()'>
<input type='submit' name='approved_$id' value='Approve this lesson plan'  >
</form>  
<div id='toggletext$id' style='display:none;'>
<div class='col-lg-10'><form action='home.php'  method='post' enctype='multipart/form-data'>
  <h3>Edit a lesson plan here </h3>
<form action='home.php'  method='post' enctype='multipart/form-data'>

<table class='table table-striped table-hover '>
<tr><td><div class='form-group'>
  <label class='control-label' for='inputSmall'>Unit</label>
".$unit."
</div></td><td>
<div class='form-group'>
  <label class='control-label' for='inputSmall'>Topic</label>
  ".$topic."
</div></td></tr><tr><td></td></tr>
<tr>
<th>Day</th>
<th>Contents</th>
<th>Objective of contents</th>
<th>Teacher's activity</th>
<th>Students activities</th>
<th>Teaching resources</th>
<th>Assessment</th>
</tr>
<tr>
<td><b>Monday</b></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='m1' id='m1' value='$m6'>".$m1."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='m2' id='m2' value='$m2'>".$m2."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='m3' id='m3' value='$m3'>".$m3."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='m4' id='m4' value='$m4'>".$m4."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='m5' id='m5' value='$m5'>".$m5."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='m6' id='m6' value='$m6'>".$m6."</textarea></td>

</tr>
<tr>
<td><b>Tuesday</b></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='tu1' id='tu1' value='$tu1'>".$tu1."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='tu2' id='tu2' >".$tu2."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='tu3' id='tu3' value='$tu3'>".$tu3."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='tu4' id='tu4' value='$tu4'>".$tu4."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='tu5' id='tu5' value='$tu5'>".$tu5."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='tu6' id='tu6' value='$tu6'>".$tu6."</textarea></td>
</tr>
<tr>
<td><b>Wednsday</b></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='w1' id='w1' >".$w1."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='w2' id='w2' >".$w2."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='w3' id='w3' >".$w3."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='w4' id='w4' >".$w4."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='w5' id='w5' >".$w5."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='w6' id='w6' >".$w6."</textarea></td>
</tr>
<tr>
<td><b>Thursday</b></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='th1' id='th1' value='$th1'>".$th1."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='th2' id='th2' value='$th2'>".$th2."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='th3' id='th3' value='$th3'>".$th3."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='th4' id='th4' value='$th4'>".$th4."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='th5' id='th5' value='$th5'>".$th5."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='th6' id='th6' value='$th6'>".$th6."</textarea></td>
</tr>
<tr>
<td><b>Friday</b></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='f1' id='f1' value='$f1'>".$f1."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='f2' id='f2' value='$f2'>".$f2."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='f3' id='f3' value='$f3'>".$f3."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='f4' id='f4' value='$f4'>".$f4."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='f5' id='f5' value='$f5'>".$f5."</textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='f6' id='f6' value='$f6'>".$f6."</textarea></td>
</tr>
<tr>
<td></td>
<td></td>
<td>  <input type='submit' name='approved_$id'   value='Approve'    class='btn btn-primary' placeholder='POST'></td>
<td></td>
<td></td>
</tr>
</table>
</form> 
</div>
</div>
 

";}}
else{
  echo "  </div> You haven't recieved any lessonplans yet";
   }
include("inc/footer.inc.php");
include("inc/footer.inc.php");
             }

if($position=="student")  {
    
echo"
<div class='well'><img src='$profile_pic' height='150' width='150' /></div></br> Welcome to teachgram ".$user_name ."....</td>
  <td ><div class='panel panel-info'><div class='panel-heading'>
  <h3 class='panel-title'>Things to Do</h3></div>
    <ul class='nav nav-pills'>

                <li ><h3>&nbsp;Math</h3><a class='math' href='things_to_do.php?u=math'><span class='badge'>"; if($count_undone_math >=1) {echo $count_undone_math;} echo "</span></a></li>
                <li ><h3>Amharic</h3><a class='amharic' href='things_to_do.php?u=amharic'><span class='badge'>"; if($count_undone_amharic >=1) {echo $count_undone_amharic;} echo "</span></a></li>
                <li ><h3>English</h3><a class='english' href='things_to_do.php?u=english'><span class='badge'>"; if($count_undone_english >=1) {echo $count_undone_english;} echo "</span></a></li>
                <li ><h3>Biology</h3><a class='biology' href='things_to_do.php?u=biology'><span class='badge'>"; if($count_undone_biology >=1) {echo $count_undone_biology;} echo "</span></a></li>
                <li ><h3>Chemistry</h3><a class='chemistry' href='things_to_do.php?u=chemistry'><span class='badge'>"; if($count_undone_chemistry >=1) {echo $count_undone_chemistry;} echo "</span></a></li>
                <li ><h3>Physics</h3><a class='physics' href='things_to_do.php?u=physics'><span class='badge'>"; if($count_undone_physics >=1) {echo $count_undone_physics;} echo "</span></a></li>
                <li ><h3>Civics</h3><a class='civics' href='things_to_do.php?u=civics'><span class='badge'>"; if($count_undone_civics >=1) {echo $count_undone_civics;} echo "</span></a></li>
                <li ><h3>History</h3><a class='history' href='things_to_do.php?u=history'><span class='badge'>"; if($count_undone_history >=1) {echo $count_undone_history;} echo "</span></a></li>
                <li ><h3>Geography</h3><a class='geography' href='things_to_do.php?u=geography'><span class='badge'>"; if($count_undone_geography >=1) {echo $count_undone_geography;} echo "</span></a></li>
  

        </ul>        

</div>
  </td>
</tr>
<tr><td></td><td>
";
  // Get posts from the database
$getposts = mysql_query("SELECT * FROM posts WHERE for_grade='$grade' ORDER BY id DESC LIMIT 10") ;
while($row = mysql_fetch_assoc($getposts)){
    $id = $row['id'];
    $body = $row['body']; 
    $date_added = $row['date_added'];
    $added_by = $row['added_by'];
    $user_posted_to = $row['for_grade'];
    $attachment = $row['attachments'];
    $deadline = $row['deadline'];
    $date = date("m/d/y");
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

    if($deadline>=strtotime($date)){
 echo "
  
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

<iframe src='./like_frame.php?id=$id' frameborder='0' style='max-width: 70px; max-height: 72px;'></iframe>

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
 } 
 echo "";
}
}


 echo "

</td>
  
</tr>
</table>


";
if($position=="teacher")  {

  echo"
<div class='well'><img src='$profile_pic' height='150' width='150' /></div></br> Welcome to teachgram $user_name...


  <h3>Post here</h3>
     <form action='home.php'  method='post' enctype='multipart/form-data'>
 <textarea class='form-control' name='post'   rows='4' cols='58' id='textArea'></textarea>
  <label for='select' class='col-lg-2 control-label'>For Grade:</label>
  <select class='form-control' name='select_grade'>
  <option></option>
  <option>9</option>
  <option>10</option>
  <option>11</option>
  <option>12</option>
  </select>
  <label for='select' class='col-lg-2 control-label'>Deadline (MM/DD/YYYY):</label><form>
<input id='datepicker' type='text' class='form-control' name='deadline' />
";
 




 echo "



<input type='file' name='file'></br>
   <input type='submit' name='send'  onclick='javascript:send_post()' value='Post'    class='btn btn-primary' placeholder='POST'></form>
  </form>


  ";


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


 echo "
  
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


echo '  

<div class="btn-group">
  <a href="#" class="btn btn-default">Liked by</a>
  <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
  <ul class="dropdown-menu">';
  
$get_likers = mysql_query("SELECT * from post_likes where like_id ='$id'");
  while($get = mysql_fetch_assoc($get_likers)){
$liker = $get['liked_by'];
   echo' <li><a href="http://localhost:8080/teachgram/profile.php?u='.$liker.'">'.$liker.'</a></li>';}
echo'
  </ul>
</div>
'
; echo "

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

  

  echo " <div class='col-lg-10'><form action='home.php'  method='post' enctype='multipart/form-data'>
  <h3>Submit a lesson plan here </h3>
 
<form action='home.php'  method='post' enctype='multipart/form-data'>

<table class='table table-striped table-hover '>
<tr><td><div class='form-group'>
  <label class='control-label' for='inputSmall'>Unit</label>
  <input class='form-control input-sm' id='inputSmall' name='unit' type='text'>
</div></td><td>
<div class='form-group'>
  <label class='control-label' for='inputSmall'>Topic</label>
  <input class='form-control input-sm' id='inputSmall' name='topic' type='text'>
</div></td></tr><tr><td></td></tr>
<tr>
<th>Day</th>
<th>Contents</th>
<th>Objective of contents</th>
<th>Teacher's activity</th>
<th>Students activities</th>
<th>Teaching resources</th>
<th>Assessment</th>
</tr>
<tr>
<td><b>Monday</b></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='m1' id='m1'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='m2' id='m2'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='m3' id='m3'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='m4' id='m4'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='m5' id='m5'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='m6' id='m6'></textarea></td>

</tr>
<tr>
<td><b>Tuesday</b></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='tu1' id='tu1'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='tu2' id='tu2'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='tu3' id='tu3'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='tu4' id='tu4'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='tu5' id='tu5'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='tu6' id='tu6'></textarea></td>
</tr>
<tr>
<td><b>Wednsday</b></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='w1' id='w1'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='w2' id='w2'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='w3' id='w3'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='w4' id='w4'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='w5' id='w5'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='w6' id='w6'></textarea></td>
</tr>
<tr>
<td><b>Thursday</b></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='th1' id='th1'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='th2' id='th2'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='th3' id='th3'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='th4' id='th4'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='th5' id='th5'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='th6' id='th6'></textarea></td>
</tr>
<tr>
<td><b>Friday</b></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='f1' id='f1'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='f2' id='f2'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='f3' id='f3'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='f4' id='f4'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='f5' id='f5'></textarea></td>
<td><textarea class='form-control
rows='5' cols='7' type='text'  name='f6' id='f6'></textarea></td>
</tr>
<tr>
<td></td>
<td></td>
<td>  <input type='submit' name='submit'   value='Submit'    class='btn btn-primary btn-lg btn-block' placeholder='POST'></td>
<td></td>
<td></td>
</tr>
</table>
</form> 

  ";



if (isset($_POST['submit'])){
$unit =  @$_POST['unit'];
$topic =  @$_POST['topic'];

$m1 =  @$_POST['m1'];
$m2 =  @$_POST['m2'];
$m3 =  @$_POST['m3'];
$m4 =  @$_POST['m4'];
$m5 =  @$_POST['m5'];
$m6 =  @$_POST['m6'];

$tu1 =  @$_POST['tu1'];
$tu2 =  @$_POST['tu2'];
$tu3 =  @$_POST['tu3'];
$tu4 =  @$_POST['tu4'];
$tu5 =  @$_POST['tu5'];
$tu6 =  @$_POST['tu6'];

$w1 =  @$_POST['w1'];
$w2 =  @$_POST['w2'];
$w3 =  @$_POST['w3'];
$w4 =  @$_POST['w4'];
$w5 =  @$_POST['w5'];
$w6 =  @$_POST['w6'];

$th1 =  @$_POST['th1'];
$th2 =  @$_POST['th2'];
$th3 =  @$_POST['th3'];
$th4 =  @$_POST['th4'];
$th5 =  @$_POST['th5'];
$th6 =  @$_POST['th6'];

$f1 =  @$_POST['f1'];
$f2 =  @$_POST['f2'];
$f3 =  @$_POST['f3'];
$f4 =  @$_POST['f4'];
$f5 =  @$_POST['f5'];
$f6 =  @$_POST['f6'];

$date_added = date('d/m/y');
$name= $f_name .' '.$l_name;

if($topic=='' || $unit==''){
  echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
Either the topic or unit field is empty ! </div>
  ';
}
else{
 
 $sumbit= mysql_query("INSERT into lessonplans VALUES('','$name','$subject', '$grade','$unit','$topic','$date_added','no', '$m1','$m2','$m3','$m4','$m5','$m6','$tu1','$tu2','$tu3','$tu4','$tu5','$tu6','$w1','$w2','$w3','$w4','$w5','$w6','$th1','$th2','$th3','$th4','$th5','$th6','$f1','$f2','$f3','$f4','$f5','$f6')") or die (mysql_error());

  echo ' <div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>You have successfuly submitted your lesson plan</strong> 
</div>

 
';
  }}
 echo ' <div class="panel panel-info"><div class="panel-heading">
  <h3 class="panel-title">My approved Lesson Plans</h3></div>'; 


$grab_lessonplans = mysql_query("SELECT * FROM lessonplans where subject='$subject' && grade='$grade' && approved='yes'  ");
$numrows = mysql_numrows($grab_lessonplans);
if($numrows != 0) {
while($get_lessonplans = mysql_fetch_assoc($grab_lessonplans)){
 $id =$get_lessonplans['id'];

  $date_submitted =$get_lessonplans['date_submitted'];

  echo "<a >". $date_submitted."                                             </a> <a href='lessonplan.php?u=". $id."' >". "<button class='open_pdf'></button> </a></p>";
}

}}
?>


</td></tr>
</table>

</div>
<?php
include("inc/footer.inc.php");

?>
