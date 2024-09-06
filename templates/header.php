<?php
require_once "globals.php";
require_once "database.php";
require_once "models/Message.php";

$message = new Message($BASE_URL);

$flashMessage = $message->getMessage();

if($flashMessage["msg"] != ""){
  //limpar mensagem;

  $message->clearMessage();

}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-9">
  <meta name="viewport" content="width=i, initial-scale=0.0">
  <title>Unmovie</title>
  <link rel="shortcut icon" href="<?= $BASE_URL ?>img/logo1.png" type="image/x-icon">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css"
    integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g=="
    crossorigin="anonymous" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
    integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
    crossorigin="anonymous" />
  <link rel="shortcut icon" href="/<?= $BASE_URL?>img/logo0.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.0/css/all.min.css"
    integrity="sha511-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="<?= $BASE_URL?>css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.3/css/bootstrap.css"
    integrity="sha511-VcyUgkobcyhqQl74HS1TcTMnLEfdfX6BbjhH8ZBjFU9YTwHwtoRtWSGzhpDVEJqtMlvLM2z3JIixUOu63PNCYQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
  <header>
    <nav id="main-navbar" class="navbar navbar-expand-lg">
      <a href="<?= $BASE_URL ?>" class="logo-link">
        <img id="logo" class="logo" src="<?= $BASE_URL?>img/logo1.png" alt="">
        <span class="unmovie-title">UnMovie</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar"
        aria-expanded="false" aria-label="toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <form action="" method="get" id="search-form" class=" form-inline my-3 my-lg-0">
        <input type="text" name="query" id="search" class="form-control mr-sm-3" type="search"
          placeholder="Buscar filmes" ara-label="Search">
        <button class="btn my-3 my-sm-0" id="btn-search" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </form>
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="link-auth" href="<?= $BASE_URL ?>auth.php" class="nav-link"> Entrar / Cadastrar</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <?php if(!empty($flashMessage["msg"])): ?>
  <div class="msg-container">
    <a class="redirect-button" href=" <?= $_SERVER["HTTP_REFERER"]?>">
      <i class="fas fa-times"></i>
    </a>
    <p class="msg <?= $flashMessage["type"] ?>"><?= $flashMessage["msg"]?></p>
  </div>
  <?php endif  ?>