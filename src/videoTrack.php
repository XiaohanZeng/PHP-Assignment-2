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



function init()
{
	global $mysqli,$table;
	$all = $mysqli->prepare("SELECT * FROM $table");//prepared statment
	$all->execute();// run the prepared statment,all save object
	$res = $all->get_result();
	buildDropdown();
	buildTable($res);
}

function buildTable($res)
{
	echo '<table>';
	echo '<tr>';
	echo '<td> ID </td>';
	echo '<td> Name </td>';
	echo '<td> Category </td>';
	echo '<td> Length </td>';
	echo '<td> Rent </td>';
	echo '<td>  </td>';
	echo '</tr>';
	while($row = $res->fetch_assoc()) //get it one by one
	{
		$status = "";
		echo '<tr id = "'.$row['ID'].'">'; 
		echo '<td>'.$row['ID'].'</td>';
		echo '<td class="checkName">'.$row['Name'].'</td>';
		echo '<td>'.$row['Category'].'</td>';
		echo '<td>'.$row['Length'].'</td>';
		if($row['Rent'] == "0")
		{
			$status = "check out";
			echo '<td>available</td>';
		}
		else 
		{
			$status = "check in";
			echo '<td>check out</td>';
		}
		echo '<td><button type="button" onclick="deleteRow(this.parentNode.parentNode.id)">DELETE</button></td>';
		echo '<td><button type="button" class=changeRent onclick="changeRent(this)">'.$status.'</button></td>';
		echo '</tr>';
	
	}
	echo '</table>';
}

function deleteAll()
{
	global $mysqli,$table;
	$all = $mysqli->prepare("DELETE FROM $table");
	$all->execute();
	$res = $all->get_result();
	init();
}

function addNew()
{
	global $mysqli,$table;
	$name = $_GET['Name'];
	$category = $_GET['Category'];
	$length = $_GET['Length'];
	$all = $mysqli->prepare("INSERT INTO $table (Name, Category, Length) VALUES('$name','$category','$length')");
	$all->execute();
	init();
}

function deleteOne()
{
	global $mysqli,$table;
	$deleteID =$_GET['id'];
	$all = $mysqli->prepare("DELETE FROM $table WHERE ID=$deleteID");
	$all->execute();
	init();
}

function changeRent()
{
	global $mysqli,$table;
	$changeRentID =$_GET['id'];
	$status =$_GET['Rent'];
	$all = $mysqli->prepare("UPDATE $table SET Rent=$status WHERE ID=$changeRentID");
	$all->execute();
	init();
	
}
function buildDropdown()
{
	global $mysqli,$table;
	$all = $mysqli->prepare("SELECT DISTINCT Category FROM videoTrack");
	$all->execute();
	$res = $all->get_result();
	echo '<br>';
	echo '<select id="dropDown">';
	echo '<option value="allCategory">All Category</option>';
	while($row = $res->fetch_assoc()) //get it one by one
	{	
		echo '<option value="'.$row['Category'].'">'.$row['Category'].'</option>';
	}
	echo '</select>';
	
	echo '<button type="button" onclick="filterVideo()">Filter</button>';
	echo '<br>';
}
function filterCate()
{
	global $mysqli,$table;
	$category = $_GET['Category'];
	if($category == "allCategory")
	{
			init();
	}
	else
	{
		$all = $mysqli->prepare("SELECT * FROM $table WHERE Category='$category'");	
		$all->execute();
		$res = $all->get_result();
		buildDropdown();
		buildTable($res);
		
	}
}

if(isset($_REQUEST['action']))
{
	$action = $_REQUEST['action'];
	if($action == 'init')
	{
		init();
	}
	if($action == 'deleteAll')
	{
		deleteAll();
	}
	if($action == 'addNew')
	{
		addNew();
	}
	if($action == 'deleteOne')
	{
		deleteOne();
	}
	if($action == 'change')
	{
		changeRent();
	}
	if($action == 'filter')
	{
		filterCate();
	}
}

?>