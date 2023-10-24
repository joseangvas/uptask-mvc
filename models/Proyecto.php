<?php

namespace Model;
use Model\ActiveRecord;
class Proyecto extends ActiveRecord {
  protected static $tabla = 'proyectos';
  protected static $columnasDB = ['id', 'proyecto', 'url', 'propietarioId'];

  public $id;
  public $proyecto;
  public $url;
  public $propietarioId;
  
  //* Función Constructora de la Tabla
  public function __construct($args = []) {
    $this->id = $args['id'] ?? null;
    $this->proyecto = $args['proyecto'] ?? '';
    $this->url = $args['url'] ?? '';
    $this->propietarioId = $args['propietarioId'] ?? '';
  }

  //* Validar el Ingreso del Nombre del Proyecto
  public function validarProyecto() {
    if(!$this->proyecto) {
      self::$alertas['error'][] = 'El Nombre del Proyecto es Obligatorio';
    }

    return self::$alertas;
  }
}