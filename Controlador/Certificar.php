<?php
session_start();
include ("../Modelo/Conexion/conexion.php");

$codigo=$_GET['codigo'];

    $estudiante=1;

    $consulta= "UPDATE estudiante SET evaluaciondocente = '$estudiante' WHERE codigo = '$codigo'";
    $resultado = mysqli_query($conexion,$consulta);

echo "<script> location='../Paginas-Admin/Certificado.php'</script>";

mysqli_close($conexion);

?>