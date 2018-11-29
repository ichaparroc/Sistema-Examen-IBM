<?php
session_start();
header('Content-Type: text/html; charset=ISO-8859-1');
include("conexion.php");

if(!isset($_POST['codigo']))
{
  header("Location: login.php");
  exit;
}

if($_POST['codigo']=="admin" AND $_POST['dni']=="controldegestion")
{
  $_SESSION['token']="sistemacreadoporsilvanacabana";
	$_SESSION['examen']=$_POST['examen'];
  header("Location: creador.php");
}
else
{
   $query="select * from usuario where codigo='".$_POST['codigo']."'";
   //echo $query;
   $result=$conexion->query($query);
   $usuario=array();
   while($row = mysqli_fetch_row($result))
   {
		$usuario[]=$row;
   }
   mysqli_free_result($result);
   $conexion->next_result();
   if(count($usuario)==1 and $_POST['dni']==$usuario[0][2]) //si esta bien el codigo y dni
   {
	 
		$query="select * from cuestionario where codigo='".$_POST['examen']."'";
		//echo $query;
		$result=$conexion->query($query);
		$cuestionario=array();
		while($row = mysqli_fetch_row($result))
		{
			$cuestionario[]=$row;
		}
		mysqli_free_result($result);
		$conexion->next_result();
		if(count($cuestionario)==1 and $_POST['examen']==$cuestionario[0][1]) //si esta bien el cuestionario
		{
			$query="select * from evaluacion where id_cuestionario='".$cuestionario[0][0]."' AND id_usuario='".$usuario[0][0]."'";
			//echo $query;
			$result=$conexion->query($query);
			$evaluacion=array();
			while($row = mysqli_fetch_row($result))
			{
				$evaluacion[]=$row;
			}
			mysqli_free_result($result);
			//$conexion->next_result();

			$_SESSION['loggedin'] = true;

			$_SESSION['id_usuario'] = $usuario[0][0];
			$_SESSION['codigo_usuario'] = $usuario[0][1];
			$_SESSION['nombresyapellidos_usuario'] = $usuario[0][3];

			$_SESSION['id_cuestionario'] = $cuestionario[0][0];
			$_SESSION['codigo_cuestionario'] = $cuestionario[0][1];
			$_SESSION['titulo_cuestionario'] = $cuestionario[0][2];

			$_SESSION['start'] = time();
			$_SESSION['expire'] = $_SESSION['start'] + (10 * 60); //aqui cambiar tiempo en minutos para rendir examen

			if(count($evaluacion)!=0) //si no existe la evaluacion
			{
				$_SESSION['id_evaluacion'] = $evaluacion[0][0];
				$_SESSION['fecha_evaluacion'] = $evaluacion[0][3];
				$_SESSION['nota_evaluacion'] = $evaluacion[0][4];
			}
			header('Location: evaluacion.php'); 
		}
		else //no existe ese cuestionario
		{
			header('Location: login.php?error=examen'); 
		}
   }
   else //esta mal el dni o codigo
   {
		header('Location: login.php?error=dni');    
   }
}
?>
