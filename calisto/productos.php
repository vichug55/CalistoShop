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
    

   $id=$_GET['id'];
   $id=filter_var($id,FILTER_VALIDATE_INT); 

   if(!$id){
    header('Location: /calistoshop/playeras.php');
   }
   
   $query0="SELECT * FROM colores WHERE ato_id='$id'";
   $resultado0=mysqli_query($db,$query0);
   $col_id=mysqli_fetch_assoc($resultado0);

   
   $query1="SELECT * FROM tallas WHERE ato_id='$id'";
   $resultado1=mysqli_query($db,$query1);
   $tal_id=mysqli_fetch_assoc($resultado1);

   $query2="SELECT * FROM inventario WHERE ato_id='$id'";
   $resultado2=mysqli_query($db,$query2);
   $invenatrio=mysqli_fetch_assoc($resultado2);

   $consulta="SELECT * FROM articulos WHERE id='$id'";
   $result=mysqli_query($db,$consulta);
   $articulo=mysqli_fetch_assoc($result);

    $nombre=$articulo['nombre'];
    $descripcion=$articulo['descripcion'];
    $tipo=$articulo['tipo_de_ato'];
    $estilo=$articulo['estilo'];
    $precio=$articulo['precio'];
    
    
   if($_SERVER['REQUEST_METHOD']==='POST'){

    $talla=$_POST['talla'];
    $color=$_POST['color'];
    $cantidad=$_POST['cantidad'];
    $precioReal=$precio*$cantidad;

    $queryColor="SELECT * FROM colores WHERE id='$color'";
    $resultadoColor=mysqli_query($db,$queryColor);
    $colores=mysqli_fetch_assoc($resultadoColor);

    if($clte_id == null){
        header('Location: /calistoshop/login.php');
    }

    if($color=="" and $talla==""){
        $imagenOriginal=$articulo['imagen'];
        $query="INSERT INTO ato_comprados (ato_id, numero_de_ato,imagen,clte_id, precio) 
        VALUES ('$id','$cantidad','$imagenOriginal','$clte_id','$precioReal');";
    }else{
        $imagenColor=$colores['imagen'];
        $query="INSERT INTO ato_comprados (ato_id, numero_de_ato, tal_id, col_id,imagen,clte_id, precio) 
        VALUES ('$id','$cantidad','$talla','$color','$imagenColor','$clte_id','$precioReal');";
    }



    $resultado=mysqli_query($db,$query);


    if($resultado){
        header('Location: /calistoshop/carrito.php');
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
    <link rel="stylesheet" href="estilos/styles.css?3.0">
    <script src="js/validacion.js"></script>
    <script src="js/fotos.js?2.0"></script>
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
    <title>Compra</title>
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


    <main class="contenedor">
        <h1><?php echo $articulo['nombre']; ?></h1>

        <div class="product">
            <img id="imagen_producto" class="product__imagen" src="imagenes/articulos/<?php echo $articulo['imagen']; ?>" alt="imagen">

            <div class="product__contenido">
                <h2>Precio: $<?php echo $articulo['precio']; ?></h2>
                <p class="desc-producto"><?php echo $articulo['descripcion']; ?></p>

                <?php if(!$tal_id and !$col_id):?>
                    <form class="formulario-producto" method="POST">

                    <input class="formulario-producto__campo" type="number" name="cantidad" placeholder="Cantidad" min="1"  max="<?php echo $invenatrio['existencias']; ?>" step="1">
                     

                    <input class="botonN" type="submit" value="Agregar al carrito"><!--boton-->
                </form>
                <?php else:?>
                <form class="formulario-producto" method="POST">

                    <select class="formulario-producto__campo" name="talla">
                        <option disabled selected>--Selecciona talla</option>
                        <?php do{?>
                        <option value="<?php echo $tal_id['id'];?>"><?php echo $tal_id['talla'];?></option>    
                        <?php }while($tal_id=mysqli_fetch_assoc($resultado1)); ?> 
                    </select>

                    <input class="formulario-producto__campo" type="number" name="cantidad" placeholder="Cantidad" min="1"  max="<?php echo $invenatrio['existencias']; ?>" step="1">
                    <?php do{?>
                    <input class="formulario-producto__campo__color" name="color" value="<?php echo $col_id['id'];?>" type="radio" style="background-color: <?php echo $col_id['color'];?>; cursor:pointer" onchange="cambiarImagen('<?php echo $col_id['imagen'];?>')">   
                    <?php }while($col_id=mysqli_fetch_assoc($resultado0)); ?> 

                    <input class="botonN" type="submit" value="Agregar al carrito"><!--boton-->
                </form>
                <?php endif;?>
            </div>
        </div>
    </main>

    <footer id="footer" class="footer">
        <p class="footer__texto">Footer</p>
    </footer>
    <script src="js/scroll.js?1.0"></script>


</body>
</html>