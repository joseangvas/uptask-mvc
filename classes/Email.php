<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email {
  public $nombre;
  public $email;
  public $token;

  public function __construct($nombre, $email, $token) {
    $this->nombre = $nombre;
    $this->email = $email;
    $this->token = $token;
  }

  public function enviarConfirmacion() {
    try {
      // Crear el Objeto de Email
      $mail = new PHPMailer();
      $mail->isSMTP();
      $mail->Host = $_ENV['EMAIL_HOST'];
      $mail->SMTPAuth = true;
      $mail->Port = $_ENV['EMAIL_PORT'];
      $mail->Username = $_ENV['EMAIL_USER'];
      $mail->Password = $_ENV['EMAIL_PASS'];

      
    } catch (Exception $e) {
      echo 'El Email No pudo ser Enviado. ' . $mail->ErrorInfo;
    }
  }
}