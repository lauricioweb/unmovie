<?php
require_once "templates/header.php";
?>

<div class="container-fluid" id="main-container">
  <div class="col-md-12" style="height: 100%; padding-top:120px;">
    <div class="row" id="auth-row">
      <div class="col-md-4" id="login-container">
        <h3 id="my-text-color">Entrar</h3>
        <form action="<?= $BASE_URL?>auth_process.php" method="post">
          <input name="type" type="hidden" value="login">
          <div class="form-group">
            <label for="email" class="text-white">Email</label>
            <input type="email" class="form-control" name="email" id="email">
          </div>
          <div class="form-group">
            <label for="senha" class="text-white">Senha</label>
            <input type="password" class="form-control" name="password" id="password">
            <input type="submit" value="Entrar" id="my-btn" class="mt-3">
          </div>
        </form>
      </div>
      <div class="col-md-4" id="register-container">
        <h3 id="my-text-color">Criar conta</h3>
        <form action="<?= $BASE_URL ?>auth_process.php" method="post">
          <input name="type" type="hidden" value="register">
          <div class="form-group">
            <label for="nome" class="text-white">Nome</label>
            <input type="text" class="form-control" name="nome" id="nome">
          </div>
          <div class="form-group">
            <label for="sobrenome" class="text-white">Sobrenome</label>
            <input type="text" class="form-control" name="sobrenome" id="sobrenome">
          </div>
          <div class="form-group">
            <label for="email" class="text-white">Email</label>
            <input type="email" class="form-control" name="email" id="email">
          </div>
          <div class="form-group">
            <label for="senha" class="text-white">Senha</label>
            <input type="password" class="form-control" name="password" id="password">
          </div>
          <div class="form-group">
            <label for="confirm" class="text-white">Confirmar Senha</label>
            <input type="password" class="form-control" name="confirm" id="confirm">
          </div>
          <div class="form-group">
            <input type="submit" value="Entrar" id="my-btn" class="mt-3">
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php
require_once "templates/footoer.php";
?>