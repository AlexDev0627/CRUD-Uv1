<?php 
    namespace app\controllers;
    use app\models\mainModel;

    class loginController extends mainModel{

        # Controlador para inicio de Sesion #
        public function iniciarSesionControlador(){
            # Almacenando Datos #
            $usuario=$this->limpiarCadena($_POST['login_usuario']);
            $clave=$this->limpiarCadena($_POST['login_clave']);

              # Verificando campos obligatorios #
              if($usuario=="" || $clave=="" ){
                echo"
                <script>
	              Swal.fire({
                    icon: 'error',
                    title: 'Ocurrio un error inesperado',
                    text: 'No has llenado todos los campos obligatorios',
                    confirmButtonText: 'Aceptar'
                    });
                  </script>
                  ";

              }else{

                # Verificando la integridad de los datos #
                if($this->verificarDatos("[a-zA-Z0-9]{4,20}",$usuario)){
                  echo"
                  <script>
                  Swal.fire({
                      icon: 'error',
                      title: 'Ocurrio un error inesperado',
                      text: 'El USUARIO no COINCIDE con el FORMATO solicitado',
                      confirmButtonText: 'Aceptar'
                      });
                    </script>
                    ";
                }else{

                    if($this->verificarDatos("[a-zA-Z0-9$@.-]{7,100}",$clave)){
                      echo"
                      <script>
                      Swal.fire({
                          icon: 'error',
                          title: 'Ocurrio un error inesperado',
                          text: 'LA CLAVE no COINCIDE con el FORMATO solicitado',
                          confirmButtonText: 'Aceptar'
                          });
                        </script>
                        ";
                    }else{

                    }
                }
              }
        }
    }