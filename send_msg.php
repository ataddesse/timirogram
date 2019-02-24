 <?php
 include ("./inc/header.inc.php"); 
if (isset($_GET['u'])) {
  $username = mysql_real_escape_string($_GET['u']);
  if (ctype_alnum($username)) {
  //check user exists
  $check = mysql_query("SELECT user_name, f_name FROM susers WHERE user_name='$username'");
  if (mysql_num_rows($check)===1) {
  $get = mysql_fetch_assoc($check);
  $username = $get['user_name'];
  $f_name = $get['f_name']; 
       //check whether users aren't sending private messaging to themselves
  if ($user_name != $username)
  {
  	if(isset($_POST['submit'])){
  		$msg_body = strip_tags(@$_POST['msg_body']);
  		$msg_title = strip_tags(@$_POST['msg_title']);
  		$date = date("Y-m-d");
  		$opened = "no";
        $deleted = "no";

  		$send_msg = mysql_query("INSERT into pvt_messages VALUES ('','$user_name','$username','$msg_body','$date','$opened','$deleted')");
  		echo "Your message has been sent!";
  	}
  	echo "

<form action='send_msg.php?u=$username' method='POST'>
<h3> Compose a message ($username) </h3>
<textarea cols='50' rows='12' name='msg_body'>Type the message you want to send ...</textarea>
<input type='submit' name='submit' value='Send'>

  	";
     }else{
     	header("Location: $user_name");
     }
  }
  }
}


  ?>