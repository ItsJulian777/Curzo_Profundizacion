<?php
	session_start();
include ("../Modelo/Conexion/conexion.php");
//SE DEBE PONER EL METODO GET PARA BORRAR LOS ARCHIVOS Y NO EL METODO POST
$id=$_GET['id'];
$eliminar= "DELETE FROM tareas WHERE id='$id'";

$resultadoEliminar = mysqli_query($conexion,$eliminar);

if($resultadoEliminar){
    header("Location:../Paginas-Admin/Tareas.php");
} else {
    echo"<script>alert('No se pudo eliminar'); windows.history.go(-1);</script>";
}
?>