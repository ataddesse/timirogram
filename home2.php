<?php include ("./inc/header.inc.php"); 


if(!$_SESSION['user_name']){
	header("location: index.php");
}

?>
<?php
mysql_connect("localhost","root","");
mysql_select_db("tusers_db");

if (isset($_GET ['u'])){
   $user_name = mysql_real_escape_string($_GET['u']);
   if (ctype_alnum($user_name)) {
   
   $check = mysql_query("SELECT user_name, f_name FROM tusers WHERE user_name = '$user_name' ");
   if (mysql_num_rows($check)===1){
   	$get = mysql_fetch_assoc($check);
   	$user_name = $get['user_name'];
   	$first_name = $get['f_name'];
  }
   else
   {
   	echo "<script>window.open('index.php','_self')</script>";
   	exit();
   }
   }

}


?>


<table class= "table table-striped table-hover">
<tr >
	<td><img src="" height="250" width="200" alt="<?php echo $user_name; ?>'s Profile"/></td>
	<td>
  <h3>Post here</h3>
     <div class="col-lg-10"><form action="<?php echo $user_name; ?>" method="post">
 <textarea class="form-control" name="post"   rows="4" cols="58" id="textArea"></textarea>

 


   <input type="submit" name="send"  onclick="javascript:send_post()" value="Post"    class="btn btn-primary" placeholder="POST">
  <?php include ("send_post.php"); ?></form></td>
	</tr>

</table>

</div>

