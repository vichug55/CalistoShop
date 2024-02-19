<?php
   session_start();
  require 'conexion.php';
  $db=conectarDB();
  
   
   $auth=$_SESSION['login'];
   $correo=$_SESSION['usuario'];

   $query0="SELECT * FROM empleados WHERE correo='$correo'";
   $resultado0=mysqli_query($db,$query0);


   $usuario=mysqli_fetch_assoc($resultado0);

   $jefe_id=$usuario['id'];

   if(!$auth){
    header('Location: /calistoshop/login.php');
   }

   $id=$_GET['id'];
   $id=filter_var($id,FILTER_VALIDATE_INT);

   if(!$id){
    header('Location: /calistoshop/listaMateria.php');
   }

   $consulta="SELECT * FROM mta_primas WHERE id='$id'";
   $result=mysqli_query($db,$consulta);
   $materia=mysqli_fetch_assoc($result);

   $nombre_de_proveedor=$materia['nombre_de_proveedor'];
   $nombre=$materia['nombre'];
   $color=$materia['color'];
   $estilo=$materia['estilo'];
   $talla=$materia['talla'];
   $unidad_de_medida=$materia['unidad_de_medida'];

  if($_SERVER['REQUEST_METHOD']==='POST'){

    $nombre_de_proveedor=$_POST['nombreProveedor'];
    $nombre=$_POST['nombreMaterial'];
    $color=$_POST['color'];
    $estilo=$_POST['estilo'];
    $talla=$_POST['talla'];
    $unidad_de_medida=$_POST['unidadMedida'];

    $query="UPDATE mta_primas SET nombre_de_proveedor='$nombre_de_proveedor', nombre='$nombre', color='$color', estilo='$estilo',
     talla='$talla', unidad_de_medida='$unidad_de_medida' WHERE id='$id'";

    $resultado=mysqli_query($db,$query);


    if($resultado){
        header('Location: /calistoshop/listaMateria.php');
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

<header class="header">
        <a href="adminPage.php">
            <img class="header__logo" src="imagenes/logo-removebg-preview.png" alt="Logotipo">
        </a>
         <a href="infoAdministrador.php">
            <svg class="header__user_admin " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
        </a>
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

    <h3>Actualizar materia prima</h3>
    <form class="formulario--materia" method="POST" name="fvalida" onsubmit="return validarMateria()">
        <fieldset>
            <div class="contenedor-campos--materia">
                <div class="campo-materia">
                    <label><span>*</span>Nombre del proveedor</label>
                    <select name="nombreProveedor" class="input-text">
                        <option><?php echo $nombre_de_proveedor ?></option>
                        <option value="Alibaba">Alibaba</option>
                        <option value="Telas Poncho">Telas Poncho</option>
                        <option value="Comex">Comex</option>
                        <option value="Kompass">Kompass</option>
                        <option value="Skytex">Skytex</option>
                    </select>
                </div>
                <div class="campo-materia">
                    <label><span>*</span>Nombre del material</label>
                    <input class="input-text" value="<?php echo $nombre ?>" type="text" name="nombreMaterial" >
                </div>

                <div class="campo-materia">
                    <label><span></span>Color</label>
                    <select class="input-text" name="color">
                    <option><?php echo $color ?></option>
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
                    <label><span></span>Estilo</label>
                    <input class="input-text" value="<?php echo $estilo ?>" type="text" name="estilo">
                </div>
                <div class="campo-materia">
                    <label><span></span>Talla</label>
                    <select name="talla" class="input-text">
                        <option><?php echo $talla ?></option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                </div>


                <div class="campo-materia">
                    <label><span></span>Unidad de medida</label>
                    <select name="unidadMedida" class="input-text">
                        <option><?php echo $unidad_de_medida ?></option>
                        <option value="Kg">Kg</option>
                        <option value="Lb">Lb</option>
                        <option value="LT">Lt</option>
                        <option value="Mts">Mts</option>
                        <option value="Oz">Oz</option>
                        <option value="Gal">Gal</option>
                    </select>
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