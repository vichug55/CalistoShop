function cargarFotoEmpleado() {
    var input = document.createElement("input");
    input.type = "file";
    input.accept = "image/*";
    input.onchange = function(event) {
      var archivo = event.target.files[0];
      var lector = new FileReader();
      lector.readAsDataURL(archivo);
      lector.onload = function() {
        var imagen = document.getElementById("perfil");
        var foto = document.getElementById("foto");
        var icono = document.getElementById("icono");
        var urlImagen = lector.result;
  
        // Verificar si existe una foto de perfil
        if (foto) {
          foto.src = urlImagen;
          imagen.src = urlImagen;
        } else {
          // Si no existe, reemplazar el icono por la nueva foto
          var img = document.createElement("img");
          img.src = urlImagen;
          img.setAttribute("class", "profile-pic");
          icono.replaceWith(img);
          imagen.src = urlImagen;
          
        }
  
        guardarFotoEmpleado(archivo);
      }
    }
    input.click();
  }
  
    
    function guardarFotoEmpleado(archivo) {
      var formData = new FormData();
      formData.append("foto_de_perfil", archivo);
      var request = new XMLHttpRequest();
      request.open("POST", "guardarFotoEmpleado.php");
      request.send(formData);
    }