$(() => {
    console.log('object');
})

async function sendPassword(event){
    event.preventDefault();
    const url = base_url(['password/updated']);
    const data = {
        password_now:       $('#currentPassword').val(),
        password:           $('#newPassword').val(),
        password_confirm:   $('#confirmPassword').val()
    }
    $('#card-error').hide();
    $('#card-success').hide();

    $('#btn-send').attr('disabled', true);
    $('#btn-send').html('Enviando... <i class="ri-restart-line ri-spin"></i>');

    /*await proceso_fetch(url, data).then(respond =>{
        $('#btn-send').attr('disabled', false);
        $('#btn-send').html('Renovar contraseña');
        if(respond.status == 403){
            $('#card-error h5').html(respond.title);
            $('#card-error p').html(respond.message);
            $('#card-error').show();
        }else{
            $('#card-success h5').html(respond.title);
            $('#card-success p').html(respond.message);
            $('#card-success').show();
            $('#formAccountSettings')[0].reset();
        }
    })*/
    
    await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(respond => {

        $('#btn-send').attr('disabled', false);
        $('#btn-send').html('Renovar contraseña');

        if(respond.status == 403){
            $('#card-error h5').html(respond.title);
            $('#card-error p').html(respond.message);
            $('#card-error').show();
        }else{
            $('#card-success h5').html(respond.title);
            $('#card-success p').html(respond.message);
            $('#card-success').show();
            $('#formAccountSettings')[0].reset();
        }
    })
    .catch(error => {
        console.error(error);
        $('#btn-send').attr('disabled', false);
        $('#btn-send').html('Renovar contraseña');
    });

    return false;
}