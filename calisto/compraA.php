<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos/styles.css?2.0">
    <script src="js/validacion.js"></script>
    <link rel="shortcut icon" href="imagenes/logo.png">
    <title>Compra</title>
</head>
<body>

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

    <div class="content principalC">
        <div class="grid-articulos">
            <div class="articulo">
                <img src="imagenes/green_lantern_white.png">
            </div>

            <div class="articulo">
                <img src="imagenes/green_lantern_black.png">
            </div>

            <div class="articulo">
                <img src="imagenes/green_lantern_green.png">
            </div>
        </div>

        <main class="info">
           <form method="GET" name="fvalida" action="pagoCompra.php" >
            <h2>Hoodie Green Lantern</h2>
            <h3>Precio </h3><h4>$499</h4>
            <h3>Descripción</h3>
            <h4>Sudadera de algodón con estampado en 
                transfer, relax fit.</h4>

            
                <div class="colores">
                    <h2>Color:</h2>
                    <input type="radio" class="check-verde" name="colorAnt" value="Verde" id="col">
                    <input type="radio" class="check-negro" name="colorAnt" value="Negro">
                    <input type="radio" class="check-blanco" name="colorAnt" value="Blanco">
                </div>

                <h3>Existenica: </h3><h4>3 disponibles</h4>
                <h3>Selecciona tu talla</h3>

                <div class="tallas">
                    <input type="radio" class="radio-s" name="tallaAnt" value="S" id="tax"><span class="tal">S</span>
                    <input type="radio" class="radio-m" name="tallaAnt" value="M" id="tax"><span class="tal">M</span>
                    <input type="radio" class="radio-l" name="tallaAnt" value="L" id="tax"><span class="tal">L</span>
                    <input type="radio" class="radio-xl" name="tallaAnt" value="XL" id="tax"><span class="tal">XL</span>
                </div>

                <div class="colores">
                   <h2>Cantidad:</h2>
                   <input type="number" class="input-text-cant" name="cantidad" value="1" id="cant" min="1">
                </div>
                
                <div class="compraBoton">
                    <input class="botonN" type="submit" value="Agregar al carrito" onclick="return validarCompra();"><br>
                    
                </div>
            </form>
            
        </main>
    </div>

    <footer class="footer">
        <p class="footer__texto">Footer</p>
    </footer>


</body>
</html>