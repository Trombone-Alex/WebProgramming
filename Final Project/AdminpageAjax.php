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
    define( 'DB_USER' , 'root');
    define( 'DB_PASSWORD' , 'asiegel11');
    define( 'DB_NAME' , 'finalproject');


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
		$sql = "SELECT name, link, dt, id from Youtube";
		$result = mysqli_query($conn, $sql);


		echo "<h3>Youtube Links:</h3><br>";
		//Check if empty
		if(mysqli_num_rows($result) > 0){

			//Output data
			while($row = mysqli_fetch_assoc($result)){

				$name = $row['name'];
				$link = $row['link'];
				$date = $row['dt'];
				$id = $row['id'];
				$media = "youtube";
				$delurl = "[<a href='' onclick=return(deleteYTEntry('$id'))>delete</a>]";
				echo "[".$date."] ".$name." - ".$link." $delurl<br>";
			}
		} else {
			echo "0 Results";
		}

		//Retrieve data
		$sql = "SELECT name, link, dt, id from Spotify";
		$result = mysqli_query($conn, $sql);


		echo "<br><h3>Spotify Links:</h3><br>";
		//Check if empty
		if(mysqli_num_rows($result) > 0){

			//Output data
			while($row = mysqli_fetch_assoc($result)){

				$name = $row['name'];
				$link = $row['link'];
				$date = $row['dt'];
				$id = $row['id'];
				$media = "spotify";
				$delurl = "[<a href='' onclick=return(deleteSPEntry('$id'))>delete</a>]";
				echo "[".$date."] ".$name." - ".$link." $delurl<br>";
			}
		} else {
			echo "0 Results";
		}
	}


	/*
	 * Insert Data from form into database
	 * @Parameters: FirstName, LastName, PhoneNumber
	 */
	function InsertEntry($name, $link, $media){

		global $conn;
		$dt = new DateTime("now", new DateTimeZone('America/New_York') );
		$date = $dt->format("Y-m-d");

		if(isset($media)){
			if(strcmp($media, "youtube") == 0){
				$insert = "INSERT INTO Youtube SET name='$name', link='$link', dt='$date' ";	
			} else {
				$insert = "INSERT INTO Spotify SET name='$name', link='$link', dt='$date' ";
			}
		}
		$result = $conn->query($insert);
		echo "<script> 
				$(\"#warning\").css('color', 'green');
				$(\"#warning\").html(\"Link added to database\"); 
				</script><br>"; 
	}

	/*
	 * Delete Data from Youtube database
	 * @Parameter: ID
	 */
	function deleteYTEntry($id){

		global $conn;
		$del = "DELETE FROM Youtube WHERE id='$id' ";
		$result = $conn->query($del);
	}

	/*
	 * Delete Data from Spotify database
	 * @Parameter: ID
	 */
	function deleteSPEntry($id){

		global $conn;
		$del = "DELETE FROM Spotify WHERE id='$id' ";
		$result = $conn->query($del);
	}

	if(isset($_GET['cmd'])){
		$cmd = $_GET['cmd'];

		if($cmd == "create"){
			InsertEntry($_GET['name'], $_GET['link'], $_GET['media']);
		} else if ($cmd == "deleteYT"){
			deleteYTEntry($_GET['id']);
		} else if($cmd == "deleteSP"){
			deleteSPEntry($_GET['id']);
		}
	}

	ShowData();

	//Close connection
	mysqli_close($conn); 
?>