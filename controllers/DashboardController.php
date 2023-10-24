<?php

namespace Controllers;

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

    $router->render('dashboard/perfil', [
      'titulo' => 'Perfil'
    ]);
  }
}