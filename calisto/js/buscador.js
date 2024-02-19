document.addEventListener('keyup',e=>{
    if(e.target.matches('#buscador')){
        document.querySelectorAll('.producto').forEach(producto=>{
            producto.textContent.toLowerCase().includes(e.target.value)
            ? producto.classList.remove('filtro')
            :producto.classList.add('filtro');
        })
    }
})

document.addEventListener('keyup',e=>{
    if(e.target.matches('#buscador')){
        document.querySelectorAll('.filas').forEach(producto=>{
            producto.textContent.toLowerCase().includes(e.target.value)
            ? producto.classList.remove('filtro')
            :producto.classList.add('filtro');
        })
    }
})

/*function cambiarImagen() {
    // Obtener el elemento select
    const opcionesColor = document.getElementById("opcionesColor");
    // Obtener el valor seleccionado
    const valorSeleccionado = opcionesColor.value;
    // Obtener la imagen del producto
    const imagenProducto = document.getElementById("imagenProducto");
    // Cambiar la imagen del producto según el valor seleccionado
    if (valorSeleccionado === "rojo") {
      imagenProducto.src = "<?php echo $colores['imagen']; ?>";
    } else if (valorSeleccionado === "azul") {
      imagenProducto.src = "<?php echo $colores['imagen']; ?>";
    } else if (valorSeleccionado === "verde") {
      imagenProducto.src = "<?php echo $colores['imagen_verde']; ?>";
    } else {
      // Si no hay una imagen para el color seleccionado, se muestra la imagen original del producto
      imagenProducto.src = "<?php echo $articulo['imagen']; ?>";
    }
  }*/