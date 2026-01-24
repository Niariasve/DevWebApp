<?php

namespace Controllers;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Model\Ponente;
use MVC\Router;

class PonentesController
{

  public static function index(Router $router)
  {
    $ponentes = Ponente::all();

    $router->render('admin/ponentes/index', [
      'titulo' => 'Ponentes / Conferencistas',
      'ponentes' => $ponentes,
    ]);
  }

  public static function crear(Router $router)
  {
    $alertas = [];

    $ponente = new Ponente;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (!empty($_FILES['imagen']['tmp_name'])) {
        $carpeta_imagenes = '../public/img/speakers';

        if (!is_dir($carpeta_imagenes)) mkdir($carpeta_imagenes, 0755, true);

        // $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('png', 80);
        // $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 800)->encode('webp', 80);
        $manager = new ImageManager(new Driver);

        $imagen_png = $manager->read($_FILES['imagen']['tmp_name'])->resize(800, 800)->toPng(80);
        $imagen_webp = $manager->read($_FILES['imagen']['tmp_name'])->resize(800, 800)->toWebp(80);
        // $imagen_avif = $manager->read($_FILES['imagen']['tmp_name'])->resize(800, 800)->toAvif(80);

        $nombre_imagen = md5(uniqid(rand(), true));

        $_POST['imagen'] = $nombre_imagen;
      }

      $ponente->sincronizar($_POST);

      $alertas = $ponente->validar();

      if (empty($alertas)) {
        $ponente->redes = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);

        $imagen_png->save($carpeta_imagenes . "/$nombre_imagen.png");
        $imagen_webp->save($carpeta_imagenes . "/$nombre_imagen.webp");
        // $imagen_avif->save($carpeta_imagenes . "/$nombre_imagen.avif");

        $resultado = $ponente->guardar();
        if ($resultado) {
          header('Location: /admin/ponentes');
        }
      }
    }

    $router->render('admin/ponentes/crear', [
      'titulo' => 'Registrar Ponente',
      'alertas' => $alertas,
      'ponente' => $ponente,
    ]);
  }

  public static function editar(Router $router)
  {
    $alertas = [];
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    if (!$id || !$ponente = Ponente::find($id)) {
      header('Location: /admin/ponentes');
    }

    $ponente->redes = (array) json_decode($ponente->redes);
    $imagen_actual = $ponente->imagen;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (!empty($_FILES['imagen']['tmp_name'])) {
        $carpeta_imagenes = '../public/img/speakers';

        if (!is_dir($carpeta_imagenes)) mkdir($carpeta_imagenes, 0755, true);

        $manager = new ImageManager(new Driver);

        $imagen_png = $manager->read($_FILES['imagen']['tmp_name'])->resize(800, 800)->toPng(80);
        $imagen_webp = $manager->read($_FILES['imagen']['tmp_name'])->resize(800, 800)->toWebp(80);

        $nombre_imagen = md5(uniqid(rand(), true));

        $_POST['imagen'] = $nombre_imagen;
      } else {
        $_POST['imagen'] = $imagen_actual;
      }

      $ponente->sincronizar($_POST);

      $alertas = $ponente->validar();
      if (empty($alertas)) {
        $ponente->redes = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);

        if (isset($nombre_imagen)) {
          $imagen_png->save($carpeta_imagenes . "/$nombre_imagen.png");
          $imagen_webp->save($carpeta_imagenes . "/$nombre_imagen.webp");
        }

        $resultado = $ponente->guardar();
        if ($resultado) header('Location: /admin/ponentes');
      }
    }

    $router->render('admin/ponentes/editar', [
      'titulo' => 'Actualizar Ponente',
      'alertas' => $alertas,
      'ponente' => $ponente,
    ]);
  }

  public static function eliminar() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $id = $_POST['id'];
      $ponente = Ponente::find($id);

      if (!$ponente) header('Location: /admin/ponentes');

      $resultado = $ponente->eliminar();
      $texto_resultado = $resultado ? 'success' : 'error';
      header("Location: /admin/ponentes?mensaje=$texto_resultado");
    }
  }
}
