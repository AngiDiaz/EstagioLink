<?php

function conectar()
{


    $conn = new PDO ("mysql:dbname=elk;host=localhost","root","aluno");
    return $conn;

}
 ?>
