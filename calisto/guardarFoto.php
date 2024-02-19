<?php
session_start();
include_once "conexion.php";
$db=conectarDB();

  $clte_id=$_SESSION['id'];

  $consulta="SELECT * FROM clientes WHERE id='$clte_id'";
   $result=mysqli_query($db,$consulta);
   $usuario=mysqli_fetch_assoc($result);

    $foto=$usuario['foto_de_perfil'];

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $foto = $_FILES["foto_de_perfil"];

  $carpetaImagen="imagenes/fotosPerfil/";
    if(!is_dir($carpetaImagen)){
        mkdir($carpetaImagen);
    }

    $nombreImagen='';
    
    if($foto['name']){
        unlink($carpetaImagen.$usuario['foto_de_perfil']);
        $nombreImagen=md5(uniqid(rand(),true)).".jpg";
        move_uploaded_file($foto['tmp_name'],$carpetaImagen.$nombreImagen);
    }else{
        $nombreImagen=$usuario['foto_de_perfil'];
    }

  $query = "UPDATE clientes SET foto_de_perfil = '$nombreImagen' WHERE id = '$clte_id'";

  $resultado=mysqli_query($db,$query);

  if($resultado){
    header('Location: /calistoshop/infoUsuario.php');
   }
}

?>
