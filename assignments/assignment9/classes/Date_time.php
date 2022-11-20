<?php
class Date_time
{
    function checkSubmit()
    {
        if(isset($_POST["addNote"])){
            return $this->uploadFile();
        }
        elseif (isset($_POST["getNotes"])) {
            return $this->getNotes();
        }
    }

    function uploadFile()
    {
        require_once "classes/Pdo_methods.php";
        $strTime = $_POST["dateTime"];
        $time = strtotime($strTime);
        $content = $_POST["contents"];
        
        $pdo = new PdoMethods();

        $sql = "INSERT INTO notes (timestamp, content) VALUES (:timestamp, :content);";
        $bindings = [
            [":timestamp",$time,"int"],
            [":content",$content ,"str"]
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
    function getNotes()
    {  
        require_once "classes/Pdo_methods.php";
        $output = '<table class="table table-bordered table-striped">
        <thead>
        <tr>
          <th scope="col">Date and Time</th>
          <th scope="col">Note</th>
        </tr>
      </thead>
      <tbody>';
        $start = strtotime($_POST["beginTime"]);
        $end = strtotime($_POST["endTime"]);
        $pdo = new PdoMethods();

        $sql = "SELECT * FROM notes WHERE timestamp between :low AND :high ORDER BY timestamp DESC;";
        $bindings = [
            [":low",$start,"int"],
            [":high",$end ,"int"]
        ];

        $records = $pdo->selectBinded($sql, $bindings);

        foreach($records as $row)
        {
            $output .= '<tr><td>';
            $output .= date("n/d/Y h:i a", $row["timestamp"]);
            $output .= '</td><td>'.$row["content"].'</td></tr>';
        }
        $output .= "</tbody></table>";
        return $output;
    }

}
?>