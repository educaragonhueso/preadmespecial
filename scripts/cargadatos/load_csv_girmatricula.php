<?php
#carga de datos de matrícula del directorio de ficheros de matricula por mes
require('../config.php');

$fdatos=DATA_DIR.'alumnos_especial5.csv';

$helper=new ACCESO($fdatos);

$totalmatricula=$helper->carga_matricula();
print(PHP_EOL."fin carga matricula, total: ".$totalmatricula);

?>
