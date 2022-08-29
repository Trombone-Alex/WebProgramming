<!DOCTYPE html>
<html>
	<head>
		<script src="./jquery/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="./foundation/css/foundation.css">
        <link rel="stylesheet" href="./css/SigninpageStyle.css">
        <title>Sign In</title>
     </head>
     <body>
     	<div id="entirebody">
            <div class="top-bar">
                <div class="top-bar-left">
                    <ul class="dropdown menu" data-dropdown-menu>
                        <li class="menu-text">Trombonium</li>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="Aboutpage.html">About</a></li>
                        <li><a href="Archivepage.php">Archives</a></li>
                        <li><a href="Contact.php">Contact</a></li>
                        <li class="active"><a href="Signinpage.php">Sign in</a></li>
                    </ul>
                </div>
            </div>
            <div class="grid-x" id="header">
                <div class="cell small-12 medium-12 large-12">
                    <image id="headimage" src="Music.jpg">
                </div>
     		</div>
            <div class="grid-x">
                <div class="cell small-12 medium-12 large-12" id="body">
                    <form method=post id="form">
                        Username: <input type="text" placeholder="username" name="user"><br>
                        Password: <input type="password" placeholder="password" name="pass"><br>
                        <input type="submit" value="Submit"> 
                    </form>

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

                    //Retrieve data
                    $sql = "SELECT id, username, password FROM WebsiteLogin";
                    $result = mysqli_query($conn, $sql);


                    //Check if form is filled out
                    if(isset($_POST['user']) && isset($_POST['pass'])) {

                         $user = $_POST['user'];
                         $pass = $_POST['pass'];

                        if(empty($user)){
                            echo "<span style='color:blue'> Please enter a username </span><br>";
                        }  else if (empty($pass)){
                            echo "<span style='color:blue'> Please enter a password </span><br>";
                        } else {
                         
                            //Check if rows are empty
                            if(mysqli_num_rows($result) > 0){

                                //Loop through rows
                                while($row=mysqli_fetch_assoc($result)){

                                    //Match variables to database
                                    if(strcmp($user, $row['username']) == 0 && strcmp($pass, $row['password'] == 0)){
                                        setcookie("userid", $row['id'], time() + 86400, "/");
                                        header("Location: Adminpage.php");
                                        return;
                                    } 
                                }
                                setcookie("userid", "", time() - 99999999, "/");
                                echo "<span style='color:red'> Incorrect username and/or password </span><br>";
                            }
                        }
                    } 

                    mysqli_close($conn);
                    ?> 
                </div>        
                <div class="cell small-12 medium-12 large-12" id="footer">
                    &copy 2022 Alex Siegel, All Rights Reserved
                    <br>
                    Designed by Alex Siegel
                </div>
            </div>
     	</div>
     </body>
</html>