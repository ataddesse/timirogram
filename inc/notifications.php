<?php include ("./inc/header.inc.php"); 

?>
<?php

 include ("./inc/connect.inc.php");
?>
<div id = "wrap">
<br/><br/><br/>
<h3>My notifications</h3>
<div class="panel panel-default">
  <div class="panel-heading"><h4>Meetings</h4></div>
  <div class="panel-body">
   
  <img src="./img/2017-22-6--11-36-12.png"></img>
<?php
$check = mysql_query("SELECT grade FROM susers WHERE user_name = '$user_name' ");
   // Check if there is a meeting
   if (mysql_num_rows($check)===1){
    $get = mysql_fetch_assoc($check);
  
    $grade = $get['grade'] ."th grade students";
   
}
 // Get meetings concerning the user
$grab_meetings = mysql_query("SELECT * FROM meeting where scheduled_for='$grade' || scheduled_for= 'Everyone'  ");
$numrows = mysql_numrows($grab_meetings);
if($numrows != 0) {
while($get_meetings = mysql_fetch_assoc($grab_meetings)){
	// declare variable for the meeting exctracted from the database
      $id = $get_meetings['id'];
      $date_added= $get_meetings['date_added'];
      $by = $get_meetings['scheduled_by'];
      $for = $get_meetings['scheduled_for'];
      $place = $get_meetings['place'];
      $date = $get_meetings['date1'];
      $time = $get_meetings['time'];
      $reason = $get_meetings['reason'];

      $date1  = date("m/d/y", $date);
      
      $current_date = strtotime(date("m/d/y"));
      if($date>=$current_date){


   if (isset($_POST['gotit'])){
   	$gotit= mysql_query("UPDATE meeting SET opened='yes' where id='$id'");
}   
 echo"
 <table class='table table-striped table-hover '>
<tr class='info'>
      <td>Invitation from:</td>
      <td>$by</td>
</tr>
<tr class='info'>
      <td>To:</td>
      <td>$for</td>
</tr>
<tr class='info'>
      <td>At:</td>
      <td>$place</td>
</tr>
<tr class='info'>
      <td>Date:</td>
      <td>$date1</td>
</tr>
<tr class='info'>
      <td>Time:</td>
      <td>$time</td>
</tr>
<tr class='info'>
      <td>Reason:</td>
      <td>$reason</td>
</tr>
 <tr class='info'>
      <td></td>
      <td>
<form method='POST'>

<input type='submit' name='gotit' value='GOT IT'    class='btn btn-primary' placeholder='GOT IT'>
</form


      </td>
      

</tr>
 </table>


 "     ;}
     }
}
?></div>
</div>
</div>
<?php
include("inc/footer.inc.php");

?>
