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
	 * Matches password info 
	 */
	//Establish connection
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		//Check coonnection
		if(!$conn){
			die("Connection Failed: ".mysqli_connect_error());
		}

		//Retrieve data
		$sql = "SELECT id, username, password FROM user";
		$result = mysqli_query($conn, $sql);

		//Check if form is filled out
		if(isset($_POST['user']) && isset($_POST['pass'])){

			//Check if rows are empty
			if(mysqli_num_rows($result) > 0){

				//Loop through rows
				while($row=mysqli_fetch_assoc($result)){

					//Match variables to database
					if($_POST['user'] == $row['username'] && $_POST['pass'] == $row['password']){
						setcookie("userid", $row['id'], time() + 86400, "/");
						$loggedIn = true;
						header("Location: Week6.php");
						return;
					} 
				}
			}
			setcookie("userid", "", time() - 99999999, "/");
			echo "<span style='color:red;'>Username and Password are not correct</span><br>";
		} 
?>

<form method="post">
	Username: <input type="text" placeholder="username" name="user"><br>
	Password: <input type="text" placeholder="password" name="pass"><br>
	<input type="submit" Value="Submit">
</form>



