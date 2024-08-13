<?php
class Alerts
{
    public static function ok($opc, $message, $seccion)
    {

        $url = ($opc == 1) ? "controlador.php?seccion=$seccion" : "controladorVadmin.php?seccionAd=$seccion";

        $output = <<<SCRIPT
        <script>
        Swal.fire({
            icon: 'success',
            title: '$message',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '$url';
            }
        });
        </script>
        SCRIPT;

        return $output;

    }

    public static function error($opc, $message, $seccion)
    {
        if ($opc == 3) {
            $url = $seccion;
        } elseif ($opc == 1) {
            $url = "controlador.php?seccion=$seccion";
        } elseif ($opc == 2) {
            $url = "controladorVadmin.php?seccionAd=$seccion";
        }

        $output = <<<SCRIPT
            <script>
            Swal.fire({
                icon: 'error',
                title: '$message',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '$url';
                }
            });
            </script>
            SCRIPT;

        return $output;

    }
    /*
        public static function ok_admin($opc, $message, $section)
        {

            $output = <<<SCRIPT
        <script>
        Swal.fire({
            icon: 'success',
            title: '$message',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'controladorVadmin.php?seccionAd=$section';
            }
        });
        </script>
        SCRIPT;

            return $output;
        }
    */
    public static function are_you_sare_delete($data, $url)
    {

        $salida = "";
        $salida .= "<script>";
        $salida .= "Swal.fire({";
        $salida .= "title: '¿Estás seguro?',";
        $salida .= "text: 'Vas a eliminar tu $data',";
        $salida .= "icon: 'warning',";
        $salida .= "showCancelButton: true,";
        $salida .= "confirmButtonColor: '#3085d6',";
        $salida .= "cancelButtonColor: '#d33',";
        $salida .= "confirmButtonText: 'Sí, confirmar'";
        $salida .= "}).then((result) => {";
        $salida .= "if (result.isConfirmed) {";
        $salida .= "Swal.fire({";
        $salida .= "title: '$data eliminado',";
        $salida .= "text: 'Tu $data ha sido eliminado',";
        $salida .= "icon: 'success'";
        $salida .= "}).then((result) => {";
        $salida .= "if (result.isConfirmed) {";
        $salida .= "window.location.href = 'inicioSesion.php';";
        $salida .= "}";
        $salida .= "});";
        $salida .= "}";
        $salida .= "});";
        $salida .= "</script>";

        return $salida;

    }
}