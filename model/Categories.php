<?php

include_once ("connect.php");

class CycleCreateCalender extends conexionBD
{

    /**
     * Obtiene todas las categorías de la base de datos y genera opciones HTML para un elemento `<select>`.
     * 
     * Este método realiza una consulta a la base de datos para recuperar todas las categorías disponibles
     * y genera las opciones HTML correspondientes para un elemento `<select>`.
     * 
     * @return string Una cadena de texto con las opciones HTML para el elemento `<select>`, cada opción
     *                 representa una categoría con su valor y nombre correspondientes.
     */
    public static function getCatgory($selectedCategory = null)
    {
        // Obtener la conexión a la base de datos
        $conexion = self::getConexion();

        // Crear la consulta SQL para obtener todas las categorías
        $sql = "select * FROM categorias_rutinas ";

        // Ejecutar la consulta
        $result = $conexion->query($sql);

        // Inicializar la variable para almacenar las opciones HTML
        $r = '';

        // Procesar los resultados de la consulta
        while ($fila = $result->fetch_array()) {
            $isSelected = $fila[0] == $selectedCategory ? 'selected' : '';
            // Generar una opción HTML para cada categoría
            $r .= "<option value='" . $fila[0] . "' $isSelected>" . $fila[1] . "</option>";
        }
        // Cierra la conexion a la base de datos
        $conexion->close();

        // Devolver las opciones HTML generadas
        return $r;
    }


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
}