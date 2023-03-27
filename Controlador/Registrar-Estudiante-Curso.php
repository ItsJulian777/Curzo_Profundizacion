<?php
session_start();
include ("../Modelo/Conexion/conexion.php");
if(isset($_POST["cursos"])){
            $codigos=$_POST["codigos"];
            $usuarios=$_SESSION['nombreEstudent'];
            $comprobantes=$_FILES['comprobantes']['name'];
            $comprobantes_tmp=$_FILES['comprobantes']['tmp_name'];
            $route_comprobantes="../img/Documentos/".$comprobantes;
            $curso=$_GET['id'];
            move_uploaded_file($comprobantes_tmp,$route_comprobantes);
            $evaluacionDocente=0;
            $consultas = "INSERT INTO estudiante(codigo,comprobante,idusuario,idcurso,evaluaciondocente)
            VALUES('$codigos',' $comprobantes','$usuarios','$curso','$evaluacionDocente')";
            $resultados=mysqli_query($conexion,$consultas);

            $sql = "SELECT * FROM estudiante  WHERE codigo=$codigos ";
            $resultada = mysqli_query($conexion,$sql);
            $filaU=mysqli_fetch_array($resultada);
            if($resultada){
                if($filaU['idcurso']==$curso){//cisco
                    $_SESSION['CodigoEstudent']=$filaU['codigo'];
                    $_SESSION['CursoID']=$filaU['idcurso'];

                    echo "<script>alert('Ha enviado archivos, espere una respuesta');window.location='../index.php'</script>";
                    
                }else{
                    echo "<script>alert('Registro a curso erroneo');</script>";
                }
            }
            else {
                printf("Errormessage: %s\n", mysqli_error($conexion));
             }
            
           
            }   
            else{
                echo "Error al subir archivo";
            }
            //mysqli_close($conexion);
?>