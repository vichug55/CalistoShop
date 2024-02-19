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

    if(isset($_SESSION['rol'])) {
        // El cliente ha iniciado sesión
        $rol = $_SESSION['rol'];
    } else {
        // El cliente no ha iniciado sesión
        $rol = null;
    }

    if(isset($_SESSION['usuario'])) {
        $correo = $_SESSION['usuario'];
        $query="SELECT * FROM empleados WHERE correo='$correo'";
    $resultado=mysqli_query($db,$query);

    $empeleado=mysqli_fetch_assoc($resultado);

    $foto_de_perfil=$empeleado['foto_de_perfil'];
    } else {
        $correo = null;
    }

    if(isset($_SESSION['id'])) {
        $clte_id = $_SESSION['id'];
    } else {
        $clte_id = null;
    }

    if(!$auth || $rol!='A'){
    header('Location: /calistoshop/login.php');
    }

   $id=$_GET['id'];
   $id=filter_var($id,FILTER_VALIDATE_INT);

   if(!$id){
    header('Location: /calistoshop/listaArticulos.php');
   }
   $query0="SELECT * FROM colores WHERE ato_id='$id'";
   $resultado0=mysqli_query($db,$query0);

   $query1="SELECT * FROM tallas WHERE ato_id='$id'";
   $resultado1=mysqli_query($db,$query1);
  

  if($_SERVER['REQUEST_METHOD']==='POST'){

    
    $color=mysqli_escape_string($db,$_POST['color']);
    $talla=mysqli_escape_string($db,$_POST['talla']);

    if($color=="" and $talla==""){
        $query3="INSERT INTO inventario (ato_id) 
        VALUES ('$id');";
    }else{
        $query3="INSERT INTO inventario (col_id,tal_id,ato_id) 
        VALUES ('$color','$talla','$id');";
    }

    

    $resultado3=mysqli_query($db,$query3);
    

    if($resultado3){
        header('Location: /calistoshop/listaArticulos.php');
    }


  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articulo</title>
    <link rel="stylesheet" href="estilos/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="estilos/styles.css">
    <link rel="shortcut icon" href="imagenes/logo.png">
    <script src="js/validacion.js"></script>
</head>

<body>
    <header>
        <div class="logo">
          <a href="adminPage.php">
            <img src="imagenes/logo-removebg-preview.png" alt="Logo de la página">
          </a>
        </div>

        <div class="icons">
          <?php if($auth==null || $foto_de_perfil==null):?>
          <a href="infoAdministrador.php"><i class="fa fa-user"></i></a>
          <?php else:?>
          <a href="infoAdministrador.php">
            <img src="imagenes/fotosPerfil/<?php echo $empeleado['foto_de_perfil']; ?>" alt="Foto de perfil" class="profile-pic">
          </a>
          <?php endif;?>
        </div>
    </header>

    <nav>
		<ul class="menu-horizontal">
            <li>
				<a href="#">Empleados</a>
				<ul class="menu-vertical">
					<li><a href="registroEmpleado.php">Registro</a></li>
					<li><a href="listaEmpleados.php">Lista</a></li>
				</ul>
			</li>

			<li>
				<a href="#">Articulos</a>
				<ul class="menu-vertical">
					<li><a href="listaArticulos.php">Lista</a></li>
                    <li><a href="listaInventario.php">Inventario</a></li>
                    <li><a href="listaColores.php">Colores</a></li>
				</ul>
			</li>

			<li>
				<a href="#">Materia prima</a>
				<ul class="menu-vertical">
                    <li><a href="registroMateria.php">Pedido</a></li>
					<li><a href="listaMateria.php">Lista</a></li>
                    <li><a href="listaPedido.php">Lista pedido</a></li>
				</ul>
			</li>
			
             <li>
				<a href="#">Proceso</a>
				<ul class="menu-vertical">
					<li><a href="proceso.php">Registro</a></li>
                    <li><a href="listaProcesos.php">Lista</a></li>
				</ul>
			</li>

            <li>
				<a href="#">Categorias</a>
				<ul class="menu-vertical">
                    <li><a href="registroCategoria.php">Registro</a></li>
					<li><a href="listaCategorias.php">Lista</a></li>
					<li><a href="registroBanners.php">Banners</a></li>
                    <li><a href="listaBanners.php">Lista banners</a></li>
				</ul>
			</li>

		</ul>
	</nav>
 
    <h3>Registro combinacion</h3>
    

    <form class="formulario--colores" method="POST" name="fvalida" onsubmit="return validarInventario()">
        <fieldset>
            <div class="contenedor-campos--colores">

                <div class="campo-articulo">
                    <label><span></span>Color</label>
                    <select class="input-text" name="color">
                        <option disabled selected>--Selecciona color</option>
                        <?php while($col_id=mysqli_fetch_assoc($resultado0)):?>
                        <option style="background-color: <?php echo $col_id['color'];?>;" value="<?php echo $col_id['id'];?>"></option>    
                        <?php endwhile; ?>    
                    </select>
                </div>

                <div class="campo-articulo">
                    <label><span></span>Tallas</label>
                    <select class="input-text" name="talla">
                        <option disabled selected>--Selecciona talla</option>
                        <?php while($tal_id=mysqli_fetch_assoc($resultado1)):?>
                        <option value="<?php echo $tal_id['id'];?>"><?php echo $tal_id['talla'];?></option>    
                        <?php endwhile; ?>  
                    </select>
                </div>
               
            </div>

            <div class="alinear-derecha flex">
                <input class="boton" type="submit" value="Agregar combinación" >
            </div>

        </fieldset>
    </form>


    
    <footer id="footer" class="footer">
        <p class="footer__texto">Footer</p>
    </footer>
    <script src="js/scroll.js?1.0"></script>
    
</body>

</html>