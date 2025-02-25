<?php
   include 'banco.php';
   $id_usuario = $_COOKIE['id_usuario'];
   excluir_usuario($id_usuario);

   header("Location: logout.php");
   ?>
