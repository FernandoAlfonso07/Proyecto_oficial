<?php

include_once ("connect.php");

class CycleCreateCalender extends conexionBD
{

    /**
     * Genera un formulario HTML para seleccionar categorías y rutinas.
     *
     * @param string $nameDay El nombre del día que se mostrará en el formulario.
     * @param string $id_filterCategory El identificador del elemento select para filtrar categorías.
     * @param string $id_filterRoutines El identificador del elemento select para filtrar rutinas.
     * @param string $nameId_Routine El nombre del campo select para elegir la rutina.
     * 
     * @return string El HTML generado para el formulario.
     */
    public static function showFormuler($nameDay, $id_filterCategory, $id_filterRoutines, $nameId_Routine)
    {
        $salida = '';

        // Inicio de la fila y la primera columna
        $salida .= '<div class="row my-5">';
        $salida .= '<div class="col-md-8">';

        // Segunda columna con el select de categorías
        $salida .= '</div>';
        $salida .= '<div class="col-md-4">';
        $salida .= "<select class='form-select' name='id_filterCategory' id='$id_filterCategory' onChange='hola(event,\"$id_filterRoutines\")'>";
        $salida .= 'aria-label="Default select example">';
        $salida .= '<option selected>Seleccione la categoria</option>';

        // Consulta para obtener las categorías y agregarlas al select
        $conexion = conexionBD::getConexion();

        $sql = 'SELECT * FROM categorias_rutinas ';
        $result = mysqli_query($conexion, $sql);

        // Agregar cada categoría como una opción en el select
        while ($fila = $result->fetch_array()) {
            $salida .= "<option value='" . $fila[0] . "'>" . $fila[1] . "</option>";
        }

        // Cierre del select de categorías y columnaF
        $salida .= ' </select>';
        $salida .= '</div>';
        $salida .= '<div class="col-md-6 my-2">';

        // Columna para mostrar el nombre del día
        $salida .= "<b>$nameDay</b>";
        $salida .= '</div>';

        // Columna con el select de rutinas
        $salida .= '<div class="col-md-6 my-2">';
        $salida .= "<select class='form-select' name='$nameId_Routine' id='$id_filterRoutines' aria-label='Default select example'>";
        $salida .= '<option selected>Seleccione una rutina</option>';

        // <!-- Aqui se deben renderizar las rutinas segun el parametro de categoria elegido -->

        $salida .= '</select>';
        $salida .= ' </div>';
        // Cierre de la fila
        $salida .= ' </div>';

        return $salida;
    }

    /**
     * Obtiene una lista de categorías desde la base de datos y genera un conjunto de opciones HTML.
     *
     * @param string $opc La opción seleccionada que determina la tabla de la cual obtener las categorías.
     *                    Puede ser 'roles', 'gyms', 'paymentMethods', o 'categoryRoutine'.
     * @param mixed $selectedCategory El valor de la categoría seleccionada por defecto (opcional).
     *                                Si se proporciona, la opción con este valor se marcará como seleccionada.
     * @return string Un conjunto de opciones HTML (<option>) para ser utilizado en un elemento <select>.
     */
    public static function getCategories($opc, $selectedCategory = null)
    {
        // Obtiene la conexión a la base de datos.
        $conexion = self::getConexion();

        // Inicializa la variable de la consulta SQL.
        $sql = '';

        // Determina la consulta SQL basada en la opción seleccionada.
        switch ($opc) {
            case 'roles':
                $sql = "SELECT * FROM roles ";
                break;
            case 'gyms':
                $sql = "SELECT * FROM categorias_gyms ";
                break;
            case 'paymentMethods':
                $sql = "SELECT * FROM payment_methods_gyms ";
                break;
            case 'categoryRoutine':
                $sql = "SELECT * FROM categorias_rutinas ";
                break;
        }

        // Ejecuta la consulta SQL.
        $result = $conexion->query($sql);

        // Inicializa una variable para almacenar las opciones HTML.
        $salida = '';

        // Itera sobre los resultados de la consulta.
        while ($row = $result->fetch_array()) {

            // Compara el valor de la categoría actual con el valor seleccionado.
            // Si son iguales, marca la opción como seleccionada.
            $isSelected = $row[0] == $selectedCategory ? 'selected' : '';

            // Genera una opción HTML para la categoría actual.
            $salida .= "<option value='" . $row[0] . "' $isSelected>" . $row[1] . "</option>";
        }

        // Cierra la conexión a la base de datos.
        $conexion->close();

        // Devuelve el conjunto de opciones HTML.
        return $salida;
    }

}
