<?php
class Name{
    public $name;
    function addName($name){
        $this->name = $name;
        $z = implode(", ", array_reverse(explode(" ", $name)));
        // $x=explode(" ", $name);
        // // $y = array("lname"=>$x[1],"fname"=>$x[0]);
        // $z = implode(", ", $y);
        return $z . "\n";
    }
}

?>