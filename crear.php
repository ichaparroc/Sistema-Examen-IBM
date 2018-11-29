<?php
session_start();
session_start();
if(!isset($_SESSION['token']) OR $_SESSION['token']!="sistemacreadoporsilvanacabana")
{
  header("Location: login.php");
  exit;
}
include('conexion.php');

if(isset($_SESSION['id_cuestionario'])) //hace update
{

}
else //hacer insert
{
  $query="INSERT INTO cuestionario(codigo,titulo) VALUES (".$_POST['codigo-examen'].",".$_POST['titulo-examen'].")";
  //echo $query;
  $conexion->query($query);
  $_SESSION['id_cuestionario']=$conexion->insert_id;
}

for($nro=0;$nro<20;$nro++)
{
  $query="INSERT INTO pregunta(id_cuestionario,titulo,alternativa1,alternativa2,alternativa3,alternativa4,alternativa5,correcta) VALUES (".$_SESSION['id_cuestionario'].","$_POST["titulo-pregunta_".$nro.",".$_POST["marcada_".$pregunta[$nro][0]].")";
  echo $query;
  $conexion->query($query);

}

$query="UPDATE evaluacion SET nota=".$nota." WHERE id=".$_SESSION['id_evaluacion'];
//echo $query;
$conexion->query($query);
                                  
header('Location: evaluacion.php');
?>