
      <link rel="stylesheet" href="css/bootstrap.css" media="screen">

<?php
include ("./inc/connect.inc.php");
// starting the user_name session
$user_name =  "";
session_start();
if (!isset($_SESSION["user_name"])){

}
else
{
  $user_name = $_SESSION["user_name"];
}

if (isset($_GET ['u'])){
  // Get the username of the user
   $id= mysql_real_escape_string($_GET['u']);
  

}


$grab_lessonplans = mysql_query("SELECT * FROM lessonplans where id='$id' ");
$numrows = mysql_numrows($grab_lessonplans);
if($numrows != 0) {
$get_lessonplans = mysql_fetch_assoc($grab_lessonplans);
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
        $space= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        $table= "
<table  border='1' cellpadding='0' cellspacing='0' height='100%' width='100%' style='border-collapse:collapse;'>
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
<td>".$m1."</td>

<td>".$m2."</td>
<td>".$m3."</td>
<td>".$m4."</td>
<td>".$m5."</td>
<td>".$m6."</td>
</tr>
<tr>
<td><b>Tuesday</b></td>
<td>".$tu1."</td>

<td>".$tu2."</td>
<td>".$tu3."</td>
<td>".$tu4."</td>
<td>".$tu4."</td>
<td>".$tu6."</td>
</tr>
<tr>
<td><b>Wednsday</b></td>
<td>".$w1."</td>

<td>".$w2."</td>
<td>".$w3."</td>
<td>".$w4."</td>
<td>".$w5."</td>
<td>".$w6."</td>
</tr>
<tr>
<td><b>Thursday</b></td>


<td>".$th1."</td>

<td>".$th2."</td>
<td>".$th3."</td>
<td>".$th4."</td>
<td>".$th5."</td>
<td>".$th6."</td>
</tr>
<tr>
<td><b>Friday</b></td>
<td>".$f1."</td>

<td>".$f2."</td>
<td>".$f3."</td>
<td>".$f4."</td>
<td>".$f5."</td>
<td>".$f6."</td>
</tr>

</table>
";

}
require ("MPDF57/mpdf.php");
$header = "<h1 align='center'>Andinet International School</h1
><h3 align='center'>Lesson Plan</h3
> <p align='center'>ADDIS ABABA, ETHIOPIA</p
>";
$info = "<h3 align='center'>By:".$from.$space."Grade:".$grade.$space."Unit:".$unit.$space."Topic:".$topic.$space."Subject:".$subject.$space."Date:".date("m/d/y")."</h3>";
$footer = "<br/><br/><br/>
Teacher's signature: <img src='img/sign2.PNG'></img>".$space.$space.$space.$space.$space.$space.$space.$space.$space.$space.$space.$space.$space.$space.$space.$space.$space.$space."Principal's signature: <img src='img/sign.PNG'></img>
";
$mpdf=new mPDF('c','A4-L');
$mpdf->WriteHTML($header);
$mpdf->WriteHTML($info);
$mpdf->WriteHTML($table);
$mpdf->WriteHTML($footer);
$mpdf->SetDisplayMode('fullpage');
$mpdf->Output();

?>