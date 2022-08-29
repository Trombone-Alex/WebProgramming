<!DOCTYPE html>
<html>
	<head>
		<script src="./jquery/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="./foundation/css/foundation.css">
        <link rel="stylesheet" href="./css/ArchivepageStyle.css">
        <title>Archives</title>
     </head>
     <body>
     	<div id="entirebody">
            <div class="top-bar">
                <div class="top-bar-left">
                    <ul class="dropdown menu" data-dropdown-menu>
                        <li class="menu-text">Trombonium</li>
                        <li><a href="index.php">Home</a>
                        <li><a href="Aboutpage.html">About</a>
                        <li class="active"><a href="Archivepage.php">Archives</a>
                        <li><a href="Contact.php">Contact</a>
                        <li><a href="Signinpage.php">Sign in</a>
                    </ul>
                </div>
            </div>
            <div class="grid-x" id="header">
                <div class="cell small-12 medium-12 large-12">
                    <image id="headimage" src="Music.jpg">
                </div>
     		</div>
            <div class="grid-x">

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

                $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

                if(!$conn){
                    die("Connection Failed: " . mysqli_connect_errror());       
                }

                ?>

                <div class="cell small-12 medium-6 large-6" id="vidcontainer">
                    
                    <h4>Video Archives</h4>

                    <div id="pastvids">
                        <ul class="vertical menu expanded">

                        <?php

                            $sql = "SELECT name, link, id FROM Youtube";
                            $result = mysqli_query($conn, $sql);

                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    $name = $row['name'];
                                    $link = $row['link'];
                                    $id = "youtube".$row['id'];
                        ?>

                          <li id="link"><a href=<?php echo $link; ?>><?php echo $name ?></a></li>
                          
          
                        <?php
                                }
                            }
                        ?>
                        </ul>
                    </div>
                </div>

                <div class="cell small-12 medium-6 large-6" id="spotcontainer">
                    
                    <h4>Spotify Archives</h4>

                    <div id="pastvids">
                        <ul class="vertical menu expanded">

                        <?php

                            $sql = "SELECT name, link, id FROM Spotify";
                            $result = mysqli_query($conn, $sql);

                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    $name = $row['name'];
                                    $link = $row['link'];
                                    $id = "spotify".$row['id'];
                        ?>

                          <li id="link"><a href=<?php echo $link; ?>><?php echo $name ?></a></li>
                        <?php
                                }
                            }
                            mysqli_close($conn);
                        ?>
                        </ul>
                    </div>
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