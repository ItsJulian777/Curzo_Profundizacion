<?php
session_start();
include ("../Modelo/Conexion/conexion.php");
if(isset($_POST["id"])){
    $id=$_POST['id'];
    $sql = "SELECT * FROM validardatos WHERE id=?";
    $sql->bindParam(1,$id);
    $sql->execute();
    
    $file = 'media/'.$data["reporte"];

    if(file_exists($file)){
        header('Content-Description:'.$data);
        readfile($file);
        exit;
    }
}
?>