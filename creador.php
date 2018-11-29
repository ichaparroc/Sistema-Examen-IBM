<?php
session_start();
if(!isset($_SESSION['token']) OR $_SESSION['token']!="sistemacreadoporsilvanacabana")
{
  header("Location: login.php");
  exit;
}

header('Content-Type: text/html; charset=ISO-8859-1');
include('conexion.php');

var_dump($_SESSION);

$query="select * from cuestionario where codigo='".$_SESSION['examen']."'";
//echo $query;
$result=$conexion->query($query);
$cuestionario=array();
while($row = mysqli_fetch_row($result))
{
  $cuestionario[]=$row;
}
mysqli_free_result($result);
if(count($cuestionario)==0)  //no existen el cuestionario, hay que crearlo
{
  $editable=0;
?>
<script type="text/javascript">
if(!confirm("Este examen NO existe, desea crearlo?"))
{
  window.location.replace("login.php");
}
</script>
<?php
}
else //si existe el cuestionario, hay que modificarlo
{
  $editable=1;
  $_SESSION['id_cuestionario']=$cuestionario[0][0];
?>
<script type="text/javascript">alert("Este examen existe, se editará.")</script>
<?php
  $query="select * from pregunta where id_cuestionario='".$_SESSION['examen']."'";
  //echo $query;
  $result=$conexion->query($query);
  $pregunta=array();
  while($row = mysqli_fetch_row($result))
  {
    $pregunta[]=$row;
  }
  mysqli_free_result($result);
  $conexion->next_result();
}


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
<form id="form1" method="post" action="crear.php"> 
    <section class="bg-primary" >
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">
                      <input type="text" class="form-control" placeholder="codigo-examen" aria-describedby="basic-addon1" name="codigo-examen" required <?php print "value='".$_SESSION['examen']."'"; ?> maxlength="25">
                      <input type="text" class="form-control" placeholder="titulo-examen" aria-describedby="basic-addon1" name="titulo-examen" required maxlength="100">
                    </h2>
                    <!--<hr class="small"></hr> -->
                    <br> 
                    
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="default">
        <br>
        
        <div class="container">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="panel panel-default">
                            <div class="panel-body panel-info" >
                                                                  
                                    <?php
                                      for($nro=0;$nro<1;$nro++)
                                      {
                                    ?>
                                      <h4 class="section-heading">
                                        <?php print ($nro+1); ?>. <textarea required type="text" class="form-control" placeholder="titulo-pregunta-<?php print ($nro+1); ?>" aria-describedby="basic-addon1" name="titulo-pregunta_<?php print $nro; ?>" maxlength="250"></textarea>
                                      </h4>
                                      <div class="radio">
                                        <input type="radio" value="1" <?php echo "name='marcada_".$nro."'";?> required>
                                        <input required type="text" class="form-control" placeholder="alternativa1-pregunta-<?php print ($nro+1); ?>" aria-describedby="basic-addon1" name="titulo-pregunta_<?php print $nro; ?>_1" maxlength="100">
                                      </div>
                                      <div class="radio">
                                        <input type="radio" value="2" <?php echo "name='marcada_".$nro."'";?> required>
                                        <input required type="text" class="form-control" placeholder="alternativa2-pregunta-<?php print ($nro+1); ?>" aria-describedby="basic-addon1" name="titulo-pregunta_<?php print $nro; ?>_2" maxlength="100">
                                      </div>
                                      <div class="radio">
                                        <input type="radio" value="3" <?php echo "name='marcada_".$nro."'";?> required>
                                        <input required type="text" class="form-control" placeholder="alternativa3-pregunta-<?php print ($nro+1); ?>" aria-describedby="basic-addon1" name="titulo-pregunta_<?php print $nro; ?>_3" maxlength="100">
                                      </div>
                                      <div class="radio">
                                        <input type="radio" value="4" <?php echo "name='marcada_".$nro."'";?> required>
                                        <input required type="text" class="form-control" placeholder="alternativa4-pregunta-<?php print ($nro+1); ?>" aria-describedby="basic-addon1" name="titulo-pregunta_<?php print $nro; ?>_4" maxlength="100">
                                      </div>
                                      <div class="radio">
                                        <input type="radio" value="5" <?php echo "name='marcada_".$nro."'";?> required>
                                        <input required type="text" class="form-control" placeholder="alternativa5-pregunta-<?php print ($nro+1); ?>" aria-describedby="basic-addon1" name="titulo-pregunta_<?php print $nro; ?>_5" maxlength="100">
                                      </div>
                                      

                                      <hr>
                                    <?php
                                      }
                                    ?>
                                  <div class="text-center">
                                  </div>
                                  <div class="row">
                                      <div class="col-sm-6">
                                          <input class='btn btn-primary btn-block btn-sm' role='button' type="submit" value="Guardar">
                                      </div>
                                      <!-- Boton antiguo, pero no revisa los required.
                                      <div class="col-sm-6">
                                          <a href='' onclick='if(confirm("Esta seguro(a)?")) {form1.submit(); return false}' class='btn btn-primary btn-block btn-sm' role='button'><span class="glyphicon glyphicon-check"></span> Enviar</a>
                                      </div>-->
                                      <div class="col-sm-6">
                                          <a href='login.php' onclick='if(confirm("Esta seguro(a)?"))' class='btn btn-danger btn-block btn-sm' role='button'><span class="glyphicon glyphicon-log-out"></span> Salir</a>
                                      </div>
                                  </div>
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
</form>
</body>

</html>
