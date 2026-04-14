// CONTROLADOR AJAX 
$('#formularioAplicacion').on('submit', function(e) {
    e.preventDefault();

    let datosFormulario = {
        nombre: $('#nombre').val(),
        edad: $('#edad').val(),
        sueldo: $('#sueldo').val()
    };

    $.ajax({
        url: 'procesar.php',
        type: 'POST',
        data: datosFormulario,
        dataType: 'json',
        success: function(respuesta) {
            if (respuesta.status === true) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Aprobado!',
                    text: respuesta.mensaje,
                    confirmButtonText: 'Aceptar'
                });
                $('#formularioAplicacion')[0].reset();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'No Aprobado',
                    text: respuesta.mensaje,
                    confirmButtonText: 'Entendido'
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error de servidor',
                text: 'Ocurrió un problema al intentar procesar la solicitud con el servidor.'
            });
        }
    });
});
