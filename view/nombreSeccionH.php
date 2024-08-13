<?php

/**
 * Retorna el nombre descriptivo de una sección según las opciones proporcionadas.
 *
 * @param int $opc Opción que determina el contexto (0 para usuario normal, 1 para administrador).
 * @param string|null $seccion Nombre de la sección para usuarios normales.
 * @param string|null $seccion_admin Nombre de la sección para administradores.
 * @return string Nombre descriptivo de la sección.
 */
function nombrar($opc, $seccion = null, $seccion_admin = null)
{

    $secciones_user = [
        'Pagina de inicio' => 'seccion1',
        'WorldFit | Mis calendarios' => 'misCalendarios',
        'WorldFit | Mi perfil' => 'MiPerfil',
        'WorldFit | Actualizando' => 'updateDatas',
        'Crear Calendario Rutinario' => 'createCalender',
        'Asignar rutinas diarias' => 'createCalender2do',
    ];

    $secciones_admin = [
        'Pagina de inicio | Administrador' => 'seccionAd1',
        'Administrador | Agregar Ejercicios' => 'addEjercicios',
        'Administrador | Ver Ejercicios' => 'verEjercicios',
        'Administrador | Crear Rutina' => 'addRutina',
        'Administrador | Ver Rutinas' => 'showRoutines',
        'Administrador | Registrar Gimnasio' => 'addGym',
        'Administrador | Crear Usuario' => 'addUsuario',
        'Administrador | Ver Usuarios' => 'verUsuarios',
    ];

    $nombreSeccion = '';

    if ($opc == 0) {
        // Opciones para usuarios normales
        foreach ($secciones_user as $nameSection => $sections) {
            if ($seccion == $sections) {
                $nombreSeccion = $nameSection;
                break;
            }
        }
    } elseif ($opc == 1) {
        // Opciones para administradores
        foreach ($secciones_admin as $nameSectionAdmin => $sectionAdmin) {
            if ($seccion_admin == $sectionAdmin) {
                $nombreSeccion = $nameSectionAdmin;
                break;
            }
        }
    }

    return $nombreSeccion;
}
