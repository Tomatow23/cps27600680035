<?php
require_once "php/Pdo_methods.php";
$output = "<ul>";

$pdo = new PdoMethods();
$sql = "SELECT * FROM files ORDER BY file_name";

$records = $pdo->selectNotBinded($sql);

foreach ($records as $row)
{
    $output .= '<li><a target="_blank" href='.$row["file_path"].'>'.$row["file_name"].'</a></li>';
}

$output .= "</ul>";
?>