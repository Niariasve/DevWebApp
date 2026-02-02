<?php

namespace Controllers;

use Model\Ponente;

class ApiPonentes {

  public static function index() {
    $ponentes = Ponente::all();
    echo json_encode($ponentes);
  }

  public static function ponente() {
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    if (!$id || $id < 1) {
      json_encode([]);
      return;
    }

    $ponente = Ponente::find($id);
    echo json_encode($ponente, JSON_UNESCAPED_SLASHES);
  }
}