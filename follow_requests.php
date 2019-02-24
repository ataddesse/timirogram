<?php
include("./inc/header.inc.php");
?>
<?php
// Find follow requests
$findrequests = mysql_query("SELECT * from follow_requests where user_to='$user_name'");
$numrows = mysql_num_rows($findrequests);
if ($numrows ==0){
	echo "You have no freind Requests at this time,";
}
else
{
	while ($get_row = mysql_fetch_assoc($findrequests)){
		$id = $get_row['id'];
		$user_to = $get_row ['user_to'];
		$user_from = $get_row['user_from'];

		echo '' . $user_from. 'wants to be freind </br>' ;

?>
<?php

if (isset($_POST['acceptrequest' . $user_from]))
{
	//select the follow_array row from the logged in user
	$get_follow_check = mysql_query("SELECT follow_array FROM susers where user_name = '$user_name' ");
	$get_follow_row = mysql_fetch_assoc($get_follow_check);
	$follow_array = $get_follow_row['follow_array'];
	$followarray_explode = explode(",", $follow_array);
	$followarray_count = count($followarray_explode);

	//select the follow_array from the user who sent the requestd
	$get_follow_check_follow = mysql_query("SELECT follow_array FROM susers where user_name = '$user_name' ");
	$get_follow_row_follow = mysql_fetch_assoc($get_follow_check);
	$follow_array_follow = $get_follow_row_follow['follow_array'];
	$followarray_explode_follow = explode(",", $follow_array);
	$followarray_count_follow = count($followarray_explode);
	
	if ($follow_array == ""){
         $followarray_count = count(NULL);

	}

	if ($follow_array_follow == ""){
         $followarray_count_follow = count(NULL);

	}

    if ($followarray_count == NULL){
    	$add_follow_query = mysql_query("UPDATE susers SET follow_array=CONCAT(follow_array, ',$user_from') where user_name='$user_name'");
    }
    
    if ($followarray_count_follow == NULL){
    	$add_follow_query = mysql_query("UPDATE susers SET follow_array=CONCAT(follow_array, ',$user_to') where user_name='$user_from'");
    }
     if ($followarray_count >= 1){
    	$add_follow_query = mysql_query("UPDATE susers SET follow_array=CONCAT(follow_array, ',$user_from') where user_name='$user_name'");
    	 if ($followarray_count_follow >= 1){
    	$add_follow_query = mysql_query("UPDATE susers SET follow_array=CONCAT(follow_array, ',$user_to') where user_name='$user_from'");
    }
    }
    $delete_request = mysql_query("DELETE FROM follow_requests where user_to='$user_to' && user_from='$user_from'  ");
    echo "You are friends now";
    header("Location: follow_requests.php");

//if the user has no followers we just concat the followers username
}
  if (isset($_POST['ignorerequest' . $user_from])){
  	 $ignore_request = mysql_query("DELETE FROM follow_requests where user_to='$user_to' && user_from='$user_from'  ");
    echo "You are friends now";
    header("Location: follow_requests.php");
  }
?>
<form action="follow_requests.php" method="POST">
<input type="submit" name="acceptrequest<?php echo $user_from; ?>" value="Accept Request" >
<input type="submit" name="ignorerequest<?php echo $user_from; ?>" value="Ignore Request" >
</form>
<?php
}
}
?>