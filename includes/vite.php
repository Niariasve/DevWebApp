<?php

function vite_asset(string $entry)
{
  static $manifest = null;

  // --DEV MODE--
  if (!empty($_ENV['VITE_DEV'] && $_ENV['VITE_DEV'] == "true")) {
    return "http://localhost:5173/$entry";
  }

  // --PROD MODE--
  if ($manifest === null) {
    $manifestPath = __DIR__ . '/../public/build/.vite/manifest.json';

    if (!file_exists($manifestPath)) {
      throw new Exception('Manifest not found. Run vite vuild');
    }

    $manifest = json_decode(file_get_contents($manifestPath), true);
  }

  if (!isset($manifest[$entry])) {
    throw new Exception("Asset missing: $entry");
  }

  return '/build/' . $manifest[$entry]['file'];
}

function vite_css()
{
  if (!empty($_ENV['VITE_DEV'] && $_ENV['VITE_DEV'] == "true")) {
    return null;
  }

  static $manifest = null;

  if ($manifest === null) {
    $manifestPath = __DIR__ . '/../public/build/.vite/manifest.json';

    if (!file_exists($manifestPath)) {
      throw new Exception('Manifest not found. Run vite vuild');
    }

    $manifest = json_decode(file_get_contents($manifestPath), true);
  }

  $css = $manifest['src/js/app.js']['css'][0] ?? null;

  return $css ? "/build/$css" : null;
}
