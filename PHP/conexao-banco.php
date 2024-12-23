<?php
    function conectar(){
        $conn = new PDO("mysql:dbname=estagiolink;host=127.0.0.1","root","");
        return $conn;
    }

?>