<?php

require_once "globals.php";
require_once "database.php";
require_once "models/User.php";
require_once "models/Message.php";
require_once "dao/UserDao.php";

$message = new Message($BASE_URL);
$userDao = new UserDao($connection, $BASE_URL);
$user = new User();

//authenticação de usuario;

$type_form = filter_input(INPUT_POST, "type");

if ($type_form == "register") {
  $user_name = filter_input(INPUT_POST, "nome");
  $user_last = filter_input(INPUT_POST, "sobrenome");
  $user_email = filter_input(INPUT_POST, "email");
  $user_password = filter_input(INPUT_POST, "password");
  $user_confirm = filter_input(INPUT_POST, "confirm");


  //verificação de dados obrigatorio
  if ($user_name && $user_email && $user_password) {


    // verificando se as senhas batem
    if ($user_password != $user_confirm) {

      $message->setMessage("as senhas devem ser iguais", "error", "back");
    } else {

      // verificando se email ja esta sendo usado;
      if ($userDao->findByEmail($user_email) === false) {
        $token = $user->generateToken();
        $finalPassword = password_hash($user_password, PASSWORD_DEFAULT);

        //preparando usuario para a inserção

        $user =  new User();
        $user->user_name = $user_name;
        $user->user_email = $user_email;
        $user->last_name = $user_last;
        $user->user_password = $finalPassword;
        $user->user_token = $token;

        $auth = true;

        $result = $userDao->create($user, $auth);
      } else {
        $message->setMessage("email ja esta sendo usado ", "error", "back");
      }
    }
  } else {
    // msg de erros
    $message->setMessage("preencha todos os campos", "error", "back");
  }
} else {
  //login do usuario
}
