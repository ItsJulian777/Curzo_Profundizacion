<?php
session_start();
include ("../Modelo/Conexion/conexion.php");

$usuario=$_GET['idusuario'];
$id=$_GET['id'];
    $estudiante=3;
    $verificar=1;

    $consulta= "UPDATE usuario SET ustipo = '$estudiante' WHERE documento = $usuario";
    $sql="UPDATE validardatos SET verificar= '$verificar' WHERE id = $id";
    $resultado = mysqli_query($conexion,$consulta);
    $resultado2 = mysqli_query($conexion,$sql);
echo "<script> location='../Paginas-Admin/Aprovar-Estudiante.php'</script>";

mysqli_close($conexion);

?>