<!DOCTYPE html>
<html>
	<head>
		<script src="./jquery/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="./foundation/css/foundation.css">
        <link rel="stylesheet" href="./css/ContactStyle.css">
        <title>Contact</title>
     </head>
     <body>
     	<div id="entirebody">
            <div class="top-bar">
                <div class="top-bar-left">
                    <ul class="menu">
                        <li class="menu-text">Trombonium</li>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="Aboutpage.html">About</a></li>
                        <li><a href="Archivepage.php">Archives</a></li>
                        <li class="is-active"><a href="Contact.php">Contact</a></li>
                        <li><a href="Signinpage.php">Sign in</a></li>
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
                    <form method=post id="contact">
                        Name: <input type="text" placeholder="name" name="name"><br>
                        Email: <input type="email" placeholder="email" name="email"><br>  
                        Message: <textarea placeholder="message" name="msg" cols="40" rows="5"></textarea><br>      
                        <input type="submit" value="Submit"><br>
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

                     if(isset($_POST['email']) && isset($_POST['name']) && isset($_POST['msg'])){

                         // Post variables
                        $email = $_POST['email'];
                        $name = $_POST['name'];
                        $msg = $_POST['msg'];

                        if(empty($name)){
                            echo"<span style='color:red'> Please enter a name </span><br>";
                        } else if(empty($email)){
                            echo"<span style='color:red'> Please enter an email </span><br>";
                        } else if(empty($msg)){
                            echo"<span style='color:red'> Please enter a message </span><br>";
                        } else {

                            //Create connection
                            $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

                            //Check connection
                            if(!$conn){
                                echo"<span style='color:red'> Could not submit message. Please try again later.</span><br>";
                                die("Connection Failed: " . mysqli_connect_errror());       
                            }

                            $dt = new DateTime("now", new DateTimeZone('America/New_York') );
                            $date = $dt->format("Y-m-d");
                            $insert = "INSERT INTO Messages SET name='$name', email='$email', message='$msg', dt='$date'";
                            $result = $conn->query($insert);

                            echo"<span style='color:green'> Message has been submitted. Please allow 24-48 hours for a response. </span><br>";

                        }
                    }
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