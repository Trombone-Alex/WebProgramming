<?php

	/*
	 * Check if cookies is set
	 * If not, send to the login page
	 */ 
	
	if(!isset($_COOKIE['userid'])){
		header("Location: Week6Login.php");
	} 
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

	//Greeting message
	echo "<span style='color:green;'>ID: </span><span style='color:red';>".$_COOKIE['userid']."</span><span style='color:green;'> has logged in.</span>";

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
		$sql = "SELECT id, username, password FROM user";
		$result = mysqli_query($conn, $sql);

		//Check if empty
		if(mysqli_num_rows($result) > 0){

			//Output data
			while($row = mysqli_fetch_assoc($result)){

				$delurl = "[<a href='https://codd.cs.gsu.edu/~asiegel11/Week6.php?cmd=delete&id={$row['id']}'>delete</a>]";
				echo "[ID: " . $row['id']. "] Username: " . $row['username']. " | Password: " . $row['password']."$delurl"."<br>";
			}
		} else {
			echo "0 Results";
		}
		mysqli_close($conn);
	}

	/*
	 * Insert Data from form into database
	 * @Parameters: username, password
	 */
	function InsertEntry($username, $password){

		//Create connection
		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		//Check connection
		if(!$conn){
			die("Connection Failed: " . mysqli_connect_errror());
		}

		//Insert Data
		$insert = "INSERT INTO user SET username='$username', password='$password' ";
		
		$result = $conn->query($insert);		
		mysqli_close($conn);
	}

	/*
	 * Delete Data from database
	 * @Parameter: ID
	 */
	function deleteEntry($id){

		//Create connection
		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		//Check connection
		if(!$conn){
			die("Connection Failed: " . mysqli_connect_errror());
		}

		$del = "DELETE FROM user WHERE id='$id' ";
		$result = $conn->query($del);

		mysqli_close($conn);
	}
?>

<form method="post">
	Create Username: <input type="text" placeholder="username" name="username"><br>
	Create Password: <input type="text" placeholder="password" name="password"><br>
	<input type="submit" Value="Submit">
</form>


<?php 

		/*	 
		 * Check if all forms are filled in and set
		 * Inputs entry into database if all conditions are met
		 */

		if(isset($_POST['username']) && $_POST['username'] != '' && isset($_POST['password']) && $_POST['password'] != ''){
				echo "<span style='color:green;'>Login has been created</span><br>";
				InsertEntry($_POST['username'], $_POST['password']);
		} else if(isset($_GET['act']) && $_GET['act'] == 'deleted') {
			echo "<span style='color:red;'>Login has been deleted</span><br>";
		} else {
			echo "<span style='color:black;'>Fill in all fields</span><br><br>";
		}

		/*
		 * Check if delete command is set and activated
		 */
		if(isset($_GET['cmd']) && $_GET['cmd'] == 'delete') {
			$id = $_GET['id'];
			DeleteEntry($id);
			header("Location: Week6.php?act=deleted");
		}

//Update Data
ShowData();
?>