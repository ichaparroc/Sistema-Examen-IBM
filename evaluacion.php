<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{

}
else
{
  header('Location: login.php');
  exit;
}
header('Content-Type: text/html; charset=ISO-8859-1');
include('conexion.php');
?>


<!DOCTYPE html>
<html lang="es">

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
 
    <section class="bg-primary" >
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading"><?php echo $_SESSION['codigo_cuestionario'].": ".$_SESSION['titulo_cuestionario']; ?></h2>
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
                    <h3><?php echo $_SESSION['codigo_usuario'].": ".$_SESSION['nombresyapellidos_usuario']; ?></h3>
                    <hr class="small">
                    
                </div>
            </div>
        </div>
        
        <div class="container">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="panel panel-default">
                            <div class="panel-body panel-info" >
                                
                                <?php
                                  $query="select * from pregunta where id_cuestionario='".$_SESSION['id_cuestionario']."' order by id";
                                  //echo $query;
                                  $result=$conexion->query($query);
                                  $pregunta=array();
                                  while($row = mysqli_fetch_row($result))
                                  {
                                    $pregunta[]=$row;
                                  }
                                  mysqli_free_result($result);
                                  //$conexion->next_result(); movido hacia abajo
                                  $modificable=1;
                                  if(isset($_SESSION['id_evaluacion']))
                                  {
                                    $query="select * from respuesta where id_evaluacion='".$_SESSION['id_evaluacion']."' order by id_pregunta";
                                    //echo $query;
                                    $result=$conexion->query($query);
                                    $respuesta=array();
                                    while($row = mysqli_fetch_row($result))
                                    {
                                      $respuesta[]=$row;
                                    }
                                    mysqli_free_result($result);


                                    echo "<center><h3 style='background-color:Tomato;''>NOTA: ".$_SESSION['nota_evaluacion']." <br>FECHA: ".$_SESSION['fecha_evaluacion']."</h3></center><hr>";
                                    $modificable=0;
                                  }
                                  
                                ?>

                                <form id="form1" method="post" action="calificacion.php">
                                    
                                    <?php
                                      for($nro=0;$nro<count($pregunta);$nro++)
                                      {
                                    ?>
                                      <?php if($modificable==0) {if($pregunta[$nro][8]==$respuesta[$nro][3]) {print "<big><span style='color:#00D000' class='glyphicon glyphicon-ok'></span> </big>";} else {print "<big><span style='color:#FF0000' class='glyphicon glyphicon-remove'></span> </big>";}} ?>
                                      <label ><?php echo ($nro+1).".- ".$pregunta[$nro][2];?></label>
                                      
                                      
                                      <div class="radio">
                                        <label <?php if($modificable==0) if($pregunta[$nro][8]==1) print "style='color:#00D000;font-weight:bold'"; elseif($respuesta[$nro][3]==1) print "style='color:#FF0000;font-weight:bold'"; ?> ><input <?php if($modificable==0) {print "disabled "; if($respuesta[$nro][3]==1) print "checked ";} ?> type="radio" value="1" <?php echo "name='marcada_".$pregunta[$nro][0]."'";?>><?php echo $pregunta[$nro][3];?></label>
                                      </div>
                                      <div class="radio">
                                        <label <?php if($modificable==0) if($pregunta[$nro][8]==2) print "style='color:#00D000;font-weight:bold'"; elseif($respuesta[$nro][3]==2) print "style='color:#FF0000;font-weight:bold'"; ?> ><input <?php if($modificable==0) {print "disabled "; if($respuesta[$nro][3]==2) print "checked ";} ?>type="radio" value="2" <?php echo "name='marcada_".$pregunta[$nro][0]."'";?>><?php echo $pregunta[$nro][4];?></label>
                                      </div>
                                      <div class="radio">
                                        <label <?php if($modificable==0) if($pregunta[$nro][8]==3) print "style='color:#00D000;font-weight:bold'"; elseif($respuesta[$nro][3]==3) print "style='color:#FF0000;font-weight:bold'"; ?> ><input <?php if($modificable==0) {print "disabled "; if($respuesta[$nro][3]==3) print "checked ";} ?>type="radio" value="3" <?php echo "name='marcada_".$pregunta[$nro][0]."'";?>><?php echo $pregunta[$nro][5];?></label>
                                      </div>
                                      <div class="radio">
                                        <label <?php if($modificable==0) if($pregunta[$nro][8]==4) print "style='color:#00D000;font-weight:bold'"; elseif($respuesta[$nro][3]==4) print "style='color:#FF0000;font-weight:bold'"; ?> ><input <?php if($modificable==0) {print "disabled "; if($respuesta[$nro][3]==4) print "checked ";} ?>type="radio" value="4" <?php echo "name='marcada_".$pregunta[$nro][0]."'";?>><?php echo $pregunta[$nro][6];?></label>
                                      </div>
                                      <div class="radio">
                                        <label <?php if($modificable==0) if($pregunta[$nro][8]==5) print "style='color:#00D000;font-weight:bold'"; elseif($respuesta[$nro][3]==5) print "style='color:#FF0000;font-weight:bold'"; ?> ><input <?php if($modificable==0) {print "disabled "; if($respuesta[$nro][3]==5) print "checked ";} ?>type="radio" value="5" <?php echo "name='marcada_".$pregunta[$nro][0]."'";?>><?php echo $pregunta[$nro][7];?></label>
                                      </div>

                                      <hr>
                                    <?php
                                      }
                                    ?>
                                  <div class="text-center">
                                  </div>
                                  <div class="row">
                                      <?php
                                        if($modificable==0)
                                        {
                                      ?>
                                      <div class="col-sm-12">
                                          <a href='login.php' class='btn btn-danger btn-block btn-sm' role='button'><span class="glyphicon glyphicon-log-out"></span> Salir</a>
                                      </div>
                                      <?php
                                        }
                                        else
                                        {
                                      ?>
                                      <div class="col-sm-6">
                                          <a href='' onclick='if(confirm("Esta seguro(a)?")) {form1.submit(); return false}' class='btn btn-primary btn-block btn-sm' role='button'><span class="glyphicon glyphicon-check"></span> Enviar</a>
                                      </div>
                                      <div class="col-sm-6">
                                          <a href='login.php' onclick='if(confirm("Esta seguro(a)?"))' class='btn btn-danger btn-block btn-sm' role='button'><span class="glyphicon glyphicon-log-out"></span> Salir</a>
                                      </div>
                                      <?php
                                        }
                                      ?>
                                  </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
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
