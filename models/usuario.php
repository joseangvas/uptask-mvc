<?php

namespace Model;

class Usuario extends ActiveRecord {
  protected static $tabla = 'usuarios';
  protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

  public $id;
  public $nombre;
  public $email;
  public $password;
  public $token;
  public $confirmado;

  public function __construct($args = []) {
    $this->id = $args['id'] ?? null;
    $this->nombre = $args['nombre'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->password2 = $args['password2'] ?? '';
    $this->token = $args['token'] ?? '';
    $this->confirmado = $args['confirmado'] ?? 0;
  }

  //* Validación para Cuentas Nuevas
  public function validarNuevaCuenta() {
    if(!$this->nombre) {
      self::$alertas['error'][] = 'El Nombre del Usuario es Obligatorio';
    }

    if(!$this->email) {
      self::$alertas['error'][] = 'El Email del Usuario es Obligatorio';
    }

    if(!$this->password) {
      self::$alertas['error'][] = 'El Password No puede ir Vacío';
    }

    if(strlen($this->password) < 6) {
      self::$alertas['error'][] = 'El Password No puede Tener Menos de 6 Caracteres';
    }

    if($this->password !== $this->password2) {
      self::$alertas['error'][] = 'Los Passwords Son Diferentes';
    }

    return self::$alertas;
  }

  //* Hashear el Password
  public function hashPassword() {
    $this->password = password_hash($this->password, PASSWORD_BCRYPT);
  }

  //* Generar un Token
  public function crearToken() {
    $this->token = uniqid();  // = md5(uniqid()): más avanzado BD + grandes
  }

}