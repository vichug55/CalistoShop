<?php
   session_start();
  require 'conexion.php';
  $db=conectarDB();
  
   
  if(isset($_SESSION['login'])) {
    // El cliente ha iniciado sesión
    $auth = $_SESSION['login'];
    } else {
        // El cliente no ha iniciado sesión
        $auth = null;
    }

    if(isset($_SESSION['rol'])) {
        // El cliente ha iniciado sesión
        $rol = $_SESSION['rol'];
    } else {
        // El cliente no ha iniciado sesión
        $rol = null;
    }

    if(isset($_SESSION['usuario'])) {
        $correo = $_SESSION['usuario'];
        $query="SELECT * FROM empleados WHERE correo='$correo'";
    $resultado=mysqli_query($db,$query);

    $empeleado=mysqli_fetch_assoc($resultado);

    $foto_de_perfil=$empeleado['foto_de_perfil'];
    } else {
        $correo = null;
    }

    if(isset($_SESSION['id'])) {
        $clte_id = $_SESSION['id'];
    } else {
        $clte_id = null;
    }

    if(!$auth || $rol!='A'){
    header('Location: /calistoshop/login.php');
    }

   $query0="SELECT * FROM empleados WHERE correo='$correo'";
   $resultado0=mysqli_query($db,$query0);


   $usuario=mysqli_fetch_assoc($resultado0);

   $jefe_id=$usuario['id'];

   $id=$_GET['id'];
   $id=filter_var($id,FILTER_VALIDATE_INT);

   if(!$id){
    header('Location: /calistoshop/listaEmpleados.php');
   }

   $consulta="SELECT * FROM empleados WHERE id='$id'";
   $result=mysqli_query($db,$consulta);
   $empleado=mysqli_fetch_assoc($result);

   $nombre=$empleado['nombre'];
   $apellidoPaterno=$empleado['apellido_paterno'];
   $apellidoMaterno=$empleado['apellido_materno'];
   $celular=$empleado['celular'];
   $email=$empleado['correo'];
   $calle=$empleado['calle_y_numero'];
   $numeroI=$empleado['numero_interior'];
   $col=$empleado['colonia'];
   $cp=$empleado['codigo_postal'];
   $ciudad=$empleado['ciudad'];
   $comision=$empleado['sueldo'];
   $puesto=$empleado['puesto'];

  if($_SERVER['REQUEST_METHOD']==='POST'){

    $nombre=$_POST['nombre'];
    $apellidoPaterno=$_POST['apellidoPaterno'];
    $apellidoMaterno=$_POST['apellidoMaterno'];
    $celular=$_POST['celular'];
    $email=$_POST['email'];
    $contraseña=$_POST['contraseña'];
    $calle=$_POST['calle'];
    $numeroI=$_POST['numeroI'];
    $col=$_POST['col'];
    $cp=$_POST['cp'];
    $ciudad=$_POST['ciudad'];
    $comision=$_POST['comision'];
    $puesto=$_POST['puesto'];
    $tipo='E';
    $passwordHash=password_hash($contraseña,PASSWORD_BCRYPT);

    $query="UPDATE empleados SET nombre='$nombre', apellido_paterno='$apellidoPaterno', apellido_materno='$apellidoMaterno', celular='$celular',
     correo='$email',calle_y_numero='$calle', colonia='$col', codigo_postal='$cp', ciudad='$ciudad', 
     sueldo='$comision', puesto='$puesto', epo_id='$jefe_id' WHERE id='$id'";

    $resultado=mysqli_query($db,$query);


    $query2="UPDATE usuarios SET nombre='$nombre', correo='$email' WHERE id='$id'";

    $resultado2=mysqli_query($db,$query2);

    if($resultado && $resultado2){
        header('Location: /calistoshop/listaEmpleados.php');
    }


  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos/styles.css">
    <script src="js/validacion.js"></script>
    <script src="js/code.js"></script>
    <link rel="shortcut icon" href="imagenes/logo.png">
    <title>Registro</title>
</head>

<body >

    <header>
        <div class="logo">
          <a href="adminPage.php">
            <img src="imagenes/logo-removebg-preview.png" alt="Logo de la página">
          </a>
        </div>

        <div class="icons">
          <?php if($auth==null || $foto_de_perfil==null):?>
          <a href="infoAdministrador.php"><i class="fa fa-user"></i></a>
          <?php else:?>
          <a href="infoAdministrador.php">
            <img src="imagenes/fotosPerfil/<?php echo $empeleado['foto_de_perfil']; ?>" alt="Foto de perfil" class="profile-pic">
          </a>
          <?php endif;?>
        </div>
    </header>

    <nav>
		<ul class="menu-horizontal">
            <li>
				<a href="#">Empleados</a>
				<ul class="menu-vertical">
					<li><a href="registroEmpleado.php">Registro</a></li>
					<li><a href="listaEmpleados.php">Lista</a></li>
				</ul>
			</li>

			<li>
				<a href="#">Articulos</a>
				<ul class="menu-vertical">
					<li><a href="listaArticulos.php">Lista</a></li>
                    <li><a href="listaInventario.php">Inventario</a></li>
                    <li><a href="listaColores.php">Colores</a></li>
				</ul>
			</li>

			<li>
				<a href="#">Materia prima</a>
				<ul class="menu-vertical">
                    <li><a href="registroMateria.php">Pedido</a></li>
					<li><a href="listaMateria.php">Lista</a></li>
                    <li><a href="listaPedido.php">Lista pedido</a></li>
				</ul>
			</li>
			
             <li>
				<a href="#">Proceso</a>
				<ul class="menu-vertical">
					<li><a href="proceso.php">Registro</a></li>
                    <li><a href="listaProcesos.php">Lista</a></li>
				</ul>
			</li>

            <li>
				<a href="#">Categorias</a>
				<ul class="menu-vertical">
                    <li><a href="registroCategoria.php">Registro</a></li>
					<li><a href="listaCategorias.php">Lista</a></li>
					<li><a href="registroBanners.php">Banners</a></li>
                    <li><a href="listaBanners.php">Lista banners</a></li>
				</ul>
			</li>

		</ul>
	</nav>

    <h3>Actualizar empleado</h3>
    <form class="formulario--empleado" method="POST" name="fvalida" onsubmit="return validarEmpleado()">
        <fieldset>
            <div class="contenedor-campos--empleado">
                <div class="campo-empleado">
                    <label><span>*</span>Nombre</label>
                    <input class="input-text"  value="<?php echo $nombre ?>" type="text" name="nombre" placeholder="Nombre" pattern="^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$" title="Ingresa un nombre valido">
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>Apellido Paterno</label>
                    <input class="input-text" value="<?php echo $apellidoPaterno ?>" type="text" placeholder="Paterno" name="apellidoPaterno" pattern="^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$" title="Ingresa un apellido valido">
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>Apellido Materno</label>
                    <input class="input-text" value="<?php echo $apellidoMaterno ?>" type="text" placeholder="Materno" name="apellidoMaterno" pattern="^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$" title="Ingresa un apellido valido">
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>Celular</label>
                    <input class="input-text" value="<?php echo $celular ?>" type="tel" name="celular" placeholder="2211335588" pattern="[0-9]{10}" title="El numero debe tener 10 digitos">
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>Correo</label>
                    <input class="input-text" value="<?php echo $email ?>" type="email" placeholder="tuCorreo@example.com" name="email">
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>Calle y numero</label>
                    <input class="input-text" value="<?php echo $calle ?>" type="text" name="calle" placeholder="5 sur">
                </div>

                <div class="campo-empleado">
                    <label><span></span>Numero interior</label>
                    <input class="input-text" value="<?php echo $numeroI ?>" type="text" name="numeroI" pattern="[0-9]" placeholder="4">
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>Colonia</label>
                    <input class="input-text" value="<?php echo $col ?>" type="text" name="col" placeholder="Cristo">
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>C.P</label>
                    <input class="input-text" value="<?php echo $cp ?>" type="text" name="cp" placeholder="72000">
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>Ciudad</label>
                    <input class="input-text" value="<?php echo $ciudad ?>" type="text" name="ciudad" placeholder="Puebla">
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>Sueldo</label>
                    <input class="input-text" value="<?php echo $comision ?>" type="number" name="comision" min="0" placeholder="3500">
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>Puesto</label>
                    <input class="input-text" value="<?php echo $puesto ?>" type="text" name="puesto" placeholder="Empleado">
                </div>


            </div>

            <div class="alinear-derecha flex">
                <input class="boton" type="submit" value="Actualizar Empleado" >
            </div>

        </fieldset>

    </form>

    <footer id="footer" class="footer">
        <p class="footer__texto">Footer</p>
    </footer>
    <script src="js/scroll.js?1.0"></script>

</body>

</html>