<?php

namespace Controllers;

use Model\Ponente;
use MVC\Router;

class PonentesController {
  
  public static function index(Router $router) {

    $router->render('admin/ponentes/index', [
      'titulo' => 'Ponentes / Conferencistas',
    ]);
  }

  public static function crear(Router $router) {
    $alertas = [];

    $ponente = new Ponente;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (!empty($_FILES['imagen']['tmp_name'])) {
        $carpeta_imagenes = '../public/img/speakers';

        if (!is_dir($carpeta_imagenes)) mkdir($carpeta_imagenes, 0755, true);
      }

      $ponente->sincronizar($_POST);

      $alertas = $ponente->validar();
    }

    $router->render('admin/ponentes/crear', [
      'titulo' => 'Registrar Ponente',
      'alertas' => $alertas,
    ]);
  }
}