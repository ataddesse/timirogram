<?php include ("./inc/header.inc.php"); 
?>

<?php

$check_for_pokes = mysql_query("SELECT * FROM pokes WHERE user_to='$user_name'");
$poke = mysql_fetch_assoc($check_for_pokes);
$poke_num = mysql_num_rows($check_for_pokes);
 $user_to = $poke['user_to'];
 $user_from = $poke['user_from'];

 if (@$_POST['poke_' . $user_from . '']) {
   $delete_poke = mysql_query("DELETE FROM pokes WHERE user_from='$user_from' && user_to='$user_to'");
    $create_new_poke = mysql_query("INSERT INTO pokes VALUES ('','$user_name','$user_from')");
    header("Location: my_pokes.php");
 echo "You just Poked $user_from";
}
if ($poke_num == 0) {
 echo "You have no pokes yet.";
}
else
{
 echo "
 <form action='my_pokes.php' method='POST'>
 You have been poked by $user_from&nbsp;
 <input type='submit' name='poke_$user_from' value=\"Poke Back\">
 </form>
 "."<br>";
} 
?> 