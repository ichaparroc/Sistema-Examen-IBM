<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{}
else
{
  header('Location: login.php');
  exit;
}


header('Content-Type: text/html; charset=ISO-8859-1');
include("frontend.php");
?>


<!DOCTYPE html>
<html lang="es">

<?php
    all_head();
?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php
        navegacion($_SESSION['id_usua']);
        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Inicio <small>Sistema de Tutoría</small>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->
                <br><br>
                
                <div class="row">
                    <div class="text-vertical-center">
                             <div align="center">
                             <img  class="img-responsive img-rounded " src="img/tutor.jpg" alt="" width="400" height="400">
                         </div>
                       
                     
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-lg-1 col-md-6">
                        
                    </div>
                    
                    <?php
                      include('conexion.php');
                      switch ($_SESSION['tipo_usuario'])
                      {
                        case 'admin':
                          $query="call informacion_admin(".$_SESSION['id_peri'].")";
                          $result=$conexion->query($query);
                          $informacion=array();
                          while($row = mysqli_fetch_row($result))
                          {
                            $informacion=$row;
                          }
                          mysqli_free_result($result);
                          $conexion->close();
                          $primero='Tutores Asignados';
                          $segundo='Estudiantes Asignados';
                          $info=array();
                          $info[0]=$informacion[1]."/".$informacion[0];
                          $info[1]=$informacion[3]."/".$informacion[2];
                          break;
                        
                        case 'estudiante':
                          $query="call informacion_estu(".$_SESSION['id_estu'].")";
                          $result=$conexion->query($query);
                          $info=array();
                          while($row = mysqli_fetch_row($result))
                          {
                            $info=$row;
                          }
                          mysqli_free_result($result);
                          $conexion->close();
                          $primero='Reuniones Grupales Realizadas';
                          $segundo='Reuniones Indiduales Realizadas';
                          break;

                        case 'docente':
                          $query="call informacion_tutor(".$_SESSION['id_tuto'].")";
                          $result=$conexion->query($query);
                          $info=array();
                          while($row = mysqli_fetch_row($result))
                          {
                            $info=$row;
                          }
                          mysqli_free_result($result);
                          $conexion->close();
                          $primero='Reuniones Grupales Realizadas';
                          $segundo='Reuniones Individuales Realizadas';
                          break;

                        default:
                          break;
                      }
                    ?>

                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-university fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $info[0]; ?></div>
                                        <?php echo $primero; ?>
                                    </div>
                                </div>
                            </div>
                            
                                <div class="panel-footer">
                                   <?php //echo $primero; ?>
                                </div>
                           
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-fw fa-graduation-cap fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $info[1]; ?></div>
                                        <?php echo $segundo; ?>
                                    </div>
                                </div>
                            </div>
                            
                                <div class="panel-footer">
                                    <?php //echo $segundo; ?>
                                </div>
                            
                        </div>
                    </div> 
                    <div class="col-lg-1 col-md-6">
                        
                    </div>
                </div>
                
                <!-- /.row -->
                <br><br>
                <!-- /.row -->
            <br><br>
            </div>
            <!-- /.container-fluid -->
            <br>
            <footer class='text-center'>
                <div class='footer-below'>
                    <div class='container'>
                        <div class='row'>
                            <div class='col-lg-12'>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
