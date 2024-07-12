
function hola(event) {
    var texto = event.target.value;
    var param = {
        'entrenamientos': texto
    };
    $.ajax({
        data: param,
        url: '../functions/filter.php',
        datatype: 'html',
        method: 'get',
        success: function (data) {
            //console.log(data);
            document.getElementById('options').innerHTML = data;
        },
        error: function (xhr, status, error) {
            console.log(error);
        }
    });

}


