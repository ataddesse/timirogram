// Grab lessonplan that are submitted by a teacher
$grab_lessonplans = mysql_query("SELECT * FROM lessonplans where approved='no' ");
$numrows = mysql_numrows($grab_lessonplans);
if($numrows != 0) {
while($get_lessonplans = mysql_fetch_assoc($grab_lessonplans)){
  $id =$get_lessonplans['id'];
  $from =$get_lessonplans['from'];
  $subject =$get_lessonplans['subject'];
  $grade =$get_lessonplans['grade'];
   $date =$get_lessonplans['date'];
    $m1 =$get_lessonplans['m1'];
    $m2 =$get_lessonplans['m2'];
    $m3 =$get_lessonplans['m3'];
    $m4 =$get_lessonplans['m4'];
    $m5 =$get_lessonplans['m5'];  
      $tu1 =$get_lessonplans['tu1'];
    $tu2 =$get_lessonplans['tu2'];
    $tu3 =$get_lessonplans['tu3'];
    $tu4 =$get_lessonplans['tu4'];
    $tu5 =$get_lessonplans['tu5']; 
      $w1 =$get_lessonplans['w1'];
    $w2 =$get_lessonplans['w2'];
    $w3 =$get_lessonplans['w3'];
    $w4 =$get_lessonplans['w4'];
    $w5 =$get_lessonplans['w5']; 
      $th1 =$get_lessonplans['th1'];
    $th2 =$get_lessonplans['th2'];
    $th3 =$get_lessonplans['th3'];
    $th4 =$get_lessonplans['th4'];
    $th5 =$get_lessonplans['th5'];
      $f1 =$get_lessonplans['f1'];
    $f2 =$get_lessonplans['f2'];
    $f3 =$get_lessonplans['f3'];
    $f4 =$get_lessonplans['f4'];
    $f5 =$get_lessonplans['f5'];  
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
  if (@$_POST['approve_' . $id. '']){
$approve_query = mysql_query("UPDATE lessonplans SET approved='yes' where id = '$id'");
  }