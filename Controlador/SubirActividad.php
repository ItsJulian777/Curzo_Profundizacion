<?php
    session_start();
    include ("../Modelo/Conexion/conexion.php");
    if(isset($_POST["subir"])){
        $idCursoTarea = $_GET['idCurso'];
        $codigo=$_POST["codigo"];
        $titulo=$_POST["titulo"];
        $tipoActividad=$_POST['tipoActividad'];
        $actividad=$_FILES['actividad']['name'];

        if(filter_var($codigo, FILTER_VALIDATE_INT) && filter_var($idCursoTarea, FILTER_VALIDATE_INT))
        {
            $ConsultaCodigoTarea = "SELECT id FROM evaluacion WHERE id = $codigo";
            $queryConsultaCodigo = mysqli_fetch_array(mysqli_query($conexion,$ConsultaCodigoTarea));
            if($queryConsultaCodigo == null){
                $ConsultaTipoActividad = "SELECT id FROM evaluacion WHERE idcurso = $idCursoTarea AND tipoentrega = $tipoActividad";
                $queryConsultaTipoActividad = mysqli_fetch_array(mysqli_query($conexion,$ConsultaTipoActividad));
                if(filter_var($tipoActividad, FILTER_VALIDATE_INT) <> 3 and $queryConsultaTipoActividad != null){
                    echo "<script>alert('NO se subió la actividad: Ya hay un registro subido para esa actividad puntual.');window.location='../Paginas-Admin/Tareas-admin.php?idCurso=".$idCursoTarea."'</script>";
                }else{
                    $consulta = "INSERT INTO evaluacion(id,archivo,tipoentrega,idcurso,titulo)
                    VALUES('$codigo','$actividad','$tipoActividad','$idCursoTarea','$titulo')";
                    $resultado = mysqli_query($conexion,$consulta);
                    if($resultado){
                        $actividad_tmp=$_FILES['actividad']['tmp_name'];
                        $route_actividad="../img/Tareas/".$actividad;
                        move_uploaded_file($actividad_tmp,$route_actividad);
                        echo "<script>alert('se ha enviado informe');window.location='../Paginas-Admin/Tareas-admin.php?idCurso=".$idCursoTarea."'</script>";
                    } else {
                        printf("Errormessage: %s\n", mysqli_error($conexion));
                    }
                }
            }
            else{
                echo "<script>alert('NO se subió la actividad: El código de la actividad ya fue registrado con anterioridad.');window.location='../Paginas-Admin/Tareas-admin.php?idCurso=".$idCursoTarea."'</script>";
            }
        }else{
            echo "<script>alert('NO se subió la actividad: El código de la actividad debe ser un valor entero diferente de 0.');window.location='../Paginas-Admin/Tareas-admin.php?idCurso=".$idCursoTarea."'</script>";
        }
    }
    else{
        echo "Error al subir archivo";
    }
    mysqli_close($conexion);
?>