<?php
// Incluye los archivos necesarios para usar las clases 'usuario' y 'validate'
include_once ("../model/usuario.php");
include_once ('../model/validate.php'); // Se incluye la clase que permite sanitizar

// Inicia la sesión si no ha sido iniciada previamente
if (!isset($_SESSION))
    session_start();

$id_user = 0;

// Obtén el tipo de usuario desde la variable GET
$type = $_GET['type'] ?? null;

// Verifica si ambas sesiones están vacías o no definidas
if (
    (!isset($_SESSION['id']) || empty($_SESSION['id']))
    &&
    (!isset($_SESSION['id_admin']) || empty($_SESSION['id_admin']))
    &&
    (!isset($_SESSION['id_edit_usu']) || empty($_SESSION['id_edit_usu']))
) {
    // Redirige a la página de inicio de sesión si ambas sesiones están vacías o no definidas
    header("Location: ../view/inicioSesion.php");
    exit();
}

// Determina el ID del usuario basado en el tipo de sesión
$id_user = 0;
if ($type === 'admin') {
    $id_user = $_SESSION['id_admin'] ?? 0;
} elseif ($type === 'user') {
    $id_user = $_SESSION['id'] ?? 0;
} elseif ($type === 'editUser') {
    $id_user = $_SESSION['id_edit_usu'] ?? 0;
}

// Define un arreglo con los nombres de los campos que se van a validar
$inputs = [];
if ($type === 'admin') {
    $inputs = ['name', 'lastName', 'phone', 'mail', 'sex', 'weight', 'height', 'roleUser'];
} elseif ($type === 'user') {
    $inputs = ['name', 'lastName', 'phone', 'mail', 'sex', 'weight', 'height'];
} elseif ($type === 'editUser') {
    $inputs = ['name', 'lastName', 'phone', 'mail', 'sex', 'weight', 'height', 'roleUser'];
}

// Verifica que todos los campos en el arreglo no estén vacíos
if (validate::validateNotEmptyInputs($inputs)) {

    // Sanitiza las entradas del formulario
    $nombres = validate::sanitize($_POST['name']);
    $apellidos = validate::sanitize($_POST['lastName']);
    $telefono = validate::sanitize($_POST['phone']);
    $correo = validate::sanitize($_POST['mail']);
    $pr = isset($_POST['personaleRecord']) && !empty($_POST['personaleRecord']) ? validate::sanitize($_POST['personaleRecord']) : 0;
    $pesoActual = validate::sanitize($_POST['weight']);
    $altura = validate::sanitize($_POST['height']);
    $sex = isset($_POST['sex']) ? validate::sanitize($_POST['sex']) : null;
    $rol = isset($_POST['roleUser']) ? validate::sanitize($_POST['roleUser']) : null;

    // Imagen de perfil
    $currentImagePath = usuarios::getPerfil(9, $id_user);
    $defaultImagePath = '../view/user img/default_img.PNG';

    // Verifica si se ha subido una nueva imagen
    if (!empty($_FILES['imagenPerfil']['name'])) {
        // Validación basada en el tipo de usuario
        if ($type === 'admin') {
            $ruta_imagen = validate::media('imagenPerfil', '../view/administrador/controladorVadmin.php?error=incorrectFormat&seccionAd=updateDatas', '../view/user img/');
        } elseif ($type === 'user') {
            $ruta_imagen = validate::media('imagenPerfil', '../view/controlador.php?error=incorrectFormat&seccion=updateDatas', '../view/user img/');
        } else {
            $ruta_imagen = null;  // O maneja el caso de que no haya tipo válido
        }

        // Elimina la imagen actual si no es la imagen por defecto
        if ($currentImagePath && $currentImagePath !== $defaultImagePath) {
            unlink($currentImagePath);
        }
    } else {
        // Mantiene la ruta de la imagen actual si no se sube una nueva
        $ruta_imagen = $currentImagePath;
    }

    // Validación del correo electrónico.
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        if ($type === 'user') {
            header('Location: ../view/controlador.php?error=invalidEmail&seccion=updateDatas');
        } elseif ($type === 'admin') {
            header('Location: ../view/administrador/controladorVadmin.php?error=invalidEmail&seccionAd=updateDatas');
        } elseif ($type === 'editUser') {
            header('Location: ../view/administrador/controladorVadmin.php?error=invalidEmailEdit&edit=' . $id_user . '&seccionAd=createUser');
        }
        exit(); // Detiene la ejecución después de redirigir
    }

    // Validación de entradas: todas deben ser números flotantes positivos
    if ($type === 'user') {
        // Validación para usuario normal
        if (
            !filter_var($pr, FILTER_VALIDATE_FLOAT) || $pr <= 0 ||
            !filter_var($pesoActual, FILTER_VALIDATE_FLOAT) || $pesoActual <= 0 ||
            !filter_var($altura, FILTER_VALIDATE_FLOAT) || $altura <= 0
        ) {
            header('Location: ../view/controlador.php?error=notNumber&seccion=updateDatas');
            exit(); // Detiene la ejecución después de redirigir
        }
    } elseif ($type === 'admin') {
        // Validación para administrador
        if (
            !filter_var($pesoActual, FILTER_VALIDATE_FLOAT) || $pesoActual <= 0 ||
            !filter_var($altura, FILTER_VALIDATE_FLOAT) || $altura <= 0
        ) {
            header('Location: ../view/administrador/controladorVadmin.php?error=notNumber&seccionAd=updateDatas');
            exit(); // Detiene la ejecución después de redirigir
        }
    } elseif ($type === 'editUser') {
        // Validación para edición de usuario
        if (
            !filter_var($pesoActual, FILTER_VALIDATE_FLOAT) || $pesoActual <= 0 ||
            !filter_var($altura, FILTER_VALIDATE_FLOAT) || $altura <= 0
        ) {
            header('Location: ../view/administrador/controladorVadmin.php?error=notNumberEdit&edit=' . $id_user . '&seccionAd=createUser');
            exit(); // Detiene la ejecución después de redirigir
        }
    }

    // Validación del teléfono: debe ser un número entero positivo
    if (!filter_var($telefono, FILTER_VALIDATE_INT) || $telefono <= 0) {
        if ($type === 'user') {
            header('Location: ../view/controlador.php?error=invalidPhone&seccion=updateDatas');
        } elseif ($type === 'admin') {
            header('Location: ../view/administrador/controladorVadmin.php?error=invalidPhone&seccionAd=updateDatas');
        } elseif ($type === 'editUser') {
            header('Location: ../view/administrador/controladorVadmin.php?error=invalidPhoneEdit&edit=' . $id_user . '&seccionAd=createUser');
        }
        exit(); // Detiene la ejecución después de redirigir
    }



    // Actualiza los datos del usuario en la base de datos
    if ($type === 'user') {
        // Actualización de datos para usuario normal
        $respuesta = usuarios::actualizarDatos($id_user, $nombres, $apellidos, $telefono, $correo, $pr, $pesoActual, $altura, $sex, $ruta_imagen);
    } elseif ($type === 'admin' || $type === 'editUser') {
        // Actualización de datos para administrador o edición de usuario
        $respuesta = usuarios::actualizarDatos($id_user, $nombres, $apellidos, $telefono, $correo, $pr, $pesoActual, $altura, $sex, $ruta_imagen, $rol);
    }

    // Redirige según el resultado de la actualización
    if ($respuesta > 1) {
        header('Location: ../view/controlador.php?seccion=MiPerfil');
        exit();
    } else {
        if ($type === 'user') {
            header('Location: ../view/controlador.php?success=exito&seccion=MiPerfil');
        } elseif ($type === 'admin') {
            header('Location: ../view/administrador/controladorVadmin.php?success=exito&seccionAd=MiPerfil');
        } elseif ($type === 'editUser') {
            // Elimina la variable de sesión específica
            unset($_SESSION['id_edit_usu']);
            header('Location: ../view/administrador/controladorVadmin.php?success=exitoEdit&seccionAd=verUsuarios');
        }
        exit(); // Detiene la ejecución después de redirigir
    }

} else {

    // Si alguno de los campos está vacío, redirige con un error
    if ($type === 'user') {
        header('Location: ../view/controlador.php?error=emptyFields&seccion=updateDatas');
    } elseif ($type === 'admin') {
        header('Location: ../view/administrador/controladorVadmin.php?error=emptyFields&seccionAd=updateDatas');
    } elseif ($type === 'editUser') {
        header('Location: ../view/administrador/controladorVadmin.php?error=emptyFieldsEdit&edit=' . $id_user . '&seccionAd=createUser');
    }
    exit(); // Detiene la ejecución después de redirigir

}