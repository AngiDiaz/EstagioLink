<?php
    function conectar(){
        $conn = new PDO("mysql:dbname=elk;host=127.0.0.1","root","");
        return $conn;
    }

?> 