
<html><?php
include ("./inc/connect.inc.php");


require ("./inc/header.inc.php");

?>
<div id="wrap"></br></br></br></br>
<?php
$i = "";
   $k = $_GET['k']; 
      $terms = explode(" ",$k);
      $query = "SELECT * FROM search WHERE ";
        foreach ($terms as $each)
      {
      	$i++;
      	if ($i == 1){
      		$query .= "keywords LIKE '%$each%' ";
      	}else{
      		$query .= "OR keywords LIKE '%$each%' ";
      	} 
      } 
   $query = mysql_query($query) or die (mysql_error());

   $numrows = mysql_num_rows($query);
   if($numrows > 0 ){
   	while ($row = mysql_fetch_assoc( $query)){
   		$id = $row ['id'];
   		$title= $row ['title'];
   		$description = $row ['discription'];
   		$keywords = $row ['keywords'];
   		$links= $row ['links'];

   		echo "<li class='list-group-item'><h2> <a href='$links'>$title</a>  </h2>$description <br/></li>
   		";
   	}
   } else{
   	echo "no results found";
   }?>
</div>
   <?php
   include ("./inc/footer.inc.php");
?>


