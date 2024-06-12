<?php

function nombrar($opc, $seccion = null, $seccion_admin = null)
{

    $nombreSeccion = '';


    if ($opc == 0) {

        if ($seccion == 'seccion1') {
            $nombreSeccion = 'Home Page';

        } elseif ($seccion == 'misCalendarios') {
            $nombreSeccion = 'WorldFit | Mis calendarios';

        } elseif ($seccion == 'MiPerfil') {
            $nombreSeccion = 'WorldFit | Mi perfil';

        }
    } elseif ($opc == 1) {

        if ($seccion_admin == 'seccionAd1') {   //esta desicion es para la plantilla de Administrador...
            $nombreSeccion = 'Home Page | Administrador';

        } elseif ($seccion_admin == 'seccionAd2') {
            $nombreSeccion = '| Ejercicios';

        } elseif ($seccion_admin == 'MiPerfil') {
            $nombreSeccion = 'Mi perfil';

        }
    }





    return $nombreSeccion;
}