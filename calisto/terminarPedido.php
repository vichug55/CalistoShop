<?php
  session_start();

  // Reiniciar la variable de sesión 'id_pedido'
  $_SESSION['id_pedido'] = null;

  // Redirigir al usuario a la página 'adminPage.php'
  header('Location: /calistoshop/adminPage.php');
?>
