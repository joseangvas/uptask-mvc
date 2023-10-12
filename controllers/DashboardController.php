<?php

namespace Controllers;

use Model\Proyecto;
use MVC\Router;

class DashboardController {
  public static function index(router $router) {
    session_start();
    isAuth();
    

    $router->render('dashboard/index', [
      'titulo' => 'Proyectos'
    ]);
  }


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


  public static function perfil(Router $router) {
    session_start();
    isAuth();

    $router->render('dashboard/perfil', [
      'titulo' => 'Perfil'
    ]);
  }
}