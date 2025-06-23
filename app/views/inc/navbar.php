<nav class="navbar is-primary is-fixed-top has-shadow">
    <div class="navbar-brand">
        <a class="navbar-item" href="<?php echo APP_URL; ?>dashboard/">
            <img src="<?php echo APP_URL; ?>app/views/img/logoUniversidad.png" alt="Clínica de Salud" style="max-height: 100px">
        </a>
        <div class="navbar-burger" data-target="navbarExampleTransparentExample">
            <!-- <span></span>
            <span></span>
            <span></span> -->
        </div>
    </div>

    <div id="navbarExampleTransparentExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item has-text-weight-semibold" href="<?php echo APP_URL; ?>dashboard/">
                <span class="icon">
                    <i class="fas fa-home"></i>
                </span>
                <span>Ir a inicio</span>
            </a>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link has-text-weight-semibold">
                    <span class="icon">
                        <i class="fas fa-user-plus"></i>
                    </span>
                    <span>Agregar Paciente</span>
                </a>
                <div class="navbar-dropdown is-boxed">
                    <a class="navbar-item" href="<?php echo APP_URL; ?>userNew/">
                        <span class="icon">
                            <i class="fas fa-file-medical"></i>
                        </span>
                        <span>Nuevo Paciente</span>
                    </a>
                    <a class="navbar-item" href="<?php echo APP_URL; ?>userList/">
                        <span class="icon">
                            <i class="fas fa-list"></i>
                        </span>
                        <span>Listado De Pacientes</span>
                    </a>
                    <!-- <a class="navbar-item" href="<?php echo APP_URL; ?>userSearch/">
                        <span class="icon">
                            <i class="fas fa-search"></i>
                        </span>
                        <span>Buscar Pacientes</span>
                    </a> -->
                </div>
            </div>
        </div>

        <div class="navbar-end">
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    <span class="icon">
                        <i class="fas fa-user"></i>
                    </span>
                    <span><?php echo $_SESSION['usuario']?></span>
                </a>
                <div class="navbar-dropdown is-boxed is-right">
                    <a class="navbar-item" href="<?php echo APP_URL."userUpdate/".$_SESSION['id']."/"; ?>">
                        <span class="icon">
                            <i class="fas fa-cog"></i>
                        </span>
                        <span>Mi cuenta</span>
                    </a>
                    <hr class="navbar-divider">
                    <a class="navbar-item has-text-danger" href="<?php echo APP_URL; ?>logOut/" id="btn_exit">
                        <span class="icon">
                            <i class="fas fa-sign-out-alt"></i>
                        </span>
                        <span>Salir</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
    /* Estilos mínimos para mejorar la apariencia sin cambiar estructura */
    .navbar {
        min-height: 4rem;
        max-height: 2rem;
    }
    .navbar-item, .navbar-link {
        padding: 0.75rem 1.25rem;
        transition: all 0.2s ease;
    }
    .navbar-item:hover {
        background-color: rgba(255, 255, 255, 0.1) !important;
    }
    .navbar-dropdown {
        border-top: 2px solid rgba(255, 255, 255, 0.1);
    }
    .navbar-divider {
        background-color: rgba(255, 255, 255, 0.1);
    }
    #btn_exit:hover {
        background-color: rgba(255, 99, 71, 0.1) !important;
    }
</style>