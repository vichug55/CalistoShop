<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos/styles.css?1.0">
    <link rel="shortcut icon" href="imagenes/logo.png">
    <title>Usuario</title>
</head>
<body>
        <?php
            $articulo=$_GET["articulo"];
            $materiaPrima=$_GET["materiaPrima"];
            $materialUtilizado=$_GET["materialUtilizado"];
        ?>
    <header class="header">
        <a href="index.html">
            <img class="header__logo" src="imagenes/logo-removebg-preview.png" alt="Logotipo">
        </a>
    </header>

    <nav class="navegacion">
        <a class="navegacion__enlace" href="sudaderas.html">Sudaderas</a>
        <a class="navegacion__enlace" href="playeras.html">Playeras</a>
        <a class="navegacion__enlace" href="tazas.html">Tazas</a>
        <a class="navegacion__enlace" href="fundas.html">Fundas</a>
        <a class="navegacion__enlace" href="pulseras.html">Pulseras</a>
        
    </nav>

    <div class="content principalC">
        <aside class="usuario">
            <div class="img_usu">
                <img src="imagenes/material-removebg-preview.png">
            </div>
        </aside>

        <main class="info">
            <h2 class="info">Articulo: <span class="usurioR"><?php echo $articulo; ?></span></h2><br>
            <h2 class="info">Materia Prima: <span class="usurioR"><?php echo $materiaPrima; ?></span></h2><br>
            <h2 class="info">Material Utilizado: <span class="usurioR"><?php echo $materialUtilizado; ?></span></h2><br>

        </main>
    </div>

    <footer id="footer" class="footer">
        <p class="footer__texto">Footer</p>
    </footer>
    <script src="js/scroll.js?1.0"></script>


</body>
</html>