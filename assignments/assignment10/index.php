<?php
/* WRITE THE NECESSARY PHP CODE HERE.  YOU WILL NEED TO RETURN AN ARRAY THAT CONTAINS TWO INDEXES. FIRST INDEX IS A PLACE FOR A MESSAGE (MAYBE BLANK OR NOT DEPENDING ON THE SITUATION) AND THE OTHER IS THE FORM OR THE TABLE DISPLAYING THE DATA (SEE $RESULT VARIABLE BELOW). */
if(isset($_GET)){
	if($_GET['page'] === "form"){
		//CODE GOES HERE TO REQUIRE THE FORM.PHP PAGE AND CALL WHATEVER METHOD YOU WROTE
		require_once("php/form.php");
		$result = init();


	}
	else if($_GET['page'] === "display"){
		//CODE GOES HERE TO REQUIRE THE DISPLAYRECORDS.PHP PAGE AND CALL WHATEVER METHOD YOU WROTE
		require_once("php/displayRecords.php");

		$result = init();

	}
	else {
		header('Location: ./index.php?page=form');
		exit;
	}
}

else {
	header('Location: ./index.php?page=form');
		exit;
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Final Project</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<style>
			.error {
				color: red;
				margin-left: 5px;
			}
			.space {
				margin-right: 30px;
			}
			nav ul li {
				list-style: none;
			}
			input[type=submit]{
				margin: 10px 0;
			}
			</style>
	</head>

	<body class="container">
		<nav>
			<ul>
				<li><a href="index.php?page=form">Add Contact Information</a></li>
				<li><a href="index.php?page=display">Display All Contacts Information</a></li>
			</ul>
		</nav>
		
		<?php
			echo $result[0]; 
			echo $result[1]; 
		?>
	</body>
</html> 