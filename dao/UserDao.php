<?php

require_once "models/User.php";
require_once "models/Message.php";

class UserDao implements UserDAOInterface
{

  private $connection;
  private $url;
  private $message;

  public function __construct(PDO $connection, $url)
  {
    $this->connection = $connection;
    $this->url = $url;
    $this->message = new Message($url);
  }

  public function buildUser($data)
  {
    $user = new User();

    $user->user_name = $data["user_name"];
    $user->last_name = $data["user_lastname"];
    $user->user_email = $data["user_email"];
    $user->user_bio = $data["user_bio"];
    $user->user_password = $data["user_password"];
    $user->user_photo = $data["user_photo"];
    $user->user_token = $data["user_token"];

    return $user;
  }

  public function create(User $user, $authUser = false)
  {
    $stmt = $this->connection->prepare("insert into users(
    user_name, user_lastname, user_email, user_bio, user_password, user_token
    ) values (
      :user_name, :user_lastname, :user_email, :user_bio, :user_password, :user_token 
    ) ");

    $stmt->bindParam(":user_name", $user->user_name);
    $stmt->bindParam(":user_lastname", $user->last_name);
    $stmt->bindParam(":user_email", $user->user_email);
    $stmt->bindParam(":user_bio", $user->user_bio);
    $stmt->bindParam(":user_password", $user->user_password);
    $stmt->bindParam(":user_token", $user->user_token);

    $stmt->execute();

    if ($authUser) {
      return  $this->setTokenToSession($user->user_token);
    }
  }

  public function update(User $user) {}

  public function verifyToken($protected = false)
  {

    //verificando se existe token na sessão;

    if (!empty($_SESSION["token"])) {
      //pega token da session e verifica se é valido
      $token = $_SESSION["token"];

      $user = $this->findByToken($token);

      if ($user) {
        return $user;
      } else {
        $this->message->setMessage("Faça login para acessar esta pagina", "error", "index.php");
      }
    } else {
      return "teste";
    }
  }

  public function setTokenToSession($token, $redirect = true)
  {
    $_SESSION["token"] = $token;

    if ($redirect) {
      //redireciona o para a pagina do perfil.
      $this->message->setMessage("Seja bem vindo", "success", "edit_profile.php");
    }
  }
  public function authenticateUser($email, $password) {}
  public function findByEmail($email)
  {
    $stmt = $this->connection->prepare("SELECT * FROM users WHERE user_email = :email");
    $stmt->bindParam(":email", $email);

    $stmt->execute();


    if ($stmt->rowCount() > 0) {
      //peogando usuarios
      $data = $stmt->fetch();
      $user = $this->buildUser($data);
      return $user;
    } else {
      return false;
    }
  }

  public function findByToken($token)
  {
    $stmt = $this->connection->prepare("SELECT * FROM users WHERE user_token = :token");
    $stmt->bindParam(":token", $token);

    $stmt->execute();


    if ($stmt->rowCount() > 0) {
      //peogando usuarios
      $data = $stmt->fetch();
      $user = $this->buildUser($data);
      return $user;
    } else {
      return false;
    }
  }

  public function findById($id) {}

  public function changePassword(User $user) {}
}
