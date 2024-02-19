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
        <?php
            $id=$_GET["id"];
            $nombre=$_GET["nombre"];
            $descripcion=$_GET["descripcion"];
            $tipo=$_GET["tipo"];
            $estilo=$_GET["estilo"];
            $color=$_GET["color"];
            $tallas=$_GET["tallas"];
            $existencias=$_GET["existencias"];

        ?>
    <header class="header">
        <a href="index.html">
            <img class="header__logo" src="imagenes/logo.png" alt="Logotipo">
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
                <img src="imagenes/sudadera-removebg-preview.png">
            </div>
        </div>

        <div class="info">
            <h2 class="info">Id: <span class="usurioR"><?php echo $id; ?></span></h2><br>
            <h2 class="info">Nombre: <span class="usurioR"><?php echo $nombre; ?></span></h2><br>
            <h2 class="info">Descripcion: <span class="usurioR"><?php echo $descripcion; ?></span></h2><br>
            <h2 class="info">Tipo: <span class="usurioR"><?php echo $tipo; ?></span></h2><br>
        </div>

        <div class="info">
            <h2 class="info">Estilo: <span class="usurioR"><?php echo $estilo; ?></span></h2><br>
            <h2 class="info">Color: <span class="usurioR"><?php echo $color; ?></span></h2><br>
            <h2 class="info">Tallas: <span class="usurioR"><?php echo $tallas; ?></span></h2><br>
            <h2 class="info">Existencias: <span class="usurioR"><?php echo $existencias; ?></span></h2><br>
        </div>
    </div>

    <footer class="footer">
        <p class="footer__texto">Footer</p>
    </footer>


</body>
</html>