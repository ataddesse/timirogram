<html><?php
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
?>

<head> 
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/bootstrap.css" media="screen">
   <script src="js/collapse.js"></script>
        <script src="js/dropdown.js"></script>  
  <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
   <link rel="icon" type="image/png" href="favicon.png">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  
  <script>
  $(document).ready(function() {
    $("#datepicker").datepicker();
  });
  </script>
</head>
<body>
  

  <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
      
       <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">          <span class="sr-only"><b>Timirogram</b></span></span>
        <span class="sr-only"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="navbar-brand" href="home.php "> <b>Timirogram</b></a>
    </div>
     <div class="navbar-collapse collapse" id="navbar-main">
    
    <?php 
 $activepage = basename($_SERVER['PHP_SELF'], '.php');
    if(!$user_name){ echo '

        
          <ul class="nav navbar-nav navbar-right">
        <li><a href="about_us.php">About us</a></li>
    <li><a href="contuct_us.php">Contuct us</a></li>

      </ul>'; }else{
        // Counting unread messages
  $get_unread_query = mysql_query("SELECT opened from pvt_messages where user_to = '$user_name'  && opened='no'");
  $get_unread = mysql_fetch_assoc($get_unread_query);
  $unread_numrows = mysql_num_rows($get_unread_query);
      
  //Check whether the user has uploaded a profile picture or not
$check_pic = mysql_query("SELECT user_pic FROM susers where user_name='$user_name'");
$get_pic_row = mysql_fetch_assoc($check_pic);
$profile_pic_db = $get_pic_row['user_pic'];
if($profile_pic_db == "") {
$profile_pic = "./img/default_pic.jpg";
}else{
$profile_pic = "userdata/profile_pics/".$profile_pic_db; 
}
$check = mysql_query("SELECT fav_extra FROM susers WHERE user_name = '$user_name' ");
   // Check if there is a meeting
   if (mysql_num_rows($check)===1){
    $get = mysql_fetch_assoc($check);
  
    $fav_extra = $get['fav_extra'];
   
}

       //Count upcoming meetings
     $current_date = strtotime(date("m/d/y"));

     echo $current_date;
$check = mysql_query("SELECT grade FROM susers WHERE user_name = '$user_name' ");
     if (mysql_num_rows($check)===1){
    $get = mysql_fetch_assoc($check);
  
    $grade = $get['grade'] ."th grade students";
   
}


  $get_meeting_query = mysql_query("SELECT date1 from meeting where date1>='$current_date' && scheduled_for = '$grade' ||  scheduled_for='Everyone' || scheduled_for='All students' || scheduled_by= '$fav_extra' ") or die (mysql_error());
  $get_meeting= mysql_fetch_assoc($get_meeting_query);

  $meeting_numrows = mysql_num_rows($get_meeting_query);
 
    
echo '   

  <form class="navbar-form navbar-left" action="search_results.php?k=" method="GET" role="search">
        <div class="form-group">
          <input type="text" name="k" id="k" class="form-control" placeholder="Search">
       </div>
        <input type="submit"  value="Search" class="btn btn-default">
      </form> ';
      echo'
          <ul class="nav navbar-nav navbar-right">
        <li class="'; 
echo ($activepage == 'my_messages')?'active':'';

         echo'""><a href="my_messages.php"><button class="message"></button><span class="badge">';if($unread_numrows>=1){ echo $unread_numrows ; }echo'</span></a></li>
        <li class="'; 
echo ($activepage == 'notifications')?'active':'';

         echo'""><a href="notifications.php"><button class="notification"></button><span class="badge">';if($meeting_numrows>=1){echo $meeting_numrows ;}echo'</span></a></li>
         
     
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img class="img-circular-navbar" src="'.$profile_pic.'">     '.$user_name.' <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
         <li class="'; 
echo ($activepage == 'account_settings')?'active':'';

         echo'""><a href="account_settings.php">Account Settings</a></li>
     <li class="'; 
echo ($activepage == 'profile')?'active':'';

         echo'""><a href="profile.php?u='.$user_name.'">My profile</a></li>
    <li><a href="logout.php">Log out</a></li></ul></li></ul>'; 
      
      }
?>
    </div>
  </div>
</nav></body>
</body></html>

