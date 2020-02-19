<?php
session_start();
include('includes/head.php');
?>
<body>
    <div class="wrapper">
        <div id="content">
	  <span type="hidden" id="estado" name="estado"><?php echo $_SESSION['estado']; ?></span>
	  <span type="hidden" id="rol" name="rol"><?php echo $_SESSION['rol']; ?></span> 
		<?php if($_SESSION['rol']=='centro' or $_SESSION['rol']=='admin' or strpos($_SESSION['rol'],'sp')!==FALSE) include('includes/menusuperior.php');?>
		<?php /*usamos metodo del controlador de centros activo echo $this->showTimeline('centro',$_SESSION['id_centro'],'matricula');*/?>
		<div class="row ">
		<div id="t_matricula" style="width:100%"></div>
		<?php /*usamos metodo del controlador de centros activo*/if($_SESSION['rol']=='centro') echo $this->showTabla('centro',$_SESSION['id_centro'],'matricula');?>
		<?php if($_SESSION['rol']=='admin') echo $this->showTablas($_SESSION['rol'],$_SESSION['id_centro'],'matricula','todas');?>
		<?php if($_SESSION['rol']=='sphuesca') echo $this->showTablas($_SESSION['rol'],$_SESSION['id_centro'],'matricula','Huesca');?>
		<?php 
					if($_SESSION['rol']=='alumno')
					{
	  				echo '<input type="hidden" id="pin" name="pin" value="'.$_SESSION['clave'].'" ></input> ';
						if($_SESSION['nombre_usuario']=='nousuario')
			 				echo '<button class="btn btn-outline-info" id="nuevasolicitud" type="button">Nueva solicitud</button>';
						else //usuario alumno autenticado
			 				echo '<button class="btn btn-outline-info calumno" id="versolicitud" type="button">Ver solicitud</button>';
			 			
					echo '<a href="http://hgir.tk"><button class="btn btn-outline-info" id="inicio" type="button">INICIO</button></a>';
					}
		?>
		</div>
		<div class="row ">
		<div id="l_matricula" style="width:100%"></div>
		</div>
        </div>
    </div>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
		<script>
			$( document ).ready(function() {
			 $( "#nuevasolicitud" ).trigger( "click" );
 			});
		</script>
</body>
</html>