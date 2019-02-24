<?php
include ("./inc/header.inc.php"); 
?> 
<h2> My unread messages </h2>
  
<?php
// Grab the messages for the logged in user
$grab_messages = mysql_query("SELECT * FROM pvt_messages where user_to= '$user_name' && opened='no' && deleted='no'");
$numrows = mysql_numrows($grab_messages);
if($numrows != 0) {
while($get_msg = mysql_fetch_assoc($grab_messages)){
	$id =$get_msg['id'];
	$user_to =$get_msg['user_to'];
	$user_from =$get_msg['user_from'];
	$msg_title =$get_msg['msg_title'];
    $msg_body =$get_msg['msg_body'];
    $date =$get_msg['date'];
    $opened =$get_msg['opened'];
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
    if (strlen($msg_title) > 50){
  $msg_title = substr($msg_title, 0, 150) . "...";  
}else{
	$msg_title = $msg_title;}
if (strlen($msg_body) > 150){
  $msg_body = substr($msg_body, 0, 150) . "...";  
}else{
	$msg_body = $msg_body;
	if(@$_POST['setopened_'.$id.'']){
		$setopened = mysql_query("UPDATE pvt_messages SET opened='yes' where id = '$id'");
	} 
echo "
<form method='POST' action='my_messages.php' name='msg_title'>
<b><a href='$user_from' >$user_from</a> </b>
<input type='button' name='openmsg' value='$msg_title' onclick = 'javascript:toggle$id()'>
<input type='submit' name='setopened_$id' value=\"I've read this\" >
</form>  
<div id='toggletext$id' style='display:none;'>
$msg_body
</div>
<hr/>
";
}
}
}
else{
	echo "You haven't read any messages yet.";
}


?>

<h2> My read messages </h2>
<?php
// Grab the messages for the logged in user
$grab_messages = mysql_query("SELECT * FROM pvt_messages where user_to= '$user_name' && opened='yes' && deleted='no'");
$numrows_read = mysql_numrows($grab_messages);
if($numrows_read != 0) {
while($get_msg = mysql_fetch_assoc($grab_messages)){
	$id =$get_msg['id'];
	$user_to =$get_msg['user_to'];
	$user_from =$get_msg['user_from'];
	$msg_title =$get_msg['msg_title'];
    $msg_body =$get_msg['msg_body'];
    $date =$get_msg['date'];
    $opened =$get_msg['opened'];
     $deleted =$get_msg['deleted'];
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
if (strlen($msg_title) > 50){
  $msg_title = substr($msg_title, 0, 150) . "...";  
}else{
	$msg_title = $msg_title;}
if (strlen($msg_body) > 150){
  $msg_body = substr($msg_body, 0, 150) . "...";  
}else{
	$msg_body = $msg_body; 
	if (@$_POST['delete_' . $id. '']){
$delete_msg_query = mysql_query("UPDATE pvt_messages SET deleted='yes' where id = '$id'");
	}

echo "
<form method='POST' action='my_messages.php' name='msg_title'>
<b><a href='$user_from' >$user_from</a> </b>
<input type='button' name='openmsg' value='$msg_title' onclick = 'javascript:toggle$id()'>
<input type='submit' name='delete_$id' value=\"X\" title='delete message' >
</form>  
<div id='toggletext$id' style='display:none;'>
$msg_body
</div>
<hr/>
";
}
}
}
else{
	echo "You haven't read any messages yet.";
}

?>