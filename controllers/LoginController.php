<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
  public static function login(Router $router) {
 
    if($_SERVER['REQUEST_METHOD'] === 'POST') {


    }

    // Render a la Vista
    $router->render('auth/login', [
      'titulo' => 'Iniciar Sesión'
    ]);
  }


  public static function logout() {
    echo "Desde Logout";


  }

  //* CREAR USUARIO EN UPTASK
  public static function crear(Router $router) {
    $alertas = [];
    $usuario = new Usuario;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $usuario->sincronizar($_POST);
      $alertas = $usuario->validarNuevaCuenta();

      if(empty($alertas)) {
        $existeUsuario = Usuario::where('email', $usuario->email);

        if($existeUsuario) {
          Usuario::setAlerta('error', 'El Usuario ya está Registrado');
          $alertas = Usuario::getAlertas();
        } else {
          // Hashear el Password
          $usuario->hashPassword();

          // Eliminar password2
          unset($usuario->password2);

          // Generar el Token Unico
          $usuario->crearToken();

          // Crear un Nuevo Usuario
          $resultado = $usuario->guardar();

          // Enviar el Email de Confirmación
          $email = new Email($usuario->email, $usuario->nombre, $usuario->token);

          $email->enviarConfirmacion();

          if($resultado) {
            header('Location: /mensaje');
          }
        }
      }
    }

    // Render a la Vista
    $router->render('auth/crear', [
      'titulo' => 'Crear tu Cuenta en UpTask',
      'usuario' => $usuario,
      'alertas' => $alertas
    ]);
  }


  //*****  CUANDO EL USUARIO OLVIDO SU PASSWORD  ******//
  public static function olvide(Router $router) {


    if($_SERVER['REQUEST_METHOD'] === 'POST') {

    }

    // Muestra la Vista
    $router->render('auth/olvide', [
      'titulo' => 'Olvidé mi Password'
    ]);
  }


  //* REESTABLER EL PASSWORD CUANDO ES OLVIDADO POR EL USUARIO
  public static function reestablecer(Router $router) {
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

    }

    // Muestra la Vista
    $router->render('auth/reestablecer', [
      'titulo' => 'Reestablecer Contraseña'
    ]);
  }


  public static function mensaje(Router $router) {
    
    $router->render('auth/mensaje', [
      'titulo' => 'Cuenta Creada Exitosamente'
    ]);
  }


  public static function confirmar(Router $router) {
    
    $router->render('auth/confirmar', [
      'titulo' => "Confirme su cuenta UpTask",
    ]);
  }
}