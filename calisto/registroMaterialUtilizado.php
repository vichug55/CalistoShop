<?php
  session_start();
  require 'conexion.php';
  $db=conectarDB();
  $errores=[];

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
    $empeleadoId=$empeleado['id'];
    //var_dump($id_pedido);
    
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

    $id=$_GET['id'];
    $id=filter_var($id,FILTER_VALIDATE_INT);

    $col_id=mysqli_escape_string($db,$_GET['col_id']);
    $col_id=filter_var($col_id,FILTER_VALIDATE_INT);

    $tal_id=mysqli_escape_string($db,$_GET['tal_id']);
    $tal_id=filter_var($tal_id,FILTER_VALIDATE_INT);

   if(!$id){
    header('Location: /calistoshop/listaInventario.php');
   }

   /*if(!$col_id){
    header('Location: /calistoshop/listaInventario.php');
   }

   if(!$tal_id){
    header('Location: /calistoshop/listaInventario.php');
   }*/

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_de_proveedor = $_POST['nombreProveedor'];
    $nombre = $_POST['nombreMaterial'];
    $color = $_POST['color'];
    $talla = $_POST['talla'];
    $cantidad = $_POST['cantidad'];

    if(empty($errores)){
    // Buscar si la materia prima ya existe en la base de datos
    $query = "SELECT * FROM mta_primas WHERE nombre_de_proveedor='$nombre_de_proveedor' AND tipo_de_mta_prima='$nombre' AND color='$color' AND talla='$talla'";
    $resultado = mysqli_query($db, $query);
    

    if($resultado->num_rows){


        $materia_prima = mysqli_fetch_assoc($resultado);
        $mta_prima_id=$materia_prima['id'];

        if($col_id=="" and $tal_id==""){
            $queryMaterial="INSERT INTO material_utilizado (ato_id, mta_prima_id, cantidad)
            VALUES ('$id','$mta_prima_id','$cantidad');";
           $resultadoMaterial = mysqli_query($db, $queryMaterial);
        }else{
            $queryMaterial="INSERT INTO material_utilizado (ato_id, mta_prima_id, col_id, tal_id, cantidad)
            VALUES ('$id', '$mta_prima_id', '$col_id', '$tal_id', '$cantidad');";
           $resultadoMaterial = mysqli_query($db, $queryMaterial);
        }

    }else{
        $errores[]="La materia prima introducida no existe";
    }

    
    

    /*if($resultado){
        header('Location: /calistoshop/adminPage.php');
    }*/

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
    <link rel="shortcut icon" href="imagenes/logo.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <title>Material utilizado</title>
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

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <h3>Material necesario</h3>
    <form id="my-form" class="formulario--materia" method="POST" name="fvalida" onsubmit="return validarMateria()">
        <fieldset>
            <div class="contenedor-campos--materia">
                <div class="campo-materia">
                    <label><span>*</span>Nombre del proveedor</label>
                    <select name="nombreProveedor" class="input-text">
                        <option></option>
                        <option value="Alibaba">Alibaba</option>
                        <option value="Telas Poncho">Telas Poncho</option>
                        <option value="Comex">Comex</option>
                        <option value="Kompass">Kompass</option>
                        <option value="Skytex">Skytex</option>
                    </select>
                </div>
                <div class="campo-materia">
                    <label><span>*</span>Tipo de material</label>
                    <select name="nombreMaterial" class="input-text">
                        <option></option>
                        <option value="Playeras">Playeras</option>
                        <option value="Sudaderas">Sudaderas</option>
                        <option value="Tazas">Tazas</option>
                        <option value="Fundas">Fundas</option>
                        <option value="Hilo elastico">Hilo elastico</option>
                        <option value="Piedra bizuteria">Piedra bizuteria</option>
                    </select>
                </div>

                <div class="campo-materia">
                    <label><span></span>Color</label>
                    <select class="input-text" name="color">
                    <option></option>
                        <option value="Rojo">Rojo</option>
                        <option value="Verde">Verde</option>
                        <option value="Azul">Azul</option>
                        <option value="Amarillo">Amarillo</option>
                        <option value="Morado">Morado</option>
                        <option value="Naranja">Naranja</option>
                        <option value="Negro">Negro</option>
                        <option value="Blanco">Blanco</option>
                        <option value="Rosa">Rosa</option>
                    </select>
                </div>

                <div class="campo-materia">
                    <label><span></span>Talla</label>
                    <select name="talla" class="input-text">
                        <option></option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                </div>

                <div class="campo-materia">
                    <label><span>*</span>Cantidad</label>
                    <input class="input-text" type="number" name="cantidad">
                </div>

            </div>
            <div class="alinear-derecha flex">
                <input class="boton" type="submit" value="Registrar materia" >
            </div>
        </fieldset>
    </form>

    <footer id="footer" class="footer">
        <p class="footer__texto">Footer</p>
    </footer>
    <script src="js/scroll.js?1.0"></script>


    
</body>
</html>
