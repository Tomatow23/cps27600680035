<?php
$output = "";
if(isset($_POST["uploadFile"])){
    $output .= proccesFile();
}

function proccesFile()
{
    require_once "php/Pdo_methods.php";

    $fileSize = $_FILES["file"]["size"];
    $fileType = $_FILES["file"]["type"];

    if ($fileSize >= 100000)
    {
        return "File too big.";
    }
    if ($fileType != "application/pdf")
    {
        return "File must be a pdf file.";
    }
    
    move_uploaded_file($_FILES["file"]["tmp_name"], "files/".$_FILES["file"]["name"]);
    $pdo = new PdoMethods();

    $sql = "INSERT INTO files (file_name, file_path) VALUES (:fname, :fpath)";
    $bindings = [
        [":fname",$_POST["name"],'str'],
        [":fpath","files/".$_FILES["file"]["name"],'str']
    ];

    if ($pdo->otherBinded($sql, $bindings) == "error")
    {
        return "Error uploading file.";
    }
    else
    {
        return "File has been added.";
    }

}
?>