<?php

function conectar()
{


    $conn = new PDO ("mysql:dbname=elk;host=localhost","root","3041");
    return $conn;

}
 ?>
