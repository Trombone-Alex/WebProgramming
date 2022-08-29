<?php
	require("Functions.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<script src="./jquery/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="./foundation/css/foundation.css">
        
        <title>Alex's Webpage</title>
        <style>

        	#entirebody {
        		background-color:darkslategray;
        		position: relative;
        		min-height: 100vh;
        	}

        	.nav {
        		margin: 15px;
        	}

        	#header {
        		background-color: darkslategray;
        		border: 1px solid black;
        	}

        	#image {
        		border:  3px solid black;
        	}

        	#castle {
        		width: 100%;
        		height: 20rem;
        	}

        	#leftbody {
        		padding: 10px;
        		border: 1px solid darkslategray;
        		font-family: Georgia, Arial, Helvetica;
        		font-size: 140%;
        		background-color: darkseagreen;
        	}

        	#body {
        		padding:  10px;
        		border:  1px solid darkslategray;
        		font-family: Georgia, Arial, Helvetica;
        		font-size: 140%;
        		background-color: cadetblue;
        	}
		
			#date {
				color: white;
				background-color: black;
				border: 1px dashed saddlebrown;
				text-align: center;
				padding: 5px;
			}

        	#footer {
        		background-color: linen;
        		margin-top: 40px;
        		min-height: 5vh;
        		padding-top: 10px;
        	}


        </style>
        <script type="text/javascript">
        	
        	$( document ).ready(function() {

        		$("#Alert").on("click", callAlert);
        		$("#Change").on("click", changeBody);


        		function callAlert(){
        			alert("Hello World!");
        		}

        		function changeBody(){
        			$("#body").html("As you can see, the Change Body button works perfectly!");
        		}
        	});


        </script>
	</head>
	<body>
		<div id="entirebody">
			<div class="grid-x">
				<div id="image" class="cell small-12 medium-12 large-12">
					<img id="castle" src="CastleImage.jpg">
				</div>
			</div>
			<div class="grid-x">
				<div id="header" class="cell small-12 medium-12 large-12 text-center">
					<button id="Alert" class="button nav">Alert</button>
					<button id="Change" class="button nav">Change Body</button>
				</div>
			</div>
			<div class="grid-x">
				<div id="leftbody" class="cell small-12 medium-4 large-4">
					"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
				</div>
				<div id="body" class="cell small-12 medium-8 large-8">
					Hello, my name is Alex Siegel. I am designing this website for my Web Programming class.
				</div>
				<div id="date" class="cell small-12 medium-12 large-12">
					<?php 
					dateFunction();
					timeFunction();
					?> 
				</div>
			</div>
			<div id="footer" class="grid-x">
				<div class="cell small-12 medium-6 large-6 text-center">&copy 2022 Alex Siegel, All Rights Reserved</div>
				<div class="cell small-12 medium-6 large-6 text-center">Desgiend by Alex Siegel</div>
			</div>
		</div>
	</body>
</html>