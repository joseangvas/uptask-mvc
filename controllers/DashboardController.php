<?php

namespace Controllers;

use Model\Usuario;
use Model\Proyecto;
use MVC\Router;

class DashboardController {
  public static function index(router $router) {
    session_start();
    isAuth();
    
    $id = $_SESSION['id'];
    $proyectos = Proyecto::belongsto('propietarioId', $id);

    $router->render('dashboard/index', [
      'titulo' => 'Proyectos',
      'proyectos' => $proyectos
    ]);
  }


  //* Crear Proyectos a Realizar
  public static function crear_proyecto(Router $router) {
    session_start();
    isAuth();

    $alertas = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $proyecto = new Proyecto($_POST);

      // Validación
      $alertas = $proyecto->validarProyecto(); // llama a Método del Modelo
 
      if(empty($alertas)) {
        // Generar una URL única
        $hash = md5(uniqid());
        $proyecto->url = $hash;

        // Almacenar el Creador del Proyecto
        $proyecto->propietarioId = $_SESSION['id'];

        // Guardar el Proyecto
        $proyecto->guardar();

        // Redireccionar
        header('Location: /proyecto?id=' . $proyecto->url);
      }
    }

    $router->render('dashboard/crear-proyecto', [
      'titulo' => 'Crear Proyecto',
      'alertas' => $alertas
    ]);
  }


  //* Editar Proyectos
  public static function proyecto(Router $router) {
    session_start();
    isAuth();

    $token = $_GET['id'];

    if(!$token) header('Location: /dashboard');

    // Revisar que el Usuario es el Creador del Proyecto
    $proyecto = Proyecto::where('url', $token);

    if($proyecto->propietarioId !== $_SESSION['id']) {
      header('Location: /dashboard');
    }
    // debuguear($proyecto);

    $router->render('dashboard/proyecto', [
      'titulo' => $proyecto->proyecto
    ]);
  }


  //* Editar Perfil de Usuario
  public static function perfil(Router $router) {
    session_start();
    isAuth();

    $alertas = [];

    $usuario = Usuario::find($_SESSION['id']);

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $usuario->sincronizar($_POST);
      $alertas = $usuario->validar_perfil();

      if(empty($alertas)) {
        // Verificar que el Email Ingresado No pertenece a otro Usuario Registrado
        $existeUsuario = Usuario::where('email', $usuario->email);

        if($existeUsuario && $existeUsuario->id !== $usuario->id) {
          // Mostrar Mensaje de Error de Email Repetido
          Usuario::setAlerta('error', 'Ya Existe Usuario con este Email');
          $alertas = $usuario->getAlertas();
        } else {
          // Guardar los Datos del Usuario
          $usuario->guardar();
  
          Usuario::setAlerta('exito', 'Guardado Correctamente');
          $alertas = $usuario->getAlertas();
  
          // Asignar el Nombre Nuevo a la Barra Superior
          $_SESSION['nombre'] = $usuario->nombre;
        };
      }
    }
    
    $router->render('dashboard/perfil', [
      'titulo' => 'Mi Perfil',
      'usuario' => $usuario,
      'alertas' => $alertas
    ]);
  }


  //* Cambiar el Password del Usuario
  public static function cambiar_password(Router $router) {
    session_start();
    isAuth();

    $alertas = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $usuario = Usuario::find($_SESSION['id']);

      // Sincronizar con los Datos del Usuario
      $usuario->sincronizar($_POST);
      $alertas = $usuario->nuevo_password();

      if(empty($alertas)) {
        // Guardar los Datos del Usuario
        $resultado = $usuario->comprobar_password();

        if($resultado) {
          // Asignar el Nuevo Password
          $usuario->password = $usuario->password_nuevo;

          // Eliminar Propiedades No Necesarias
          unset($usuario->password_actual);
          unset($usuario->password_nuevo);

          // Hashear el Nuevo Password
          $usuario->hashPassword();

          // Guardar los Datos del Usuario
          $resultado = $usuario->guardar();

          if($resultado) {
            Usuario::setAlerta('exito', 'Password Guardado Correctamente');
            $alertas = $usuario->getAlertas();
          }
        } else {
          Usuario::setAlerta('error', 'Password Incorrecto');
          $alertas = $usuario->getAlertas();
        }
      }
    };

    $router->render('dashboard/cambiar-password', [
      'titulo' => 'Cambiar Password',
      'alertas' => $alertas
    ]);
  }
}