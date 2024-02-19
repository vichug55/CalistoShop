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
    header('Location: /proyectos/2023/Calisto_Shop/login.php');
   }

   $id=$_GET['id'];
   $id=filter_var($id,FILTER_VALIDATE_INT);

   if(!$id){
    header('Location: /proyectos/2023/Calisto_Shop/listaArticulos.php');
   }
  

  if($_SERVER['REQUEST_METHOD']==='POST'){

    $talla=$_POST['tallas'];

    $query="INSERT INTO tallas (talla,ato_id) 
    VALUES ('$talla','$id');";


    $resultado=mysqli_query($db,$query);


    if($resultado){
        header('Location: /proyectos/2023/Calisto_Shop/listaArticulos.php');
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
<header class="header">
        <a href="adminPage.php">
            <img class="header__logo" src="imagenes/logo.png" alt="Logotipo">
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
					<li><a href="registroEmpleado.php">Registrar empleadod</a></li>
					<li><a href="listaEmpleados.php">Lista empleados</a></li>
				</ul>
			</li>

			<li>
				<a href="#">Articulos</a>
				<ul class="menu-vertical">
					<li><a href="listaArticulos.php">Lista articulo</a></li>
				</ul>
			</li>

			<li>
				<a href="#">Materia prima</a>
				<ul class="menu-vertical">
					<li><a href="registroMateria.php">Registrar materia prima</a></li>
					<li><a href="listaMateria.php">Lista de materia prima</a></li>
				</ul>
			</li>
			
             <li>
				<a href="#">Proceso</a>
				<ul class="menu-vertical">
					<li><a href="proceso.php">Registrar proceso</a></li>
                    <li><a href="listaProcesos.php">Lista de procesos</a></li>
				</ul>
			</li>

		</ul>
	</nav>
 
    <h3>Registro articulo</h3>
    

    <form class="formulario--colores" method="POST" name="fvalida" enctype="multipart/form-data" onsubmit="return validarArticulo()">
        <fieldset>
            <div class="contenedor-campos--colores">

                <div class="campo-articulo">
                    <label><span></span>Tallas</label>
                    <select class="input-text" name="tallas">
                        <option>Talla</option>
                        <option value="XS">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                </div>
               
            </div>

            <div class="alinear-derecha flex">
                <input class="boton" type="submit" value="Agregar talla" >
            </div>

        </fieldset>
    </form>

    <footer class="footer">
        <p class="footer__texto">Footer</p>
    </footer>
</body>

</html>