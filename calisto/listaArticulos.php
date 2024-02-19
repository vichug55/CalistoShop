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

   $query="SELECT articulos.id, articulos.nombre,articulos.tipo_de_ato,articulos.descripcion,articulos.estilo,articulos.imagen,articulos.precio,categorias.categoria
   FROM articulos
   JOIN categorias ON articulos.cat_id=categorias.id;";

   $resultado=mysqli_query($db,$query);

   

   if($_SERVER['REQUEST_METHOD']==='POST'){
    $id=$_POST['id'];
    $id=filter_var($id,FILTER_VALIDATE_INT);

    if($id){

        $queryInventario="DELETE FROM inventario WHERE ato_id='$id'";
        $resultadoInventario=mysqli_query($db,$queryInventario);

        $queryMaterial="DELETE FROM material_utilizado WHERE ato_id='$id'";
        $resultadoMaterial=mysqli_query($db,$queryMaterial);

        $queryColores="DELETE FROM colores WHERE ato_id='$id'";
        $resultadoColores=mysqli_query($db,$queryColores);

        $queryTalla="DELETE FROM tallas WHERE ato_id='$id'";
        $resultadoTalla=mysqli_query($db,$queryTalla);


        $query2="DELETE FROM articulos WHERE id='$id'";
        $resultado2=mysqli_query($db,$query2);

        if($resultado2){
            header('Location: /calistoshop/listaArticulos.php'); 
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
                <th>Nombre</th>
                <th>Tipo de articulo</th>
                <th>Descripción </th>
                <th>Estilo</th>
                <th>Imagen</th>
                <th>Categoria</th>
                <th>Precio actual</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($articulo=mysqli_fetch_assoc($resultado)):?>
            <tr class="filas">
                <td style="text-align: center;"><?php echo $articulo['id']; ?></td>
                <td style="text-align: center;"><?php echo $articulo['nombre']; ?></td>
                <td style="text-align: center;"><?php echo $articulo['tipo_de_ato']; ?></td>
                <td style="text-align: center;"><?php echo $articulo['descripcion']; ?></td>
                <td style="text-align: center;"><?php echo $articulo['estilo']; ?></td>
                <td style="text-align: center;"><img class="imagen-lista" src="imagenes/articulos/<?php echo $articulo['imagen']; ?>"></td>
                <td style="text-align: center;"><?php echo $articulo['categoria']; ?></td>
                <td style="text-align: center;">$<?php echo $articulo['precio']; ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $articulo['id']; ?>">
                        <input type="submit" value="Eliminar articulo" class="boton-eliminar" onsubmit="return confirmacionEliminar()" >
                    </form>
                    <a href="actualizarArticulo.php?id=<?php echo $articulo['id']; ?>" class="boton-actualizar" >Actualizar articulo</a>
                    <a href="colorArticulo.php?id=<?php echo $articulo['id']; ?>" class="boton-registrar-precio">Registrar color</a>
                    <a href="tallaArticulo.php?id=<?php echo $articulo['id']; ?>" class="boton-registrar-precio">Registrar talla</a>
                    <a href="registroInventario.php?id=<?php echo $articulo['id']; ?>" class="boton-registrar-precio">Registrar combinacion</a>
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