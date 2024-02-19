<?php
session_start();
include_once "conexion.php";
$db=conectarDB();

  $emp_id=$_SESSION['usuario'];

  $consulta="SELECT * FROM empleados WHERE correo='$emp_id'";
   $result=mysqli_query($db,$consulta);
   $empleado=mysqli_fetch_assoc($result);

    $foto=$empleado['foto_de_perfil'];

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $foto = $_FILES["foto_de_perfil"];

  $carpetaImagen="imagenes/fotosPerfil/";
    if(!is_dir($carpetaImagen)){
        mkdir($carpetaImagen);
    }

    $nombreImagen='';
    
    if($foto['name']){
        unlink($carpetaImagen.$empleado['foto_de_perfil']);
        $nombreImagen=md5(uniqid(rand(),true)).".jpg";
        move_uploaded_file($foto['tmp_name'],$carpetaImagen.$nombreImagen);
    }else{
        $nombreImagen=$empleado['foto_de_perfil'];
    }

  $query = "UPDATE empleados SET foto_de_perfil = '$nombreImagen' WHERE correo = '$emp_id'";

  $resultado=mysqli_query($db,$query);

  if($resultado){
    header('Location: /calistoshop/infoUsuario.php');
   }
}

?>
