<?php

namespace Controllers;

use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\Hora;
use Model\Ponente;
use MVC\Router;

class PaginasController
{

  public static function index(Router $router)
  {
    $eventos = Evento::ordernar('hora_id', 'ASC');

    Evento::preload(Categoria::class, array_column($eventos, 'categoria_id'));
    Evento::preload(Dia::class, array_column($eventos, 'dia_id'));
    Evento::preload(Hora::class, array_column($eventos, 'hora_id'));
    Evento::preload(Ponente::class, array_column($eventos, 'ponente_id'));

    $eventos_formateados = [];
    foreach ($eventos as $evento) {
      if ($evento->dia_id == 1 && $evento->categoria_id == 1) {
        $eventos_formateados['conferencias_v'][] = $evento;
      } else if ($evento->dia_id == 2 && $evento->categoria_id == 1) {
        $eventos_formateados['conferencias_s'][] = $evento;
      } else if ($evento->dia_id == 1 && $evento->categoria_id == 2) {
        $eventos_formateados['workshops_v'][] = $evento;
      } else if ($evento->dia_id == 2 && $evento->categoria_id == 2) {
        $eventos_formateados['workshops_s'][] = $evento;
      }
    }

    $ponentesTotal = Ponente::total();
    $conferenciasTotal = count($eventos_formateados['conferencias_v']) + count($eventos_formateados['conferencias_s']);
    $workshopsTotal = count($eventos_formateados['workshops_v']) + count($eventos_formateados['workshops_s']);

    $ponentes = Ponente::all();

    $router->render('paginas/index', [
      'titulo' => 'Inicio',
      'eventos' => $eventos_formateados,
      'ponentesTotal' => $ponentesTotal,
      'conferenciasTotal' => $conferenciasTotal,
      'workshopsTotal' => $workshopsTotal,
      'ponentes' => $ponentes,
    ]);
  }
  public static function evento(Router $router)
  {
    $router->render('paginas/devwebcamp', [
      'titulo' => 'Sobre DevWebCamp'
    ]);
  }
  public static function paquetes(Router $router)
  {
    $router->render('paginas/paquetes', [
      'titulo' => 'Paquetes'
    ]);
  }
  public static function conferencias(Router $router)
  {
    $eventos = Evento::ordernar('hora_id', 'ASC');

    Evento::preload(Categoria::class, array_column($eventos, 'categoria_id'));
    Evento::preload(Dia::class, array_column($eventos, 'dia_id'));
    Evento::preload(Hora::class, array_column($eventos, 'hora_id'));
    Evento::preload(Ponente::class, array_column($eventos, 'ponente_id'));

    $eventos_formateados = [];
    foreach ($eventos as $evento) {
      if ($evento->dia_id == 1 && $evento->categoria_id == 1) {
        $eventos_formateados['conferencias_v'][] = $evento;
      } else if ($evento->dia_id == 2 && $evento->categoria_id == 1) {
        $eventos_formateados['conferencias_s'][] = $evento;
      } else if ($evento->dia_id == 1 && $evento->categoria_id == 2) {
        $eventos_formateados['workshops_v'][] = $evento;
      } else if ($evento->dia_id == 2 && $evento->categoria_id == 2) {
        $eventos_formateados['workshops_s'][] = $evento;
      }
    }

    $router->render('paginas/conferencias', [
      'titulo' => 'Conferencias & Workshops',
      'eventos' => $eventos_formateados,
    ]);
  }
}
