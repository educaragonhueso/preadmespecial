<?php
define("CONTROLADOR_DEFECTO", "centros");
define("ACCION_DEFECTO", "index");

define("DIR_BASE",$_SERVER['CONTEXT_DOCUMENT_ROOT']."/");
define("DIR_CORE",DIR_BASE."/core");
//parametros propios de la aplicacion
define("DIR_APP",DIR_BASE."/app/");
define("DIR_CONF",DIR_BASE."config/");
define("DIR_CLASES",DIR_BASE."scripts/clases/");
define("DIR_LOGS",DIR_BASE.'/scripts/datos/logs/');

define("URL_BASE",'http://preadmespecial.aragon.es/');

define("DIA_SORTEO",'2020-02-21');
define("DIA_BAREMACION",'2020-02-21');
define("DIA_PROVSIONALES",'2020-02-22');
define("DIA_DEFINIVOS",'2020-02-25');
?>
