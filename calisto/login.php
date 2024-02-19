<?php

    require 'conexion.php';
    $db=conectarDB();

    $errores=[];

    if($_SERVER['REQUEST_METHOD']==='POST'){
        $correo=mysqli_real_escape_string($db,filter_var($_POST['correo'],FILTER_VALIDATE_EMAIL));
        $contraseña=mysqli_real_escape_string($db,$_POST['contraseña']);


    if(empty($errores)){
        //revisar que exista el cliente
        $query="SELECT * FROM usuarios WHERE correo='$correo'";
        $resultado=mysqli_query($db,$query);

        $query2="SELECT * FROM usuarios WHERE correo='$correo'";
        $resultado2=mysqli_query($db,$query2);

        $query3="SELECT * FROM clientes WHERE correo='$correo'";
        $resultado3=mysqli_query($db,$query3);


        if($resultado->num_rows){

            //verificar si la contraseña es correcta
            $usuario=mysqli_fetch_assoc($resultado);
            $rol=mysqli_fetch_assoc($resultado2);
            $cliente=mysqli_fetch_assoc($resultado3);
            $auth=password_verify($contraseña,$usuario['contraseña']);

            if($auth){
                //Autenticado
                session_start();
                $_SESSION['usuario']=$usuario['correo'];
                $_SESSION['rol']=$rol['tipo'];
                $_SESSION['login']=true;
                $_SESSION['id']=$cliente['id'];

                if($_SESSION['rol']=='C'){
                    header('Location: /calistoshop/index.php');
                }else if($_SESSION['rol']=='A'){
                    header('Location: /calistoshop/adminPage.php');
                }else if($_SESSION['rol']=='E'){
                    header('Location: /calistoshop/empleadoPage.php');
                }

                
            }else{
                $errores[]="La contraseña es incorrecta";
            }

        }else{
            $errores[]="El usuario no existe";
        }
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
    <link rel="shortcut icon" href="imagenes/logo.png">
    <script src="js/code.js"></script>
    <title>Inicio de Sesión</title>
</head>
<body class="loginB">
    <div class="logo-login">
        <img src="imagenes/logo-removebg-preview.png">
    </div>
    <form class="formulario" name="fvalida" method="POST" onsubmit=" setTimeout(function() { return valida_envia();}, 2500);">
        <fieldset>

            <div class="contenedor-campos">
                <div class="campo-login">
                    <label>Correo</label>
                    <input class="input-text" type="email" placeholder="tuCorreo@example.com" name="correo">
                </div>

                <div class="campo-login">
                    <label>Contraseña</label>
                    <div class="contains">
                    <input class="input-text" type="password" id="input" name="contraseña" pattern="[A-Za-z\d$@$!%*?&]{8,15}" placeholder="Contraseña" title="La contraseña debe tener de 8 a 15 caracteres, mayusculas, minusculas y un caracter">
                    <svg id="eye" class="icon" onclick="mostrar_contra()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
                    </div>
                </div>

            </div> <!-- .contenedor-campos -->

            <div class="alinear-derecha flex">
                <button class="selectnone w-sm-100" type="submit" >
        <span class="spa">Iniciar Sesión</span>
        <svg class="bb" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
        <path d="M0 11c2.761.575 6.312 1.688 9 3.438 3.157-4.23 8.828-8.187 15-11.438-5.861 5.775-10.711 12.328-14 18.917-2.651-3.766-5.547-7.271-10-10.917z"/>
        </svg>
    </button>
            </div>

            <div class="alinear-derecha flex">
                <label class="redL">Olvide mi contraseña</label>
            </div>

            
        </fieldset>
    </form>

    

    <div class="alinear-derecha flex">
        <label class="redL">¿No tienes cuenta?</label>
    </div>

    <div class="alinear-derecha flex">
        <a class="botonS" href="registrarUsuario.php">Crear cuenta</a>
    </div>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
</body>

<script>
    function valida_envia(){
        if(document.fvalida.correo.value==""){
            alert("Tiene que introducir un correo")
            document.fvalida.correo.focus()
            return false;
        }if(document.fvalida.contraseña.value==""){
            alert("Tiene que introducir una contraseña")
            document.fvalida.contraseña.focus()
            return false;
        }
        return true;
    }
</script>


</html>