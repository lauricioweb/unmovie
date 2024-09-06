<?php

class User
{
  public $user_id;
  public $user_name;
  public $last_name;
  public $user_email;
  public $user_password;
  public $user_photo;
  public $user_bio;
  public $user_token;


  public function generateToken()
  {
    return bin2hex(random_bytes(6));
  }
}


interface UserDAOInterface
{
  public function buildUser($data);
  public function create(User $user, $authUser = false);
  public function update(User $user);
  public function verifyToken($protected = false);
  public function setTokenToSession($token, $redirect = true);
  public function authenticateUser($email, $password);
  public function findByEmail($email);
  public function findByToken($token);
  public function findById($id);
  public function changePassword(User $user);
}
