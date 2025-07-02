<?php
require_once __DIR__ . '/../src/config/config.php';

// Recup la page demandée dans l'URL
$page = $_GET['page'] ?? 'home';

// chemin de base vers les vues
$viewPath = __DIR__ . '/../src/view/';

// Redirection en fonction de ?page=
switch ($page) {
  case 'home':
    include $viewPath . 'home.php';
    break;

  case 'favoris':
    include $viewPath . 'favoris.php';
    break;

  case 'login':
    include $viewPath . 'login.php';
    break;
  case 'register':
    include $viewPath . 'register.php';
    break;

  case 'index':
    include $viewPath . '/../../public/index.php';
    break;

  case 'logout':
    session_start();
    session_destroy();
    header('Location: /public');
    break;

  case 'public':
    session_start();
    header('Location: /public');
    break;

  default:
    http_response_code(404);
    echo "<h1>Page introuvable</h1>";
    break;
}
