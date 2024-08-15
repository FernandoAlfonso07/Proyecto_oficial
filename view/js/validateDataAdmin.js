$(document).ready(function () {
    function validateField(fieldSelector, errorMessageId, typeValidation, customMessages = {}) {
        $(fieldSelector).on("keyup", function () {
            const fieldValue = $(this).val().trim();
            const $this = $(this);
            const defaultMessages = {
                emptyData: "Este campo es obligatorio",
                invalidCharacters: "Datos inválidos",
                invalidData: "Datos inválidos",
                dataOutOfRange: "Valor fuera de rango",
                dataIsNotValid: "El valor ingresado no es válido",
                dataValidated: ""
            };
            const messages = { ...defaultMessages, ...customMessages };
            $("#buttonValidate").prop("disabled", true);

            $.ajax({
                url: "../../functions/validations/validateAllFields.php",
                type: "post",
                data: {
                    dataValidate: fieldValue,
                    typeValidation: typeValidation
                },
                success: function (response) {
                    if (response === "dataValidated") {
                        $this.removeClass("input-error");
                        $(errorMessageId).hide();
                        $("#buttonValidate").prop("disabled", false);
                    } else {
                        $this.addClass("input-error");
                        $(errorMessageId).show().text(messages[response] || messages.invalidData);
                        $("#buttonValidate").prop("disabled", true);
                    }
                }
            });
        });
    }

    // Validaciones para cada campo por separado
    validateField("#nombres", "#nombres-error-message", "v string", {
        invalidCharacters: "Datos inválidos, solo se permiten letras y espacios"
    });
    validateField("#apellidos", "#apellidos-error-message", "v string", {
        invalidCharacters: "Datos inválidos, solo se permiten letras y espacios"
    });
    validateField("#telefono", "#telefono-error-message", "v phone", {
        invalidData: "Número de teléfono inválido, debe ser menor a 15 dígitos y mayor que 10 dígitos"
    });
    validateField("#email", "#email-error-message", "v email", {
        invalidEmail: "No es un correo válido, ej: example@gmail.com"
    });
    validateField("#password", "#password-error-message", "v password", {
        passwordTooShort: "La contraseña es muy corta, debe ser mayor a 8 dígitos"
    });
    validateField("#height", "#height-error-message", "v float height", {
        dataOutOfRange: "El valor debe estar entre 1.50 y 3.00"
    });
    validateField("#text-area", "#text-area-error-message", "v text-area");
    validateField("#peso", "#peso-error-message", "v float weight", {
        dataOutOfRange: "El peso debe estar entre 0.50 y 3.00 kg",
        dataIsNotValid: "El valor ingresado no es válido. Debe ser un número decimal"
    });
    validateField("#personalRecord", "#personalRecord-error-message", "v int positive", {
        dataOutOfRange: "El registro personal debe estar entre 0.50 y 3.00 kg.",
        dataIsNotValid: "El valor ingresado no es válido. Debe ser un número entero positivo."
    });

    // Validaciones para los campos del formulario
    validateField("#nombreEjercicio", "#nombreEjercicio-error-message", "v string", {
        invalidCharacters: "Datos inválidos, solo se permiten letras y espacios"
    });
    validateField("#instrucciones", "#instrucciones-error-message", "v text");
    validateField("#equipo", "#equipo-error-message", "v text");
    validateField("#series", "#series-error-message", "v int positive", {
        customValidation: "series",
        dataOutOfRange: "El número de series debe ser mayor a 5"
    });
    validateField("#repeticiones", "#repeticiones-error-message", "v int positive", {
        customValidation: "repeticiones",
        dataOutOfRange: "El número de repeticiones debe ser mayor a 5"
    });
    validateField("#t_descanso", "#t_descanso-error-message", "v int positive", {
        customValidation: "t_descanso",
        dataOutOfRange: "El tiempo de descanso debe ser mayor a 10 segundos"
    });
});