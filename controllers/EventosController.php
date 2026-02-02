<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\Hora;
use Model\Ponente;
use MVC\Router;

class EventosController
{

  public static function index(Router $router)
  {
    admin_auth();
    $pagina_actual = filter_var($_GET['page'], FILTER_VALIDATE_INT);
    $registros_por_pagina = 10;
    $total_registros = Evento::total();
    $total_paginas = max(1, ceil($total_registros / $registros_por_pagina));

    if (!$pagina_actual || $pagina_actual < 1 || $pagina_actual > $total_paginas) 
      header('Location: /admin/eventos?page=1');

    $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total_registros);

    $eventos = Evento::paginar($registros_por_pagina, $paginacion->offset());

    Evento::preload(Categoria::class, array_column($eventos, 'categoria_id'));
    Evento::preload(Dia::class, array_column($eventos, 'dia_id'));
    Evento::preload(Hora::class, array_column($eventos, 'hora_id'));
    Evento::preload(Ponente::class, array_column($eventos, 'ponente_id'));

    $router->render('admin/eventos/index', [
      'titulo' => 'Conferencias y Workshops',
      'eventos' => $eventos,
      'paginacion' => $paginacion->paginacion(),
    ]);
  }

  public static function crear(Router $router)
  {
    admin_auth();
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

  public static function editar(Router $router)
  {
    admin_auth();
    $alertas = [];

    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    if (!$id || !$evento = Evento::find($id)) {
      header('Location: /admin/eventos');
    }

    $categorias = Categoria::all('ASC');
    $dias = Dia::all('ASC');
    $horas = Hora::all('ASC');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $evento->sincronizar($_POST);
      $alertas = $evento->validar();

      // dd($evento);

      if (empty($alertas)) {
        // $resultado = $evento->guardar();
        // if ($resultado) header('Location: /admin/eventos');
      }
    }

    $router->render('admin/eventos/crear', [
      'titulo' => 'Editar Evento',
      'alertas' => $alertas,
      'categorias' => $categorias,
      'dias' => $dias,
      'horas' => $horas,
      'evento' => $evento,
    ]);
  }

  public static function eliminar()
  {
    admin_auth();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $id = $_POST['id'];
      $evento = Evento::find($id);
      $page = $_GET['page'] ?? 1;

      if (!$evento) header('Location: /admin/eventos');

      $resultado = $evento->eliminar();
      $texto_resultado = $resultado ? 'success' : 'error';
      header("Location: /admin/eventos?page=$page&mensaje=$texto_resultado");
    }
  }
}
