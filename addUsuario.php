<style>
    .boton {
        margin-top: 20px;
    }
</style>

<div class="container">
    <form action="../../controler/ejercicioAgregado.php" method="get">
        <div class="row">

            <div class="col-md-6">
                img
            </div>
            <div class="col-md-6">

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Nombres</label>

                        <input type="text" name="nombreUsuario" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Apellidos</label>

                        <input type="text" name="apellidoUsuario" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Correo</label>

                        <input type="text" name="correoUsuario" class="form-control">
                    </div>
                    <div class="col-md1-12">
                        <label class="form-label">Contraseña</label>
                        <input type="text" name="contraseña" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Peso actual</label>
                        <input type="text" name="pesoActual" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><label>
                                Altura Actual
                            </label></label>
                        <input type="text" name="AlturaActual" class="form-control">
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputGroupSelect01" class="form-label">
                                Género
                            </label>
                            <select class="form-select custom-select" name="genero" id="inputGroupSelect01" required>
                                <option value="" disabled selected>Selecciona el género</option>
                                <option value="1">Masculino</option>
                                <option value="0">Femenino</option>
                            </select>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <label class="form-label"> Teléfono</label>
                        <input type="text" name="telefono" class="form-control">
                    </div>



                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label"><label for="inputGroupSelect01" class="form-label">
                                    Rol</label>

                                <select class="form-select custom-select" name="RolUsuario" id="inputGroupSelect01"
                                    required>
                                    <option value="" disabled selected>Selecciona el rol</option>
                                    <option value="0">invitado</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">super-administrador</option>
                                </select>

                        </div>
                    </div>
                    <br>
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary boton">Registrar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>