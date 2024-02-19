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

   $query="SELECT * FROM mta_primas";
   $resultado=mysqli_query($db,$query);

   if($_SERVER['REQUEST_METHOD']==='POST'){
    $id=$_POST['id'];
    $id=filter_var($id,FILTER_VALIDATE_INT);

    if($id){

        $queryMaterial="DELETE FROM material_utilizado WHERE mta_prima_id='$id'";
        $resultadoMaterial=mysqli_query($db,$queryMaterial);

        $queryPro="DELETE FROM pro_pedidos WHERE mta_prima_id='$id'";
        $resultadoPro=mysqli_query($db,$queryPro);

        $query2="DELETE FROM mta_primas WHERE id='$id'";
        $resultado2=mysqli_query($db,$query2);
        if($resultado2){
            header('Location: /calistoshop/listaMateria.php'); 
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <title>Lista de materia</title>
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
                <th>Nombre del proveedor</th>
                <th>Nombre de la materia</th>
                <th>Color</th>
                <th>Talla</th>
                <th>Unidad de medida</th>
                <th>Existencias</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($materia=mysqli_fetch_assoc($resultado)):?>
            <tr class="filas">
                <td><?php echo $materia['id']; ?></td>
                <td><?php echo $materia['nombre_de_proveedor']; ?></td>
                <td><?php echo $materia['tipo_de_mta_prima']; ?></td>
                <td><?php echo $materia['color']; ?></td>
                <td><?php echo $materia['talla']; ?></td>
                <td><?php echo $materia['unidad_de_medida']; ?></td>
                <td><?php echo $materia['existencias']; ?></td>
                <td>
                    <form method="POST">
                     <input type="hidden" name="id" value="<?php echo $materia['id']; ?>">
                     <input type="submit" value="Eliminar materia" class="boton-eliminar">
                    </form>
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