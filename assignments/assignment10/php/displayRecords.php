<?php

function init()
{
    require_once("classes/Pdo_methods.php");
    $results;

    if(isset($_POST["remove"]))
    {
        $results[0] = deleteRecords($_POST["remove"]);
    }
    else
    {
        $results[0] = "";
    }

    $pdo = new PdoMethods();
    $sql = "SELECT * FROM contacts;";

    $records = $pdo->selectNotBinded($sql);

   
    $output = <<<HTML
    <form method="post" action="index.php?page=display">
    <div class="mb-2">
        <button name="submit" value="delete" class="btn btn-danger">Delete</button>
    </div>
    <div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Address</th>
          <th scope="col">City</th>
          <th scope="col">State</th>
          <th scope="col">Phone</th>
          <th scope="col">Email</th>
          <th scope="col">DOB</th>
          <th scope="col">Contact</th>
          <th scope="col">Age</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
HTML;

    foreach($records as $row)
    {
        $output .= '<tr>';
        $output .= '<td>'.$row["name"].'</td>';
        $output .= '<td>'.$row["address"].'</td>';
        $output .= '<td>'.$row["city"].'</td>';
        $output .= '<td>'.$row["state"].'</td>';
        $output .= '<td>'.$row["phone"].'</td>';
        $output .= '<td>'.$row["Email"].'</td>';
        $output .= '<td>'.$row["DOB"].'</td>';
        $output .= '<td>'.$row["contact"].'</td>';
        $output .= '<td>'.$row["age"].'</td>';
        $output .= '<td> <input type="checkbox" name="remove[]" value="'.$row["contact_id"].'"></td>';
        $output .= '</tr>';
    }   
    $output .= "</tbody></table></div> </form>";
    if(count($records) == 0)
    {
        $results[1] = "<p>There are no records to display<p>";
    }
    else
    {
        $results[1] = $output;
    }
    return $results;
}

function deleteRecords($record_id)
{
    require_once("classes/Pdo_methods.php");
    $pdo = new PdoMethods();

    foreach ($record_id as $id)
    {
        $sql = "DELETE FROM contacts WHERE contact_id = :id;";
        $bindings = [
            [":id", $id, "int"]
        ];
        if($pdo->otherBinded($sql, $bindings) === "error")
        {
            return "<p>Could not delete the names</p>";
        }
    } 

    return "<p>Contact(s) deleted</p>";
    
}

?>