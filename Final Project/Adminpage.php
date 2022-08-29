<!DOCTYPE html>
<html>
	<head>
        <?php 
            /*
             * Check if cookies is set
             * If not, send to the login page
             */ 
            if(!isset($_COOKIE['userid'])){
                header("Location: Signinpage.php");
            } 
        ?>
		<script src="./jquery/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="./foundation/css/foundation.css">
        <link rel="stylesheet" href="./css/AdminpageStyle.css">
        <title>Admin</title>
     </head>
     <body>
     	<div id="entirebody">
            <div class="top-bar">
                <div class="top-bar-left">
                    <ul class="dropdown menu" data-dropdown-menu>
                        <li class="menu-text">Trombonium</li>
                        <li class="active"><a href="index.php" onclick="removeCookies()">Sign out</a></li>
                    </ul>
                </div>
            </div>
            <script>
                function removeCookies(){
                    document.cookie = "userid=''; expires=Thu, 18 Dec 2013 12:00:00 UTC; path=/";
                    return true;
                }
            </script>
            <div class="grid-x" id="header">
                <div class="cell small-12 medium-12 large-12">
                    <image id="headimage" src="Music.jpg">
                </div>
     		</div>
            <div class="grid-x">
                <div class="cell small-12 medium-4 large-4" id="body">
                    <div id="data">
                        <h3>Enter links</h3>
                        <p>The latest youtube/spotify links appear on the homepage</p>
                        <form method="get" onsubmit="return(insertEntry())">
                            Name: <input type="text" placeholder="Name" id="name"><br>
                            Link: <input type="url" placeholder="Link" id="link"><br>
                            Link Type: 
                            Youtube <input type="radio" id="youtube" name="media" value="youtube">
                            Spotify <input type="radio" id="spotify" name="media" value="spotify"><br>
                            <input type="submit" Value="Submit">
                        </form>
                        <div id=warning></div><br>
                    </div>
                </div>
                <div class="cell small-12 medium-8 large-8" id="links">
                    <div id=showData></div>
                    <script>
                        function insertEntry(){
                            name = $("#name").val();
                            link = $("#link").val();

                            var ele = document.getElementsByName('media');

                            if(name == null || name === ""){
                                $("#warning").css('color', 'red');
                                $("#warning").html("Please enter a name");
                                return(false);
                            }

                            if(link == null || link === ""){
                                $("#warning").css('color', 'red');
                                $("#warning").html("Please enter a link");
                                return(false);
                            }

                            if($('input[name=media]:checked').length < 1){
                                $("#warning").css('color', 'red');
                                $("#warning").html("Please specify the link type");
                                return(false);
                            }

                            for(i = 0; i < ele.length; i++) {
                                if(ele[i].checked) 
                                    media = ele[i].value;
                            }


                            $.get("./AdminpageAjax.php", {"cmd": "create", "name": name, "link": link, "media": media}, function(data){
                                $("#showData").html(data);
                            });
                            return(false);
                        }

                        function deleteYTEntry(id){
                            $.get("./AdminpageAjax.php", {"cmd": "deleteYT", "id": id}, function(data){
                                $("#showData").html(data);
                            });
                            return(false);
                        }

                        function deleteSPEntry(id){
                            $.get("./AdminpageAjax.php", {"cmd": "deleteSP", "id": id}, function(data){
                                $("#showData").html(data);
                            });
                            return(false);
                        }

                        function showData(){
                            $.get("./AdminpageAjax.php", {"cmd": ""}, function(data){
                                $("#showData").html(data);
                            });
                            return(false);
                        }

                    showData();
                </script>
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