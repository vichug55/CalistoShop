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
    <title>Calisto Shop</title>
</head>
<body>
       <?php
            $calle=$_GET["calle"];
            $col=$_GET["col"];
            $ciudad=$_GET["ciudad"];
            $cp=$_GET["cp"];
            $alias=$_GET["alias"];
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

    <h3>Direcciones</h3>

    <main>
        <div class="contenedor--direcciones">
            <div class="direc">
                <input type="radio" checked><h4><?php echo $calle; ?> <?php echo $col; ?></h4> 
                <h5>Editar direccion</h4>
            </div>    
        </div>
    </main>
    


    <footer id="footer" class="footer">
        <p class="footer__texto">Footer</p>
    </footer>
    <script src="js/scroll.js?1.0"></script>

</body>
</html>