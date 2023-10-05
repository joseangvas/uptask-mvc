<?php

namespace Controllers;

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