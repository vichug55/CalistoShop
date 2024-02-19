<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Utilizado</title>
    <link rel="stylesheet" href="estilos/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos/styles.css">
    <script src="js/validacion.js?1.0"></script>
    <link rel="shortcut icon" href="imagenes/logo.png">
</head>
<!--
   Material Utilizado
-->

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
 
    

    <form class="formulario--materialUtilizado" method="GET" name="fvalida" action="infoMaterialUtilizado.php" onsubmit="return validarMaterial()">
        <fieldset>
            <div class="contenedor-campos--materialUtilizado">

                <div class="campo-materialUtilizado">
                    <label><span>*</span>Articulo</label>
                    <input class="input-text" type="text" name="articulo">
                </div>

                <div class="campo-materialUtilizado">
                    <label><span>*</span>Materia Prima</label>
                    <input class="input-text" type="text" name="materiaPrima">
                </div>

                
                <div class="campo-materialUtilizado">
                    <label><span>*</span>Cantidad de Material Utilizado</label>
                    <input class="input-text" type="number" name="materialUtilizado" min="0">
                </div>



            </div>

            <div class="alinear-derecha flex">
                <input class="boton" type="submit" value="Agregar Registro" >
            </div>

        </fieldset>
    </form>

    <footer id="footer" class="footer">
        <p class="footer__texto">Footer</p>
    </footer>
    <script src="js/scroll.js?1.0"></script>
</body>

</html>