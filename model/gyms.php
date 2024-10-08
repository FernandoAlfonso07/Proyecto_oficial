<?php
// Incluye la clase de conexion
include_once("connect.php");

class Gyms extends conexionBD
{
    /**
     * Método para mostrar la información de los gimnasios.
     *
     * @param int $opc Opción para determinar la consulta a ejecutar:
     *                 1 - Para obtener la información de todos los gimnasios.
     *                 2 - Para obtener la información de un gimnasio específico.
     * @param int|null $id_gym El ID del gimnasio para el cual se desea obtener información (opcional, requerido solo si $opc es 2).
     * @return string HTML con la información de los gimnasios.
     */
    public static function showInfoGyms($opc, $id_gym = null)
    {
        // Obtener la conexión a la base de datos
        $connect = self::getConexion();

        // Preparar la consulta SQL según la opción ($opc)
        $sql = $opc == 1 ? "SELECT * FROM infoGyms WHERE status = 'activo'" : "CALL getInfoGyms($id_gym)";

        // Ejecutar la consulta
        $response = $connect->query($sql);

        // Inicializar la variable para almacenar el HTML
        $gymsInfo = '';

        // Iterar sobre los resultados de la consulta
        while ($row = $response->fetch_array()) {
            if ($opc == 1) {

                // Si la opción es 1, construir el HTML para mostrar todos los gimnasios
                $name = htmlspecialchars($row[1]);
                $id = htmlspecialchars($row[0]);
                $description = htmlspecialchars($row[3]);
                $mission = htmlspecialchars($row[4]);
                $vision = htmlspecialchars($row[5]);
                $path_image = htmlspecialchars($row[6]);

                $gymsInfo .= '<div class="show-gyms-container">
                <div class="show-gyms-content">
                    <div class="show-gyms-header">
                        <h1>' . $name . '</h1>
                        <p>' . $description . '</p>
                    </div>
                    <div class="show-gyms-info">
                        <div class="info-section">
                            <h3>MISION</h3>
                            <p>' . $mission . '</p>
                        </div>
                        <div class="info-section">
                            <h3>VISION</h3>
                            <p>' . $vision . '</p>
                        </div>
                    </div>
                    <div class="show-gyms-footer">
                        <a href="controlador.php?gymid=' . $id . '&seccion=infoThisGym">
                            <button type="button">Ver Más</button>
                        </a>
                    </div>
                </div>
                <div class="show-gyms-image">
                    <img src="' . $path_image . '" alt="Imagen del Gimnasio ' . $name . '">
                </div>
            </div>';

            } else {
                // Si la opción es 2, preparar los datos del gimnasio específico
                $array = [
                    'nameGym' => 0,
                    'descriptionGym' => 1,
                    'missionGym' => 2,
                    'visionGym' => 3,
                    'pathImage' => 4,
                    'timeStartMorningDay' => 5,
                    'timeEndMorningDay' => 6,
                    'timeStartAfternoonDay' => 7,
                    'timeEndAfternoonDay' => 8,
                    'timeStartMorningEnd' => 9,
                    'timeEndMorningEnd' => 10,
                    'timeStartAfternoonEnd' => 11,
                    'timeEndAfternoonEnd' => 12,
                    'phone' => 13,
                    'mail' => 14,
                    'direction' => 15,
                    'categoria' => 16,
                    'method' => 17,
                    'nombre' => 18,
                    'apellido' => 19,
                    'correo' => 20,
                    'telefono' => 21
                ];

                // Extraer los datos del resultado de la consulta en un array asociativo
                $gymDetails = [];
                foreach ($array as $varName => $index) {
                    $gymDetails[$varName] = htmlspecialchars($row[$index]);
                }

                // Extraer las variables del array para el archivo incluido
                extract($gymDetails);
                ob_start();
                // Iniciar el buffer de salida y capturar el contenido del archivo visitGym.php
                include_once("../view/pages/visitGym.php");

                // Obtener el contenido del buffer y almacenarlo en $gymsInfo
                $gymsInfo = ob_get_clean();
            }
        }
        // Cerrar la conexión a la base de datos
        $connect->close();

        // Devolver el HTML generado
        return $gymsInfo;
    }

    /**
     * Obtiene información específica de un gimnasio desde la base de datos.
     *
     * @param string $opc El nombre de la columna que se desea recuperar de la respuesta de la base de datos.
     * @param int $id_gym El identificador del gimnasio cuya información se desea obtener.
     * @return mixed El valor de la columna especificada en $opc para el gimnasio con el ID dado, o null si no se encuentra la columna.
     */
    public static function getInfoThisGym($opc, $id_gym, $selectedSql)
    {
        // Establece la conexión con la base de datos
        $connect = self::getConexion();

        // Prepara la consulta SQL para llamar al procedimiento almacenado que obtiene información del gimnasio por ID.
        $sql = "";
        if (isset($selectedSql)) {
            if ($selectedSql == "call") {
                $sql = "CALL getInfoGyms ('$id_gym') ";
            } elseif ($selectedSql == "detailedInfo") {
                $sql = "SELECT * FROM infogyms WHERE id = '$id_gym'";
            } elseif ($selectedSql == "datailedMore") {
                $sql = "SELECT * FROM registration_inscriptions WHERE id_gym = '$id_gym'";
            }
        }

        // Ejecuta la consulta y almacena la respuesta.
        $response = $connect->query($sql);

        // Inicializa una variable para almacenar el resultado de la consulta.
        $r = "";

        // Itera sobre las filas obtenidas de la consulta.
        while ($row = $response->fetch_array()) {

            // Asigna el valor de la columna especificada en $opc a la variable $r. Si la columna no existe, $r será null.
            $r = $row[$opc] ?? null;
        }
        // Cierra la conexión con la base de datos.
        $connect->close();

        // Devuelve el valor obtenido para la columna especificada, o null si no se encontró la columna.
        return $r;

    }

}