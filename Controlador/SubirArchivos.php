<?php
session_start();
include ("../Modelo/Conexion/conexion.php");
if(isset($_POST["archivos"])){

$usuario=$_SESSION['nombreUser'];
$verificar=0;
$consig=$_POST['consignacion'];
$reporte=$_FILES['reporte']['name'];
$pago=$_FILES['pago']['name'];
$documento=$_FILES['documento']['name'];
$certificado=$_FILES['certificado']['name'];

$reporte_tmp=$_FILES['reporte']['tmp_name'];
$pago_tmp=$_FILES['pago']['tmp_name'];
$documento_tmp=$_FILES['documento']['tmp_name'];
$certificado_tmp=$_FILES['certificado']['tmp_name'];

$route_reporte="../img/Documentos/".$reporte;
$route_pago="../img/Documentos/".$pago;
$route_documento="../img/Documentos/".$documento;
$route_certificado="../img/Documentos/".$certificado;

move_uploaded_file($reporte_tmp,$route_reporte);
move_uploaded_file($pago_tmp,$route_pago);
move_uploaded_file($documento_tmp,$route_documento);
move_uploaded_file($certificado_tmp,$route_certificado);

$consulta = "INSERT INTO validardatos(id,reporte,pago,cedula,certificado,idusuario,verificar)
VALUES('$consig','$reporte','$pago','$documento','$certificado','$usuario','$verificar')";
$resultado = mysqli_query($conexion,$consulta);
    
echo "<script>alert('Se ha logueado');window.location='../index.php'</script>";
}
?>