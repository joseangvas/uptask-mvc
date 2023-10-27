<?php

namespace Controllers;

use Model\Proyecto;
use Model\Tarea;


class TareaController {
  public static function index() {
    // debuguear($_GET);  Solo para Probar la url.
    $proyectoId = $_GET['id'];
    
    if(!$proyectoId) header('Location: /dashboard');
    
    $proyecto = Proyecto::where('url', $proyectoId);

    session_start();

    if(!$proyecto || $proyecto->propietarioId !== $_SESSION['id']) header('Location: /404');

    $tareas = Tarea::belongsto('proyectoId', $proyecto->id);

    echo json_encode(['tareas' => $tareas]);
  }


  public static function crear() {

    if($_SERVER['REQUEST_METHOD'] === 'POST') {

      session_start();
      $proyectoId = $_POST['proyectoId'];
      $proyecto = Proyecto::where('url', $proyectoId);

      // Validar si los Datos de la Tarea son Válidos
      if(!$proyecto || $proyecto->propietarioId !== $_SESSION['id']) {
        $respuesta = [
          'tipo' => 'error',
          'mensaje' => 'Hubo un Error al Agregar la Tarea'
        ];

        echo json_encode($respuesta);
        return;
      }

      // Instanciar y Crear la Tarea
      $tarea = new Tarea($_POST);
      $tarea->proyectoId = $proyecto->id;
      $resultado = $tarea->guardar();
      $respuesta = [
        'tipo' => 'exito',
        'id' => $resultado['id'],
        'mensaje' => 'Tarea Creada Correctamente',
        'proyectoId' => $proyecto->id
      ];

      echo json_encode($respuesta);
    }
  }


  public static function actualizar() {

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Validar que el Proyecto Exista
      $proyecto = Proyecto::where('url', $_POST['proyectoId']);

      session_start();

      // Validar si los Datos de la Tarea son Válidos
      if(!$proyecto || $proyecto->propietarioId !== $_SESSION['id']) {
        $respuesta = [
          'tipo' => 'error',
          'mensaje' => 'Hubo un Error al Actualizar la Tarea'
        ];

        echo json_encode($respuesta);
        return;
      }

      $tarea = new Tarea($_POST);
      $tarea->proyectoId = $proyecto->id;

      // Guardar los Datos
      $resultado = $tarea->guardar();

      if($resultado) {
        $respuesta = [
          'tipo' => 'exito',
          'id' => $tarea->id,
          'proyectoId' => $proyecto->id,
          'mensaje' => 'Tarea Actualizada Correctamente'
        ];

        echo json_encode(['respuesta' => $respuesta]);
      }
    }
  }


  public static function eliminar() {

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      
    }
  }
}