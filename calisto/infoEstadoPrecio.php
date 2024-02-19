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
            $fechaInicio=$_GET["fechaInicio"];
            $fechaFin=$_GET["fechaFin"];
            $horaInicio=$_GET["horaInicio"];
            $horaFin=$_GET["horaFin"];
            $precio=$_GET["precio"];
        
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

    <div class="content principal--empleado">
        <div class="usuario">
            <div class="img_usu">
                <img src="imagenes/moneda-removebg-preview.png">
            </div>
        </div>

        <div class="info">
            <h2 class="info">Fecha Inicio: <span class="usurioR"><?php echo $fechaInicio; ?></span></h2><br>
            <h2 class="info">Fecha Fin: <span class="usurioR"><?php echo $fechaFin; ?></span></h2><br>
            <h2 class="info">Hora Inicio: <span class="usurioR"><?php echo $horaInicio; ?></span></h2><br>
        </div>

        <div class="info">
            <h2 class="info">Hora Fin: <span class="usurioR"><?php echo $horaFin; ?></span></h2><br>
            <h2 class="info">Precio: <span class="usurioR"><?php echo $precio; ?></span></h2><br>
        </div>
    </div>

    

    <footer id="footer" class="footer">
        <p class="footer__texto">Footer</p>
    </footer>
    <script src="js/scroll.js?1.0"></script>


</body>
</html>