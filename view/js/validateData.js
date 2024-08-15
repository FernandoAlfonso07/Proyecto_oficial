$(document).ready(function () {
    $("#nombres, #apellidos").on("keyup", function () {
        const $this = $(this);
        const fieldId = $this.attr('id');
        const fieldValue = $this.val().trim();
        const errorMessageId = `#${fieldId}-error-message`;

        $("#buttonValidate").prop("disabled", true);

        $.ajax({
            url: "../functions/validations/validateAllFields.php",
            type: "post",
            data: {
                dataValidate: fieldValue,
                fieldName: fieldId,
                typeValidation: "v string"
            },
            success: function (response) {
                if (response === "dataValidated") {
                    $this.removeClass("input-error");
                    $(errorMessageId).hide();
                    $("#buttonValidate").prop("disabled", false);
                } else if (response === "emptyData") {
                    $this.addClass("input-error");
                    $(errorMessageId).show().text("Este campo es obligatorio");
                    $("#buttonValidate").prop("disabled", true);
                } else if (response === "invalidCharacters") {
                    $this.addClass("input-error");
                    $(errorMessageId).show().text("Datos inválidos, solo se permiten letras y espacios");
                    $("#buttonValidate").prop("disabled", true);
                }
            }
        });
    });

    $("#telefono").on("keyup", function () {
        const phone = $("#telefono").val();
        $("#buttonValidate").prop("disabled", true);

        $.ajax({
            url: "../functions/validations/validateAllFields.php",
            type: "post",
            data: {
                dataValidate: phone,
                typeValidation: "v phone"
            },
            success: function (response) {
                if (response === "dataValidated") {
                    $("#telefono").removeClass("input-error");
                    $("#telefono-error-message").hide();
                    $("#buttonValidate").prop("disabled", false);
                } else if (response === "emptyData") {
                    $("#telefono").addClass("input-error");
                    $("#telefono-error-message").show().text("Este campo es obligatorio");
                    $("#buttonValidate").prop("disabled", true);
                } else if (response === "invalidData") {
                    $("#telefono").addClass("input-error");
                    $("#telefono-error-message").show().text("Número de teléfono inválido, debe ser menor a 15 dígitos y mayor que 10 dígitos");
                    $("#buttonValidate").prop("disabled", true);
                }
            }
        });
    });

    $("#email").on("keyup", function () {
        const email = $("#email").val();
        $("#buttonValidate").prop("disabled", true);

        $.ajax({
            url: "../functions/validations/validateAllFields.php",
            type: "post",
            data: {
                dataValidate: email,
                typeValidation: "v email"
            },
            success: function (response) {
                if (response === "dataValidated") {
                    $("#email").removeClass("input-error");
                    $("#email-error-message").hide();
                    $("#buttonValidate").prop("disabled", false);
                } else if (response === "emptyData") {
                    $("#email").addClass("input-error");
                    $("#email-error-message").show().text("Este campo es obligatorio");
                    $("#buttonValidate").prop("disabled", true);
                } else if (response === "invalidEmail") {
                    $("#email").addClass("input-error");
                    $("#email-error-message").show().text("No es un correo válido, ej: example@gmail.com");
                    $("#buttonValidate").prop("disabled", true);
                }
            }
        });
    });

    $("#password").on("keyup", function () {
        const password = $("#password").val();
        $("#buttonValidate").prop("disabled", true);

        $.ajax({
            url: "../functions/validations/validateAllFields.php",
            type: "post",
            data: {
                dataValidate: password,
                typeValidation: "v password"
            },
            success: function (response) {
                if (response === "dataValidated") {
                    $("#password").removeClass("input-error");
                    $("#password-error-message").hide();
                    $("#buttonValidate").prop("disabled", false);
                } else if (response === "emptyData") {
                    $("#password").addClass("input-error");
                    $("#password-error-message").show().text("Este campo es obligatorio");
                    $("#buttonValidate").prop("disabled", true);
                } else if (response === "passwordTooShort") {
                    $("#password").addClass("input-error");
                    $("#password-error-message").show().text("La contraseña es muy corta, Debe ser mayor a 8 dígitos");
                    $("#buttonValidate").prop("disabled", true);
                }
            }
        });
    });

    $("#height").on("keyup", function () {
        const heightValue = $("#height").val();
        $('#buttonValidate').prop('disabled', true);

        $.ajax({
            url: "../functions/validations/validateAllFields.php",
            type: "POST",
            data: {
                dataValidate: heightValue,
                typeValidation: "v float height"
            },
            success: function (response) {
                if (response === "dataValidated") {
                    $("#height").removeClass("input-error");
                    $("#height-error-message").hide();
                    $("#buttonValidate").prop("disabled", false);
                } else if (response === "emptyData") {
                    $("#height").addClass("input-error");
                    $("#height-error-message").show().text("Este campo es obligatorio");
                    $("#buttonValidate").prop("disabled", true);
                } else if (response === "dataOutOfRange") {
                    $("#height").addClass("input-error");
                    $("#height-error-message").show().text("El valor debe estar entre 1.50 y 3.00");
                    $("#buttonValidate").prop("disabled", true);
                } else if (response === "dataIsNotValid") {
                    $("#height").addClass("input-error");
                    $("#height-error-message").show().text("El valor ingresado no es válido");
                    $("#buttonValidate").prop("disabled", true);
                }
            }
        });
    });

    $("#text-area").on("keyup", function () {
        const text = $("#text-area").val();
        $('#buttonValidate').prop('disabled', true);

        $.ajax({
            url: "../functions/validations/validateAllFields.php",
            type: "POST",
            data: {
                dataValidate: text,
                typeValidation: "v text-area"
            },
            success: function (response) {
                if (response === "dataValidated") {
                    $("#text-area").removeClass("input-error");
                    $("#text-area-error-message").hide();
                    $("#buttonValidate").prop("disabled", false);
                } else if (response === "emptyData") {
                    $("#text-area").addClass("input-error");
                    $("#text-area-error-message").show().text("Este campo es obligatorio");
                    $("#buttonValidate").prop("disabled", true);
                }
            }
        });
    });

    $("#peso").on("keyup", function () {
        const dataPeso = $("#peso").val();
        $('#buttonValidate').prop('disabled', true);

        $.ajax({
            url: "../functions/validations/validateAllFields.php",
            type: "POST",
            data: {
                dataValidate: dataPeso,
                typeValidation: "v float weight"
            },
            success: function (response) {
                if (response === "dataValidated") {
                    $("#peso").removeClass("input-error");
                    $("#peso-error-message").hide();
                    $("#buttonValidate").prop("disabled", false);
                } else if (response === "emptyData") {
                    $("#peso").addClass("input-error");
                    $("#peso-error-message").show().text("Este campo es obligatorio");
                    $("#buttonValidate").prop("disabled", true);
                } else if (response === "dataOutOfRange") {
                    $("#peso").addClass("input-error");
                    $("#peso-error-message").show().text("El peso debe estar entre 0.50 y 3.00 kg");
                    $("#buttonValidate").prop("disabled", true);
                } else if (response === "dataIsNotValid") {
                    $("#peso").addClass("input-error");
                    $("#peso-error-message").show().text("El valor ingresado no es válido. Debe ser un número decimal");
                    $("#buttonValidate").prop("disabled", true);
                }
            }
        });
    });
});
