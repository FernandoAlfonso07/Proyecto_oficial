<link rel="stylesheet" href="css/estilo_interfaz_usuario.css">

<div class="container-fluid text-end BMI_record">
    <div class="row">
        <div class="col-md-12 py-2">
            TU INDICE DE MASA CORPORAL ESTA EN:
            <h1>
                <?php echo usuarios::get_user_registration_indexes($_SESSION['id'], 3); ?>
            </h1>
        </div>
    </div>
</div>

<div class="container opciones-dos">
    <div class="row">
        <div class="col-md-6 text-center opciones-dos-dos">
            <a href="#">
                <div class="card text-bg-dark position-relative contenedor-opcion-dos">
                    <img src="img/imagen_gimnasioss.png" class="card-img" alt="...">
                    <div
                        class="card-img-overlay position-absolute top-50 start-50 translate-middle texto-opcion-dos efecto-cristal">
                        <h5 class="card-title position-absolute top-50 start-50 translate-middle titulo-opcion">VER
                            GIMNASIOS
                            <img src="img/icono_ver_gyms.png" class="img-fluid pt-4" alt="icono de ver" width="30px">
                        </h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 text-center opciones-dos-dos">

            <a href="controlador.php?seccion=createCalender">
                <div class="card text-bg-dark position-relative contenedor-opcion-dos">
                    <img src="img/imagen-calendario.png" class="card-img" alt="...">
                    <div
                        class="card-img-overlay position-absolute top-50 start-50 translate-middle texto-opcion-dos efecto-cristal">

                        <h5 class="card-title position-absolute top-50 start-50 translate-middle titulo-opcion">
                            CREAR CALENDARIO
                            <img src="img/icono_gregar_calendario.png" class="img-fluid pt-4" alt="icono de agregar"
                                width="30px">
                        </h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p>&copy; 2024 WorldFit. Todos los derechos reservados.</p>
    </div>
</footer>