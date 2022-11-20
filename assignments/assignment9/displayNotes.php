<?php
require_once 'classes/Date_time.php';
$dt = new Date_time();
$notes = $dt->checkSubmit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Notes</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
    <div class="container m-3 mx-auto">
    <div class="row">
        <h1>Display Notes</h1>
    </div>
    <div class="row mb-3">
        <a href="addNotes.php">Add Notes</a>
    </div>
    <form method="POST" action="#">

        <div class="row">
            <div class="mb-3">
                <label for="beginTime" class="form-label">Beginning Date</label>
                <input type="date" class="form-control" id="beginTime" name="beginTime">
            </div>
        </div>
        <div class="row">
            <div class="mb-3">
                <label for="endTime" class="form-label">Ending Date</label>
                <input type="date" class="form-control" id="endTime" name="endTime">
            </div>
        </div>
        <div class="mb-3">
            <input class="btn btn-primary" type="submit" id="getNotes" name="getNotes" value="Get Notes">
        </div>
    </form>
    <div class="row mb-3">
        <?php echo $notes; ?>
    </div>
</div>
</body>
</html>