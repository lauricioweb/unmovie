<?php

require_once "models/User.php";

class UserDao implements UserDAOInterface
{

  private $connection;
  private $url;

  public function __construct(PDO $connection, $url)
  {
    $this->connection = $connection;
    $this->url = $url;
  }

  public function buildUser($data)
  {
    $user = new User();

    $user->user_name = $data["user_name"];
    $user->last_name = $data["last_name"];
    $user->user_email = $data["user_email"];
    $user->user_bio = $data["user_bio"];
    $user->user_password = $data["user_password"];
    $user->user_photo = $data["user_photo"];
    $user->user_token = $data["user_token"];

    return $user;
  }

  public function create(User $user, $authUser = false) {}

  public function update(User $user) {}

  public function verifyToken($protected = false) {}

  public function setTokenToSession($token, $redirect = true) {}
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

  public function findByToken($token) {}

  public function findById($id) {}

  public function changePassword(User $user) {}
}
