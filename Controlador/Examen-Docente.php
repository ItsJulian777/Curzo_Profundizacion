<?php
session_start(); 
include ("../Modelo/Conexion/conexion.php");
if(isset($_POST["resultado"])){
    $habilidad1=$_POST["habilidad1"];
    $sumah1=0;
    foreach ($habilidad1 as $habi1){
        $sumah1+=$habi1;
    }
    $habilidad2=$_POST["habilidad2"];
    $sumah2=0;
    foreach ($habilidad2 as $habi2){
        $sumah2+=$habi2;
    }
    $habilidad3=$_POST["habilidad3"];
    $sumah3=0;
    foreach ($habilidad3 as $habi3){
        $sumah3+=$habi3;
    }
    $habilidad4=$_POST["habilidad4"];
    $sumah4=0;
    foreach ($habilidad4 as $habi4){
        $sumah4+=$habi4;
    }
    $habilidad5=$_POST["habilidad5"];
    $sumah5=0;
    foreach ($habilidad5 as $habi5){
        $sumah5+=$habi5;
    }

    $comportamiento1=$_POST["comportamiento1"];
    $comportamiento2=$_POST["comportamiento2"];
    $comportamiento3=$_POST["comportamiento3"];
    $comportamiento4=$_POST["comportamiento4"];
    $comportamiento5=$_POST["comportamiento5"];

    $desmpeño1=$_POST["desmpeño1"];
    $desmpeño2=$_POST["desmpeño2"];
    $desmpeño3=$_POST["desmpeño3"];
    $desmpeño4=$_POST["desmpeño4"];
    $desmpeño5=$_POST["desmpeño5"];


if($nit!="" && $contraseña!=""){
    if($radio=="option2"){
      $verAdmin="SELECT * FROM usuario WHERE documento='$nit' AND contraseña='$contraseña' ";
      $resultado = mysqli_query($conexion,$verAdmin);
      $filaU=mysqli_fetch_array($resultado);
      if($filaU['ustipo']==1){//admin
             $_SESSION['active']= true;
            $_SESSION['nombreAdmin']=$nit;
            $_SESSION['claveAdmin']=$contraseña;
            $_SESSION['UserType']="Admin";
            $_SESSION['adminID']=$filaU['documento'];
            echo "<script>alert('Se ha logueado como Administrador');window.location='../index.php'</script>";
            $_SESSION['verificarLogin']=1;
        }else{
            echo "<script>alert('Usuario o contraseña incorrectos');window.location='../Paginas/IniciarSesion.php'</script>";
            $_SESSION['verificarLogin']=0;
        }
    }
    if($radio=="option1"){
        $verUser="SELECT * FROM usuario WHERE documento='$nit' AND contraseña='$contraseña' ";
        $resultado = mysqli_query($conexion,$verUser);
        
        $filaU=mysqli_fetch_array($resultado);
        if($filaU['ustipo']==2){//Usuario
            $_SESSION['active']= true;
            $_SESSION['nombreUser']=$nit;
            $_SESSION['claveUser']=$contraseña;
            $_SESSION['UserType']="User";
            $_SESSION['UserNIT']=$filaU['documento'];
            echo "<script>alert('Se ha logueado como Usuario');window.location='../index.php'</script>";
            $_SESSION['verificarLogin']=1;
        }else{
            echo "<script>alert('Usuario o contraseña incorrectos');window.location='../Paginas/IniciarSesion.php'</script>";
            $_SESSION['verificarLogin']=0;
        }
    }
    if($radio=="option3"){
        $verEstudiante="SELECT * FROM usuario  WHERE documento='$nit' AND contraseña='$contraseña' ";
        
        $resultado = mysqli_query($conexion,$verEstudiante);
        $filaU=mysqli_fetch_array($resultado);
      
        
        if($filaU['ustipo']==3){//Estudiante
            $_SESSION['active']= true;
            $_SESSION['nombreEstudent']=$nit;
            $_SESSION['claveEstudent']=$contraseña;
            $_SESSION['UserType']="Estudent";
            $_SESSION['EstudentID']=$filaU['documento'];
            $_SESSION['verificarLogin']=1;

            //Verificar si el estudiante tiene código asignado
            $verificarCodigo="SELECT codigo,idcurso FROM  estudiante WHERE idusuario=$nit";
            $result = mysqli_query($conexion,$verificarCodigo);
            $filaA=mysqli_fetch_array($result);
            if($filaA==null){
                $_SESSION['CodigoEstudent']="";
                echo "<script>alert('Se ha logeado como estudiante sin código asignado');window.location='../index.php'</script>";
            }else{
                $_SESSION['CodigoEstudent']= $filaA['codigo'];
                $_SESSION['CursoID']=$filaA['idcurso'];
                echo "<script>alert('Se ha logeado como Estudiante con código asignado: ".$_SESSION['CodigoEstudent']."');window.location='../index.php'</script>";
            }    
          }else{
              echo "<script>alert('Usuario o contraseña incorrectos');window.location='../Paginas/IniciarSesion.php'</script>";
              $_SESSION['verificarLogin']=0;
          }
      }

}else{
    echo 'Error campo vacío<br>Intente nuevamente';
    $_SESSION['verificarLogin']=0;
}
}
?>