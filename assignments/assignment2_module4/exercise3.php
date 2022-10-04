<?php
function table1(){
$numRows = 15;
$numCols = 5;
$table = "<table border='1'>";
for($i = 1; $i <= $numRows; $i++){
    $table .= "<tr>";
    for($j = 1; $j <= $numCols; $j++){
        $table .= "<td> Row $i Column $j </td>";
}
}
$table .= "</tr>";
$table .= "</table>";
echo $table;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo table1();
    ?>
</body>
</html>