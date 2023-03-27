<?php 
    session_start(); 
    error_reporting(E_PARSE);
    include ("../../Modelo/Conexion/conexion.php");
    if($_SESSION['nombreUser']=="" && $_SESSION['nombreAdmin']=="" && $_SESSION['nombreEstudent']==""){
        $_SESSION['verificarLogin']=0;
    }else{
        $_SESSION['verificarLogin']=1;
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cursos-Profundizacion</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../../index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Cursos-Profundizacion</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="../../index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>INICIO</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


             <!-- Nav Item - Pages Collapse Menu - ENLACE A CURSOS -->
             <?php
            if(!$_SESSION['nombreUser']==""){//usuario puede ver los cursos disponibles y subir documentos para ser estudiante
                echo '
                    <li class="nav-item">
                        <a class="nav-link" href="../../Paginas/Cursos.php">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Cursos</span></a>
                    </li>
                ';
            } else if(!$_SESSION['nombreEstudent']=="" && $_SESSION['CodigoEstudent']==""){//estudiante sin codigo puede ver cursos y subir pagos para registrarse en uno
                echo '
                    <li class="nav-item">
                        <a class="nav-link" href="Confirmado-por-Admin/Cursos-confirmado.php">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Cursos</span></a>
                    </li>
                '; 
            } else if(!$_SESSION['nombreAdmin']==""){//admin puede aprovar o rechazar solicitudes de usuarios a estudiante
                echo '
                    <li class="nav-item">
                        <a class="nav-link" href="../../Paginas-Admin/Aprobar-Estudiante.php">
                            <i class="fas fa-fw fa-table"></i>
                            <span>Aprobar-Estudiantes</span>
                        </a>
                    </li>
                '; 
            }
           
            ?>


           <!-- Nav Item - Utilities Collapse Menu - ENLACE A INFORMACIÓN DE CURSOS -->
           <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-folder"></i>
                    <?php
                        if(!$_SESSION['nombreAdmin']==""){
                            echo '
                                <span>Información-Estudiantes</span>
                            ';
                        }else{
                            echo '
                                <span>Información-Cursos</span>
                            ';
                        }
                    ?>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <?php 
                            if(!$_SESSION['nombreEstudent']=="" && !$_SESSION['CodigoEstudent']==""){//Estudiante registrado en un curso
                                echo '
                                    <a class="collapse-item" href="#">Calificaciones</a>
                                    <a class="collapse-item" href="#">Actividades</a>
                                ';
                            }else if(!$_SESSION['nombreAdmin']==""){//Admin
                                echo '
                                    <a class="collapse-item" href="../../Paginas-Admin/Estudiantes-Matriculados.php">Estudiantes-Matriculados</a>
                                    <a class="collapse-item" href="../../Paginas-Admin/Escoger-curso.php">Actividades-Cursos</a>
                                ';
                            }//Si es estudiante sin curso asignado, usuariono o no está logeado no despliega nada
                        ?>
                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">


              <!-- Nav Item - Pages Collapse Menu - SECCIÓN DE RECIBOS -->
              <?php 
                if(!$_SESSION['nombreEstudent']=="" && !$_SESSION['CodigoEstudent']==""){//Si es estudiante registrado al curso se pueden solicitar todos los recibos
                    echo '
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                                aria-expanded="true" aria-controls="collapsePages">
                                <i class="fas fa-fw fa-folder"></i>
                                <span>Recibos</span>
                            </a>
                            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <a class="collapse-item" href="../../Paginas-Admin/Archivos-Usuario.php">Archivos-Usuarios</a>
                                    <a class="collapse-item" href="../../Paginas-Admin/Pagos-Usuario.php">Pagos-Consignaciones</a>
                                </div>
                            </div>
                        </li>
                    ';
                }else if(!$_SESSION['nombreEstudent']=="" && $_SESSION['CodigoEstudent']==""){//Si es estudiante que no esta registrado a un curso no se pueden ver los pagos (porque no ha hecho ninguno)
                    echo '
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                                aria-expanded="true" aria-controls="collapsePages">
                                <i class="fas fa-fw fa-folder"></i>
                                <span>Recibos</span>
                            </a>
                            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <a class="collapse-item" href="../../Paginas-Admin/Archivos-Usuario.php">Archivos-Usuarios</a>
                                </div>
                            </div>
                        </li>
                    ';
                }else if(!$_SESSION['nombreAdmin']==""){//Si es admin puede ver todos los pagos y documentos subidos
                    echo '
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                                aria-expanded="true" aria-controls="collapsePages">
                                <i class="fas fa-fw fa-folder"></i>
                                <span>Recibos</span>
                            </a>
                            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <a class="collapse-item" href="../../Paginas-Admin/Archivos-Usuario.php">Archivos-Usuarios</a>
                                    <a class="collapse-item" href="../../Paginas-Admin/Pagos-Usuario.php">Pagos-Consignaciones</a>
                                </div>
                            </div>
                        </li>
                    ';
                }else{ //Si es usuario o aún no se ha logeado muestra la carpeta pero no despliega nada
                    echo '
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                                aria-expanded="true" aria-controls="collapsePages">
                                <i class="fas fa-fw fa-folder"></i>
                                <span>Recibos</span>
                            </a>
                            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <!-- nada -->
                                </div>
                            </div>
                        </li>
                    ';    
                }
            ?>

            <!-- Nav Item - Charts - SECCIÓN DE CERTIFICADO -->
            <?php
                if(!$_SESSION['nombreEstudent']=="" && !$_SESSION['CodigoEstudent']==""){//Si es estudiante con curso registrado puede solicitar su certificado
                    echo'
                        <li class="nav-item">
                            <a class="nav-link" href="../../Paginas-Admin/Certificado.php">
                                <i class="fas fa-fw fa-chart-area"></i>
                                <span>Certificado</span>
                            </a>
                        </li>
                    ';
                }else if(!$_SESSION['nombreAdmin']==""){//Si es admin puede ver todos los estudiantes que pueden solicitar certificado y solicitarlo por ellos
                    echo'
                        <li class="nav-item">
                            <a class="nav-link" href="../../Paginas-Admin/Certificado.php">
                                <i class="fas fa-fw fa-chart-area"></i>
                                <span>Certificados</span>
                            </a>
                        </li>
                    ';
                }//Si es estudiante sin registrarse en curso, si es usuario o si no se ha logeado no puede ver la 'sección de certificado'
            ?>

            <!-- Nav Item - Tables - SECCIÓN EVALUACIÓN DOCENTE-->
            <?php
                if(!$_SESSION['nombreEstudent']=="" && !$_SESSION['CodigoEstudent']==""){//Si es estudiante con curso registrado puede realizar una evaluación al docente del curso
                   
                    echo '
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-credit-card-alt"></i>
                                <span>Evaluacion-Docente</span>
                            </a>
                        </li>
                    '
                
                    ;
            
                }else if(!$_SESSION['nombreAdmin']==""){//Si es admin puede ver todos las evaluaciones de docentes subidas
                    echo '
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa fa-credit-card-alt"></i>
                                <span>Evaluacione-Docente</span>
                            </a>
                        </li>
                    ';
                }//Si es estudiante sin registrarse en curso, si es usuario o si no se ha logeado no puede ver la 'sección de evaluación docente'
            ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
  <!-- Nav Item - USER INFORMATION -->
  <?php
                            if(!$_SESSION['nombreUser']==""){//Usuario
                                echo ' 
                                    <li class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">&nbsp;&nbsp;'.$_SESSION['nombreUser'].'</span>
                                            <img class="img-profile rounded-circle"
                                                src="../../img/undraw_profile.svg">
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                            aria-labelledby="userDropdown">
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Cuenta
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="Paginas/salir.php" data-toggle="modal" data-target="#logoutModal">
                                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Salir
                                            </a>
                                        </div>
                                    </li>
                                ';
                            }else if(!$_SESSION['nombreAdmin']==""){//Admin
                                echo ' 
                                    <li class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">&nbsp;&nbsp;Administrador</span>
                                            <img class="img-profile rounded-circle"
                                                src="../../img/undraw_profile.svg">
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                            aria-labelledby="userDropdown">
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Cuenta
                                            </a>
                                    
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="Paginas/salir.php" data-toggle="modal" data-target="#logoutModal">
                                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Salir
                                            </a>
                                        </div>
                                    </li>
                                ';
                            }else if(!$_SESSION['nombreEstudent']==""){//Estudiante
                                echo ' 
                                    <li class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">&nbsp;&nbsp;'.$_SESSION['nombreEstudent'].'</span>
                                            <img class="img-profile rounded-circle"
                                                src="../../img/undraw_profile.svg">
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                            aria-labelledby="userDropdown">
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Cuenta
                                            </a>
                                    
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="Paginas/salir.php" data-toggle="modal" data-target="#logoutModal">
                                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Salir
                                            </a>
                                        </div>
                                    </li>
                                ';
                            }else{//Sin logear
                                echo '
                                    <li class="nav-item dropdown no-arrow">
                                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                                            <img class="img-profile rounded-circle"
                                                src="../../img/undraw_profile.svg">
                                        </a>
                                        <!-- Dropdown - User Information -->
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                            aria-labelledby="userDropdown">
                                            <a class="dropdown-item" href="Paginas/IniciarSesion.php">
                                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Login
                                            </a>
                                    </li>
                                ';
                            }
                        ?>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <!--titulo-->
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h1 style="text-align: center;">EVALUACION-DOCENTE</h1>
                        </div>
                    </div>
                </div>

                <!--Preguntas-->
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <form action="../../Controlador/Examen-Docente.php" method="POST">

                                <div div class="card mb-4 py-3 border-left-dark">
                                    <div class="card-body">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                                    <h1 class="h3 mb-0 text-gray-800">Desempeño</h1>

                                                </div>
                                                <p><strong>1. tiene la predisposicion de resolver cualquier duda
                                                        referente a la clase.</strong><select name="desmpeño1"class="form-select"
                                                        aria-label="Default select example">

                                                        <option selected>De una calificacion de 1 a 5</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select></p>

                                                <p><strong>2. Emplea las tecnologías de la información y de la
                                                        comunicación </strong><select name="desmpeño2"class="form-select"
                                                        aria-label="Default select example">

                                                        <option selected>De una calificacion de 1 a 5</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select></p>
                                                <p><strong>3. Promueve el uso seguro, legal y ético de la información
                                                        digital. </strong><select name="desmpeño3"class="form-select"
                                                        aria-label="Default select example">

                                                        <option selected>De una calificacion de 1 a 5</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select></p>
                                                <p><strong>4. Es accesible y está dispuesto a brindarte ayuda académica.
                                                    </strong><select name="desmpeño4" class="form-select"
                                                        aria-label="Default select example">

                                                        <option selected>De una calificacion de 1 a 5</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select></p>
                                                <p><strong>5. Fomenta la importancia de contribuir a la conservación del
                                                        medio ambiente. </strong><select name="desmpeño5" class="form-select"
                                                        aria-label="Default select example">

                                                        <option selected>De una calificacion de 1 a 5</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>>
                                                    </select></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div div class="card mb-4 py-3 border-left-dark">
                                    <div class="card-body">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                                    <h1 class="h3 mb-0 text-gray-800">HABILIDAD</h1>

                                                </div>
                                                <p><strong>1. El docente revisa las bases teoricas enfocadas al estudio
                                                        de la pedagogia </strong><select name="habilidad1" class="form-select"
                                                        aria-label="Default select example">

                                                        <option selected>De una calificacion de 1 a 5</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select></p>

                                                <p><strong>2. Adquiere conocimientos a travez de cursos relaciondos a su
                                                        ejercicio profesional. </strong><select name="habilidad2" class="form-select"
                                                        aria-label="Default select example">

                                                        <option selected>De una calificacion de 1 a 5</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select></p>
                                                <p><strong>3. Tiene la predisposicion en el proceso de enseñanzas a todo
                                                        .tipo de estudiantes- </strong><select name="habilidad3" class="form-select"
                                                        aria-label="Default select example">

                                                        <option selected>De una calificacion de 1 a 5</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select></p>
                                                <p><strong>4. utiliza diferentes procesos pedagogicos en el proceso de
                                                        enseñanza. </strong><select name="habilidad4"
                                                        class="form-select" aria-label="Default select example">

                                                        <option selected>De una calificacion de 1 a 5</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select></p>
                                                <p><strong>5. Promueve el uso de tecnicas de aprendizaje ante los
                                                        posibles factores externos. </strong><select name="habilidad5"
                                                        class="form-select" aria-label="Default select example">

                                                        <option selected>De una calificacion de 1 a 5</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div div class="card mb-4 py-3 border-left-dark">
                                    <div class="card-body">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                                    <h1 class="h3 mb-0 text-gray-800">COMPORTAMIENTO</h1>

                                                </div>
                                                <p><strong>1. Considera los resultados de la evaluación (asesorías,
                                                        trabajos complementarios). </strong><select name="comportamiento1" class="form-select"
                                                        aria-label="Default select example">

                                                        <option selected>De una calificacion de 1 a 5</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select></p>

                                                <p><strong>2. Da a conocer las calificaciones en el plazo establecido
                                                    </strong><select name="comportamiento2" class="form-select"
                                                        aria-label="Default select example">

                                                        <option selected>De una calificacion de 1 a 5</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select></p>
                                                <p><strong>3. Otorga calificaciones imparciales. </strong><select name="comportamiento3"
                                                        class="form-select" aria-label="Default select example">

                                                        <option selected>De una calificacion de 1 a 5</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select></p>
                                                <p><strong>4. Toma en cuenta las actividades realizadas y los productos
                                                        como evidencias pa calificación</strong><select name="comportamiento4"
                                                        class="form-select" aria-label="Default select example">

                                                        <option selected>De una calificacion de 1 a 5</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select></p>
                                                <p><strong>5. Proporciona información para realizar adecuadamente las
                                                        actividades de evaluación </strong><select name="comportamiento5" class="form-select"
                                                        aria-label="Default select example">

                                                        <option selected>De una calificacion de 1 a 5</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <button name="resultado" type="submit" class="btn btn-primary">RESULTADO</button>
                                <hr />
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Optional JavaScript -->
                <!--Llamada al script de respuestas-->
                <script src="../../js/respuestas.js"></script>




                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © 2022 UFPS - Todos los Derechos Reservados &copy;  Desarrollado por:OSCAR FELIPE CACERES SUAREZ Y JOSE JULIAN FORERO PEREZ <br>
                            Versión: 2.0
                        </span>
                    </div>
                </div>
            </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">¿Desea cerrar sesión?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Se cerrara la sesion actual.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-primary" href="login.html">Salir</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="../../vendor/jquery/jquery.min.js"></script>
        <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../../js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="../../vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="../../js/demo/chart-area-demo.js"></script>
        <script src="../../js/demo/chart-pie-demo.js"></script>

</body>

</html>