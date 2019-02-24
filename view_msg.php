
<?php
include ("./inc/header.inc.php");
include ("./inc/connect.inc.php"); ?>

<div id="wrap"><br/><br/><br/><br/>

<?php

if (isset($_GET ['u'])){
  // Get the username of the user
   $from= mysql_real_escape_string($_GET['u']);
     }
     // Grab the messages for the logged in user
$grab_messages = mysql_query("SELECT * FROM pvt_messages where (
                user_to = '$from' OR user_to = '$user_name') AND (
                user_from = '$from' OR user_from = '$user_name')");
$set_open_query = mysql_query("UPDATE pvt_messages SET opened='yes' where user_from = '$from' && user_to='$user_name'");
$numrows = mysql_numrows($grab_messages);
if($numrows != 0) {
		if(isset($_POST['send_msg'])){
  		$msg_body = strip_tags(@$_POST['msg_body']);
  		$date = date("Y-m-d");
  		$opened = "no";
        $deleted = "no";


$check_convo = "select * from pvt_convos where (
                user_to = '$from' OR user_to = '$user_name') AND (
                user_from = '$from' OR user_from = '$user_name') ";

  $run = mysql_query($check_convo);


     
  if (mysql_num_rows($run)>0  ){

   $send_msg = mysql_query("INSERT into pvt_messages VALUES ('','$user_name','$from','$msg_body','$date','$opened','$deleted')");
   $update_convo = mysql_query("UPDATE pvt_convos SET  user_from='$user_name', user_to='$from', last_msg='$msg_body'  where (
                user_to = '$from' OR user_to = '$user_name') AND (
                user_from = '$from' OR user_from = '$user_name') ")or die (mysql_error());

      echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>Your message has been sent!</div>';
  }
  else{ 


  		$send_msg = mysql_query("INSERT into pvt_messages VALUES ('','$user_name','$from','$msg_body','$date','$opened','$deleted')");
      $insert_convo = mysql_query("INSERT into pvt_convos VALUES('','$user_name','$from','$msg_body','$date','$opened')")or die (mysql_error());
    
     echo '<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>Your message has been sent!</div>';;

  }


  	}
while($get_msg = mysql_fetch_assoc($grab_messages)){
  $id =$get_msg['id'];
  $user_to =$get_msg['user_to'];
  $user_from =$get_msg['user_from'];
    $msg_body =$get_msg['msg_body'];
    $date =$get_msg['date'];
    $opened =$get_msg['opened'];

    if($user_from==$user_name){
    	$user_from = "You";
    }

    echo  '<label class="control-label">'.$user_from .'</label><div class="well well-success">' .$msg_body .'</div> ' . $date ;
}

echo '<form action="view_msg.php?u='.$from.'#" method="POST" >
<label class="control-label">You</label>
<div class="form-group">
    <div class="input-group">

    <input class="form-control" type="text" name="msg_body">
    <span class="input-group-btn">
 <input  type="submit"  name="send_msg" class="post_comment" ></span>

    </span>
  </div>
</div>


</form>';
 
}
?>
</div>
<?php
include("inc/footer.inc.php");

?>