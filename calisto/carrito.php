<?php
   session_start();
   require 'conexion.php';
   $db=conectarDB();
   
   $auth=$_SESSION['login'];
   $correo=$_SESSION['usuario'];
   $clte_id=$_SESSION['id'];
   $rol=$_SESSION['rol'];

   $query="SELECT * FROM clientes WHERE correo='$correo'";
    $resultado2=mysqli_query($db,$query);

    $usuario=mysqli_fetch_assoc($resultado2);

    $foto_de_perfil=$usuario['foto_de_perfil'];

   if(!$auth || $rol!='C'){
    header('Location: /calistoshop/login.php');
   }

   $query="SELECT ato_comprados.ato_id,ato_comprados.imagen, articulos.nombre,ato_comprados.precio
   FROM ato_comprados
   LEFT JOIN articulos ON ato_comprados.ato_id=articulos.id WHERE clte_id=$clte_id;";
   $resultado=mysqli_query($db,$query);
   $carrito = mysqli_fetch_assoc($resultado);

   $subtotal=0;


   if($_SERVER['REQUEST_METHOD']==='POST'){
    $id=$_POST['id'];
    $id=filter_var($id,FILTER_VALIDATE_INT);

    if($id){
        $query2="DELETE FROM ato_comprados WHERE ato_id='$id' AND clte_id='$clte_id'";
        $resultado2=mysqli_query($db,$query2);
        if($resultado2){
            header('Location: /calistoshop/carrito.php'); 
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
        <a class="navegacion__enlace" href="pulseras.php">Pulseras</a>
        
    </nav>

    <?php if(!$carrito):?>
        <h2>Carrito Vacio</h2>
        <div style="width: 60%; margin: 0 auto;">
        <img  src="imagenes/emptyCar-removebg-preview.png">
        </div>

    <?php else:?>
    <h2>Carrito</h2>
    <table class="carrito">
        
        <tbody>
            <?php do{?>
            <tr>
                <td style="text-align: left;"><img class="imagen-lista" src="imagenes/articulos/<?php echo $carrito['imagen']; ?>"></td>
                <td style="text-align: left;"><?php echo $carrito['nombre']; ?></td>
                <td style="text-align:left;">$<?php echo $carrito['precio']; ?></td>
                <td >
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $carrito['ato_id']; ?>">
                        <input type="submit" value="Eliminar del carrito" class="boton-eliminar"  onsubmit="return confirmacionEliminar()" >
                    </form>
                    
                </td>
            </tr>
            
            <?php $subtotal+=$carrito['precio']; }while($carrito=mysqli_fetch_assoc($resultado));?>
        </tbody>
    </table>
    <div class="alinear-derecha flex">
        <input class="boton" type="submit" value="Pagar $<?php echo $subtotal; ?>" >
    </div>
    <?php endif;?>
    

    <footer id="footer" class="footer">
        <p class="footer__texto">Footer</p>
    </footer>
    <script src="js/scroll.js?1.0"></script>

</body>
</html>