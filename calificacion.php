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
include('conexion.php');

$query="INSERT INTO evaluacion(id_cuestionario,id_usuario) VALUES (".$_SESSION['id_cuestionario'].",".$_SESSION['id_usuario'].")";
//echo $query;
$conexion->query($query);
$_SESSION['id_evaluacion']=$conexion->insert_id;

$query="select * from evaluacion where id='".$_SESSION['id_evaluacion']."'";
//echo $query;
$result=$conexion->query($query);
$evaluacion=array();
while($row = mysqli_fetch_row($result))
{
  $evaluacion[]=$row;
}
$_SESSION['fecha_evaluacion'] = $evaluacion[0][3];
mysqli_free_result($result);
//$conexion->next_result();

$query="select * from pregunta where id_cuestionario='".$_SESSION['id_cuestionario']."' order by id";
//echo $query;
$result=$conexion->query($query);
$pregunta=array();
while($row = mysqli_fetch_row($result))
{
  $pregunta[]=$row;
}
mysqli_free_result($result);

$nota=0;
for($nro=0;$nro<count($pregunta);$nro++)
{
  if(!isset($_POST["marcada_".$pregunta[$nro][0]]))
  {
    $_POST["marcada_".$pregunta[$nro][0]]=-1;
  }
  $query="INSERT INTO respuesta(id_evaluacion,id_pregunta,marcada) VALUES (".$_SESSION['id_evaluacion'].",".$pregunta[$nro][0].",".$_POST["marcada_".$pregunta[$nro][0]].")";
  //echo $query;
  $conexion->query($query);

  if($_POST["marcada_".$pregunta[$nro][0]]== $pregunta[$nro][8])
  {
    $nota++;
  }
}
$_SESSION['nota_evaluacion'] = $nota;

$query="UPDATE evaluacion SET nota=".$nota." WHERE id=".$_SESSION['id_evaluacion'];
//echo $query;
$conexion->query($query);
                                  
header('Location: evaluacion.php');
?>