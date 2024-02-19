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
    <title>Info Proceso</title>
</head>
<body>
        <?php
            $idProceso=$_GET["idProceso"];
            $nombreProceso=$_GET["nombreProceso"];
            $precioProceso=$_GET["precioProceso"];
        
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
                <img src="imagenes/brocha-removebg-preview.png">
            </div>
        </div>

        <div class="info">
            <h2 class="info">Id: <span class="usurioR"><?php echo $idProceso; ?></span></h2><br>
            <h2 class="info">Nombre: <span class="usurioR"><?php echo $nombreProceso; ?></span></h2><br>
            <h2 class="info">Precio: <span class="usurioR"><?php echo $precioProceso; ?></span></h2><br>
        </div>

    </div>

    <footer class="footer">
        <p class="footer__texto">Footer</p>
    </footer>


</body>
</html>