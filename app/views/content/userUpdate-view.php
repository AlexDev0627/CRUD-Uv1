<div class="container is-fluid mb-6">
    <?php
    $id = $insLogin->limpiarCadena($url[1] ?? '');
    $datosUsuario = $insLogin->seleccionarDatos("Unico", "usuario", "usuario_id", $id);
    
    if($datosUsuario->rowCount() == 1){
        $datos = $datosUsuario->fetch();
    ?>
    <h1 class="title">Actualización de Usuario</h1>
</div>

<div class="container pb-6 pt-6">
    <h2 class="subtitle has-text-centered has-text-danger">
        ACTUALIZANDO A: <?php echo $datos['usuario_nombre']." ".$datos['usuario_apellido']; ?>
        </h2>
    <?php include "./app/views/inc/btn_back.php"; ?>

    <form class="FormularioAjax" action="<?php echo APP_URL?>app/ajax/usuarioAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data">
        <input type="hidden" name="modulo_usuario" value="actualizar">
        <input type="hidden" name="usuario_id" value="<?php echo $datos['usuario_id']; ?>">

        <!-- Sección 1: Información Personal -->
        <div class="box mb-5">
            <h3 class="title is-4 has-text-info">Información Personal</h3>
            <div class="columns is-multiline">
                <div class="column is-half">
                    <div class="field">
                        <label class="label">Nombres</label>
                        <div class="control">
                            <input class="input" type="text" name="usuario_nombre" 
                                   value="<?php echo htmlspecialchars($datos['usuario_nombre']); ?>" 
                                   pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>
                        </div>
                    </div>
                </div>
                <div class="column is-half">
                    <div class="field">
                        <label class="label">Apellidos</label>
                        <div class="control">
                            <input class="input" type="text" name="usuario_apellido" 
                                   value="<?php echo htmlspecialchars($datos['usuario_apellido']); ?>" 
                                   pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>
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
                                    <option value="Masculino" <?php echo ($datos['genero'] ?? '') == 'Masculino' ? 'selected' : ''; ?>>Masculino</option>
                                    <option value="Femenino" <?php echo ($datos['genero'] ?? '') == 'Femenino' ? 'selected' : ''; ?>>Femenino</option>
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
                                   value="<?php echo htmlspecialchars($datos['edad'] ?? ''); ?>" 
                                   min="1" max="120" placeholder="Ej: 30">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección 2: Datos de Contacto -->
        <div class="box mb-5">
            <h3 class="title is-4 has-text-info">Datos de Contacto</h3>
            <div class="columns is-multiline">
                <div class="column is-half">
                    <div class="field">
                        <label class="label">Cédula</label>
                        <div class="control">
                            <input class="input" type="text" name="cedula" 
                                   value="<?php echo htmlspecialchars($datos['cedula'] ?? ''); ?>" 
                                   pattern="[0-9]{6,20}" maxlength="20" required>
                        </div>
                    </div>
                </div>
                <div class="column is-half">
                    <div class="field">
                        <label class="label">Teléfono</label>
                        <div class="control">
                            <input class="input" type="tel" name="telefono" 
                                   value="<?php echo htmlspecialchars($datos['telefono'] ?? ''); ?>" 
                                   pattern="[0-9+]{7,15}" maxlength="15" placeholder="+1234567890">
                        </div>
                    </div>
                </div>
                <div class="column is-half">
                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control">
                            <input class="input" type="email" name="usuario_email" 
                                   value="<?php echo htmlspecialchars($datos['usuario_email'] ?? ''); ?>" 
                                   maxlength="70" placeholder="correo@ejemplo.com">
                        </div>
                    </div>
                </div>
                <div class="column is-half">
                    <div class="field">
                        <label class="label">Dirección</label>
                        <div class="control">
                            <input class="input" type="text" name="direccion" 
                                   value="<?php echo htmlspecialchars($datos['direccion'] ?? ''); ?>" 
                                   maxlength="200" placeholder="Dirección completa">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección 3: Información Médica -->
        <div class="box mb-5">
            <h3 class="title is-4 has-text-info">Información Médica</h3>
            <div class="field">
                <label class="label">Síntomas</label>
                <div class="control">
                    <textarea class="textarea" name="sintomas" rows="3" 
                              placeholder="Describa los síntomas del paciente"><?php echo htmlspecialchars($datos['sintomas'] ?? ''); ?></textarea>
                </div>
            </div>
        </div>

        <!-- Sección 4: Verificación de Seguridad -->
        <div class="box">
            <h3 class="title is-4 has-text-danger">Verificación de Seguridad</h3>
            <div class="field">
                <label class="label">Clave de Administrador</label>
                <div class="control has-icons-left">
                    <input class="input" type="password" name="administrador_clave" required
                           placeholder="Ingrese su clave para confirmar los cambios">
                    <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
                <p class="help">Se requiere su clave de administrador para guardar los cambios</p>
            </div>
        </div>

        <!-- Botones de Acción -->
        <div class="field is-grouped is-grouped-centered mt-6">
            <div class="control">
                <button type="reset" class="button is-link is-light is-rounded">
                    <span class="icon"><i class="fas fa-eraser"></i></span>
                    <span>Limpiar</span>
                </button>
            </div>
            <div class="control">
                <button type="submit" class="button is-info is-rounded">
                    <span class="icon"><i class="fas fa-save"></i></span>
                    <span>Guardar Cambios</span>
                </button>
            </div>
        </div>
    </form>
    <?php
    } else {
        echo '<div class="notification is-danger is-light">
                <button class="delete"></button>
                <strong>¡Error!</strong> No se encontró el usuario solicitado
              </div>';
    }
    ?>
</div>