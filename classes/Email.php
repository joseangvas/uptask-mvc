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
      $mail->Host = 'sandbox.smtp.mailtrap.io';
      $mail->SMTPAuth = true;
      $mail->Port = 2525;
      $mail->Username = 'f1ecf0cbfbb712';
      $mail->Password = '996cf78b53e82f';

      
    } catch (Exception $e) {
      echo 'El Email No pudo ser Enviado. ' . $mail->ErrorInfo;
    }
  }
}