function contacto() {
    var nombre = $('#InputNombre').val()
    var email = $('#InputEmail').val()
    var telefono = $('#InputTelefono').val()
    var mensaje = $('#InputMensaje').val()

    //validación nombre
    if (nombre == null || nombre.length == 0 || /^\s+$/.test(nombre)) {
        swal({
            icon: 'warning',
            text: '¡Ingrese su nombre!',
            buttons: false,
            timer: 2000
        })
        $('#InputNombre').focus()
        return
    }

    //validación de email
    if (email == null || email.length == 0 || !(/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w/.test(email))) {
        //alert("¡Ingrese una dirección de correo válida!")
        swal({
            icon: 'warning',
            text: '¡Ingrese un correo electrónico válido!',
            buttons: false,
            timer: 2000
        })
        $('#InputEmail').focus()
        return
    }

    //validación telefono
    if (telefono == null || telefono.length == 0 || isNaN(telefono)) {
        swal({
            icon: 'warning',
            text: '¡Ingrese su teléfono!',
            buttons: false,
            timer: 2000
        })
        $('#InputTelefono').focus()
        return
    }

    //validación mensaje    
    if (mensaje == null || mensaje.length == 0 || /^\s+$/.test(mensaje)) {
        swal({
            icon: 'warning',
            text: '¡Ingrese un mensaje!',
            buttons: false,
            timer: 2000
        })
        $('#InputMensaje').focus()
        return
    }
}
