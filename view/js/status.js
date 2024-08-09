$(document).ready(function () {
    $(document).on('click', '.btn-status', function () {
        const id = $(this).data("id-gym");

        $.ajax({
            url: "../../controller/handleStatus.php",
            data: {
                accion: "changeStatus",
                id: id
            },
            type: "post",
            success: function (response) {
                $(".btn-status[data-id-gym='" + id + "'] i").replaceWith(response);
            },
            error: function (xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    });
});