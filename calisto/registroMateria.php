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

    if(!isset($_SESSION['id_pedido'])) {
        // Si no hay un ID de pedido en la sesión, crea uno nuevo
        $queryPedido="INSERT INTO pedidos (epo_id) VALUES ('$empeleadoId');";
        $resultadoPedido=mysqli_query($db,$queryPedido);
        $id_pedido = mysqli_insert_id($db);
        $_SESSION['id_pedido'] = $id_pedido; // Guarda el ID del pedido en la sesión
    } else {
        // Si ya hay un ID de pedido en la sesión, úsalo
        $id_pedido = $_SESSION['id_pedido'];

    }

    if(!$auth){
    header('Location: /calistoshop/login.php');
    }

    

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_de_proveedor = $_POST['nombreProveedor'];
    $nombre = $_POST['nombreMaterial'];
    $color = $_POST['color'];
    $talla = $_POST['talla'];
    $unidad_de_medida = $_POST['unidadMedida'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    // Buscar si la materia prima ya existe en la base de datos
    $query = "SELECT * FROM mta_primas WHERE nombre_de_proveedor='$nombre_de_proveedor' AND tipo_de_mta_prima='$nombre' AND color='$color' AND talla='$talla' AND unidad_de_medida='$unidad_de_medida' AND precio='$precio'";
    $resultado = mysqli_query($db, $query);
    $materia_prima = mysqli_fetch_assoc($resultado);

    if ($materia_prima) {
        // Si la materia prima ya existe, actualizar las existencias
        $id_materia_prima = $materia_prima['id'];
        $existencias = $materia_prima['existencias'];
        $nuevas_existencias = $existencias + $cantidad;
        $query = "UPDATE mta_primas SET existencias='$nuevas_existencias' WHERE id='$id_materia_prima'";
        $resultado = mysqli_query($db, $query);
    } else {
        // Si la materia prima no existe, insertarla en la tabla mta_primas
        $query = "INSERT INTO mta_primas (nombre_de_proveedor, tipo_de_mta_prima, color, talla, unidad_de_medida, precio, existencias) VALUES ('$nombre_de_proveedor', '$nombre', '$color', '$talla', '$unidad_de_medida', '$precio', '$cantidad')";
        $resultado = mysqli_query($db, $query);
        $id_materia_prima = mysqli_insert_id($db);
    }

    // Insertar la cantidad del pedido en la tabla pro_pedidos
    $query = "INSERT INTO pro_pedidos (numero_de_pro, pdo_id, mta_prima_id) VALUES ('$cantidad', '$id_pedido', '$id_materia_prima')";
    $resultado = mysqli_query($db, $query);


    /*// Consulta para verificar si existe un registro con los mismos valores, excepto el id
    $sql1 = "SELECT * FROM mta_primas WHERE tipo_de_mta_prima = '$nombre' AND nombre_de_proveedor = '$nombre_de_proveedor' AND color = '$color' AND talla = '$talla' AND unidad_de_medida='$unidad_de_medida'";
    $resultadoUp = mysqli_query($db, $sql1);

    // Verificar si la consulta tiene resultados
    if (mysqli_num_rows($resultadoUp) > 0) {
        // Si existe, actualizar el número de existencias en 10
        $sql = "UPDATE mta_primas SET existencias = existencias + $cantidad WHERE tipo_de_mta_prima = '$nombre' AND nombre_de_proveedor = '$nombre_de_proveedor' AND color = '$color' AND talla = '$talla' AND unidad_de_medida='$unidad_de_medida'";
        var_dump($sql);
        mysqli_query($db, $sql);
    } else {
        // Si no existe, realizar la inserción con los datos proporcionados
        $sql = "INSERT INTO mta_primas (nombre_de_proveedor, tipo_de_mta_prima, color,talla, unidad_de_medida,precio) 
        VALUES ('$nombre_de_proveedor','$nombre','$color','$talla','$unidad_de_medida','$precio');";
        var_dump($sql);
        mysqli_query($db, $sql);
    }*/

    //var_dump($queryProPedido);
    /*if($resultado){
        header('Location: /calistoshop/adminPage.php');
    }*/


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
    <title>Registro pedido</title>
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

    <h3>Material a pedir</h3>
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
                    <label><span>*</span>Precio</label>
                    <input class="input-text" type="number" name="precio">
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
                    <label><span></span>Unidad de medida</label>
                    <select name="unidadMedida" class="input-text">
                        <option></option>
                        <option value="Kg">Kg</option>
                        <option value="Lb">Lb</option>
                        <option value="LT">Lt</option>
                        <option value="Mts">Mts</option>
                        <option value="Oz">Oz</option>
                        <option value="Gal">Gal</option>
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

    <form method="post" action="terminarPedido.php">
        <div style="display: flex;">
        <input class="boton" type="submit" id="reiniciar-btn" value="Terminar pedido" style="margin: 0 auto; margin-top:2rem;">
        </div>
    </form>


    <footer id="footer" class="footer">
        <p class="footer__texto">Footer</p>
    </footer>
    <script src="js/scroll.js?1.0"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
  $('#my-form').submit(function(event) {
    // Evitamos el comportamiento por defecto de enviar el formulario
    event.preventDefault();

    // Enviamos los datos del formulario al servidor utilizando AJAX
    $.ajax({
      type: 'POST',
      url: 'registroMateria.php', // aquí deberás indicar la ruta a tu script que procesa el formulario
      data: $(this).serialize(),
      success: function(response) {
        // Manejamos la respuesta del servidor aquí (por ejemplo, mostrando un mensaje de éxito)
        alert('¡Materia registrada con éxito!');
        
        // Borramos los campos del formulario para poder seguir registrando más materias
        $('#my-form')[0].reset();
      },
      error: function(xhr, status, error) {
        // Manejamos los errores aquí (por ejemplo, mostrando un mensaje de error)
        alert('Error al registrar la materia: ' + error);
      }
    });
  });
});

    </script>
</body>
</html>
