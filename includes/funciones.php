<?php

function dd($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function paginaActual($path) : bool {
    return str_contains($_SERVER["PATH_INFO"] ?? '', $path);
}

function ensure_session_active(): void {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function is_auth() : bool {
    ensure_session_active();
    return isset($_SESSION['nombre']) && !empty($_SESSION);
}

function is_admin(): bool {
    ensure_session_active();
    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}

function user_auth() {
    if (!is_auth()) {
        header('Location: /login');
        exit;
    }
}

function admin_auth() {
    if (!is_auth()) {
        header('Location: /login');
        exit;
    }

    if (!is_admin()) {
        header('Location: /');
        exit;
    }
}