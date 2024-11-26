$(document).ready(function() {
    $.ajax({
        url: '../controllers/UsuarioController.php?op=perfil',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $('#nombre').val(response.data.Nombre);
                $('#primerApellido').val(response.data.PrimerApellido);
                $('#segundoApellido').val(response.data.SegundoApellido);
                $('#correo').val(response.data.Correo);
                $('#telefono').val(response.data.Telefono);
                $('#nombreUsuario').val(response.data.NombredeUsuario);
                $('#fechaCreacion').val(response.data.FechadeCreacion);
            } else {
                console.error('Error fetching user profile:', response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching user profile:', error);
        }
    });
});