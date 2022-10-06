<?php
class Calculator {
    
    function calc($operand, $num1 = null, $num2 = null){
        $output = "";
        if($operand != null && $num1 !== null && $num2 !== null){
            switch($operand){
                case "/":
                    if($num2 === 0){
                        return "Cannot divide by 0<br>";
                        break;
                    }else{
                        $output = $num1/$num2;
                        return "The product of the two numbers is: " . $output . "<br>";
                        break;
                    }
                case "*":
                    $output = $num1 * $num2;
                    return "The product of the two numbers is: " . $output . "<br>"; 
                    break;
                case "+":
                    $output = $num1 + $num2;
                    return "The product of the two numbers is: " . $output . "<br>"; 
                    break;
                case "-":
                    $output = $num1 - $num2;
                    return "The product of the two numbers is: " . $output . "<br>"; 
                    break;
            }
        }else{
            return "Must Include a String and 2 Numbers <br>";
        } 
        }
       
}

?>