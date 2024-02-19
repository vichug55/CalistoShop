<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos/styles.css">
    <script src="js/validacion.js"></script>
    <link rel="shortcut icon" href="imagenes/logo.png">
    <title>Registro</title>
</head>

<body>

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
 
    <h3>Registra tu dirección</h3>
    <form class="formulario--direccion" method="GET" name="fvalida" action="direcciones.php" onsubmit="return validarDireccion()">
        <fieldset>
            <div class="contenedor-campos--direccion">
                <div class="campo-direccion">
                    <label><span>*</span>Calle y numero</label>
                    <input class="input-text" type="text" name="calle">
                </div>

                <div class="campo-direccion">
                    <label><span>*</span>Colonia</label>
                    <input class="input-text" type="text" placeholder="" name="col" >
                </div>

                <div class="campo-direccion">
                    <label><span></span>N. Interior</label>
                    <input class="input-text" type="number" name="numeroI" pattern="[0-9]" title="Ingresa un numero valido" min="0">
                </div>

                <div class="campo-direccion">
                    <label><span>*</span>Ciudad</label>
                    <input class="input-text" type="text" name="ciudad">
                </div>

                <div class="campo-direccion">
                    <label><span>*</span>Codigo Postal</label>
                    <input class="input-text" type="tel" name="cp" >
                </div>

                <div class="campo-direccion">
                    <label><span></span>Alias</label>
                    <input class="input-text" type="text" name="alias">
                </div>

            </div>

            <div class="alinear-derecha flex">
                <input class="boton" type="submit" value="Agregar dirección" >
            </div>

        </fieldset>

    </form>


    <footer id="footer" class="footer">
        <p class="footer__texto">Footer</p>
    </footer>
    <script src="js/scroll.js?1.0"></script>
</body>

</html>