<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

$dbhost = 'oniddb.cws.oregonstate.edu';
$dbname = 'zengx-db';
$dbuser = 'zengx-db';
$dbpass = 'qWXPWG1wbhOLVCAG';
$table = 'videoTrack';

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if($mysqli->connect_error)
{
	echo "Failed to connect to MySQL:(".$mysqli->connect_errno.")".$mysqli->connect_error;
}



/*function init()
{
	global $mysqli,$table;
	$all = $mysqli->prepare("SELECT * FROM $table");//prepared statment
	$all->execute// run the prepared statment,all save object
	$res = $all->get_result();
	
	
	function buildTable($res)
	{
	echo '<table>';
	echo '<tr id ="'>';
	echo '<td> Id <td>';
	echo '<td> Name <td>';
	echo '<td> Category <td>';
	echo '<td> Length <td>';
	echo '<td> Rent <td>';
	echo '</tr>';
	while($row = $res->fetch_assoc()) //get it one by one
	{
		echo '<tr>'; //echo '<tr id = "'.$row['Id'].'">'; ???
		echo '<td>'.$row['Id'].'<\td>';
		echo '<td>'.$row['Name'].'<\td>';
		echo '<td>'.$row['Category'].'<\td>';
		echo '<td>'.$row['Length'].'<\td>';
		echo '<td>'.$row['Rent'].'<\td>';
		echo '</tr>';
	}
	}
}*/

if(isset($_REQUEST['action']))
{
	$action = $_REQUEST['action'];
	if($action == 'init')
	{
		init();
	}
}

?>