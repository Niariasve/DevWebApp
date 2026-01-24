<?php

namespace Classes;

class Paginacion {
  public $pagina_actual;
  public $registro_por_pagina;
  public $total_registros;

  public function __construct($pagina_actual = 1, $registro_por_pagina = 10, $total_registros = 0)
  {
    $this->pagina_actual = (int) $pagina_actual;
    $this->registro_por_pagina = (int) $registro_por_pagina;
    $this->total_registros = (int) $total_registros;
  }

  public function offset() {
    return $this->registro_por_pagina * ($this->pagina_actual - 1);
  }

  public function totalPaginas() {
    return ceil($this->total_registros / $this->registro_por_pagina);
  }

  public function paginaAnterior() {
    $anterior = $this->pagina_actual - 1;
    return $anterior > 0 ? $anterior : false; 
  }

  public function paginaSiguiente() {
    $siguiente = $this->pagina_actual + 1;
    return $siguiente <= $this->totalPaginas() ? $siguiente : false;
  }
}