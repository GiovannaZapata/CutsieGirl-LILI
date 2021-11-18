$(document).ready(updateCarrito())
var categorias = []

function updateCarrito() { //#carrito
    $.ajax({
        url: 'controllers/controller_getNumCart.php',
        success: function(value) {
            $('#carrito').empty()
            $('#carrito').append(" " + value)
        }
    })
}

function verCarrito() {
    //bodyCarrito
    $.ajax({
        url: 'controllers/controller_getCart.php',
        success: function(res) {
            $('#bodyCarrito').empty()
            $('#bodyCarrito').append(res)
        }
    })
}

function finCompra(num) {

    if (num == '0') {
        swal({
            icon: 'error',
            text: '¡Debes iniciar sesión para poder realizar la compra!',
            buttons: false,
            timer: 3000
        })
        return
    }

    $.ajax({
            url: 'controllers/controller_getNumCart.php',
            success: function(value) {
                if (value == 0) {
                    swal({
                        icon: 'error',
                        text: '¡Debes agregar algo al carrito!',
                        buttons: false,
                        timer: 2000
                    })
                    return
                } else {
                    location.assign('index.php?mod=fincompra')
                }
            }
        })
        /*
        
        
         */
}

function getCartFinal() {
    $.ajax({
        url: 'controllers/controller_finCompra.php',
        success: function(data) {
            $('#productosCarritoFinal').append(data)
            //Esto es para que agregue lo del controlador finCompra al div de fincompra.php.
            //En controller_finCompra.php va todo el diseño relacionado con el carrito, que es lo que se va a comprar
        }
    })
}

function addToCart(nombre, cantidad, precio, imagen, idCategoria, idInventario, i) {
    $.ajax({
        type: 'POST',
        data: {
            nombre: nombre,
            cantidad: cantidad,
            precio: precio,
            imagen: imagen,
            idCategoria: idCategoria,
            idInventario: idInventario
        },
        url: 'controllers/controller_addToCart.php',
        success: function(res) {
            updateCarrito()
            swal({
                icon: 'success',
                text: '¡Agregado al carrito!',
                buttons: false,
                timer: 2000
            })
            $('#modalVistaPrevia' + i).modal('hide')
        }
    })
}

function dropCart(idCarrito) {
    updateCarrito()
    $.ajax({
        type: 'POST',
        data: {
            idCarrito: idCarrito
        },
        url: 'controllers/controller_deleteCart.php',
        success: function() {
            verCarrito()
            updateCarrito()
            swal({
                icon: 'success',
                text: 'Eliminado del carrito!',
                buttons: false,
                timer: 2000
            })
        }
    })
}

function deleteAllCart() {
    updateCarrito()
    $.ajax({
        url: 'controllers/controller_deleteAllCart.php',
        success: function() {
            verCarrito()
        }
    })
}

function verNota(nombre, idUsuario) {
    cupon = $('#cupon').val()
    $.ajax({
        type: 'POST',
        data: {
            descripcion: cupon
        },
        url: 'controllers/controller_getCupon.php',
        success: function(cup){
            verNota2(nombre, idUsuario, cup, cupon)
        }
    })
    
}

function verNota2(nombre, idUsuario, cupon, descripcion) {
    envio = $('#envio').val()
    iva = $('#iva').val()
    subtotal = $('#subtotal').val()
    total = parseFloat((-1)*(cupon/100)*subtotal) + parseFloat(iva) + parseFloat(subtotal) + parseFloat(envio)

    $.ajax({
        type: 'POST',
        data: {
            total: total,
            idUsuario: idUsuario,
            descripcion: descripcion
        },
        url: 'controllers/controller_addNota.php',
        success: function(idNota) {
            verNota3(nombre, idNota, cupon)
        }
    })
    
}

function verNota3(nombre, idNota, cupon) {

    $.ajax({
        type: 'POST',
        data: {
            idNota: idNota
        },
        url: 'controllers/controller_registroVenta.php',
        success: function() {
        }
    })

    envio = $('#envio').val()
    iva = $('#iva').val()
    subtotal = $('#subtotal').val()
    direccion = $('#direccionVta').val()
    direccion = direccion.replace('#','_')
    modo = $('input:radio[name=type]:checked').val() == 'oxxo'? "OXXO" : "TARJETA DE CREDITO"

    swal({
        icon: 'success',
        title: 'COMPRA EXITOSA',
        text: '¡Revisa tu correo electrónico!',
        timer: 3000
    })
    //IMPORTANTE
    var datos = 'nombre='+nombre+'&envio='+envio+'&direccion='+direccion+'&modo='+modo+'&idNota='+idNota+
    '&cp='+cp+'&iva='+iva+'&cupon='+cupon+'&subtotal='+subtotal
    setTimeout(function(){
                    window.open('pdf/nota.php?'+datos,'_blank')
                }, 3000)

    setTimeout(function() {
        deleteAllCart()
        setTimeout(function() {
            location.assign('index.php')
        },1000)
    },6000)
}