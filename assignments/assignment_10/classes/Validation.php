<?php

class Validation{
	/* USED AS A FLAG CHANGES TO TRUE IF ONE OR MORE ERRORS IS FOUND */
	private $error = false;

	/* CHECK FORMAT IS BASCALLY A SWITCH STATEMENT THAT TAKES A VALUE AND THE NAME OF THE FUNCTION THAT NEEDS TO BE CALLED FOR THE REGULAR EXPRESSION */
	public function checkFormat($value, $regex)
	{
		switch($regex){
			case "name": return $this->name($value); break;
			case "phone": return $this->phone($value); break;
			case "email": return $this->email($value); break;
			case "address": return $this->address($value); break;
			case "city": return $this->city($value); break;
			case "password": return $this->password($value); break;
			case "status": return $this->status($value); break;
			case "dob": return $this->dob($value); break;
			//case "age": return $this->age($value); break;
			//case "contact": return $this-status($value); break;
			default: echo(" Invalid regex type "); return false;
		}
	}


		
	/* THE REST OF THE FUNCTIONS ARE THE INDIVIDUAL REGULAR EXPRESSION FUNCTIONS*/
	private function name($value){
		$match = preg_match('/^[a-z-\' ]{1,50}$/i', $value);
		//printf("name: %x ", $match); // these are just for debugging
		return $this->setError($match);
	}

	private function email($value){
		$match = preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', $value);
		//printf("email: %x ", $match);
		return $this->setError($match);
	}

	private function phone($value){
		$match = preg_match('/\d{3}\.\d{3}.\d{4}/', $value);
		//printf("phone: %x ", $match);
		return $this->setError($match);
	}

	private function address($value){
		$match = preg_match('/\d+ [0-9a-zA-Z ]+/', $value);
		//printf("address: %x ", $match);
		return $this->setError($match);
	}

	private function city($value){
		$match = preg_match('/^[a-z-\' ]{1,50}$/i', $value);
		//printf("city: %x ", $match);
		return $this->setError($match);
	}
	///(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/
	private function password($value){
		//$match = preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{1,}/', $value);
		$match = preg_match('/^[a-z-\' ]{1,50}$/i', $value);
		//printf("pswrd: %x ", $match);
		return $this->setError($match);
	}


	private function dob($value){
		//$match = preg_match('/^(0[1-9]|1[0-2])/(0[1-9]|[1-2][0-9]|3[0-1])/[0-9]{4}$/', $value);
		$match = preg_match('/(0[1-9]|1[012])[-\/](0[1-9]|[12][0-9]|3[01])[-\/](19|20)\d\d/', $value);
		//printf("dob: %x ", $match);
		//return $this->setError($match);
		return $this->setError($match);

	}

	/*private function age($value){
		$match = preg_match('/\d+', $value);
		printf("age: %x ", $match);
		return $this->setError($match);
	}*/



	
	private function setError($match){
		if(!$match){
			$this->error = true;
			return "error";
		}
		else {
			return "";
		}
	}


	/* THE SET MATCH FUNCTION ADDS THE KEY VALUE PAR OF THE STATUS TO THE ASSOCIATIVE ARRAY */
	public function checkErrors(){
		return $this->error;
	}
	
}