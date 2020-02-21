<?php 
session_start();
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT']."/config/config_global.php";
require_once DIR_CORE.'/Conectar.php';
$_SESSION['estado']='inicioinscrion';
$_SESSION['rol'] = 'alumno';      
$_SESSION['nombre_centro'] = '9999';      
$_SESSION['fecha_actual'] = date("Y/m/d");      

if($_SESSION['fecha_actual']<DIA_SORTEO) $_SESSION['sorteo'] = 0;      
else $_SESSION['sorteo'] = 1;      
$_SESSION['fecha_inscripcion'] = date("2020/11/01");      
$_SESSION['fecha_iniccioprovisionales'] = date("2019/11/01");      
$_SESSION['fecha_inicciodefinitivas'] = date("2019/11/01");      
$_SESSION['url_base'] =URL_BASE;      
$conectar=new Conectar();
$conexion=$conectar->conexion();
header('Content-Type: text/html; charset=UTF-8');  
    // Define variables and initialize with empty values
    $nombre_usuario = $clave = "";
    $nombre_usuario_err = $clave_err = "";
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST")
	{
        // Check if username is empty
        if(empty(trim($_POST["nombre_usuario"])))
	{
            $nombre_usuario_err = 'Intro nombre de usuario';
        } 
	else
	{
            $nombre_usuario = trim($_POST["nombre_usuario"]);
        }
        // Check if password is empty
        if(empty(trim($_POST['clave'])))
	{
            $clave_err = 'Intro clave';
        } 
	else
	{
            $clave = trim($_POST['clave']);
        }
        if(empty($nombre_usuario_err) && empty($clave_err))
	{
            $sql = "SELECT nombre_usuario, clave,rol,nombre_centro,id_centro FROM usuarios u left join centros c  ON u.id_usuario=c.id_usuario WHERE  u.nombre_usuario = ?";
	    if($stmt = $conexion->prepare($sql))
		{
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("s", $param_usuario);
                // Set parameters
                $param_usuario = $nombre_usuario;
                // Attempt to execute the prepared statement
                if($stmt->execute())
								{
                    // Store result
                    $stmt->store_result();
                    // Check if username exists, if yes then verify password
                    if($stmt->num_rows == 1)
		    						{                    
                        // Bind result variables
                        $stmt->bind_result($nombre_usuario, $hashed_clave,$rol,$nombre_centro,$id_centro);
                        if($stmt->fetch())
			{
                           if(md5(strtoupper($clave))== $hashed_clave || md5($clave)== $hashed_clave)
			   {
					$_SESSION['nombre_usuario'] = $nombre_usuario;      
					$_SESSION['rol'] = $rol;      
					$_SESSION['nombre_centro'] = $nombre_centro;      
					$_SESSION['id_centro'] = $id_centro;      
					if($_SESSION['fecha_actual']>=$_SESSION['fecha_inscripcion']) $_SESSION['estado']='inicioinscripcion';
					else $_SESSION['estado']='inicioinscripcion';
					header("location: index.php");
			   } 
			   else
			   {
// Display an error message if password is not valid
				$password_err = 'Clave incorrecta';
				print("error");
			  }
}
} 
else
{
                        // Display an error message if username doesn't exist
                        $nombre_usuario_err = 'No existe una cuenta para este usuario'.$username.$hashed_password;
                    }
                }else{echo "Oops! Algo falló, prueba otra vez más tarde o habla con el administrador: lhueso@aragon.es";}
            $stmt->close();
            	}
					else {echo "No ha podido comprobarse las credenciales, prueba más tarde o consulta al administrador lhueso@aragon.es";}
            }
        // Close connection
        $conexion->close();
    	}
    ?>
    <!DOCTYPE html>

    <html lang="es">

    <head>

        <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Acceso inscripciones estudios de Educación Especial</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
            .wrapper{ 
width:450px;
padding: 28px;
    padding-top: 28px;
margin: auto;
padding-top: 120px;		
	}
input[type=text], input[type=password] {
    width: 450px;
    padding: 1px 10px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

@media screen and (max-width : 600px) {
            .wrapper{

width: 100%;
} 
input[type=text], input[type=password] {
    width: 100%;
}
}
        </style>

    </head>

    <body>
        <div class="wrapper">
            <h2>Acceso inscripciones estudios de Educación Especial</h2>
	<button type="button" class="btn btn-primary" id="csolicitud">Crear solicitud</button>


            <p>Introduce tu nombre de  usuario y contraseña</p>
            <form action="" method="post">
                <div class="form-group <?php echo (!empty($nombre_usuario_err)) ? 'has-error' : ''; ?>">
                    <label>Usuario</label>
                    <input type="text" name="nombre_usuario"class="form-control" value="<?php echo $nombre_usuario; ?>">
                    <span class="help-block"><?php echo $nombre_usuario_err; ?></span>
                </div>    
                <div class="form-group <?php echo (!empty($clave_err)) ? 'has-error' : ''; ?>">
                    <label>Clave</label>
                    <input type="password" name="clave" class="form-control">
                    <span class="help-block"><?php echo $clave_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Acceder con credenciales">
                </div>
            </form>
        </div>    

<footer class="page-footer font-small stylish-color-dark pt-4 mt-4">

    <!--Footer Links-->
    <div class="container text-center text-md-left">
        <div class="row">

    <hr>

    <!--Call to action-->
    <div class="text-center py-3">
        <ul class="list-unstyled list-inline mb-0">
            <li class="list-inline-item">
    <!--Copyright-->
    <div class="footer-copyright py-3 text-center">
        Registro e incidencias:
        <a href="mailto:lhueso@aragon.es">lhueso@aragon.es </a>
    </div>
            </li>
        </ul>
    </div>
    <!--/.Call to action-->

    <hr>


</footer>
<!--/.Footer-->
    </body>

        <script src="js/login.js"></script>
    </html>


