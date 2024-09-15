<?php
require_once("templates/header.php");
require_once("dao/UserDao.php");

$userDao = new UserDao($connection, $BASE_URL);

$userData = $userDao->verifyToken(true);
?>
<div class="container-fluid" id="main-container">
  
  <h3 style="margin-top:140px;  color:white;">Edição de perfil</h3>
</div>
<?php
require_once("templates/footoer.php");
?>
