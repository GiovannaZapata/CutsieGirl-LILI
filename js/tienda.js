$(document).ready(function () {
    getProveedores()
    getCategorias()
})

function addArticulo(cat, admin) {
    var nombre = $('#nombreArticulo').val()         //A
    var marca = $('#marca').val()                   //A
    var proveedor = $('#idProveedor').val()         //A
    var categoria = $('#idCategoria').val()         //A
    var descripcion = $('#descripcion').val()       //A
    var existencia = $('#existencia').val()         //I
    var talla = $('#talla option:selected').val()   //I
    var precio = $('#precio').val()                 //I
    var imagen = $('#image').val()                  //I
    var color = $('#color').val()                   //I
    
    //validación nombre
    if (nombre == null || nombre.length == 0 || /^\s+$/.test(nombre)) {
        swal({
            icon: 'warning',
            text: '¡Ingresa nombre de artículo!',
            buttons: false,
            timer: 2000
        })
        $('#nombreArticulo').focus()
        return
    }

    //validación marca  
    if (marca == null || marca.length == 0 || /^\s+$/.test(marca)) {
        swal({
            icon: 'warning',
            text: '¡Ingresa una marca!',
            buttons: false,
            timer: 2000
        })
        $('#marca').focus()
        return
    }

    //validación proveedores
    if (proveedor == null || proveedor.length == 0 || /^\s+$/.test(proveedor)) {
        swal({
            icon: 'warning',
            text: '¡Ingresa un proveedor!',
            buttons: false,
            timer: 2000
        })
        return
    }

    //validación categoría
    if (categoria == null || categoria.length == 0 || /^\s+$/.test(categoria)) {
        swal({
            icon: 'warning',
            text: '¡Ingresa una categoría!',
            buttons: false,
            timer: 2000
        })
        return
    }

     //validación descripción    
     if (descripcion == null || descripcion.length == 0 || /^\s+$/.test(descripcion)) {
        swal({
            icon: 'warning',
            text: '¡Ingresa una descripción!',
            buttons: false,
            timer: 2000
        })
        $('#descripcion').focus()
        return
    }

    //validación existencia
    if(existencia.length == null || existencia.length == 0 || isNaN(existencia)) {
        swal({
            icon: 'warning',
            text: '¡Ingresa la existencia!',
            buttons: false,
            timer: 2000
        })
        $('#existencia').focus()
        return
    }

    //validación precio
    if(precio.length == null || precio.length == 0 || isNaN(precio)) {
        swal({
            icon: 'warning',
            text: '¡Ingresa el precio!',
            buttons: false,
            timer: 2000
        })
        $('#precio').focus()
        return
    }

    //validación color
    if (color == null || color.length == 0 || /^\s+$/.test(color)) {
        swal({
            icon: 'warning',
            text: '¡Ingresa un color de prenda!',
            buttons: false,
            timer: 2000
        })
        $('#color').focus()
        return
    }

    //validar imagen
    if(imagen == '') {
        swal({
            icon: 'warning',
            text: '¡Ingresa una imagen!',
            buttons: false,
            timer: 2000
        })
        $('#image').focus()
        return
    }
    //fin validar  

    //Carga Imagen
    var formData = new FormData();
    var files = $('#image')[0].files[0];
    formData.append('file', files);
    $.ajax({
        url: 'php/uploadImage.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (ruta) {
            if (ruta == 0) {
                swal({
                    icon: 'error',
                    text: '¡Formato de imagen incorrecto!',
                    buttons: false,
                    timer: 2000
                })
                return
            }
            //Envío de datos
            $.ajax({
                type: 'POST',
                data: {
                    nombre: nombre,
                    marca: marca,
                    idProveedor: parseInt($('#idProveedor').attr('data-idproveedor')),
                    idCategoria: parseInt($('#idCategoria').attr('data-idcategoria')),
                    descripcion: descripcion,
                    existencia: existencia,
                    talla: talla,
                    precio: precio,
                    imagen: ruta,
                    color: color
                },
                url: "controllers/controller_addArticulo.php",
                success: function (result) {
                    getArticulo(cat, admin)
                    verGrafica()
                }
            })
            //Mensaje de éxito
            $('#modalAddArticulo').modal('hide')
            swal({
                icon: 'success',
                text: '¡Artículo añadido con éxito!',
                buttons: false,
                timer: 2000
            })
        }
    })
}

function getArticulo(cat, admin) {

    $.ajax({
        type: 'POST',
        data: {
            categoria: cat,
            admin: admin
        },
        url: "controllers/controller_getArticulo.php",
        success: function (result) {
            $('#patas1').empty()
            $('#patas1').append(result)
        }
    })
    
}

function getProveedores() {
    $.ajax({
        url: "controllers/controller_getProveedores.php",
        success: function (result) {
            $('#listProveedores').append(result)
        }
    })
}

function getCategorias() {
    $.ajax({
        url: "controllers/controller_getCategoria.php",
        success: function (result) {
            $('#listaCategorias').append(result)
        }
    })
}

function cambioCategoria(elemento) {
    $('#idCategoria').val($(elemento).text())
    $('#idCategoria').attr('data-idcategoria', $(elemento).data('idcategoria'))
}

function cambioProveedor(elemento) {
    $('#idProveedor').val($(elemento).text())
    $('#idProveedor').attr('data-idproveedor', $(elemento).data('idproveedor'))
}

function deleteArticulo(idArticulo, idInventario, cat, admin) {
    swal({
        title: "¿Desea eliminar esta prenda?",
        text: "Una vez eliminada, no se podrá recuperar",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: 'POST',
                data: {
                    idArticulo: idArticulo,
                    idInventario: idInventario
                },
                url: 'controllers/controller_deleteArticulo.php',
                success: function(res) {
                    getArticulo(cat, admin)
                    swal({
                        icon: 'success',
                        text: '¡Eliminado con éxito!',
                        buttons: false,
                        timer: 2000
                    })
                }
            })
        }
    })
}
function validaCantidad(elemento,cantidad, existencia){
    
    if(existencia == 0) {
        swal({
            icon: 'info',
            text: '¡No quedan productos disponibles!',
            buttons: false,
            timer: 2000
        })
        $(elemento).val('0')
        return
    }
    if(isNaN(cantidad) || cantidad == ''){
        swal({
            icon: 'warning',
            text: '¡Debes elegir una cantidad valida!',
            buttons: false,
            timer: 2000
        })
        $(elemento).val('1')
        return
    }
    if(existencia<cantidad){
        swal({
            icon: 'warning',
            text: '¡No hay más prendas!',
            buttons: false,
            timer: 2000
        })
        $(elemento).val(existencia)
        return
    }
    if(cantidad<1){
        swal({
            icon: 'warning',
            text: '¡Debes elegir por lo menos una unidad!',
            buttons: false,
            timer: 2000
        })
        $(elemento).val('1')
        return
    }
        
}

function editArticulo(idArticulo, idInventario, cat, admin, i) {
    var nombre = $('#editarNombre' + i)
    var marca = $('#editarMarca' + i)
    var precio = $('#editarPrecio' + i)
    var existencia = $('#editarExistencia' + i)
    var descripcion = $('#editarDescripcion' + i)


    if(!validaTexto(nombre.val())) {
        swal({
            icon: 'error',
            text: '¡Ingresa un nombre válido!',
            buttons: false,
            timer: 2000
        })
        nombre.focus()
        return
    }

    if(!validaTexto(marca.val())) {
        swal({
            icon: 'error',
            text: '¡Ingresa una marca válida!',
            buttons: false,
            timer: 2000
        })
        marca.focus()
        return
    }

    if(!validaNumero(precio.val())) {
        swal({
            icon: 'error',
            text: '¡Ingresa un precio válido!',
            buttons: false,
            timer: 2000
        })
        precio.focus()
        return
    }

    if(!validaNumero(existencia.val())) {
        swal({
            icon: 'error',
            text: '¡Ingresa una existencia válida!',
            buttons: false,
            timer: 2000
        })
        existencia.focus()
        return
    }

    if(!validaTexto(descripcion.val())) {
        swal({
            icon: 'error',
            text: '¡Ingresa una descripción!',
            buttons: false,
            timer: 2000
        })
        descripcion.focus()
        return
    }

    $.ajax({
        type: 'POST',
        data: {
            idArticulo: idArticulo,
            idInventario: idInventario,
            nombre: nombre.val(),
            marca: marca.val(),
            precio: precio.val(),
            existencia: existencia.val(),
            descripcion: descripcion.val()
        },
        url: 'controllers/controller_editArticulo.php',
        success: function(res) {
            $('#modalEditarArticulo'+i).modal('hide')
            setTimeout(function (){getArticulo(cat, admin)},2000)
            swal({
                icon: 'success',
                text: 'Editado con éxito!',
                buttons: false,
                timer: 2000
            })
        }
    })
}

function validaNumero(numero) {
    //alert(isNaN(numero) + " " + numero)
    if(isNaN(numero) || numero < 1)
        return false

    return true
}

function validaTexto(cadena) {
    if (cadena == null || cadena.length == 0 || /^\s+$/.test(cadena))
        return false

    return true
}