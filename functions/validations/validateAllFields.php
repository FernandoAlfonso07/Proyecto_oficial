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
        // Verifica si el campo está vacío
        if (empty($data)) {
            return "emptyData"; // Campo vacío
        }

        // Verifica si la contraseña tiene más de 8 caracteres
        if (strlen($data) <= 8) {
            return "passwordTooShort"; // Contraseña demasiado corta
        }

    } elseif ($opc == 'v email') { // VALIDACIONES DE CORREOS
        // Verifica si el campo está vacío
        if (empty($data)) {
            return "emptyData"; // Campo vacío
        }

        // Verifica si la dirección de correo electrónico es válida
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            return "invalidEmail"; // Correo electrónico inválido
        }

    } elseif ($opc == "v phone") { // VALIDACIONES DE NÚMEROS DE TELÉFONO
        // Verifica si el campo está vacío
        if (empty($data)) {
            return "emptyData"; // Campo vacío
        }

        // Verifica si el número de teléfono tiene entre 10 y 15 dígitos
        if (!preg_match("/^\d{10,15}$/", $data)) {
            return "invalidData"; // Número de teléfono inválido
        }

    } elseif ($opc == "v string") { // VALIDACIONES DE CAMPOS DE TEXTO
        // Verifica si el campo está vacío
        if (empty($data)) {
            return "emptyData"; // Campo vacío
        }

        // Verifica si la cadena contiene solo letras y espacios
        if (!preg_match("/^[a-zA-Z\s]+$/", $data)) {
            return "invalidCharacters"; // Caracteres no válidos
        }
    } elseif ($opc == "v float height") { // VALIDACIONES DE NÚMEROS DECIMALES
        // Verifica si el campo está vacío
        if (empty($data)) {
            return "emptyData"; // Campo vacío
        }

        // Verifica si el valor es un número decimal válido
        if (is_numeric($data) && preg_match('/^\d+(\.\d{1,2})?$/', $data)) {
            $value = floatval($data);

            // Verifica si el número está en el rango permitido (0.50 a 3.00)
            if ($value >= 1.50 && $value <= 3.00) {
                return "dataValidated"; // Valor dentro del rango
            } else {
                return "dataOutOfRange"; // Fuera del rango permitido
            }
        } else {
            return "dataIsNotValid"; // No es un número decimal válido
        }
    } elseif ($opc == "v float weight") { // VALIDACIONES DE NÚMEROS DECIMALES SIN RANGO
        // Verifica si el campo está vacío
        if (empty($data)) {
            return "emptyData"; // Campo vacío
        }

        // Verifica si el valor es un número válido (entero o decimal)
        if (is_numeric($data) && preg_match('/^\d+(\.\d{1,2})?$/', $data)) {
            return "dataValidated"; // Valor válido
        } else {
            return "dataIsNotValid"; // No es un número válido
        }
    }

    // Valor por defecto si todas las validaciones pasan
    return "dataValidated"; // Correcto todo.
}

// Envía el resultado de la validación
echo validateField($data, $opc);
// Termina el script
exit();
