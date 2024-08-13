<?php
include_once ("../model/validate.php");
include_once ("../model/administrador.php");

// Verificar que la solicitud contenga 'accion'
if (!isset($_POST['accion']) || empty($_POST['accion'])) {
    echo "Solicitud denegada";
    exit();
}

// Verificar que 'id' esté presente y no esté vacío
if (!isset($_POST['id']) || empty($_POST['id'])) {
    echo "Solicitud denegada: no existe un ID válido";
    exit();
}

// Obtener el ID del POST
$id = $_POST['id'];

// Verificar el estado actual utilizando la función de validación
$validateStatus = validate::search('searchStatus', $id);

// Verificar la acción solicitada
if ($_POST['accion'] == 'changeStatus') {
    // Asegurarse de que se ha obtenido un estado válido
    if (!isset($validateStatus) || empty($validateStatus)) {
        echo "Solicitud denegada: no tiene estado";
        exit();
    } else {
        // Cambiar el estado según el estado actual
        if ($validateStatus == 'activo') {
            $update = Administrador::updateStatus($id, 'inactivo');

            if ($update <= 0) {
                echo "No se logró actualizar el estado de activo a inactivo";
                exit();
            } else {
                // Devolver el ícono actualizado para 'inactivo'
                echo "<i class='fa-solid fa-toggle-off text-danger'></i>";
            }
        } elseif ($validateStatus == 'inactivo') {
            $update = Administrador::updateStatus($id, 'activo');

            if ($update <= 0) {
                echo "No se logró actualizar el estado de inactivo a activo";
                exit();
            } else {
                // Devolver el ícono actualizado para 'activo'
                echo "<i class='fa-solid fa-toggle-on text-success'></i>";
            }
        }
    }
} else {
    echo "Solicitud denegada: acción no válida";
    exit();
}
