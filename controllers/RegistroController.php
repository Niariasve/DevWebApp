<?php

namespace Controllers;

use Model\Paquete;
use Model\Registro;
use Model\Usuario;
use MVC\Router;

class RegistroController
{

  public static function crear(Router $router)
  {

    $router->render('registro/crear', [
      'titulo' => 'Finalizar registro',
    ]);
  }

  public static function boleto(Router $router) {

    $id = s($_GET['id']);

    if (!$id || strlen($id) != 8 || !$registro = Registro::where('token', $id)) {
      header('Location: /');
      exit;
    }

    $usuario = Usuario::find($registro->usuario_id);
    $paquete = Paquete::find($registro->paquete_id);

    $router->render('registro/boleto', [
      'titulo' => 'Asistencia a DevWebCamp',
    ]);
  }

  public static function gratis()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (!is_auth()) {
        header('Location: /login');
        exit;
      }

      $token = substr(md5(uniqid(rand(), true)), 0, 8);

      // Crear Registro
      $datos = array(
        'paquete_id' => 3,
        'pago_id' => '',
        'token' => $token,
        'usuario_id' => $_SESSION['id']
      );

      $registro = new Registro($datos);
      $resultado = $registro->guardar();

      if ($resultado) {
        header('Location: /boleto?id=' . urlencode($registro->token));
        exit;
      }
    }
  }
}
