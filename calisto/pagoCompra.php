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
            $colorAnt=$_GET["colorAnt"];
            $tallaAnt=$_GET["tallaAnt"];
            $cantidad=$_GET["cantidad"];
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

    <h3>Carrito</h3>

    <main>
        <div class="contenedor--compra">
            <div class="comp">
                <h3>Producto:<span class="usurioR">Hoodie Green Lantern</span></h3> 
                <h3>Color: <span class="usurioR"><?php echo $colorAnt; ?></span></h3> 
                <h3>Talla: <span class="usurioR"><?php echo $tallaAnt; ?></h4> 
                <h3>Total:<span class="usurioR"><?php echo "$".$cantidad*499; ?></span></h3> 
            </div>    
        </div>
    </main>
    


    <footer class="footer">
        <p class="footer__texto">Footer</p>
    </footer>

</body>
</html>