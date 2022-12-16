<?php

//session_start();// delete later
/* THIS ENTIRE PAGE IS JUST A PLACEHOLDER PAGE WHICH THE FORM WILL BE INJECTED INTO */
/*I REQUIRE IN THE ROUTES PAGE WHICH IS ACTUALLY DOES THE WORK FOR GETTING THE PAGES.*/ 
require_once('pages/routes.php');
//$login = new LoginPage;
//$login->login();
$nav = "";
//security();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>PHP Final</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		
	</head>

	<body class="container">
		<?php
            if(isset($_SESSION['access']) && $_SESSION['access'] === 'accessGranted') {
                if($_SESSION['status'] === 'admin'){
                    echo $navAdmin;
                } else {
                    echo $navStaff;
                }
            }
			echo $result[0]; 
			echo $result[1]; 
		?>
	</body>
</html> 