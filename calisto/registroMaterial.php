<?php
  session_start();
  require 'conexion.php';
  $db=conectarDB();

  if(isset($_SESSION['login'])) {
    // El cliente ha iniciado sesión
    $auth = $_SESSION['login'];
    } else {
        // El cliente no ha iniciado sesión
        $auth = null;
    }

    if(isset($_SESSION['usuario'])) {
        $correo = $_SESSION['usuario'];
        $query="SELECT * FROM empleados WHERE correo='$correo'";
    $resultado=mysqli_query($db,$query);

    $empeleado=mysqli_fetch_assoc($resultado);

    $foto_de_perfil=$empeleado['foto_de_perfil'];
    $empeleadoId=$empeleado['id'];

    $queryPedido="INSERT INTO pedidos (epo_id) 
    VALUES ('$empeleadoId');";

    $resultadoPedido=mysqli_query($db,$queryPedido);

    $id_pedido = mysqli_insert_id($db);

    //var_dump($id_pedido);
    
    } else {
        $correo = null;
    }

    if(isset($_SESSION['id'])) {
        $clte_id = $_SESSION['id'];
    } else {
        $clte_id = null;
    }

    if(!$auth){
    header('Location: /calistoshop/login.php');
    }

    

  if($_SERVER['REQUEST_METHOD']==='POST'){

    $nombre_de_proveedor=$_POST['nombreProveedor'];
    $nombre=$_POST['nombreMaterial'];
    $color=$_POST['color'];
    $talla=$_POST['talla'];
    $unidad_de_medida=$_POST['unidadMedida'];
    $precio=$_POST['precio'];
    $cantidad=$_POST['cantidad'];

    $query="INSERT INTO mta_primas (nombre_de_proveedor, tipo_de_mta_prima, color,talla, unidad_de_medida,precio) 
    VALUES ('$nombre_de_proveedor','$nombre','$color','$talla','$unidad_de_medida','$precio');";

    //var_dump($query);
    $resultado=mysqli_query($db,$query);

    $id_materia_prima = mysqli_insert_id($db);

    $queryProPedido="INSERT INTO pro_pedidos (numero_de_pro, pdo_id, mta_prima_id) 
    VALUES ('$cantidad','$id_pedido','$id_materia_prima');";

    $resultadoProPedido=mysqli_query($db,$queryProPedido);
    //var_dump($queryProPedido);
    /*if($resultado){
        header('Location: /calistoshop/adminPage.php');
    }*/


  }
?>