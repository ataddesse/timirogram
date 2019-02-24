<?php
include ("./inc/header.inc.php");
include ("./inc/connect.inc.php"); 
?> 
<div id="wrap">
<br/><br/><br/><br/>


<script language="javascript">
         function toggle1 () {
           var ele = document.getElementById("toggletext1");
           var text = document.getElementById("displaytext1");
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
  if(isset($_POST['send_msg'])){
     $to = strip_tags(@$_POST['to']);
      $msg_body = strip_tags(@$_POST['msg_body']);
      $date = date("Y-m-d");
      $opened = "no";
        $deleted = "no";


 $check_convo = "select * from pvt_convos where 
                user_to = '$to' AND user_from = '$user_name'   ";
 $check_convo2 = "select * from pvt_convos where 
            user_to = '$user_name' AND user_from = '$to'  ";
  $run = mysql_query($check_convo);
  $run2 = mysql_query($check_convo2);

     
  if (mysql_num_rows($run)>0 || mysql_num_rows($run2)>0 ){
  $send_msg = mysql_query("INSERT into pvt_messages VALUES ('','$user_name','$to','$msg_body','$date','$opened','$deleted')")or die (mysql_error());
   $update_convo = mysql_query("UPDATE pvt_convos SET last_msg='$msg_body', user_to='$to', user_from='$user_name'  where user_to = '$to' AND user_from = '$user_name' || user_to = '$user_name' AND user_from = '$to' ")or die (mysql_error());

      echo "Your message has been sent!";
  }
  if (mysql_num_rows($run)==0 || mysql_num_rows($run2)==0 ){ 

     $send_msg = mysql_query("INSERT into pvt_messages VALUES ('','$user_name','$to','$msg_body','$date','$opened','$deleted')")or die (mysql_error());
      $insert_convo = mysql_query("INSERT into pvt_convos VALUES('','$user_name','$to','$msg_body','$date','$opened')")or die (mysql_error());
    
      echo "Your message has been sent!";

  }


   
    }
?>
<div class="panel panel-default" style="width: 250px">
  <div class="panel-body">
 <form method='POST' action=''>
<p>Compose a message<input type="button" class="compose" name='openmsg' onclick = 'javascript:toggle1()'></p>

</form>
</div>
</div>
<div id='toggletext1' style='display:none;'>

<form class="form-horizontal" action="my_messages.php" method="POST" >
<fieldset>

 
    <div class="form-group">
 
              <input class="form-control" placeholder="To" id="inputEmail" name="to" type="text"><br/>
   
    <div class="input-group">

    <input class="form-control" type="text" placeholder="Type your message here..." name="msg_body">
    <span class="input-group-btn">
 <input  type="submit"  name="send_msg" class="post_comment" ></span>

    </span>
  </div>
</div>
</fieldset>
</form>

</div>
<div></div>
<?php
// Grab the messages for the logged in user
$grab_messages = mysql_query("SELECT * FROM pvt_convos where user_to= '$user_name' || user_from= '$user_name' ");
$numrows = mysql_numrows($grab_messages);
if($numrows != 0) {

echo '<div class="list-group">
  


';
while($get_msg = mysql_fetch_assoc($grab_messages)){
  $id =@$get_msg['id'];
  $user_to =@$get_msg['user_to'];
  $user_from =@$get_msg['user_from'];
    $msg_body =@$get_msg['last_msg'];
    $body = @substr($msg_body, 0,5);
    $date =@$get_msg['date'];


$unread_msg_querry = mysql_query("SELECT opened from pvt_messages where user_to = '$user_name' && user_from = '$user_from' && opened='no' ");
  $get_unread = mysql_fetch_assoc($unread_msg_querry);
  $count_unread = mysql_num_rows($unread_msg_querry);
if ($user_from==$user_name){
  $user_from = $user_to;
}

    if (strlen($msg_body) > 5){
echo '
  <a href="view_msg.php?u='.$user_from.'" class="list-group-item">
    <h4 class="list-group-item-heading">'.$user_from.'</h4>
    <p class="list-group-item-text">'.$date.'<br/>'. $body.'<span class="badge">';if ($count_unread > 0){ echo $count_unread;}echo '</span></p>
  </a>
    ';

    }else{  echo '
  <a href="view_msg.php?u='.$user_from.'" class="list-group-item">
    <h4 class="list-group-item-heading">'.$user_from.'</h4>
    <p class="list-group-item-text">'.$date.''. $msg_body.'<span class="badge">';if ($count_unread > 0){ echo $count_unread;}echo '</span></p>
  </a>
    ';



}
echo '</div>';
}}?>
</div> 
<?php
include("inc/footer.inc.php");

?>