<?php
require_once "fileUploadProc.php";
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 7</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>
<body>
    <div class="container m-3 mx-auto">
        <div class="mb-3">
            <h1>File Upload</h1>
        </div>
        <div class="mb-3">
                <h6><a href="files.php">Show File List</a></h6>
        </div>
        <div class="mb-3">
            <h6><?php echo $output; ?></h6>
        </div>
        <form method="POST" action="#" enctype="multipart/form-data">
            
            <div class="mb-3">
                <label for="fileName" class="form-label">File Name</label>
                <input type="text" class="form-control" id="fileName" name="name">
            </div>
            <div class="mb-3">
                <label for="fileUpload"><input type="file" id="fileUpload" name="file" size="30"></label>
            </div>
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" name="uploadFile" value="Upload File">
            </div>
        </form>
    </div>


</body>
</html>