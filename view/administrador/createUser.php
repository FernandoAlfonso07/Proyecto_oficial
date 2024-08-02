<div class="container">
    <form action="../../controller/controller_createUser.php" method="POST">
        <div class="row">
            <div class="col-md-6 text-center">
                <img src="https://media-public.canva.com/eFyVc/MAFUTdeFyVc/1/wm_s.png" class="img-fluid" width="70%"
                    alt="Foto">
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Nombres</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Apellidos</label>
                        <input type="text" name="lastName" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">Correo</label>
                        <input type="text" name="mail" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Peso actual</label>
                        <input type="text" name="weight" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Altura Actual</label>
                        <input type="text" name="height" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputGroupSelect01" class="form-label">Género</label>
                            <select class="form-select custom-select" name="sex" id="inputGroupSelect01" required>
                                <option value="" disabled selected>Selecciona el género</option>
                                <option value="1">Masculino</option>
                                <option value="2">Femenino</option>
                                <option value="3">Otro</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="inputGroupSelect02" class="form-label">Rol</label>
                            <select class="form-select custom-select" name="roleUser" id="inputGroupSelect02" required>
                                <option value="" disabled selected>Selecciona el rol</option>
                                <option value="2">Invitado</option>
                                <option value="1">Administrador</option>
                                <option value="3">Super-administrador</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12 my-4 text-center">
                        <button type="submit" class="btn btn-primary boton">Registrar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>