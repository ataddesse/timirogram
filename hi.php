<?php 
include ("./inc/header.inc.php"); 
include ("./inc/connect.inc.php");
?>

<html>
$date1 =strtotime("5/1/2017");
$date1 =strtotime("4/26/2017");
$date1 =strtotime("4/23/2017");
$date2 =strtotime("4/22/2017");

$diff = $date1 - $date2;
echo floor($diff/ (60 * 60 * 24)); 

<body><br/><br/><br/><br/><br/><br/>
<?php
 $get = mysql_query("SELECT * from posts where added_by = 'abiy' ");
 $getget = mysql_fetch_assoc($get);
 $date = $getget['date_added'];
 $final = max($date);
 echo $final;
?>

<form>

</form>
<?php


include("inc/footer.inc.php");

?>