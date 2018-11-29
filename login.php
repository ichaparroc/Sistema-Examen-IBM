<?php
session_start();
if(isset($_SESSION['loggedin']))
{
    foreach($_SESSION as $key => $value)
    {
      $_SESSION[$key] = NULL;
    }
    session_destroy();
}
header('Content-Type: text/html; charset=ISO-8859-1');
include("conexion.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de Examenes</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/stylish-portfolio.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="themes/default/images/favicon.ico">
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <script language="javascript" src="index.php?&amp;give=combined.js&amp;2.8.1&amp;3" type="text/javascript"></script>

</head>

<body>

    <header>
        
    </header>
  
  <section class="bg-primary" >
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">SISTEMA DE EXAMENES</h2>
                    <!--<hr class="small"></hr> -->
                    <br> 
                    
                </div>
            </div>
        </div>
    </section>

  <section id="services" class="default">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-10 col-lg-offset-1">
                    <h2>Iniciar Sesion</h2>
                    <hr class="small">
                    
                </div>
                
            </div>
            <!-- /.row -->
        </div>
        
        <div class="container">
        
                <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body panel-info" >
                        
                        <?php
                            if(isset($_GET['error']))
                            {
                                if($_GET['error']=="dni")
                                {
                                    echo "<center><h3 style='background-color:Tomato;''>Codigo o DNI incorrecto(s).</h1></center><br>";
                                }
                                else
                                {
                                    if($_GET['error']=="examen")
                                    {
                                        echo "<center><h3 style='background-color:Tomato;''>Examen incorrecto.</h1></center><br>";
                                    }
                                    else
                                    {
                                        echo "<center><h3 style='background-color:Tomato;''>Ud. ya ha Rendido la Evaluacion.</h1></center><br>";
                                    }
                                }
                            }
                        ?>

                        <form id="form1" method="post" action="checklogin.php">
                            <div class="form-group">
                                <label for="codigo">Codigo de Registro</label>
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
                                        <input type="text" class="form-control" placeholder="Codigo de Registro" aria-describedby="basic-addon1" name="codigo">
                                    </div>          
                            </div>
                            <div class="form-group">
                                <label for="dni">DNI</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-credit-card"></span></span>
                                    <input type="password" class="form-control" placeholder="DNI" aria-describedby="basic-addon1" name="dni">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="examen">Examen</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-list-alt"></span></span>
                                    <input type="password" class="form-control" placeholder="Examen" aria-describedby="basic-addon1" name="examen">
                                </div>
                            </div>
                            <hr/>
                          <div class="text-center">
                          </div>
                          <div class="row">
                              <div class="col-sm-12">
                                  <a href='#' onclick='form1.submit(); return false' class='btn btn-primary btn-block btn-sm' role='button'><span class="glyphicon glyphicon-lock"></span> Ingresar</a>
                              </div>
                          </div>
                        </form>
                    </div>
                </div>
                </div>
                </div>
                </div>
</section>



    <!--<section id="services" class="services bg-primary">
        
    </section> -->


<!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script>
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Scrolls to the selected menu item on the page
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
    </script>

</body>

</html>
