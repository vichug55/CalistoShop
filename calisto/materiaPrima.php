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
    <title>Calisto Shop</title>
</head>
<body>
       <?php
            $nombreProveedor=$_GET["nombreProveedor"];
            $nombreMaterial=$_GET["nombreMaterial"];
            $color=$_GET["color"];
            $estilo=$_GET["estilo"];
            $talla=$_GET["talla"];
            $existencia=$_GET["existencia"];
            $unidadMedida=$_GET["unidadMedida"];
        ?>
    <header class="header">
        <a href="index.html">
            <img class="header__logo" src="imagenes/logo.png" alt="Logotipo">
        </a>
    </header>
    
    <nav class="navegacion">
        <a class="navegacion__enlace" href="sudaderas.html">Sudaderas</a>
        <a class="navegacion__enlace" href="playeras.html">Playeras</a>
        <a class="navegacion__enlace" href="tazas.html">Tazas</a>
        <a class="navegacion__enlace" href="fundas.html">Fundas</a>
        <a class="navegacion__enlace" href="pulseras.html">Pulseras</a>
        
    </nav>

    <h3>Pedidos</h3>

    <div class="content principal--empleado">
        <div class="usuario">
            <div class="img_usu">
                <img src="imagenes/pintura-removebg-preview.png">
            </div>
        </div>
        <div class="info">
        <h2 class="info">Nombre del proveedor: <span class="usurioR"><?php echo $nombreProveedor; ?></span></h2><br>
            <h2 class="info">Nombre material: <span class="usurioR"><?php echo $nombreMaterial; ?></span></h2><br>
            <h2 class="info">Color del material: <span class="usurioR"><?php echo $color; ?></span></h2><br>
            <h2 class="info">Estilo: <span class="usurioR"><?php echo $estilo; ?></span></h2><br>
        </div>
            
        <div class="info">
        <h2 class="info">Talla: <span class="usurioR"><?php echo $talla; ?></span></h2><br>
            <h2 class="info">Existencia: <span class="usurioR"><?php echo $existencia; ?></span></h2><br>
            <h2 class="info">Unidad de medida: <span class="usurioR"><?php echo $unidadMedida; ?></span></h2><br>
        </div>
            
    </div>
    


    <footer class="footer">
        <p class="footer__texto">Footer</p>
    </footer>

</body>
</html>
