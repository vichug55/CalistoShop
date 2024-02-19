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
    header('Location: /calistoshop/listaArticulos.php');
   }

   $consulta="SELECT * FROM articulos WHERE id='$id'";
   $result=mysqli_query($db,$consulta);
   $articulo=mysqli_fetch_assoc($result);

    $nombre=$articulo['nombre'];
    $descripcion=$articulo['descripcion'];
    $tipo=$articulo['tipo_de_ato'];
    $estilo=$articulo['estilo'];
    $precio=$articulo['precio'];
    $imagen=$articulo['imagen'];

  if($_SERVER['REQUEST_METHOD']==='POST'){

    $nombre=$_POST['nombre'];
    $descripcion=$_POST['descripcion'];
    $tipo=$_POST['tipo'];
    $estilo=$_POST['estilo'];
    $color=$_POST['color'];
    $tallas=$_POST['tallas'];
    $existencias=$_POST['existencias'];
    $precio=$_POST['precio'];
    $imagen=$_FILES['imagen'];

    $carpetaImagen="imagenes/articulos/";
    if(!is_dir($carpetaImagen)){
        mkdir($carpetaImagen);
    }
    
    $nombreImagen='';
    
    if($imagen['name']){
        unlink($carpetaImagen.$articulo['imagen']);
        $nombreImagen=md5(uniqid(rand(),true)).".jpg";
        move_uploaded_file($imagen['tmp_name'],$carpetaImagen.$nombreImagen);
    }else{
        $nombreImagen=$articulo['imagen'];
    }

    $query="UPDATE articulos SET nombre='$nombre', tipo_de_ato='$tipo', descripcion='$descripcion', estilo='$estilo',
     color='$color',talla='$tallas',imagen='$nombreImagen', existencias='$existencias',precio='$precio' WHERE id='$id'";

    $resultado=mysqli_query($db,$query);


    if($resultado){
        header('Location: /calistoshop/listaArticulos.php');
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

    <h3>Actualizar articulo</h3>
    <form class="formulario--articulo" enctype="multipart/form-data" method="POST" name="fvalida" onsubmit="return validarArticulo()">
        <fieldset>
            <div class="contenedor-campos--articulo">

                <div class="campo-articulo">
                    <label><span>*</span>Nombre</label>
                    <input class="input-text" value="<?php echo $nombre ?>" type="text" name="nombre" placeholder ="Nombre del articulo">
                </div>

                <div class="campo-articulo">
                    <label><span>*</span>Descripcion</label>
                    <input class="input-text" value="<?php echo $descripcion ?>" type="text" name="descripcion" placeholder ="Descripcion">
                </div>

                <div class="campo-articulo">
                    <label><span>*</span>Tipo de Articulo</label>
                    <select class="input-text" name="tipo">
                       <option><?php echo $tipo ?></option>
                        <option value="Playeras">Playeras</option>
                        <option value="Sudaderas">Sudaderas</option>
                        <option value="Tazas">Tazas</option>
                        <option value="Pulseras">Pulseras</option>
                    </select>
                </div>

                
                <div class="campo-articulo">
                    <label><span></span>Estilo</label>
                    <input class="input-text" value="<?php echo $estilo ?>" type="text" name="estilo" placeholder ="Estilo">
                </div>

                <div class="campo-articulo">
                    <label><span>*</span>Precio</label>
                    <input class="input-text" type="number" value="<?php echo $precio ?>" name="precio" placeholder ="Precio" min="0">
                </div>

                <div class="campo-articulo">
                    <label><span>*</span>Imagen</label>
                    <input class="input-text" type="file" name="imagen" accept="image/jpeg, image/png">
                    <img class="imagen-lista" src="imagenes/articulos/<?php echo $imagen ?>">
                </div>
               
            </div>

            <div class="alinear-derecha flex">
                <input class="boton" type="submit" value="Actualizar Articulo" >
            </div>

        </fieldset>
    </form>

    <footer id="footer" class="footer">
        <p class="footer__texto">Footer</p>
    </footer>
    <script src="js/scroll.js?1.0"></script>

</body>

</html>