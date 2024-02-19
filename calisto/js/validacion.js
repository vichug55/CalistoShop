// Validar Empleado
function validarEmpleado() {
    if (document.fvalida.nombre.value == "") {
        alert("Tiene que escribir su nombre");
        document.fvalida.nombre.focus()
        return false;
    }

    if (document.fvalida.apellidoPaterno.value == "") {
        alert("Tiene que escribir su apellido paterno");
        document.fvalida.apellidoPaterno.focus()
        return false;
    }
    if (document.fvalida.apellidoMaterno.value == "") {
        alert("Tiene que escribir su apellido materno");
        document.fvalida.apellidoMaterno.focus()
        return false;
    }
    if (document.fvalida.celular.value == "") {
        alert("Tiene que escribir su celular");
        document.fvalida.celular.focus()
        return false;
    }


    if (document.fvalida.email.value == "") {
        alert("Tiene que escribir su correo");
        document.fvalida.email.focus()
        return false;
    }

    if (document.fvalida.calle.value == "") {
        alert("Tiene que escribir su calle");
        document.fvalida.calle.focus()
        return false;
    }

    if (document.fvalida.col.value == "") {
        alert("Tiene que escribir su colonia");
        document.fvalida.col.focus()
        return false;
    }

    if (document.fvalida.cp.value == "") {
        alert("Tiene que escribir su codigo postal");
        document.fvalida.cp.focus()
        return false;
    }

    if (document.fvalida.comision.value == "") {
        alert("Tiene que escribir su comision");
        document.fvalida.comision.focus()
        return false;
    }

    if (document.fvalida.puesto.value == "") {
        alert("Tiene que escribir su puesto");
        document.fvalida.puesto.focus()
        return false;
    }

    return true

}

//validacion usuario
function valida_envia() {
    if (document.fvalida.nombre.value == "") {
        alert("Tiene que escribir su nombre")
        document.fvalida.nombre.focus()
        return false;

    } if (document.fvalida.apellido_paterno.value == "") {
        alert("Tiene que escribir su apellido")
        document.fvalida.apellido_paterno.focus()
        return false;
    } if (document.fvalida.correo.value == "") {
        alert("Tiene que introducir un correo")
        document.fvalida.correo.focus()
        return false;
    } if (document.fvalida.contraseña.value == "") {
        alert("Tiene que introducir una contraseña")
        document.fvalida.contraseña.focus()
        return false;
    } if (document.fvalida.contra2R.value == "") {
        alert("Tiene que introducir la confirmacion")
        document.fvalida.contra2R.focus()
        return false;
    } if (document.fvalida.contraseña.value != document.fvalida.contra2R.value) {
        alert("La contraseña no es la misma")
        document.fvalida.contraseña.focus()
        return false;
    } if (document.fvalida.celular.value == "") {
        alert("Tiene que introducir un celular")
        document.fvalida.celular.focus()
        return false;
    }

    return true

}

// Validar Direccion
function validarDireccion() {
    if (document.fvalida.calle.value == "") {
        alert("Tiene que escribir su calle");
        document.fvalida.nombre.focus()
        return false;
    }

    if (document.fvalida.col.value == "") {
        alert("Tiene que escribir su colonia");
        document.fvalida.col.focus()
        return false;
    }
    if (document.fvalida.ciudad.value == "") {
        alert("Tiene que escribir su ciudad");
        document.fvalida.ciudad.focus()
        return false;
    }

    if (document.fvalida.cp.value == "") {
        alert("Tiene que escribir su codigo postal");
        document.fvalida.cp.focus()
        return false;
    }

    return true

}

//Validar Estado Precio
function validarEstadoPrecio() {
    if (document.fvalida.fechaInicio.value == "") {
        alert("Tiene que escribir la Fecha de Inicio del precio");
        document.fvalida.fechaInicio.focus();
        return false;
    }

    if (document.fvalida.precio.value == "") {
        alert("Tiene que escribir la cantidad del nuevo precio");
        document.fvalida.fechaFin.focus();
        return false;
    }

    if (document.fvalida.precio.value <= 0) {
        alert("El nuevo precio debe ser mayor a 0");
        document.fvalida.fechaFin.focus();
        return false;
    }

    return true;
}

//Procesos.....

function validarProceso() {
    if (document.fvalida.idProceso.value == "") {
        alert("Tiene que escribir el id del proceso");
        document.fvalida.idProceso.focus();
        return false;
    }

    if (document.fvalida.nombreProceso.value == "") {
        alert("Tiene que escribir el nombre del proceso");
        document.fvalida.nombreProceso.focus();
        return false;
    }

    if (document.fvalida.precioProceso.value == "") {
        alert("Tiene que escribir el precio del proceso");
        document.fvalida.precioProceso.focus();
        return false;
    }

    return true

}

//Validar pedido
function validarPedido(){
    if (document.fvalida.fecha.value == "") {
        alert("Tiene que colocar la fecha");
        document.fvalida.fecha.focus()
        return false;
    }
    if (document.fvalida.cobro.value == "") {
        alert("Tiene que colocar el monto total");
        document.fvalida.cobro.focus()
        return false;
    }

    if (document.fvalida.numProductos.value == "") {
        alert("Tiene que agregar el número de productos");
        document.fvalida.numProductos.focus()
        return false;
    }

    return true
}
//Validar materia prima
function validarMateria(){
    if (document.fvalida.nombreProveedor.value == "") {
        alert("Debe colocar el nombre del proveedor");
        document.fvalida.nombreProveedor.focus()
        return false;
    }
    if (document.fvalida.nombreMaterial.value == "") {
        alert("Debe colocar el nombre del material");
        document.fvalida.nombreMaterial.focus()
        return false;
    }

    if (document.fvalida.existencia.value == "") {
        alert("Coloque el número de existencias");
        document.fvalida.existencia.focus()
        return false;
    }

    if (document.fvalida.unidadMedida.value == "") {
        alert("Coloque la unidad de medida");
        document.fvalida.unidadMedida.focus()
        return false;
    }

    return true
}

function validarCompra(){
    if (document.fvalida.colorAnt.value == "") {
        alert("Debes seleccionar un color");
        document.getElementById("col").focus()
        return false;
    }
    if (document.fvalida.tallaAnt.value == "") {
        alert("Debe seleccionar una talla");
        document.getElementById("tax").focus()
        return false;
    }
    return true
}

function validarMaterial(){
    if (document.fvalida.articulo.value == "") {
        alert("Debes introducir un articulo");
        document.fvalida.articulo.focus()
        return false;
    }
    if (document.fvalida.materiaPrima.value == "") {
        alert("Debes introducir la materia prima");
        document.fvalida.materiaPrima.focus()
        return false;
    }
    if (document.fvalida.materialUtilizado.value == "") {
        alert("Debe indicar la cantidad del material a utilizar");
        document.fvalida.materialUtilizado.focus()
        return false;
    }
    return true
}

function validarArticulo(){
    if (document.fvalida.id.value == "") {
        alert("Debes introducir un id");
        document.fvalida.id.focus()
        return false;
    }
    if (document.fvalida.nombre.value == "") {
        alert("Debes introducir el nombre del producto");
        document.fvalida.nombre.focus()
        return false;
    }
    if (document.fvalida.descripcion.value == "") {
        alert("Indica una breve descripcion del producto");
        document.fvalida.descripcion.focus()
        return false;
    }
    if (document.fvalida.tipo.value == "") {
        alert("¿Que tipo de producto es?");
        document.fvalida.tipo.focus()
        return false;
    }
    if (document.fvalida.existencias.value == "") {
        alert("Debe indicar las existencias del producto");
        document.fvalida.existencias.focus()
        return false;
    }
    if (document.fvalida.imagen.value == "") {
        alert("Debe seleccionar una imagen");
        document.fvalida.imagen.focus()
        return false;
    }
    if (document.fvalida.precio.value == "") {
        alert("Debe indicar el precio del producto");
        document.fvalida.precio.focus()
        return false;
    }
    return true
}

function confirmacionEliminar(){
    const response = confirm ("¿Estas seguro que deseas realizar los cambios?");
    if(response)
    {
        return true;
    }
    else
    {
        return true;
    }
}
