<?php

namespace Model;

class Usuario extends ActiveRecord {
  protected static $tabla = 'usuarios';
  protected static $columnasDB = ['id', 'nombre', 'email', 'password', 'token', 'confirmado'];

  public $id;
  public $nombre;
  public $email;
  public $password;
  public $password_actual;
  public $password_nuevo;
  public $token;
  public $confirmado;

  //* Función Constructora de los Datos de la Tabla
  public function __construct($args = []) {
    $this->id = $args['id'] ?? null;
    $this->nombre = $args['nombre'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->password2 = $args['password2'] ?? '';
    $this->password_actual = $args['password_actual'] ?? '';
    $this->password_nuevo = $args['password_nuevo'] ?? '';
    $this->token = $args['token'] ?? '';
    $this->confirmado = $args['confirmado'] ?? 0;
  }


  //* Validar el Login de Usuarios
  public function validarLogin() : array {
    if(!$this->email) {
      self::$alertas['error'][] = 'El Email del Usuario es Obligatorio';
    }

    if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {  // Valida si el Email es Válido
      self::$alertas['error'][] = 'El Email No es Válido';
    }

    if(!$this->password) {
      self::$alertas['error'][] = 'El Password No puede ir Vacío';
    }

    return self::$alertas;
  }


  //* Validación para Cuentas Nuevas
  public function validarNuevaCuenta() : array {
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

  //* Valida un Email
  public function validarEmail() : array {
    if(!$this->email) {
      self::$alertas['error'][] = 'El Email es Obligatorio';
    }
    
    if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {  // Valida si el Email es Válido
      self::$alertas['error'][] = 'El Email No es Válido';
    }

    return self::$alertas;
  }

  //* Validar el Password
  public function validarPassword() : array {
    if(!$this->password) {
      self::$alertas['error'][] = 'El Password No puede ir Vacío';
    }

    if(strlen($this->password) < 6) {
      self::$alertas['error'][] = 'El Password No puede Tener Menos de 6 Caracteres';
    }

    return self::$alertas;
  }


  public function validar_perfil() : array {
    if(!$this->nombre) {
      self::$alertas['error'][] = 'El Nombre es Obligatorio';
    }
    if(!$this->email) {
      self::$alertas['error'][] = 'El Email es Obligatorio';
    }
    
    return self::$alertas;
  }


  public function nuevo_password() : array {
    if(!$this->password_actual) {
      self::$alertas['error'][] = 'El Password Actual No puede ir Vacío';
    }

    if(!$this->password_nuevo) {
      self::$alertas['error'][] = 'El Password Nuevo No puede ir Vacío';
    }
    
    if(strlen($this->password_nuevo) < 6) {
      self::$alertas['error'][] = 'El Password debe Contener al Menos 6 Caracteres';
    }

    return self::$alertas;
  }

  // Comprobar el Pasword
  public function comprobar_password() : bool {
    return password_verify($this->password_actual, $this->password);
  }


  //* Hashear el Password
  public function hashPassword() : void {
    $this->password = password_hash($this->password, PASSWORD_BCRYPT);
  }


  //* Generar un Token
  public function crearToken() : void {
    $this->token = uniqid();  // = md5(uniqid()): más avanzado BD + grandes
  }
}