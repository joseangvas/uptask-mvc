<?php

namespace Model;

class Tarea extends ActiveRecord {
  protected static $tabla = 'tareas';
  protected static $columnasDB = ['id', 'nombre', 'tiempo', 'estado', 'proyectoId'];

  public $id;
  public $nombre;
  public $tiempo;
  public $estado;
  public $proyectoId;

  public function __construct($args = []) {

    $this->id = $args['id'] ?? null;
    $this->nombre = $args['nombre'] ?? '';
    $this->tiempo = $args['tiempo'] ?? '';
    $this->estado = $args['estado'] ?? 0;
    $this->proyectoId = $args['proyectoId'] ?? '';
  }
}