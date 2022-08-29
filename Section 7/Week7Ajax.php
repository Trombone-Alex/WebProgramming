<?php

	/*
	 * Check for errors
	 */
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);


	/*
	 * Global variables
	 */
	define( 'DB_HOST' , 'localhost');
	define( 'DB_USER' , 'asiegel11');
	define( 'DB_PASSWORD' , 'asiegel11');
	define( 'DB_NAME' , 'asiegel11');


	//Create connection
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	//Check connection
	if(!$conn){
		die("Connection Failed: " . mysqli_connect_errror());		
	}

	/*
	 * Display Data on webpage
	 * Checks for connection and entries in database
	 */
	function ShowData(){

		global $conn;

		//Retrieve data
		$sql = "SELECT ID, FirstName, LastName, PhoneNumber FROM people";
		$result = mysqli_query($conn, $sql);

		//Check if empty
		if(mysqli_num_rows($result) > 0){

			//Output data
			while($row = mysqli_fetch_assoc($result)){

				$id = $row['ID'];
				$delurl = "[<a href='' onclick=return(deleteEntry($id))>delete</a>]";
				$number = $row['PhoneNumber'];
				$formatted = '('.substr($number, 0, 3).') '.substr($number, 3, 3).'-'.substr($number, 6, 4);
				echo "[ID: " . $row['ID']. "] " . $row['FirstName']. " " . $row['LastName']. " | " . $formatted. " $delurl<br>";
			}
		} else {
			echo "0 Results";
		}
	}

	/*
	 * Insert Data from form into database
	 * @Parameters: FirstName, LastName, PhoneNumber
	 */
	function InsertEntry($firstname, $lastname, $phonenumber){

		global $conn;

		$insert = "INSERT INTO people SET FirstName='$firstname', LastName='$lastname', PhoneNumber='$phonenumber' ";
		$result = $conn->query($insert);		
	}

	/*
	 * Delete Data from database
	 * @Parameter: ID
	 */
	function deleteEntry($ID){

		global $conn;

		$del = "DELETE FROM people WHERE ID='$ID' ";
		$result = $conn->query($del);
	}

	if(isset($_GET['cmd'])){
		$cmd = $_GET['cmd'];

		if($cmd == "createYT"){
			InsertEntry($_GET['FirstName'], $_GET['LastName'], $_GET['PhoneNumber']);
		} else if ($cmd == "deleteYT"){
			deleteEntry($_GET['id']);
		}
	}

	ShowData();

	//Close connection
	mysqli_close($conn);
?>