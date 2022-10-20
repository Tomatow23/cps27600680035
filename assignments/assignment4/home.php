<?php
$output = "";
if(count($_POST) > 0){
    require_once 'add_name.php';
    $addName = new Name();
    $output = $addName -> addName($_POST["enterName"]) . $_POST["nameArea"];
    if(isset($_POST["clearNames"])){
      $output = "";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Add Names</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<form method="post">
<h1>Add Names</h1>
<button class="btn btn-primary" type="submit">Add Name</button>
<button class="btn btn-primary" type="submit" name="clearNames">Clear Names</button>
<div class="mb-3">
  <label for="enterName" class="form-label">Enter Name</label>
  <input type="name" class="form-control" id="enterName" name="enterName" placeholder="Enter Name Here">
</div>
<div class="mb-3">
  <label for="nameArea" class="form-label">Names</label>
  <textarea class="form-control" id="nameArea" rows="10" name="nameArea"><?php echo $output;  ?></textarea>
</div>
</form>
</body>
</html>