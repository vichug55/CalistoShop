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

    $col_id=mysqli_escape_string($db,$_GET['col_id']);
    $col_id=filter_var($col_id,FILTER_VALIDATE_INT);

    $tal_id=mysqli_escape_string($db,$_GET['tal_id']);
    $tal_id=filter_var($tal_id,FILTER_VALIDATE_INT);

   if(!$id){
    header('Location: /calistoshop/listaArticulos.php');
   }
  

  if($_SERVER['REQUEST_METHOD']==='POST'){

    $cantidad=$_POST['cantidad'];


    $query="SELECT * FROM inventario WHERE ato_id='$id' AND col_id='$col_id' AND tal_id='$tal_id' ;"; 
    $resultado=mysqli_query($db,$query);
    $inventario = mysqli_fetch_assoc($resultado);
    $actual=$inventario['existencias'];
    $suma=$actual+$cantidad;

    $queryMaterial="SELECT * FROM material_utilizado WHERE ato_id='$id' AND col_id='$col_id' AND tal_id='$tal_id' ;"; 
    $resultadoMaterial=mysqli_query($db,$queryMaterial);
    

    if($resultadoMaterial->num_rows){

        $material = mysqli_fetch_assoc($resultadoMaterial);
        $materialNecesario=$material['cantidad'];
        $materialNecesarioArticulo=$materialNecesario*$cantidad;
        $mta_prima_id=$material['mta_prima_id'];
        
        $queryMatPrima="SELECT * FROM mta_primas WHERE id='$mta_prima_id';"; 
        $resultadoMatPrima=mysqli_query($db,$queryMatPrima);
        $matPrima = mysqli_fetch_assoc($resultadoMatPrima);
        $stock=$matPrima['existencias'];

        $resta=$stock-$materialNecesarioArticulo;
        if($materialNecesarioArticulo<=$stock){
            $queryExistencias="UPDATE inventario SET existencias='$suma' WHERE ato_id='$id' AND col_id='$col_id' AND tal_id='$tal_id';";
            $resultadoExistencias=mysqli_query($db,$queryExistencias);
    
            $queryResta="UPDATE mta_primas SET existencias='$resta' WHERE id='$mta_prima_id';";
            $resultadoResta=mysqli_query($db,$queryResta);
            if($resultadoExistencias || $resultadoResta){
                header('Location: /calistoshop/listaInventario.php');
            }
        }else if($materialNecesarioArticulo>$stock){
            $errores[]="No hay suficiente materia prima";
        }
    }else{
        $errores[]="No hay material necesario registrado para este articulo";
    }
    
    
    
    


  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articulo</title>
    <link rel="stylesheet" href="estilos/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos/styles.css">
    <link rel="shortcut icon" href="imagenes/logo.png">
    <script src="js/validacion.js"></script>
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
 
    <h3>Actualizar existencias</h3>
    <form class="formulario--colores" method="POST" name="fvalida" enctype="multipart/form-data" onsubmit="return validarArticulo()">
        <fieldset>
            <div class="contenedor-campos--colores">

                <div class="campo-articulo">
                    <label><span>*</span>Cantidad</label>
                    <input class="input-text" type="number" name="cantidad">
                </div>
               
            </div>

            <div class="alinear-derecha flex">
                <input class="boton" type="submit" value="Agregar existencias" >
            </div>

        </fieldset>
    </form>

    <footer id="footer" class="footer">
        <p class="footer__texto">Footer</p>
    </footer>
    <script src="js/scroll.js?1.0"></script>
</body>

</html>