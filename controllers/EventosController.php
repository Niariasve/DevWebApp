<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\Hora;
use MVC\Router;

class EventosController {
  
  public static function index(Router $router) {
    $pagina_actual = filter_var($_GET['page'], FILTER_VALIDATE_INT);
    $registros_por_pagina = 10;
    $total_registros = Evento::total();

    if (!$pagina_actual || $pagina_actual < 1 || $total_registros < $pagina_actual) 
      header('Location: /admin/eventos?page=1');

    $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registros);

    $eventos = Evento::paginar($registros_por_pagina, $paginacion->offset());

    $router->render('admin/eventos/index', [
      'titulo' => 'Conferencias y Workshops',
      'eventos' => $eventos,
      'paginacion' => $paginacion->paginacion(),
    ]);
  }

  public static function crear(Router $router) {
    $alertas = [];

    $categorias = Categoria::all('ASC');
    $dias = Dia::all('ASC');
    $horas = Hora::all('ASC');

    $evento = new Evento();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $evento->sincronizar($_POST);
      $alertas = $evento->validar();

      // dd($evento);

      if (empty($alertas)) {
        $resultado = $evento->guardar();
        if ($resultado) header('Location: /admin/eventos');
      }
    }

    $router->render('admin/eventos/crear', [
      'titulo' => 'Registrar Evento', 
      'alertas' => $alertas,
      'categorias' => $categorias,
      'dias' => $dias,
      'horas' => $horas,
      'evento' => $evento,
    ]);
  }
}