$(document).ready(function () {
    function searchData(param) {
        $.ajax({
            url: "../controller/search.php",
            type: "post",
            data: {
                param1: param
            },
            success: function (response) {
                $("#container_gymss").html(response);
            }
        });
    }

    $(document).on("keyup", "#toSearch", function () {
        let valor = $(this).val();
        searchData(valor);
    });
});
