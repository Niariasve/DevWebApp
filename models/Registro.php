<?php

namespace Model;

class Registro extends ActiveRecord {
  protected static $tabla = 'registros';
  protected static $columnasDB = ['id', 'paquete_id', 'pago', 'token', 'usuario_id'];

  public $id;
  public $paquete_id;
  public $pago;
  public $token;
  public $usuario_id;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->paquete_id = $args['paquete_id'] ?? '';
    $this->pago = $args['pago'] ?? '';
    $this->token = $args['token'] ?? '';
    $this->usuario_id = $args['usuario_id'] ?? '';

  }
}