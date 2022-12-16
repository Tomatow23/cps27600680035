<?php
session_start();

/* HERE I REQUIRE AND USE THE STICKYFORM CLASS THAT DOES ALL THE VALIDATION AND CREATES THE STICKY FORM.  THE STICKY FORM CLASS USES THE VALIDATION CLASS TO DO THE VALIDATION WORK.*/
require_once('classes/StickyForm.php');


$stickyForm = new StickyForm();

function init(){
  global $elementsArr, $stickyForm;

  /* IF THE FORM WAS SUBMITTED DO THE FOLLOWING  */
  if(isset($_POST['submit'])){

    /*THIS METHODS TAKE THE POST ARRAY AND THE ELEMENTS ARRAY (SEE BELOW) AND PASSES THEM TO THE VALIDATION FORM METHOD OF THE STICKY FORM CLASS.  IT UPDATES THE ELEMENTS ARRAY AND RETURNS IT, THIS IS STORED IN THE $postArr VARIABLE */
    $postArr = $stickyForm->validateForm($_POST, $elementsArr);

	//print_r($postArr);

    /* THE ELEMENTS ARRAY HAS A MASTER STATUS AREA. IF THERE ARE ANY ERRORS FOUND THE STATUS IS CHANGED TO "ERRORS" FROM THE DEFAULT OF "NOERRORS".  DEPENDING ON WHAT IS RETURNED DEPENDS ON WHAT HAPPENS NEXT.  IN THIS CASE THE RETURN MESSAGE HAS "NO ERRORS" SO WE HAVE NO PROBLEMS WITH OUR VALIDATION AND WE CAN SUBMIT THE FORM */
    if($postArr['masterStatus']['status'] == "noerrors"){
      
      /*addData() IS THE METHOD TO CALL TO ADD THE FORM INFORMATION TO THE DATABASE (NOT WRITTEN IN THIS EXAMPLE) THEN WE CALL THE GETFORM METHOD WHICH RETURNS AND ACKNOWLEDGEMENT AND THE ORGINAL ARRAY (NOT MODIFIED). THE ACKNOWLEDGEMENT IS THE FIRST PARAMETER THE ELEMENTS ARRAY IS THE ELEMENTS ARRAY WE CREATE (AGAIN SEE BELOW) */
      return addData($_POST);

    }
    else{
      /* IF THERE WAS A PROBLEM WITH THE FORM VALIDATION THEN THE MODIFIED ARRAY ($postArr) WILL BE SENT AS THE SECOND PARAMETER.  THIS MODIFIED ARRAY IS THE SAME AS THE ELEMENTS ARRAY BUT ERROR MESSAGES AND VALUES HAVE BEEN ADDED TO DISPLAY ERRORS AND MAKE IT STICKY */
   //  print_r($elementsArr); 
	  return getForm("<h1>Login</h1>",$postArr);
    }
    
  }

  /* THIS CREATES THE FORM BASED ON THE ORIGINAL ARRAY THIS IS CALLED WHEN THE PAGE FIRST LOADS BEFORE A FORM HAS BEEN SUBMITTED */
  else {
      return getForm("<h1>Login</h1>", $elementsArr);
    } 
}

/* THIS IS THE DATA OF THE FORM.  IT IS A MULTI-DIMENTIONAL ASSOCIATIVE ARRAY THAT IS USED TO CONTAIN FORM DATA AND ERROR MESSAGES.   EACH SUB ARRAY IS NAMED BASED UPON WHAT FORM FIELD IT IS ATTACHED TO. FOR EXAMPLE, "NAME" GOES TO THE TEXT FIELDS WITH THE NAME ATTRIBUTE THAT HAS THE VALUE OF "NAME". NOTICE THE TYPE IS "TEXT" FOR TEXT FIELD.  DEPENDING ON WHAT HAPPENS THIS ASSOCIATE ARRAY IS UPDATED.*/
$elementsArr = [
  	"masterStatus"=>[
    "status"=>"noerrors",
    "type"=>"masterStatus"
  ],
	"email"=>[
	"errorMessage"=>"<span style='color: red; margin-left: 15px;'>Email cannot be blank and must be a standard name</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"email@status.com",
	"regex"=>"email"
	],

    "password"=>[
    "errorMessage"=>"<span style='color: red; margin-left: 15px;'>Password cannot be blank.</span>",
    "errorOutput"=>"",
    "type"=>"text",
    "value"=>"password",
	"regex"=>"password"
    ],

    
];

$name = "";

/*THIS FUNCTION CAN BE CALLED TO ADD DATA TO THE DATABASE */
function addData($post){
  global $elementsArr;  

	  if(isset($_POST['submit'])){
		require_once 'classes/Pdo_Methods.php';
	
			$pdo = new PdoMethods();

			//print_r($post);

			//return;
			$sql = "SELECT name, email, password, status FROM admins WHERE email = :email";
			$bindings = array(
				array(':email', $post['email'], 'str')
			);
	
			$records = $pdo->selectBinded($sql, $bindings);

	
				if($records == 'error'){
					return "There was an error logging it";
				}
				
				/** */
				else{
					if(count($records) != 0){
						/** IF THE PASSWORD IS NOT VERIFIED USING PASSWORD_VERIFY THEN RETURN FAILED, OTHERWISE RETURN SUCCESS, IF NO RECORDS ARE FOUND RETURN NO RECORDS FOUND. */
						if(password_verify($post['password'], $records[0]['password'])){
							session_start();
							$_SESSION['access'] = "accessGranted";
							$_SESSION['status'] = $records[0]['status'];
							$_SESSION['name'] = $records[0]['name'];

							header('location: index.php?page=welcome');

						}
						else {
							return getForm("<h1>Login</h1><p>There was a problem logging in with those credentials</p>", $elementsArr);
						}
					}
					else {
						return getForm("<h1>Login</h1><p>There was a problem logging in with those credentials</p>", $elementsArr);
					}
				}
      
}
}
   

/*THIS IS THE GET FROM FUCTION WHICH WILL BUILD THE FORM BASED UPON UPON THE (UNMODIFIED OF MODIFIED) ELEMENTS ARRAY. */
function getForm($acknowledgement, $elementsArr){

global $stickyForm;

$form = <<<HTML
    
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<title>login page</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
			
	</head>
	<body>
	<main class="container"> 
			<form method='post' action='index.php?page=login'>
			
			<div class="form-group">
				<label for="email">Email{$elementsArr['email']['errorOutput']}</label>
				<input type="text" class="form-control" name="email" id="email" value="nmdunn@admin.com">
			</div>
			<div class="form-group">
				<label for="password">Password{$elementsArr['password']['errorOutput']}</label>
				<input type="password" class="form-control" name="password" id="password" value="password">
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-success" name="submit" id="submit" value="Login" >
			</div>
		</main>
	</body>
	</html>
	
HTML;

/* HERE I RETURN AN ARRAY THAT CONTAINS AN ACKNOWLEDGEMENT AND THE FORM.  THIS IS DISPLAYED ON THE INDEX PAGE. */
return [$acknowledgement, $form];

}


?>