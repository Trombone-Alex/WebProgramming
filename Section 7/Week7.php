<!DOCTYPE html>
<html>
	<head>
		<script src="./jquery/jquery-3.6.0.min.js"></script>
	</head>
	<body>
		<form method="get" onsubmit="return(insertEntry())">
			First Name: <input type="text" placeholder="First Name" id="FirstName"><br>
			Last Name: <input type="text" placeholder="Last Name" id="LastName"><br>
			Phone Number: <input type="text" placeholder="Phone Number" id="PhoneNumber"><br>
			<input type="submit" Value="Submit">
		</form>
		<br>
		<div id=showData></div>
		<script>

			function insertEntry(){
				first = $("#FirstName").val();
				last = $("#LastName").val();
				num = $("#PhoneNumber").val();

				$.get("./Week7Ajax.php", {"cmd": "create", "FirstName": first, "LastName": last, "PhoneNumber": num}, function(data){
					$("#showData").html(data);
				});
				return(false);
			}

			function deleteEntry(id){
				$.get("./Week7Ajax.php", {"cmd": "delete", "id" : id}, function(data){
					$("#showData").html(data);
				});
				return(false);
			}

			function showData(){
				$.get("./Week7Ajax.php", {"cmd": ""}, function(data){
					$("#showData").html(data);
				});
				return(false);
			}

			showData();
		</script>
	</body>
</html>