<div class="container is-fluid mb-6">
    <h1 class="title has-text-centered">Registro de Usuario</h1>
    
</div>

<div class="container pb-6 pt-6">
    <form class="FormularioAjax" action="<?php echo APP_URL?>app/ajax/usuarioAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data">
        <input type="hidden" name="modulo_usuario" value="registrar">

     
        <div class="box mb-5">
            <h3 class="title is-4 has-text-info">Información Personal</h3>
            <div class="columns is-multiline">
                <div class="column is-half">
                    <div class="field">
                        <label class="label">Nombres</label>
                        <div class="control">
                            <input class="input" type="text" name="usuario_nombre" 
                                   pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required
                                   placeholder="Ingrese los nombres">
                        </div>
                    </div>
                </div>
                <div class="column is-half">
                    <div class="field">
                        <label class="label">Apellidos</label>
                        <div class="control">
                            <input class="input" type="text" name="usuario_apellido" 
                                   pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required
                                   placeholder="Ingrese los apellidos">
                        </div>
                    </div>
                </div>
                <div class="column is-half">
                    <div class="field">
                        <label class="label">Género</label>
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select name="genero" required>
                                    <option value="" disabled selected>Seleccione una opción</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column is-half">
                    <div class="field">
                        <label class="label">Edad</label>
                        <div class="control">
                            <input class="input" type="number" name="edad" 
                                   min="1" max="120" placeholder="Ej: 30">
                        </div>
                    </div>
                </div>
            </div>
        </div>

     
        <div class="box mb-5">
            <h3 class="title is-4 has-text-info">Datos de Contacto</h3>
            <div class="columns is-multiline">
                <div class="column is-half">
                    <div class="field">
                        <label class="label">Cédula</label>
                        <div class="control">
                            <input class="input" type="text" name="cedula" 
                                   pattern="[0-9]{6,20}" maxlength="20" required
                                   placeholder="Número de cédula">
                        </div>
                    </div>
                </div>
                <div class="column is-half">
                    <div class="field">
                        <label class="label">Teléfono</label>
                        <div class="control">
                            <input class="input" type="tel" name="telefono" 
                                   pattern="[0-9+]{7,15}" maxlength="15" 
                                   placeholder="0412555555">
                        </div>
                    </div>
                </div>
                <div class="column is-half">
                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control">
                            <input class="input" type="email" name="usuario_email" 
                                   maxlength="70" placeholder="correo@ejemplo.com">
                        </div>
                    </div>
                </div>
                <div class="column is-half">
                    <div class="field">
                        <label class="label">Dirección</label>
                        <div class="control">
                            <input class="input" type="text" name="direccion" 
                                   maxlength="200" placeholder="Dirección completa">
                        </div>
                    </div>
                </div>
            </div>
        </div>

   
        <div class="box mb-5">
            <h3 class="title is-4 has-text-info">Información Médica</h3>
            <div class="field">
                <label class="label">Síntomas</label>
                <div class="control">
                    <textarea class="textarea" name="sintomas" rows="3" 
                              placeholder="Describa los síntomas del paciente"></textarea>
                </div>
            </div>
        </div>

     
        <div class="field is-grouped is-grouped-centered mt-6">
            <div class="control">
                <button type="reset" class="button is-link is-light is-rounded">
                    <span class="icon"><i class="fas fa-eraser"></i></span>
                    <span>Limpiar Formulario</span>
                </button>
            </div>
            <div class="control">
                <button type="submit" class="button is-info is-rounded">
                    <span class="icon"><i class="fas fa-user-plus"></i></span>
                    <span>Registrar Usuario</span>
                </button>
            </div>
        </div>
    </form>
</div>