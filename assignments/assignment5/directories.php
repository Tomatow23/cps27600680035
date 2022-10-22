<?php

Class Directories{
    public $handle = "directories/";
    function makeDirectory($name){
        $handle = "directories/";
        $path_0 = $handle . $name;
        if(!file_exists($path_0)){
            mkdir($path_0, 0777, true);
            chmod($path_0, 0777);
            return true;
        }else{
            return false;
        }
    }
    function writeToFile($name, $file_content){
        $handle = "directories/$name/readme.txt";
        if($this->makeDirectory($name)){
            touch($handle);
            $work = fopen($handle, "w");
            fwrite($work, $file_content);
            return "<br> File and Directory was created <br> <a href=$handle> Path  </a> <br>";
        }else{
            return "File already exist <br>";
        }
    }
}
?>