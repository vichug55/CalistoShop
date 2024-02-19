<?php

session_start();
require 'conexion.php';
 $db=conectarDB();

 $queryBan="SELECT * FROM banners;";
 $resultadoBan=mysqli_query($db,$queryBan);

 $query2="SELECT articulos.imagen, articulos.id,categorias.categoria
 FROM articulos
 JOIN categorias ON articulos.cat_id=categorias.id
 WHERE articulos.tipo_de_ato='playeras' AND categorias.categoria='Destacados';";

 $resultado2=mysqli_query($db,$query2);

 if(isset($_SESSION['login'])) {
    // El cliente ha iniciado sesión
    $auth = $_SESSION['login'];
} else {
    // El cliente no ha iniciado sesión
    $auth = null;
}

if(isset($_SESSION['usuario'])) {
    $correo = $_SESSION['usuario'];
    $query="SELECT * FROM clientes WHERE correo='$correo'";
 $resultado=mysqli_query($db,$query);

 $usuario=mysqli_fetch_assoc($resultado);

 $foto_de_perfil=$usuario['foto_de_perfil'];
} else {
    $correo = null;
}

if(isset($_SESSION['id'])) {
    $clte_id = $_SESSION['id'];
} else {
    $clte_id = null;
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
    <link rel="stylesheet" href="estilos/styles.css?">
    <link rel="shortcut icon" href="imagenes/logo.png">
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <title>Calisto Shop</title>
</head>

<body style="background-color: black;">
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
          <a href="infoUsuario.php"><i class="fa fa-user"></i></a>
          <?php else:?>
          <a href="infoUsuario.php">
            <img src="imagenes/fotosPerfil/<?php echo $usuario['foto_de_perfil']; ?>" alt="Foto de perfil" class="profile-pic">
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
    
    <div class="swiper carrousel">
      <div class="swiper-wrapper">
      <?php while($banners=mysqli_fetch_assoc($resultadoBan)):?>
        <div class="swiper-slide">
          <img src="imagenes/banners/<?php echo $banners['imagen']; ?>" alt=""/>
        </div>
        <?php endwhile;?>
      </div>
      <button type="button" class="swiper-button-next"></button>
      <button type="button" class="swiper-button-prev"></button>
      <div class="swiper-pagination"></div>
    </div>


    

    <section class="destacados" >
    <?php while($destacados=mysqli_fetch_assoc($resultado2)):?>
          <img src="imagenes/articulos/<?php echo $destacados['imagen']; ?>" alt="">
        <?php endwhile;?>
    </section>



    <footer id="footer" class="footer" style="margin-top:0;">
        <p class="footer__texto">Footer</p>
    </footer>

    <script src="js/scroll.js?1.0"></script>
    <script src="js/corrousel.js"></script>

</body>

<script>
  var carruselItems = document.querySelectorAll('.carrusel-item');
  var currentItem = 0;

  setInterval(function() {
    carruselItems[currentItem].classList.remove('active');
    currentItem = (currentItem + 1) % carruselItems.length;
    carruselItems[currentItem].classList.add('active');
  }, 5000);
</script>

</html>