<div class="container is-fluid">
	<h1 class="title">Home</h1>
  	
  	<!-- Sección de perfil existente -->
  	<div class="columns is-flex is-justify-content-center">
    	<figure class="image is-128x128">
			<?php
			if(is_file("./app/views/fotos/". $_SESSION['foto'])){
				echo '<img class="is-rounded" src="'.APP_URL.'app/views/fotos/'.$_SESSION['foto'].'">';
			}else{
				echo '<img class="is-rounded" src="'.APP_URL.'app/views/fotos/default.png">';
			}
			?>
		</figure>
  	</div>
  	<div class="columns is-flex is-justify-content-center">
  		<h2 class="subtitle">¡Bienvenido <?php echo $_SESSION['nombre']." ". $_SESSION['apellido'] ?>!</h2>
  	</div>

  	<!-- Nueva sección: Información del usuario -->
  	<div class="columns is-centered">
  		<div class="column is-8">
  			<div class="box">
  				<h3 class="title is-4">Información de tu cuenta</h3>
  				<div class="columns">
  					<div class="column">
  						<p><strong>Usuario:</strong> <?php echo $_SESSION['usuario'] ?? 'No disponible'; ?></p>
  						<p><strong>Email:</strong> <?php echo $_SESSION['email'] ?? 'No disponible'; ?></p>
  					</div>
  					<div class="column">
  						<p><strong>Último acceso:</strong> <?php echo date('d/m/Y H:i'); ?></p>
  						<p><strong>Estado:</strong> <span class="tag is-success">Activo</span></p>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>

  	<!-- Nueva sección: Accesos rápidos -->
<div class="columns is-centered">
    <div class="column is-10">
        <h3 class="title is-4">
            <span class="icon-text">
                <span class="icon has-text-info">
                    <i class="fas fa-rocket"></i>
                </span>
                <span>Accesos Rápidos</span>
            </span>
        </h3>
        <div class="columns">
            <!-- Card 1 - Nuevo Paciente -->
            <div class="column is-3">
                <div class="card hover-card">
                    <div class="card-content has-text-centered">
                        <span class="icon is-large has-text-primary">
                            <i class="fas fa-user-plus fa-2x"></i>
                        </span>
                        <p class="title is-6">Nuevo Paciente</p>
                        <p class="subtitle is-7">Registrar nuevo paciente</p>
                        <a href="<?php echo APP_URL; ?>userNew/" class="button is-primary is-small">
                            <span class="icon">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span>Agregar</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Card 2 - Nueva Cita -->
            <div class="column is-3">
                <div class="card hover-card">
                    <div class="card-content has-text-centered">
                        <span class="icon is-large has-text-info">
                            <i class="fas fa-calendar-plus fa-2x"></i>
                        </span>
                        <p class="title is-6">Nueva Cita</p>
                        <p class="subtitle is-7">Programar nueva cita</p>
                        <a href="<?php echo APP_URL; ?>citas/nueva/" class="button is-info is-small">
                            <span class="icon">
                                <i class="fas fa-calendar"></i>
                            </span>
                            <span>Programar</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Card 3 - Buscar Paciente -->
            <div class="column is-3">
                <div class="card hover-card">
                    <div class="card-content has-text-centered">
                        <span class="icon is-large has-text-success">
                            <i class="fas fa-search fa-2x"></i>
                        </span>
                        <p class="title is-6">Buscar Paciente</p>
                        <p class="subtitle is-7">Encontrar información</p>
                        <a href="<?php echo APP_URL; ?>userSearch/" class="button is-success is-small">
                            <span class="icon">
                                <i class="fas fa-search"></i>
                            </span>
                            <span>Buscar</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Card 4 - Historial Médico -->
            <div class="column is-3">
                <div class="card hover-card">
                    <div class="card-content has-text-centered">
                        <span class="icon is-large has-text-warning">
                            <i class="fas fa-file-medical fa-2x"></i>
                        </span>
                        <p class="title is-6">Historial Médico</p>
                        <p class="subtitle is-7">Ver registros médicos</p>
                        <a href="<?php echo APP_URL; ?>historial/" class="button is-warning is-small">
                            <span class="icon">
                                <i class="fas fa-eye"></i>
                            </span>
                            <span>Ver</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilo para las cards con hover */
    .hover-card {
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
    }
    
    /* Estilo para los botones */
    .card-content .button {
        margin-top: 0.75rem;
        transition: all 0.2s ease;
    }
    
    .card-content .button:hover {
        transform: scale(1.05);
    }
    
    /* Asegurar altura uniforme */
    .columns {
        align-items: stretch;
    }
    
    .card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .card-content {
        flex-grow: 1;
    }
</style>