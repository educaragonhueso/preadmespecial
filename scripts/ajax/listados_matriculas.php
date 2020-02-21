<?php
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/config/config_global.php";
require_once DIR_CLASES.'LOGGER.php';
require_once DIR_APP.'parametros.php';
require_once DIR_BASE.'core/ControladorBase.php';
require_once DIR_BASE.'core/EntidadBase.php';
require_once DIR_BASE.'controllers/ListadosController.php';
require_once DIR_BASE.'controllers/CentrosController.php';
require_once DIR_BASE.'models/Centro.php';


if($_POST['rol']=='admin') 
{
	$cencont=new CentrosController();
	print($cencont->showTablas('admin','1','matricula'));
}
else
{
$list=new ListadosController('matricula',1);
$conexion=$list->getConexion();
$tcentro=new Centro($conexion,$_POST['codigo_centro'],'ajax');
$tcentro->setNombre();
$matriculas=$list->getAlumnosCentro($_POST['codigo_centro']);
$tablaresumen=$tcentro->getResumen('centro','matricula');
print($list->showMatriculados($matriculas));
}
?>
