<!DOCTYPE html>
<html>
	<head>
		<script src="./jquery/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="./foundation/css/foundation.css">
        <link rel="stylesheet" href="./css/HomepageStyle.css">
        <title>Home</title>

     </head>
     <body>
     	<div id="entirebody">
            <div class="top-bar">
                <div class="top-bar-left">
                    <ul class="menu">
                        <li class="menu-text">Trombonium</li>
                        <li class="is-active"><a href="index.php">Home</a></li>
                        <li><a href="Aboutpage.html">About</a></li>
                        <li><a href="Archivepage.php">Archives</a></li>
                        <li><a href="Contact.php">Contact</a></li>
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
                <div class="cell small-12 medium-7 large-7" id="body">

                     <?php

                    /*
                     * Check for errors
                    */
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    header("Set-Cookie: key=value; path=/; domain=www.youtube.com; HttpOnly; Secure; SameSite=None");
                    header("Set-Cookie: key=value; path=/; domain=spotify.com; HttpOnly; Secure; SameSite=None");

                    /*
                     * Global variables
                     */
                    define( 'DB_HOST' , 'localhost');
                    define( 'DB_USER' , 'root');
                    define( 'DB_PASSWORD' , 'asiegel11');
                    define( 'DB_NAME' , 'finalproject');


                    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

                    if(!$conn){
                        die("Connection Failed: " . mysqli_connect_errror());       
                    }

                    $sql = "SELECT name, link FROM Youtube order by id desc limit 1";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $link = $row['link'];
                            $name = $row['name'];
                        }
                        $link = str_replace(".be/", "be.com/embed/", $link);
                    }

                    ?>

                    <h3>Video of the Week</h3>

                    <iframe width=60% height="480" src="<?php echo $link; ?>" title="<?php echo $name; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="cell small-12 medium-5 large-5" id="sidebar">

                    <?php 

                    $sql = "SELECT link FROM Spotify order by id desc limit 1";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $link = $row['link'];
                        }
                        $link = str_replace(".com/", ".com/embed/", $link);
                    }

                    ?>

                    <h3>Latest Trombone Releases</h3>
                    <iframe style="border-radius:2px" src="<?php echo $link; ?>" width="80%" height="480" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"></iframe>
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