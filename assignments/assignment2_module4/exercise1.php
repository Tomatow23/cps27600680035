<?php

    function loop(){
        $x = 1;
        $i = 1;
    
        while($x < 5){
            $output = "<li>$x</li>";
            $i = 1;
            while($i < 5){  
            $output .= "<ul>
            <li> $i </li>
            </ul>";
            $i++;
        }
        echo $output;
        $x++;
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php echo loop();?>
</head>
<body>
</body>
</html>
