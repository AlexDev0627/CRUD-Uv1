<?php
    namespace app\controllers;
    use app\models\mainModel;

    class userController extends mainModel{
        # Controlador para registrar un usuario #
       public function registrarUsuarioControlador(){

    # Almacenando datos #
    $nombre=$this->limpiarCadena($_POST['usuario_nombre']);
    $apellido=$this->limpiarCadena($_POST['usuario_apellido']);
    
    // $usuario=$this->limpiarCadena($_POST['usuario_usuario']);
    $email=$this->limpiarCadena($_POST['usuario_email']);
    // $clave1=$this->limpiarCadena($_POST['usuario_clave_1']);
    // $clave2=$this->limpiarCadena($_POST['usuario_clave_2']);

    # Campos médicos añadidos #
    $cedula=$this->limpiarCadena($_POST['cedula']);
    $telefono=$this->limpiarCadena($_POST['telefono']);
    $direccion=$this->limpiarCadena($_POST['direccion']);
    $edad=$this->limpiarCadena($_POST['edad']);
    $genero=$this->limpiarCadena($_POST['genero']);
     $sintomas=$this->limpiarCadena($_POST['sintomas']);

    # Verificando campos obligatorios #
    if($nombre=="" || $apellido=="" || $cedula=="" || $genero==""){
        $alerta=[
            "tipo"=>"simple",
            "titulo"=>"Ocurrio un error inesperado",
            "texto"=>"No has llenado todos los campos son obligatorios",
            "icono"=>"error"
        ];
        return json_encode($alerta);
        exit();
    }
    
    # Verificar la integridad de los datos #
    if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
        $alerta=[
            "tipo"=>"simple",
            "titulo"=>"Ocurrio un error inesperado",
            "texto"=>"El nombre no coincide con el formato solicitado",
            "icono"=>"error"
        ];
        return json_encode($alerta);
        exit();
    }
    
    if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido)){
        $alerta=[
            "tipo"=>"simple",
            "titulo"=>"Ocurrio un error inesperado",
            "texto"=>"El apellido no coincide con el formato solicitado",
            "icono"=>"error"
        ];
        return json_encode($alerta);
        exit();
    }
    
    // if($this->verificarDatos("[a-zA-Z0-9]{4,20}",$usuario)){
    //     $alerta=[
    //         "tipo"=>"simple",
    //         "titulo"=>"Ocurrio un error inesperado",
    //         "texto"=>"El usuario no coincide con el formato solicitado",
    //         "icono"=>"error"
    //     ];
    //     return json_encode($alerta);
    //     exit();
    // }
    
    // if($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}",$clave1)|| $this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}",$clave2)){
    //     $alerta=[
    //         "tipo"=>"simple",
    //         "titulo"=>"Ocurrio un error inesperado",
    //         "texto"=>"Las CLAVES no coinciden",
    //         "icono"=>"error"
    //     ];
    //     return json_encode($alerta);
    //     exit();
    // }
    
    # Validación de campos médicos añadidos #
    if($this->verificarDatos("[0-9]{6,20}",$cedula)){
        $alerta=[
            "tipo"=>"simple",
            "titulo"=>"Ocurrio un error inesperado",
            "texto"=>"La cédula no coincide con el formato solicitado",
            "icono"=>"error"
        ];
        return json_encode($alerta);
        exit();
    }
    
    if($telefono!="" && $this->verificarDatos("[0-9+]{7,15}",$telefono)){
        $alerta=[
            "tipo"=>"simple",
            "titulo"=>"Ocurrio un error inesperado",
            "texto"=>"El teléfono no coincide con el formato solicitado",
            "icono"=>"error"
        ];
        return json_encode($alerta);
        exit();
    }
    
    if(!in_array($genero, ['Masculino', 'Femenino'])){
        $alerta=[
            "tipo"=>"simple",
            "titulo"=>"Ocurrio un error inesperado",
            "texto"=>"El género seleccionado no es válido",
            "icono"=>"error"
        ];
        return json_encode($alerta);
        exit();
    }
    
    # Verificando Email #
    if($email!=""){
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $check_email=$this->ejecutarConsulta("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
            if($check_email->rowCount()>0){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"El CORREO ELECTRONICO que acaba de ingresar ya existe!",
                    "icono"=>"error"
                ];
                return json_encode($alerta);
                exit();
            }
        }else{
            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrio un error inesperado",
                "texto"=>"Ha ingresado un CORREO ELECTRONICO no valido",
                "icono"=>"error"
            ];
            return json_encode($alerta);
            exit();
        }
    }
    
    # Verificando cédula única #
    $check_cedula=$this->ejecutarConsulta("SELECT cedula FROM usuario WHERE cedula='$cedula'");
    if($check_cedula->rowCount()>0){
        $alerta=[
            "tipo"=>"simple",
            "titulo"=>"Ocurrio un error inesperado",
            "texto"=>"La CÉDULA que acaba de ingresar ya existe!",
            "icono"=>"error"
        ];
        return json_encode($alerta);
        exit();
    }
    
    // if($clave1!=$clave2){
    //     $alerta=[
    //         "tipo"=>"simple",
    //         "titulo"=>"Ocurrio un error inesperado",
    //         "texto"=>"Las CLAVES no coinciden",
    //         "icono"=>"error"
    //     ];
    //     return json_encode($alerta);
    //     exit();
    // }else{
    //     $clave=password_hash($clave1,PASSWORD_BCRYPT,["cost"=>10]);
    // }
    
    # Verficando usuario #
    // $check_usuario=$this->ejecutarConsulta("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$usuario'");
    // if($check_usuario->rowCount()>0){
    //     $alerta=[
    //         "tipo"=>"simple",
    //         "titulo"=>"Ocurrio un error inesperado",
    //         "texto"=>"El USUARIO que acaba de ingresar ya existe!",
    //         "icono"=>"error"
    //     ];
    //     return json_encode($alerta);
    //     exit();
    // }
   
    # Directorio de imagenes #
    // $img_dir="../views/fotos/";

    // # Comprobar si se ha seleccionado una imagen #
    // if($_FILES['usuario_foto']['name']!="" && $_FILES['usuario_foto']['size']>0){
    //     # Creando directorios #
    //     if(!file_exists($img_dir)){
    //         if(!mkdir($img_dir,0777)){
    //             $alerta=[
    //                 "tipo"=>"simple",
    //                 "titulo"=>"Ocurrio un error inesperado",
    //                 "texto"=>"Error al crear el directorio",
    //                 "icono"=>"error"
    //             ];
    //             return json_encode($alerta);
    //             exit();
    //         }
    //     }
    //     # Verificando el formato de imagenes #
    //     if(mime_content_type($_FILES['usuario_foto']['tmp_name'])!="image/jpeg" && mime_content_type($_FILES['usuario_foto']['tmp_name'])!="image/png"){
    //         $alerta=[
    //             "tipo"=>"simple",
    //             "titulo"=>"Ocurrio un error inesperado",
    //             "texto"=>"La imagen que se ha seleccionado es de un FORMATO NO PERMITIDO",
    //             "icono"=>"error"
    //         ];
    //         return json_encode($alerta);
    //         exit();
    //     }
    //     # Verificando peso de la imagen #
    //     if(($_FILES['usuario_foto']['size']/1024)>5120){
    //         $alerta=[
    //             "tipo"=>"simple",
    //             "titulo"=>"Ocurrio un error inesperado",
    //             "texto"=>"La imagen que ha seleccionado SUPERA el peso PERMITIDO",
    //             "icono"=>"error"
    //         ];
    //         return json_encode($alerta);
    //         exit();
    //     }
    //     # Nombre de la foto #
    //     $foto=str_ireplace(" ","_",$nombre);
    //     $foto=$foto."_".rand(0,100);

    //     # Extension de la imagen #
    //     switch(mime_content_type($_FILES['usuario_foto']['tmp_name'])){
    //         case "image/jpeg":
    //             $foto=$foto.".jpeg";
    //             break;
    //         case "image/png":
    //             $foto=$foto.".png";
    //             break;
    //     }
    //     # chmod da permisos de escritura y lectura, en este caso al directorio que se almacena en la variable #
    //     chmod($img_dir,0777);
    //     # Moviendo imagen al directorio #
    //     if(!move_uploaded_file($_FILES['usuario_foto']['tmp_name'],$img_dir.$foto)){
    //         $alerta=[
    //             "tipo"=>"simple",
    //             "titulo"=>"ERROR AL MOVER LA IMAGEN",
    //             "texto"=>"No se pudo subir la imagen al sistema en este momento",
    //             "icono"=>"error"
    //         ];
    //         return json_encode($alerta);
    //         exit();
    //     }
    // }else{
    //     $foto="";
    // }

    $usuario_datos_reg=[
        [
            "campo_nombre"=>"usuario_nombre",
            "campo_marcador"=>":Nombre",
            "campo_valor"=>"$nombre",
        ],
        [
            "campo_nombre"=>"usuario_apellido",
            "campo_marcador"=>":Apellido",
            "campo_valor"=>"$apellido",
        ],
        [
            "campo_nombre"=>"usuario_email",
            "campo_marcador"=>":Email",
            "campo_valor"=>"$email",
        ],
        // [
        //     "campo_nombre"=>"usuario_usuario",
        //     "campo_marcador"=>":Usuario",
        //     "campo_valor"=>"$usuario",
        // ],
        [
            "campo_nombre"=>"usuario_creado",
            "campo_marcador"=>":Creado",
            "campo_valor"=>date("Y-m-d H:i:s"),
        ],
        // [
        //     "campo_nombre"=>"usuario_actualizado",
        //     "campo_marcador"=>":Actualizado",
        //     "campo_valor"=>date("Y-m-d H:i:s"),
        // ],
        # Campos médicos añadidos al array de datos #
        [
            "campo_nombre"=>"cedula",
            "campo_marcador"=>":Cedula",
            "campo_valor"=>"$cedula",
        ],
        [
            "campo_nombre"=>"telefono",
            "campo_marcador"=>":Telefono",
            "campo_valor"=>"$telefono",
        ],
        [
            "campo_nombre"=>"direccion",
            "campo_marcador"=>":Direccion",
            "campo_valor"=>"$direccion",
        ],
        [
            "campo_nombre"=>"edad",
            "campo_marcador"=>":Edad",
            "campo_valor"=>"$edad",
        ],
        [
            "campo_nombre"=>"genero",
            "campo_marcador"=>":Genero",
            "campo_valor"=>"$genero",
        ],
        [
            "campo_nombre"=>"sintomas", 
            "campo_marcador"=>":Sintomas",
            "campo_valor"=>"$sintomas",
        ],
    ];
    
    $registar_usuario=$this->guardarDatos("usuario",$usuario_datos_reg);

    if($registar_usuario->rowCount()==1){
        $alerta=[
            "tipo"=>"limpiar",
            "titulo"=>"PACIENTE REGISTRADO",
            "texto"=>"El PACIENTE ".$nombre." ".$apellido." ha sido registrado CORRECTAMENTE",
            "icono"=>"success"
        ];

    }else{
        $alerta=[
            "tipo"=>"simple",
            "titulo"=>"ERROR AL REGISTRAR",
            "texto"=>"No se pudo REGISTRAR el PACIENTE, por favor intente nuevamente",
            "icono"=>"error"

        ];
    
    }
    return json_encode($alerta);
}
        
        # Controlador para listar usuarios #          
        public function listarUsuarioControlador($pagina,$registros,$url,$busqueda){
            
            $pagina=$this->limpiarCadena($pagina);
            $registros=$this->limpiarCadena($registros);
            
            $url=$this->limpiarCadena($url);
            $url=APP_URL.$url.'/';

            $busqueda=$this->limpiarCadena($busqueda);
            $tabla="";
            
            $pagina= (isset($pagina) && $pagina>0) ?(int) $pagina :1 ;
            $inicio = ($pagina>0) ? (($pagina*$registros)-$registros) :0 ;

            if(isset($busqueda) && $busqueda!=""){

                
                $consulta_datos="SELECT * FROM usuario WHERE ((usuario_id!='".$_SESSION['id']."' AND usuario_id!='1') AND (usuario_nombre LIKE '%$busqueda%'  OR usuario_email LIKE '%$busqueda%' OR usuario_usuario LIKE '%$busqueda%')) ORDER BY usuario_nombre ASC LIMIT $inicio,$registros";

                $consulta_total="SELECT COUNT(usuario_id) FROM usuario WHERE ((usuario_id!='".$_SESSION['id']."' AND usuario_id!='1') AND (usuario_nombre LIKE '%$busqueda%'  OR usuario_email LIKE '%$busqueda%' OR usuario_usuario LIKE '%$busqueda%'))";
            
            }else{

                $consulta_datos="SELECT * FROM usuario WHERE usuario_id!='".$_SESSION['id']."' AND usuario_id!='1' ORDER BY usuario_nombre ASC LIMIT $inicio,$registros";

                $consulta_total="SELECT COUNT(usuario_id) FROM usuario WHERE usuario_id!='".$_SESSION['id']."' AND usuario_id!='1'";
            }
            $datos = $this->ejecutarConsulta($consulta_datos);
            $datos = $datos->fetchAll();

            $total = $this->ejecutarConsulta($consulta_total);
            $total = (int) $total->fetchColumn();

            $numeroPaginas =ceil($total/$registros  );

            $tabla.='
            <div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th class="has-text-centered">Id</th>
                    <th class="has-text-centered">Nombre</th>
                    <th class="has-text-centered">Apellido</th>
                    <th class="has-text-centered">Cedula</th>
                    <th class="has-text-centered">Email</th>
                    <th class="has-text-centered">Telefono</th>
                    <th class="has-text-centered">Edad</th>
                    <th class="has-text-centered">Genero</th>
                    <th class="has-text-centered">Sintomas</th>

                    <th class="has-text-centered">Fecha de Registro</th>
                   
                    <th class="has-text-centered" colspan="3">Opciones</th>
                </tr>
            </thead>
            <tbody>
            ';

            if($total>=1 && $pagina<=$numeroPaginas){
                $contador=$inicio+1;
                $pag_inicio=$inicio+1;
                foreach($datos as $rows){
                    $tabla.='
				<tr class="has-text-centered">
					<td>'.$contador.'</td>
					<td>'.$rows['usuario_nombre'].'</td>
					<td>'.$rows['usuario_apellido'].'</td>
					<td>'.$rows['cedula'].'</td>
					<td>'.$rows['usuario_email'].'</td>
					<td>'.$rows['telefono'].'</td>
					<td>'.$rows['edad'].'</td>
					<td>'.$rows['genero'].'</td>
					<td>'.$rows['sintomas'].'</td>


					<td>'.date("d-m-Y h:i:s A",strtotime($rows['usuario_creado'])).'</td>					
	                <td>
	                    <a href="'.APP_URL.'userUpdate/'.$rows['usuario_id'].'/" class="button is-success is-rounded is-small">Actualizar</a>
	                </td>
	                <td>
	                	<form class="FormularioAjax" action="'.APP_URL.'app/ajax/usuarioAjax.php" method="POST" autocomplete="off">

	                		<input type="hidden" name="modulo_usuario" value="eliminar">
	                		<input type="hidden" name="usuario_id" value="'.$rows['usuario_id'].'">

	                    	<button type="submit" class="button is-danger is-rounded is-small">Eliminar</button>
	                    </form>
	                </td>
				</tr>

                    ';
                    $contador++;
                }
                $pag_final=$contador-1;
            }else{
                if($total>=1){
                    $tabla.='    
                <tr class="has-text-centered" >
	                <td colspan="7">
	                    <a href="'.$url.'1/" class="button is-link is-rounded is-small mt-4 mb-4">
	                        Haga clic acá para recargar el listado
	                    </a>
	                </td>
	            </tr>';                
            }else{
                $tabla.='
                <tr class="has-text-centered" >
	                <td colspan="7">
	                    No hay registros en el sistema
	                </td>
	            </tr>
                ';
                }
            }

            $tabla.='
            	</tbody></table></div>';
                if($total>=1 && $pagina<=$numeroPaginas){
                    $tabla.='
	<p class="has-text-right">Mostrando usuarios <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>
                    ';    
                $tabla.=$this->paginadorTablas($pagina,$numeroPaginas,$url,8);            
            }
            return $tabla;
        }
        
        # Programando controlador para eliminar un usuario
            public function eliminarUsuarioControlador(){
                $id=$this->limpiarCadena($_POST['usuario_id']);

                if($id==1){
                    $alerta=[
                        "tipo"=>"simple",
                        "titulo"=>"OCURRIO UN ERROR INESPERADO",
                        "texto"=>"No podemos eliminar el usuario principal del sistema",
                        "icono"=>"error"
                    ];
                return json_encode($alerta);
                exit();
                }
                # Verificando usuario #
                $datos=$this->ejecutarConsulta("SELECT * FROM usuario WHERE usuario_id='$id'");
                if($datos->rowCount()<=0){
                    $alerta=[
                        "tipo"=>"simple",
                        "titulo"=>"OCURRIO UN ERROR INESPERADO",
                        "texto"=>"No hemos encontrado el usuario en el sistema",
                        "icono"=>"error"
                    ];
                    return json_encode($alerta);
                    exit();
                }else{
                    $datos=$datos->fetch();
                }
                $eliminarUsuario=$this->eliminarRegistro("usuario","usuario_id",$id);
                
                if($eliminarUsuario->rowCount()==1){
                    if(is_file("../views/fotos/".$datos['usuario_foto'])){
                        chmod("../views/fotos/".$datos['usuario_foto'],0777);
                        unlink("../views/fotos/".$datos['usuario_foto']);
                    }
                    $alerta=[
                        "tipo"=>"recargar",
                        "titulo"=>"PACIENTE ELIMINADO",
                        "texto"=>"El PACIENTE ".$datos['usuario_nombre']."".$datos['usuario_apellido']."Se elimino Correctamente",
                        "icono"=>"success"
                    ];
                    
                }else{
                    $alerta=[
                        "tipo"=>"simple",
                        "titulo"=>"OCURRIO UN ERROR INESPERADO",
                        "texto"=>"No se PUDO ELIMINAR EL PACIENTE".$datos['usuario_nombre']."".$datos['usuario_apellido']." CORRECTAMENTE",
                        "icono"=>"error"
                    ];
                }
                return json_encode($alerta);

            }
            # Controlador para actualizar usuarios#
            public function actualizarUsuarioControlador(){
        $id = $this->limpiarCadena($_POST['usuario_id']);
        
        # Verificando usuario #
        $datos = $this->ejecutarConsulta("SELECT * FROM usuario WHERE usuario_id='$id'");
        if($datos->rowCount() <= 0){
            $alerta = [
                "tipo" => "simple",
                "titulo" => "OCURRIO UN ERROR INESPERADO",
                "texto" => "No hemos encontrado el usuario en el sistema",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        } else {
            $datos = $datos->fetch();
        }

        // $admin_usuario = $this->limpiarCadena($_POST['administrador_usuario']);
        $admin_clave = $this->limpiarCadena($_POST['administrador_clave']);

        if($admin_clave == ""){
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "No has llenado todos los campos son obligatorios, que corresponden a su USUARIO y CLAVE",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }
        
        # Verificar la integridad de los datos #
        // if($this->verificarDatos("[a-zA-Z0-9]{4,20}", $admin_usuario)){
        //     $alerta = [
        //         "tipo" => "simple",
        //         "titulo" => "Ocurrio un error inesperado",
        //         "texto" => "Su USUARIO no coincide con el formato SOLICITADO",
        //         "icono" => "error"
        //     ];
        //     return json_encode($alerta);
        //     exit();
        // }
        
        if($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}", $admin_clave)){
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "Su CLAVE no coincide con el formato SOLICITADO",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        # Verificando Administrador #
         $admin_id = $_SESSION['id']; // Asumo que guardas el ID en la sesión
    $check_admin = $this->ejecutarConsulta("SELECT usuario_clave FROM usuario WHERE usuario_id='$admin_id'");
    
    if($check_admin->rowCount() == 1){
        $check_admin = $check_admin->fetch();
        
        // Verificamos solo la clave (sin comparar usuario)
        if(!password_verify($admin_clave, $check_admin['usuario_clave'])){
            $alerta = [
                "tipo" => "simple",
                "titulo" => "OCURRIO UN ERROR INESPERADO",
                "texto" => "CLAVE de ADMINISTRADOR INCORRECTA",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }
    } else {
        $alerta = [
            "tipo" => "simple",
            "titulo" => "OCURRIO UN ERROR INESPERADO",
            "texto" => "No se pudo verificar la CLAVE de administrador",
            "icono" => "error"
        ];
        return json_encode($alerta);
        exit();
    }
        // $check_admin = $this->ejecutarConsulta("SELECT * FROM usuario WHERE usuario_usuario='$admin_usuario' AND usuario_id='".$_SESSION['id']."'");
        // if($check_admin->rowCount() <= 1){
        //     $check_admin = $check_admin->fetch();
        //     if($check_admin['usuario_usuario'] != $admin_usuario || !password_verify($admin_clave, $check_admin['usuario_clave'])){
        //         $alerta = [
        //             "tipo" => "simple",
        //             "titulo" => "OCURRIO UN ERROR INESPERADO",
        //             "texto" => "USUARIO o CLAVE de ADMINISTRADOR INCORRECTOS",
        //             "icono" => "error"
        //         ];
        //         return json_encode($alerta);
        //         exit();
        //     }
        // } else {
        //     $alerta = [
        //         "tipo" => "simple",
        //         "titulo" => "OCURRIO UN ERROR INESPERADO",
        //         "texto" => "USUARIO o CLAVE de ADMINISTRADOR INCORRECTOS",
        //         "icono" => "error"
        //     ];
        //     return json_encode($alerta);
        //     exit();
        // }
        
        # Almacenando datos #
        $nombre = $this->limpiarCadena($_POST['usuario_nombre']);
        $apellido = $this->limpiarCadena($_POST['usuario_apellido']);
        // $usuario = $this->limpiarCadena($_POST['usuario_usuario']);
        $email = $this->limpiarCadena($_POST['usuario_email']);
        // $clave1 = $this->limpiarCadena($_POST['usuario_clave_1']);
        // $clave2 = $this->limpiarCadena($_POST['usuario_clave_2']);
        
        # Campos médicos adicionales #
        $cedula = $this->limpiarCadena($_POST['cedula']);
        $telefono = $this->limpiarCadena($_POST['telefono']);
        $direccion = $this->limpiarCadena($_POST['direccion']);
        $edad = $this->limpiarCadena($_POST['edad']);
        $genero = $this->limpiarCadena($_POST['genero']);
        $sintomas = $this->limpiarCadena($_POST['sintomas']);

        # Verificando campos obligatorios #
        if($nombre == "" || $apellido == "" || $cedula == ""){
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "No has llenado todos los campos obligatorios",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }
        
        # Verificar la integridad de los datos #
        if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $nombre)){
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "El nombre no coincide con el formato solicitado",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }
        
        if($this->verificarDatos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $apellido)){
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "El apellido no coincide con el formato solicitado",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }
        
        // if($this->verificarDatos("[a-zA-Z0-9]{4,20}", $usuario)){
        //     $alerta = [
        //         "tipo" => "simple",
        //         "titulo" => "Ocurrio un error inesperado",
        //         "texto" => "El usuario no coincide con el formato solicitado",
        //         "icono" => "error"
        //     ];
        //     return json_encode($alerta);
        //     exit();
        // }
        
        # Validación de campos médicos #
        if($this->verificarDatos("[0-9]{6,20}", $cedula)){
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "La cédula debe contener solo números (6-20 dígitos)",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }
        
        if($telefono != "" && $this->verificarDatos("[0-9+]{7,15}", $telefono)){
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "El teléfono no coincide con el formato solicitado",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }
        
        if($edad != "" && ($edad < 1 || $edad > 120)){
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "La edad debe estar entre 1 y 120 años",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }
        
        if($genero != "" && !in_array($genero, ['Masculino', 'Femenino'])){
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "El género seleccionado no es válido",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }
        
        # Verificando Email #
        if($email != "" && $datos['usuario_email']){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $check_email = $this->ejecutarConsulta("SELECT usuario_email FROM usuario WHERE usuario_email='$email'");
                if($check_email->rowCount() > 0){
                    $alerta = [
                        "tipo" => "simple",
                        "titulo" => "Ocurrio un error inesperado",
                        "texto" => "El CORREO ELECTRONICO que acaba de ingresar ya existe!",
                        "icono" => "error"
                    ];
                    return json_encode($alerta);
                    exit();
                }
            } else {
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrio un error inesperado",
                    "texto" => "Ha ingresado un CORREO ELECTRONICO no valido",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }
        }
        
        # Verificando Claves #
        // if($clave1 != "" || $clave2 != ""){
        //     if($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}", $clave1) || $this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}", $clave2)){
        //         $alerta = [
        //             "tipo" => "simple",
        //             "titulo" => "Ocurrio un error inesperado",
        //             "texto" => "Las CLAVES no coinciden con el formato solicitado",
        //             "icono" => "error"
        //         ];
        //         return json_encode($alerta);
        //         exit();
        //     } else {
        //         if($clave1 != $clave2){
        //             $alerta = [
        //                 "tipo" => "simple",
        //                 "titulo" => "Ocurrio un error inesperado",
        //                 "texto" => "Las CLAVES no coinciden",
        //                 "icono" => "error"
        //             ];
        //             return json_encode($alerta);
        //             exit();
        //         } else {
        //             $clave = password_hash($clave1, PASSWORD_BCRYPT, ["cost" => 10]);
        //         }
        //     }
        // } else {
        //     $clave = $datos['usuario_clave'];
        // }
        
        # Verificando usuario #
        // if($datos['usuario_usuario'] != $usuario){
        //     $check_usuario = $this->ejecutarConsulta("SELECT usuario_usuario FROM usuario WHERE usuario_usuario='$usuario'");
        //     if($check_usuario->rowCount() > 0){
        //         $alerta = [
        //             "tipo" => "simple",
        //             "titulo" => "Ocurrio un error inesperado",
        //             "texto" => "El USUARIO que acaba de ingresar ya existe!",
        //             "icono" => "error"
        //         ];
        //         return json_encode($alerta);
        //         exit();
        //     }
        // }
        
        # Verificando cédula única #
        if($datos['cedula'] != $cedula){
            $check_cedula = $this->ejecutarConsulta("SELECT cedula FROM usuario WHERE cedula='$cedula'");
            if($check_cedula->rowCount() > 0){
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrio un error inesperado",
                    "texto" => "La CÉDULA que acaba de ingresar ya existe!",
                    "icono" => "error"
                ];
                return json_encode($alerta);
                exit();
            }
        }
        $clave = $datos['usuario_clave'];

        
        # Preparando datos para actualizar #
        $usuario_datos_up = [
            [
                "campo_nombre" => "usuario_nombre",
                "campo_marcador" => ":Nombre",
                "campo_valor" => $nombre,
            ],
            [
                "campo_nombre" => "usuario_apellido",
                "campo_marcador" => ":Apellido",
                "campo_valor" => $apellido,
            ],
            [
                "campo_nombre" => "usuario_email",
                "campo_marcador" => ":Email",
                "campo_valor" => $email,
            ],
            // [
            //     "campo_nombre" => "usuario_usuario",
            //     "campo_marcador" => ":Usuario",
            //     "campo_valor" => $usuario,
            // ],
            
            [
                "campo_nombre" => "cedula",
                "campo_marcador" => ":Cedula",
                "campo_valor" => $cedula,
            ],
            [
                "campo_nombre" => "telefono",
                "campo_marcador" => ":Telefono",
                "campo_valor" => $telefono,
            ],
            [
                "campo_nombre" => "direccion",
                "campo_marcador" => ":Direccion",
                "campo_valor" => $direccion,
            ],
            [
                "campo_nombre" => "edad",
                "campo_marcador" => ":Edad",
                "campo_valor" => $edad,
            ],
            [
                "campo_nombre" => "genero",
                "campo_marcador" => ":Genero",
                "campo_valor" => $genero,
            ],
            [
                "campo_nombre" => "sintomas",
                "campo_marcador" => ":Sintomas",
                "campo_valor" => $sintomas,
            ],
            [
                "campo_nombre" => "usuario_actualizado",
                "campo_marcador" => ":Actualizado",
                "campo_valor" => date("Y-m-d H:i:s"),
            ],
        ];
        
        $condicion = [
            "condicion_campo" => "usuario_id",
            "condicion_marcador" => ":ID",
            "condicion_valor" => $id,
        ];

        if($this->actualizarDatos("usuario", $usuario_datos_up, $condicion)){
            if($id == $_SESSION['id']){
                $_SESSION['nombre'] = $nombre;
                $_SESSION['apellido'] = $apellido;
                // $_SESSION['usuario'] = $usuario;
            }
            $alerta = [
                "tipo" => "limpiar",
                "titulo" => "PACIENTE ACTUALIZADO",
                "texto" => "El PACIENTE ".$datos['usuario_nombre']." ".$datos['usuario_apellido']." ha sido ACTUALIZADO CORRECTAMENTE",
                "icono" => "success"
            ];
        } else {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "ERROR AL ACTUALIZAR",
                "texto" => "No se pudo ACTUALIZAR el PACIENTE, por favor intente nuevamente",
                "icono" => "error"
            ];
        }
        return json_encode($alerta);

        }
    }