
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
        $empleadoID=$empeleado['id'];
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
    <link rel="shortcut icon" href="imagenes/logo.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="js/validacion.js?2.0"></script>
    <title>Administrador</title>
</head>

<body>

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


    <div>
      <h2>¿Que haras hoy administrador?</h2>
      <h3>Elige una opcion en el menu de opciones</h3>
      <img src="imagenes/ad-removebg-preview.png" class="img_admin">
      <h2>Disfruta tu estancia en Calisto Shop</h2>
    </div>
    
    <footer id="footer" class="footer">
        <p class="footer__texto">Footer</p>
    </footer>

    <script src="js/scroll.js"></script>



</body>

</html>