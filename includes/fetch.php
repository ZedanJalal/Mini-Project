<?php
include("init.php");


if (isset($_POST['delname1']) && isset($_POST['delname2'])) {
	
$name1=$_POST['delname1'];
$name2=$_POST['delname2'];

$sql = "SELECT * FROM tempsale WHERE name1='$name1' AND name2='$name2'";
$count = $db->query($sql);



if ($count->num_rows > 0) {
	$sql = "DELETE FROM tempsale WHERE name1='$name1' AND name2='$name2'";
	 $db->query($sql);
}
else {
direct('../index.php');
}

}

elseif (isset($_POST['addname1']) && isset($_POST['addname2'])) {
	
$name1=$_POST['addname1'];
$name2=$_POST['addname2'];

$sql = "UPDATE tempsale SET qty=qty+1 WHERE name1='$name1' AND name2='$name2' ;";
$db->query($sql);

}


elseif (isset($_POST['minusname1']) && isset($_POST['minusname2'])) {
	
$name1=$_POST['minusname1'];
$name2=$_POST['minusname2'];

$sql = "SELECT * FROM tempsale WHERE qty!=1 AND name1='$name1' AND name2='$name2' ;";
$count =  $db->query($sql);

if ($count->num_rows > 0 )
{
$sql = "UPDATE tempsale SET qty=qty-1 WHERE name1='$name1' AND name2='$name2' ;";
$db->query($sql);
}
else {

}




}

else {
direct('../index.php');
}