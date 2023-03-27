<?php

include ("../Modelo/Conexion/conexion.php");
if(isset($_POST["registro"])){
            $nombre=$_POST["nombre"];
            $documento=$_POST["documento"];
            $direccion=$_POST["direccion"];
            $telefono=$_POST["telefono"];
            $correo=$_POST["email"];
            $contraseña=$_POST["contraseña"];
            $tipo=2; 
            
           

            $consulta = "INSERT INTO usuario(documento,nombre,correo,celular,contraseña,direccion,ustipo)
            VALUES('$documento','$nombre','$correo','$telefono','$contraseña','$direccion','$tipo')";
            $resultado = mysqli_query($conexion,$consulta);
            if($resultado){
                echo "<script>alert('se ha enviado informe');window.location='../Paginas/IniciarSesion.php'</script>";

            } else {
               printf("Errormessage: %s\n", mysqli_error($conexion));
            }
            }
            else{
                echo "Error al subir archivo";
            }
            mysqli_close($conexion);
?>