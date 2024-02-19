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

    if(!$auth){
    header('Location: /calistoshop/login.php');
    }

   $query0="SELECT * FROM empleados WHERE correo='$correo'";
   $resultado0=mysqli_query($db,$query0);


   $usuario=mysqli_fetch_assoc($resultado0);

   $jefe_id=$usuario['id'];

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

    $query="INSERT INTO empleados (nombre, apellido_paterno, apellido_materno, celular, correo, contraseña,
    calle_y_numero, colonia, codigo_postal, ciudad, sueldo, puesto, epo_id)
    VALUES ('$nombre','$apellidoPaterno','$apellidoMaterno','$celular','$email','$passwordHash','$calle','$col','$cp',
    '$ciudad','$comision','$puesto','$jefe_id');";

    $resultado=mysqli_query($db,$query);


    $query2="INSERT INTO usuarios (nombre, correo, contraseña, tipo) 
    VALUES ('$nombre','$email','$passwordHash','$tipo');";

    $resultado2=mysqli_query($db,$query2);

    if($resultado && $resultado2){
        header('Location: /calistoshop/adminPage.php');
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
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
          <a href="infoAdministrador.php"><i id="icono" class="fa fa-user"></i></a>
          <?php else:?>
          <a href="infoAdministrador.php">
            <img id="foto" src="imagenes/fotosPerfil/<?php echo $usuario['foto_de_perfil']; ?>" alt="Foto de perfil" class="profile-pic">
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

    <h3>Registro empleado</h3>
    <form class="formulario--empleado" method="POST" name="fvalida" onsubmit="return validarEmpleado()">
        <fieldset>
            <div class="contenedor-campos--empleado">
                <div class="campo-empleado">
                    <label><span>*</span>Nombre</label>
                    <input class="input-text" type="text" name="nombre" placeholder="Nombre" pattern="^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$" title="Ingresa un nombre valido">
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>Apellido Paterno</label>
                    <input class="input-text" type="text" placeholder="Paterno" name="apellidoPaterno" pattern="^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$" title="Ingresa un apellido valido">
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>Apellido Materno</label>
                    <input class="input-text" type="text" placeholder="Materno" name="apellidoMaterno" pattern="^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$" title="Ingresa un apellido valido">
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>Celular</label>
                    <input class="input-text" type="tel" name="celular" placeholder="2211335588" pattern="[0-9]{10}" title="El numero debe tener 10 digitos">
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>Correo</label>
                    <input class="input-text" type="email" placeholder="tuCorreo@example.com" name="email">
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>Contraseña</label>
                    <div class="contains">
                    <input class="input-text" type="password" id="input" name="contraseña" pattern="[A-Za-z\d$@$!%*?&]{8,15}" placeholder="Contraseña" title="La contraseña debe tener de 8 a 15 caracteres, mayusculas, minusculas y un caracter">
                    <svg id="eye" class="icon" onclick="mostrar_contra()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
                    </div>
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>Calle y numero</label>
                    <input class="input-text" type="text" name="calle" placeholder="5 sur">
                </div>

                <div class="campo-empleado">
                    <label><span></span>Numero interior</label>
                    <input class="input-text" type="text" name="numeroI" pattern="[0-9]" placeholder="4">
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>Colonia</label>
                    <input class="input-text" type="text" name="col" placeholder="Cristo">
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>C.P</label>
                    <input class="input-text" type="text" name="cp" placeholder="72000">
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>Ciudad</label>
                    <input class="input-text" type="text" name="ciudad" placeholder="Puebla">
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>Sueldo</label>
                    <input class="input-text" type="number" name="comision" min="0" placeholder="3500">
                </div>

                <div class="campo-empleado">
                    <label><span>*</span>Puesto</label>
                    <input class="input-text" type="text" name="puesto" placeholder="Empleado">
                </div>


            </div>

            <div class="alinear-derecha flex">
                <input class="boton" type="submit" value="Agregar Empleado" >
            </div>

        </fieldset>

    </form>

    <footer id="footer" class="footer">
        <p class="footer__texto">Footer</p>
    </footer>
    <script src="js/scroll.js?1.0"></script>

</body>

</html>