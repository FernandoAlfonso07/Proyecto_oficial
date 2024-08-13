$(document).ready(function () {

    const id_r = $("#interaction").data("id-routine")
    const id_usu = $("#interaction").data("id-usu")

    $("#interaction").click(function () {
        $.ajax({
            url: "../controller/controller_interactions.php",
            type: "post",
            data: {
                accion: "like",
                id_routine: id_r,
                id_usu: id_usu
            },
            success: function (response) {
                $("#interaction i").replaceWith(response);
            },
            error: function (xhr, status, error) {
                console.log(error)
            }

        })
    })

})