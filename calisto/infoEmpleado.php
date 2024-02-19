<?php
   session_start();
   require 'conexion.php';
    $db=conectarDB();
   
   $auth=$_SESSION['login'];
   $correo=$_SESSION['usuario'];

   $query="SELECT * FROM empleados WHERE correo='$correo'";
   $resultado=mysqli_query($db,$query);


   $usuario=mysqli_fetch_assoc($resultado);

   $nombre=$usuario['nombre'];
   $apellido_paterno=$usuario['apellido_paterno'];
   $apellido_materno=$usuario['apellido_materno'];
   $correo=$usuario['correo'];
   $sueldo=$usuario['sueldo'];
   $puesto=$usuario['puesto'];
   $celular=$usuario['celular'];
   $calle_y_numero=$usuario['calle_y_numero'];
   $colonia=$usuario['colonia'];

   if(!$auth){
    header('Location: /calistoshop/login.php');
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
    <title>Usuario</title>
</head>
<body>
    <header class="header">
        <a href="empleadoPage.php">
            <img class="header__logo" src="imagenes/logo-removebg-preview.png" alt="Logotipo">
        </a>
         <a href="infoEmpleado.php">
            <svg class="header__user" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>
        </a>
    </header>

    <nav class="navegacion">
        <a class="navegacion__enlace" >Empleados</a>
        <a class="navegacion__enlace" >Pedidos</a>
        <a class="navegacion__enlace" >Productos</a>
        <a class="navegacion__enlace" >Compras</a>
        <a class="navegacion__enlace" >Inventario</a>
        
    </nav>

    <div class="content principal--empleado">
        <div class="usuario">
            <div class="img_usu">
                <img src="imagenes/usuario-removebg-preview.png">
            </div>
        </div>

        <div class="info">
            <h2 class="info">Nombre: <span class="usurioR"><?php echo $nombre; ?> <?php echo $apellido_paterno; ?> <?php echo $apellido_materno; ?></span></h2><br>
            <h2 class="info">Correo: <span class="usurioR"><?php echo $correo; ?></span></h2><br>
            <h2 class="info">Celular: <span class="usurioR"><?php echo $celular; ?></span></h2><br>
            <h2 class="info">Dirección: <span class="usurioR"><?php echo $calle; ?> <?php echo $colonia; ?></span></h2><br>
        </div>

        <div class="info">
            <h2 class="info">Sueldo: <span class="usurioR"><?php echo $sueldo; ?></span></h2><br>
            <h2 class="info">Puesto: <span class="usurioR"><?php echo $puesto; ?></span></h2><br>
        </div>
    </div>

    <div class="alinear-derecha flex">
        <a class="boton--opciones--admin" type="button" href="cerrarSesion.php">Cerrar Sesión</a>
    </div>

    <footer id="footer" class="footer">
        <p class="footer__texto">Footer</p>
    </footer>
    <script src="js/scroll.js?1.0"></script>


</body>
</html>