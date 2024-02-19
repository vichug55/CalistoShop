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

   if(!$auth){
    header('Location: /calistoshop/login.php');
   }

   $query="SELECT mta_primas.nombre_de_proveedor,mta_primas.tipo_de_mta_prima,mta_primas.color,mta_primas.talla, pedidos.id,pedidos.fecha_y_hora, pedidos.epo_id,pro_pedidos.numero_de_pro,empleados.nombre as nombre_empleado
   FROM pro_pedidos
   LEFT JOIN mta_primas ON pro_pedidos.mta_prima_id=mta_primas.id
   LEFT JOIN pedidos ON pro_pedidos.pdo_id = pedidos.id
   LEFT JOIN empleados ON pedidos.epo_id = empleados.id;";
   $resultado=mysqli_query($db,$query);

   $query2="SELECT * FROM articulos";
   $resultado2=mysqli_query($db,$query2);

  
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
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
      integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script src="js/validacion.js?3.0"></script>
    <script src="js/buscador.js"></script>
    <title>Lista pedidos</title>
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

    <div class="buscarAdmin">
         <input type="text" placeholder="Buscar" id="buscador" required />

          <div class="btnAdmin">
            <i class="fas fa-search iconSearch" ></i>
          </div>
    </div>

    <table class="empleados">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha y Hora</th>
                <th>Proveedor</th>
                <th>Tipo de materia</th>
                <th>Talla</th>
                <th>Color</th>
                <th>Empleado solicitante</th>
                <th>Cantidad pedida</th>
            </tr>
        </thead>
        <tbody>
            <?php while($pedido=mysqli_fetch_assoc($resultado)):?>
            <tr class="filas">
                <td><?php echo $pedido['id']; ?></td>
                <td><?php echo $pedido['fecha_y_hora']; ?></td>
                <td><?php echo $pedido['nombre_de_proveedor']; ?></td>
                <td><?php echo $pedido['tipo_de_mta_prima']; ?></td>
                <td><?php echo $pedido['talla']; ?></td>
                <td><?php echo $pedido['color']; ?></td>
                <td><?php echo $pedido['nombre_empleado']; ?></td>
                <td><?php echo $pedido['numero_de_pro']; ?></td>
            </tr>
            <?php endwhile;?>
        </tbody>
    </table>
    
    <footer id="footer" class="footer">
        <p class="footer__texto">Footer</p>
    </footer>
    <script src="js/scroll.js?1.0"></script>

</body>

</html>