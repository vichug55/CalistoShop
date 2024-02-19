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

   $query="SELECT * FROM procesos";
   $resultado=mysqli_query($db,$query);

   if($_SERVER['REQUEST_METHOD']==='POST'){
    $id=$_POST['id'];
    $id=filter_var($id,FILTER_VALIDATE_INT);

    if($id){

        $queryArticulosSelect="SELECT * FROM articulos WHERE proc_id='$id'";
        $resultadoArticulosSelect=mysqli_query($db,$queryArticulosSelect);
        $articulos=mysqli_fetch_assoc($resultadoArticulosSelect);
        $ato_id=$articulos['id'];

        $queryTallasSelect="SELECT * FROM tallas WHERE ato_id='$ato_id'";
        $resultadoTallasSelect=mysqli_query($db,$queryTallasSelect);
        $tallas=mysqli_fetch_assoc($resultadoTallasSelect);
        $tal_id=$tallas['id'];

        $queryColoresSelect="SELECT * FROM colores WHERE ato_id='$ato_id'";
        $resultadoColoresSelect=mysqli_query($db,$queryColoresSelect);
        $colores=mysqli_fetch_assoc($resultadoColoresSelect);
        $col_id=$colores['id'];

        $queryInventarioTallas="DELETE FROM inventario WHERE tal_id='$tal_id'";
        $resultadoInventarioTallas=mysqli_query($db,$queryInventarioTallas);

        $queryTallas="DELETE FROM tallas WHERE ato_id='$ato_id'";
        $resultadoTallas=mysqli_query($db,$queryTallas);

        $queryMaterial="DELETE FROM material_utilizado WHERE col_id='$col_id'";
        $resultadoMaterial=mysqli_query($db,$queryMaterial);

        

        $queryInventario="DELETE FROM inventario WHERE col_id='$col_id'";
        $resultadoInventario=mysqli_query($db,$queryInventario);

        $queryColores="DELETE FROM colores WHERE ato_id='$ato_id'";
        $resultadoColores=mysqli_query($db,$queryColores);

        $queryArticulos="DELETE FROM articulos WHERE proc_id='$id'";
        $resultadoArticulos=mysqli_query($db,$queryArticulos);

        $query2="DELETE FROM procesos WHERE id='$id'";
        $resultado2=mysqli_query($db,$query2);
        if($resultado2){
            header('Location: /calistoshop/listaProcesos.php'); 
        }
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
    <link rel="shortcut icon" href="imagenes/logo.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="js/validacion.js?3.0"></script>
    <script src="js/buscador.js"></script>
    <title>Lista de empleados</title>
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
                <th>Nombre del proceso</th>
                <th>Precio del proceso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($proceso=mysqli_fetch_assoc($resultado)):?>
            <tr class="filas">
                <td><?php echo $proceso['id']; ?></td>
                <td><?php echo $proceso['nombre_de_proceso']; ?></td>
                <td><?php echo $proceso['pco_actual']; ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $proceso['id']; ?>">
                        <input type="submit" value="Eliminar proceso" class="boton-eliminar">
                    </form>
                    <a href="actualizarProceso.php?id=<?php echo $proceso['id']; ?>" class="boton-actualizar">Actualizar proceso</a>
                    <a href="articulo.php?id=<?php echo $proceso['id']; ?>" class="boton-registrar-precio">Registrar articulo</a>
                </td>
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