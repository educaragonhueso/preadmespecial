<?php
#actualiza el cambio de estadod e EBO a TVA o viceversa en la matrícula
require_once DIR_BASE.'/core/Conectar.php';
require_once DIR_BASE.'/core/EntidadBase.php';
require_once DIR_BASE.'/models/Centro.php';

$conectar=new Conectar();
$conexion=$conectar->conexion();
#print_r($_POST);
$centro=new Centro($conexion,$_POST['id_centro'],'ajax');

$vacantes=$centro->getVacantes('centro','');
$nuevotipo=str_replace('CAMBIA A ','',$_POST['estado_pulsado']);
#if($nuevotipo=='EBO' and $vacantes[0]->vacantes==0) {print("novacantes ebo");exit();}
#if($nuevotipo=='TVA' and $vacantes[1]->vacantes==0) {print("novacantes tva");exit();}
$result=1;
if($_POST['continua']=='CONTINUA')
{
$sql="update matricula set tipo_alumno_actual='".trim($nuevotipo)."' where id_alumno=".$_POST['id_alumno'];
$result=$conexion->query($sql);
}
if ($result)
	{
	$vacantes=$centro->getVacantes('centro','');
	print($vacantes[0]->vacantes.':'.$vacantes[1]->vacantes);
	}
	else     
	echo "error";
$conexion->close();

?>