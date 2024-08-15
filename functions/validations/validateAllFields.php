<?php
// Verifica si los datos necesarios fueron enviados por POST
if (!isset($_POST['dataValidate']) || !isset($_POST['typeValidation'])) {
    // Si faltan datos, muestra un mensaje de error y termina el script
    echo "Solicitud Denegada";
    exit();
}

// Asigna y limpia los datos enviados por POST
$data = trim($_POST['dataValidate']);
$opc = $_POST['typeValidation'];

// Define la función para validar los datos
function validateField($data, $opc)
{
    // Verifica el tipo de validación solicitado
    if ($opc == 'v password') { // VALIDACIONES CONTRASEÑAS
        if (empty($data)) {
            return "emptyData"; // Campo vacío
        }
        if (strlen($data) <= 8) {
            return "passwordTooShort"; // Contraseña demasiado corta
        }

    } elseif ($opc == 'v email') { // VALIDACIONES DE CORREOS
        if (empty($data)) {
            return "emptyData"; // Campo vacío
        }
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            return "invalidEmail"; // Correo electrónico inválido
        }

    } elseif ($opc == "v phone") { // VALIDACIONES DE NÚMEROS DE TELÉFONO
        if (empty($data)) {
            return "emptyData"; // Campo vacío
        }
        if (!preg_match("/^\d{10,15}$/", $data)) {
            return "invalidData"; // Número de teléfono inválido
        }

    } elseif ($opc == "v string") { // VALIDACIONES DE CAMPOS DE TEXTO
        if (empty($data)) {
            return "emptyData"; // Campo vacío
        }
        if (!preg_match("/^[a-zA-Z\s]+$/", $data)) {
            return "invalidCharacters"; // Caracteres no válidos
        }

    } elseif ($opc == "v float height") { // VALIDACIONES DE NÚMEROS DECIMALES CON RANGO
        if (empty($data)) {
            return "emptyData"; // Campo vacío
        }
        if (is_numeric($data) && preg_match('/^\d+(\.\d{1,2})?$/', $data)) {
            $value = floatval($data);
            if ($value >= 1.50 && $value <= 3.00) {
                return "dataValidated"; // Valor dentro del rango
            } else {
                return "dataOutOfRange"; // Fuera del rango permitido
            }
        } else {
            return "dataIsNotValid"; // No es un número decimal válido
        }

    } elseif ($opc == "v float weight") { // VALIDACIONES DE NÚMEROS DECIMALES SIN RANGO
        if (empty($data)) {
            return "emptyData"; // Campo vacío
        }
        if (is_numeric($data) && preg_match('/^\d+(\.\d{1,2})?$/', $data)) {
            return "dataValidated"; // Valor válido
        } else {
            return "dataIsNotValid"; // No es un número válido
        }

    } elseif ($opc == "v text-area") { // VALIDACIÓN DE ÁREA DE TEXTO
        if (empty($data)) {
            return "emptyData"; // Campo vacío
        }

    } elseif ($opc == "v int positive") { // VALIDACIONES DE ENTEROS POSITIVOS
        if (empty($data)) {
            return "emptyData"; // Campo vacío
        }
        if (is_numeric($data) && intval($data) > 0) {
            // Validación adicional para número de series, repeticiones y tiempo de descanso
            if (isset($_POST['customValidation'])) {
                switch ($_POST['customValidation']) {
                    case "series":
                        return intval($data) >= 5 && intval($data) <= 100 ? "dataValidated" : "dataOutOfRange";
                    case "repeticiones":
                        return intval($data) >= 5 && intval($data) <= 50 ? "dataValidated" : "dataOutOfRange";
                    case "t_descanso":
                        return intval($data) >= 10 && intval($data) <= 600 ? "dataValidated" : "dataOutOfRange";
                }
            }
            return "dataValidated"; // Entero positivo
        } else {
            return "dataIsNotValid"; // No es un número entero positivo
        }

    } elseif ($opc == "v text") { // VALIDACIÓN PARA TEXTO
        if (empty($data)) {
            return "emptyData"; // Campo vacío
        }
        if (is_string($data) && strlen(trim($data)) > 0) {
            return "dataValidated"; // Texto válido
        } else {
            return "dataIsNotValid"; // Texto no válido
        }
    }

    return "dataValidated"; // Valor predeterminado si todo es válido
}

// Envía el resultado de la validación
echo validateField($data, $opc);

// Termina el script
exit();
