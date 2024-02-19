<?php
   session_start();
   require 'conexion.php';
    $db=conectarDB();

   $query="SELECT * FROM articulos WHERE tipo_de_ato='Pulseras'";
   $resultadoPro=mysqli_query($db,$query);

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

   if($_SERVER['REQUEST_METHOD']==='POST'){
    $id=$_POST['id'];
    $id=filter_var($id,FILTER_VALIDATE_INT);

    /*if($id){
        $query2="DELETE FROM articulos WHERE id='$id'";
        $resultado2=mysqli_query($db,$query2);
        if($resultado2){
            header('Location: /calistoshop/listaArticulos.php'); 
        }
    }*/

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
    <title>Calisto Shop</title>
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
        <a class="navegacion__enlace navegacion__enlace--activo" href="pulseras.php">Pulseras</a>
        
    </nav>

    <main class="contenedor">
        <h1>Pulseras</h1>

        
        <div class="grid">
            <?php while($articulo=mysqli_fetch_assoc($resultadoPro)):?>
              <div class="producto">
                <a href="productos.php?id=<?php echo $articulo['id']; ?>">
                    <img class="producto__imagen" src="imagenes/articulos/<?php echo $articulo['imagen']; ?>" alt="imagen camisa">
                    <div class="producto__informacion">
                        <p class="producto__nombre"><?php echo $articulo['nombre']; ?></p>
                        <p class="producto__precio">$<?php echo $articulo['precio']; ?></p>
                    </div>
                </a>

            </div><!--producto-->
           <?php endwhile;?>

        </div>
    </main>

    

    <footer id="footer" class="footer">
        <p class="footer__texto">Footer</p>
    </footer>
    <script src="js/scroll.js?1.0"></script>

</body>
</html>