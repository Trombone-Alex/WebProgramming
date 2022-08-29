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


	/*
	 * Display Data on webpage
	 * Checks for connection and entries in database
	 */
	function ShowData(){

		//Create connection
		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		//Check connection
		if(!$conn){
			die("Connection Failed: " . mysqli_connect_errror());		
		}

		//Retrieve data
		$sql = "SELECT ID, FirstName, LastName, PhoneNumber FROM people";
		$result = mysqli_query($conn, $sql);

		//Check if empty
		if(mysqli_num_rows($result) > 0){

			//Output data
			while($row = mysqli_fetch_assoc($result)){

				$delurl = "[<a href='https://codd.cs.gsu.edu/~asiegel11/Week5.php?cmd=delete&id={$row['ID']}'>delete</a>]";
				$number = $row['PhoneNumber'];
				$formatted = '('.substr($number, 0, 3).') '.substr($number, 3, 3).'-'.substr($number, 6, 4);
				echo "[ID: " . $row['ID']. "] " . $row['FirstName']. " " . $row['LastName']. " | " . $formatted. " $delurl<br>";
			}
		} else {
			echo "0 Results";
		}
		mysqli_close($conn);
	}

	/*
	 * Insert Data from form into database
	 * @Parameters: FirstName, LastName, PhoneNumber
	 */
	function InsertEntry($firstname, $lastname, $phonenumber){

		//Create connection
		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		//Check connection
		if(!$conn){
			die("Connection Failed: " . mysqli_connect_errror());
		}

		//Insert Data
		$insert = "INSERT INTO people SET FirstName='$firstname', LastName='$lastname', PhoneNumber='$phonenumber' ";
		
		$result = $conn->query($insert);		
		mysqli_close($conn);
	}

	/*
	 * Delete Data from database
	 * @Parameter: ID
	 */
	function deleteEntry($ID){

		//Create connection
		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		//Check connection
		if(!$conn){
			die("Connection Failed: " . mysqli_connect_errror());
		}

		$del = "DELETE FROM people WHERE ID='$ID' ";
		$result = $conn->query($del);

		mysqli_close($conn);
	}
?>

<form method="get">
	First Name: <input type="text" placeholder="First Name" name="firstname"><br>
	Last Name: <input type="text" placeholder="Last Name" name="lastname"><br>
	Phone Number: <input type="text" placeholder="Phone Number" name="phonenumber"><br>
	<input type="submit" Value="Submit">
</form>

<?php 

		/*	 
		 * Check if all forms are filled in and set
		 * Inputs entry into database if all conditions are met
		 */

		if(isset($_GET['firstname']) && $_GET['firstname'] != '' && isset($_GET['lastname']) && $_GET['lastname'] != '' && isset($_GET['phonenumber']) && $_GET['phonenumber'] != ''){
			if (!is_numeric($_GET['phonenumber'])){
				echo "<span style='color:red;'>The phone number must only contain numbers</span><br>";
			}  else if (strlen($_GET['phonenumber']) != 10){
				echo "<span style='color:red;'>The phone number must be 10 digits</span><br>";
			}	else {
				echo "<span style='color:green;'>Data has been entered</span><br>";
				InsertEntry($_GET['firstname'], $_GET['lastname'], $_GET['phonenumber']);
			} 
		} else {
			echo "<span style='color:black;'>Fill in all fields</span><br><br>";
		}

	/*
	 * Check if delete command is set and activated
	 */
	if(isset($_GET['cmd']) &&$_GET['cmd'] == 'delete') {
		echo "<span style='color:yellow;'>Data has been deleted</span><br>";
		$id = $_GET['id'];
		DeleteEntry($id);
	}

//Update Data
ShowData();
?>