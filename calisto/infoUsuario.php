<?php
   session_start();
   require 'conexion.php';
    $db=conectarDB();
   
   $auth=$_SESSION['login'];
   $correo=$_SESSION['usuario'];
   $rol=$_SESSION['rol'];

   $query="SELECT * FROM clientes WHERE correo='$correo'";
   $resultado=mysqli_query($db,$query);


   $usuario=mysqli_fetch_assoc($resultado);

   $nombre=$usuario['nombre'];
   $apellido_paterno=$usuario['apellido_paterno'];
   $correo=$usuario['correo'];
   $celular=$usuario['celular'];
   $foto_de_perfil=$usuario['foto_de_perfil'];

   if(!$auth || $rol!='C'){
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <script src="js/fotos.js"></script>
    <title>Usuario</title>
</head>
<body>
    <header>
        <div class="logo">
          <a href="index.php">
            <img src="imagenes/logo-removebg-preview.png" alt="Logo de la página">
          </a>
        </div>

        <div class="containerSearch">
            <input class="sss" type="text" placeholder="Buscar">
            <div class="btnSe">
                <i class="fa fa-search uni"></i>
            </div>
        </div>

        <div class="icons">
          <a href="carrito.php"><i class="fa fa-shopping-cart"></i></a>
          <?php if($auth==null || $foto_de_perfil==null):?>
          <a href="infoUsuario.php"><i id="icono" class="fa fa-user"></i></a>
          <?php else:?>
          <a href="infoUsuario.php">
            <img id="foto" src="imagenes/fotosPerfil/<?php echo $usuario['foto_de_perfil']; ?>" alt="Foto de perfil" class="profile-pic">
          </a>
          <?php endif;?>
        </div>
    </header>

    <nav class="navegacion">
        <a class="navegacion__enlace" href="sudaderas.php">Sudaderas</a>
        <a class="navegacion__enlace" href="playeras.php">Playeras</a>
        <a class="navegacion__enlace" href="tazas.php">Tazas</a>
        <a class="navegacion__enlace" href="fundas.php">Fundas</a>
        <a class="navegacion__enlace" href="pulseras.php">Pulseras</a>
        
    </nav>

    <div class="content principalC">
        <aside class="usuario">
            <div class="img_usu">
                <img id="perfil" src="imagenes/fotosPerfil/<?php echo $usuario['foto_de_perfil']; ?>" onclick="cargarFoto()" onerror="this.src='imagenes/usuario-removebg-preview.png'" class="profile-pic-big">
            </div>
        </aside>

        <main class="info">
            <h2 class="info">Nombre: <span class="usurioR"><?php echo $nombre; ?></span></h2><br>
            <h2 class="info">Apellido: <span class="usurioR"><?php echo $apellido_paterno; ?></span></h2><br>
            <h2 class="info">Correo: <span class="usurioR"><?php echo $correo; ?></span></h2><br>
            <h2 class="info">Celular: <span class="usurioR"><?php echo $celular; ?></span></h2><br>

            <div class="alinear-derecha flex">
                <a class="boton--opciones--admin" type="button" href="cerrarSesion.php">Cerrar Sesión</a>
            </div>
        </main>
    </div>

    <footer id="footer" class="footer">
        <p class="footer__texto">Footer</p>
    </footer>
    <script src="js/scroll.js?1.0"></script>


</body>
</html>