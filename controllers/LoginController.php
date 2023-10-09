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
    $alertas = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $usuario = new Usuario($_POST);
      $alertas = $usuario->validarEmail();

      if(empty($alertas)) {
        // Buscar el Usuario
        $usuario = Usuario::where('email', $usuario->email);

        if($usuario && $usuario->confirmado) {
          unset($usuario->password2);

          // Se ha Encontrado el Usuario
          // Generar el Token para Restablecer Contraseña
          $usuario->crearToken();

          // Actualizar el Usuario
          $usuario->guardar();

          // Enviar el Email
          $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
          $email->enviarInstrucciones();

          // Imprimir la Alerta
          Usuario::setAlerta('exito', 'Hemos Enviado las Instrucciones a tu Email');

        } else {
          // No se encuentra Registrado el Usuario
          Usuario::setAlerta('error', 'El Usuario No Existe o No está Confirmado');
        }
      }
    }

    $alertas = Usuario::getAlertas();

    // Muestra la Vista
    $router->render('auth/olvide', [
      'titulo' => 'Olvidé mi Password',
      'alertas' => $alertas
    ]);
  }


  //* REESTABLER EL PASSWORD CUANDO ES OLVIDADO POR EL USUARIO
  public static function reestablecer(Router $router) {
    $token = s($_GET['token']);
    $mostrar = true;

    if(!$token) header('Location: /');

    // Identificar el Usuario con este Token
    $usuario = Usuario::where('token', $token);
    
    if(empty($usuario)) {
      Usuario::setAlerta('error', 'Token No Válido');
      $mostrar = false;
    }
    
    unset($usuario->password2);

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Añadir el Nuevo Password
      $usuario->sincronizar($_POST);

      // Validar el Password
      $alertas = $usuario->validarPassword();

      if(empty($alertas)) {
        // Hashear el password
        $usuario->hashPassword();
        
        // Eliminar token de usuario
        $usuario->token = null;

        // Guardar Datos del Usuario en la BD
        $resultado = $usuario->guardar();

        // Redireccionar
        if($resultado) {
          header('Location: /');
        }
      }
    }

    $alertas = Usuario::getAlertas();

    // Muestra la Vista
    $router->render('auth/reestablecer', [
      'titulo' => 'Reestablecer Contraseña',
      'alertas' => $alertas,
      'mostrar' => $mostrar
    ]);
  }


  public static function mensaje(Router $router) {
    
    $router->render('auth/mensaje', [
      'titulo' => 'Cuenta Creada Exitosamente'
    ]);
  }


  public static function confirmar(Router $router) {

    $token = s($_GET['token']);

    if(!$token) header('Location: /');
    
    // Encontrar al Usuario con este Token
    $usuario = Usuario::where('token', $token);

    if(empty($usuario)) {
      // No se Encontró un Usuario con ese Token
      Usuario::setAlerta('error', 'Token No Válido');
    } else {
      // confirmar la Cuenta
      $usuario->confirmado = 1;
      $usuario->token = null;
      unset($usuario->password2);

      // Guardar en la Base de Datos
      $usuario->guardar();

      Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');
    }

    $alertas = Usuario::getAlertas();

    $router->render('auth/confirmar', [
      'titulo' => "Confirme su cuenta UpTask",
      'alertas' => $alertas
    ]);
  }
}