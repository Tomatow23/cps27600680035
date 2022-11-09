<?php
$output = "";
if(count($_POST) > 0){
    require_once "directories.php";
    $directory = new Directories();
    $output = $directory -> writeToFile($_POST["folderName"],$_POST["folderContent"]);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container-sm">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<h1>File and Directory Assignment</h1>
<label>Enter and folder name and the contents of a file. Folder names should contain alpha numeric characters only.<br></label>
<?php echo $output ?>
<form method="post">
<div class="mb-3">
  <label class="form-label">Folder Name</label>
  <input type="text" class="form-control" id="folderName" name="folderName">
</div>
<div class="mb-3">
  <label class="form-label">File Content</label>
  <textarea class="form-control" id="fileContext" rows="3" name="folderContent"></textarea>
</div>
<button class="btn btn-primary" type="submit">Add File</button>
</form>
</div>
</body>
</html>