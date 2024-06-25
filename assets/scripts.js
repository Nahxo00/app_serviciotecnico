$(document).ready(function () {
    let clientes = [];
    let items = {
        id: 0
    }

    // clientes
    $('#abrirClientes').click(function () {
        console.log('Se hizo clic en el botón "Nuevo Cliente"');
        $('#clientes').modal('show');
    });

    $('.eliminar').click(function (e) {
        e.preventDefault();
        if (confirm('¿Está seguro de eliminar?')) {
            this.submit();
        }
    });
});