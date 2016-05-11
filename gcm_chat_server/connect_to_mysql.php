
<?php
	$database="getmybooks";
	$conn=mysql_connect("mysql.getmybooks.co","sismol1","8978129129Bablu");
	if(!$conn)
	{
	die('could not connect:'.mysql_error());
	}
	mysql_select_db("$database",$conn);
?>
