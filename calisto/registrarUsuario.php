<?php
  require 'conexion.php';
  $db=conectarDB();

  if($_SERVER['REQUEST_METHOD']==='POST'){

    $nombre=$_POST['nombre'];
    $apellido_paterno=$_POST['apellido_paterno'];
    $correo=$_POST['correo'];
    $contraseña=$_POST['contraseña'];
    $celular=$_POST['celular'];
    $tipo='C';

    $passwordHash=password_hash($contraseña,PASSWORD_BCRYPT);

    $query="INSERT INTO clientes (nombre, apellido_paterno, correo, contraseña, celular) 
    VALUES ('$nombre','$apellido_paterno','$correo','$passwordHash','$celular');";

    $resultado=mysqli_query($db,$query);

    $query2="INSERT INTO usuarios (nombre, correo, contraseña, tipo) 
    VALUES ('$nombre','$correo','$passwordHash','$tipo');";

    $resultado2=mysqli_query($db,$query2);

    /*$query3="INSERT INTO empleados(nombre, apellido_paterno, apellido_materno, celular, correo, contraseña,
    calle_y_numero, colonia, codigo_postal, ciudad, sueldo, puesto, epo_id)
    VALUES ('$nombre','$apellido_paterno','Gómez','$celular','$correo','$passwordHash','Av. Hidalgo 320','La Libertad','72130',
    'Puebla','30000','Administrador','1');";

    $resultado3=mysqli_query($db,$query3);*/

    if($resultado && $resultado2){
        header('Location: /calistoshop/login.php');
    }


  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos/styles.css">
    <script src="js/validacion.js?2.0"></script>
    <script src="js/code.js"></script>
    <link rel="shortcut icon" href="imagenes/logo.png">
    <title>Registro</title>
</head>
<body class="loginB">
    <form class="formulario" name="fvalida" action="registrarUsuario.php" method="POST" onsubmit="return valida_envia()">
        <fieldset>

            <div class="contenedor-campos--registro">
                <div class="campo">
                    <label><span>*</span>Nombre</label>
                    <input class="input-text" type="text" placeholder="Nombre" name="nombre" pattern="^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$">
                </div>

                <div class="campo">
                    <label><span>*</span>Apellido</label>
                    <input class="input-text" type="text" placeholder="Apellido" name="apellido_paterno" pattern="^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$">
                </div>

                <div class="campo">
                    <label><span>*</span>Correo</label>
                    <input class="input-text" type="email" placeholder="Correo" name="correo">
                </div>

                <div class="campo">
                    <label><span>*</span>Contraseña</label>
                    <div class="contains">
                    <input class="input-text" type="password" id="input" name="contraseña" pattern="[A-Za-z\d$@$!%*?&]{8,15}" placeholder="Contraseña" title="La contraseña debe tener de 8 a 15 caracteres, mayusculas, minusculas y un caracter">
                    <svg id="eye" class="icon" onclick="mostrar_contra()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
                    </div>
                </div>

                <div class="campo">
                    
                    <label><span>*</span>Confirmar contraseña</label>
                    <div class="contains">
                    <input class="input-text" type="password" id="input2" name="contra2R" pattern="[A-Za-z\d$@$!%*?&]{8,15}" placeholder="Contraseña" title="La contraseña debe tener de 8 a 15 caracteres, mayusculas, minusculas y un caracter">
                    <svg id="eye2" class="icon" onclick="mostrar_contra2()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
                    </div>
                </div>

                <div class="campo">
                    <label><span>*</span>Celular</label>
                    <input class="input-text" type="tel" name="celular" placeholder="2293765991" pattern="[0-9]{10}" title="El numero debe tener 10 digitos">
                </div>

            </div> <!-- .contenedor-campos -->

            <div class="alinear-derecha flex">
                <input class="boton" type="submit" value="Registrarse" >
            </div>
            
        </fieldset>
    </form>


    
</body>

</html>