<?php
    session_start();
    include ("../Modelo/Conexion/conexion.php");
    if(isset($_POST["subir"])){
        $codigoEstudiante = $_GET['codigoEstudiante'];
        $idActividad = $_GET['idActividad'];

        $queryFilas = "SELECT COUNT(id) AS filas FROM evaluacionestudiante";
        $relustadoQueryFilas = mysqli_fetch_array(mysqli_query($conexion,$queryFilas));
        $idEntrega = $relustadoQueryFilas['filas'] + 1;

        $nota = 0;
        $solucion=$_FILES['solucion']['name'];

        $consulta = "INSERT INTO evaluacionestudiante(id,nota,archivosolucion,idestudiante,idevaluacion)
        VALUES('$idEntrega','$nota','$solucion','$codigoEstudiante','$idActividad')";
        $resultado = mysqli_query($conexion,$consulta);
        if($resultado){
            $actividad_tmp=$_FILES['solucion']['tmp_name'];
            $route_actividad="../img/Tareas/Estudiantes/".$solucion;
            move_uploaded_file($actividad_tmp,$route_actividad);
            echo "<script>alert('Se ha subido la entrega');window.location='../Paginas/Confirmado-por-Admin/Entregas-Estudiante.php'</script>";
        } else {
            printf("Errormessage: %s\n", mysqli_error($conexion));
        }
    }
    else{
        echo "Error al subir archivo";
    }
    mysqli_close($conexion);
?>