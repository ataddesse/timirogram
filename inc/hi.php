<?php 
include ("./inc/header.inc.php"); 
include ("./inc/connect.inc.php");
?>

<html>

<head>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  
  <script>
  $(document).ready(function() {
    $("#datepicker").datepicker();
  });
  </script>
</head>
<body><br/><br/><br/><br/><br/><br/>
<form>
<img style=" width: 100px;
  height: 50px;" src="../img/2017-22-6--11-36-12.png"></img>
    <input id="datepicker" />
</form>
<?php
include("inc/footer.inc.php");

?>