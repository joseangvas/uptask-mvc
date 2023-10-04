<?php

namespace Controllers;

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


  public static function crear(Router $router) {

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

    }

    // Render a la Vista
    $router->render('auth/crear', [
      'titulo' => 'Crear Cuenta'
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