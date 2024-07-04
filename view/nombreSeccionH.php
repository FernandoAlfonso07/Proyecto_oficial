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

    $nombreSeccion = '';


    if ($opc == 0) {
        // Opciones para usuarios normales
        if ($seccion == 'seccion1') {
            $nombreSeccion = 'Home Page';

        } elseif ($seccion == 'misCalendarios') {
            $nombreSeccion = 'WorldFit | Mis calendarios';

        } elseif ($seccion == 'MiPerfil') {
            $nombreSeccion = 'WorldFit | Mi perfil';

        }
    } elseif ($opc == 1) {
        // Opciones para administradores
        if ($seccion_admin == 'seccionAd1') {
            $nombreSeccion = 'Home Page | Administrador';

        } elseif ($seccion_admin == 'seccionAd2') {
            $nombreSeccion = '| Ejercicios';

        } elseif ($seccion_admin == 'MiPerfil') {
            $nombreSeccion = 'Mi perfil';

        }
    }





    return $nombreSeccion;
}