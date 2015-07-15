<?php

//DATABASE HANDLER
$db = new mysqli("localhost", "root", "root", "intro_to_php");
if ($db->connect_errno) {
  echo "Failed to connect to MySQL :(<br>";
  echo $db->connect_error;
  exit();
}

//ROUTES
if (isset($_POST['submit'])){
	$addr= $_POST['address'];
	$new= $db->prepare("INSERT INTO markers (address) VALUES(?)");
	$new->bind_param("s", $addr);
	$new->execute();
	$result= $db->query("SELECT*FROM markers");
	$url= "";
	foreach($result as $row){
		$url .= urlencode($row['address']);
		$url .=  "|";
	}
$url= "https://maps.googleapis.com/maps/api/staticmap?size=400x400" . $url;
echo "<img src = $url >";
}
?>
<form action = "Maps.php" method= "POST">
	<input type= 'text' name= 'address'>
	<input type= 'submit' name= 'submit'>
</form>

<?php
