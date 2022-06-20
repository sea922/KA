<?php
class Product extends Controller
{
  public function __construct()
  {
  }

  function Default()
  {
    if (isset($_SESSION['userlogin'])) {
      $user_id = $_SESSION['userlogin'][3];
    } else {
      $user_id = "";
    }

    $User = $this->model("UserModel");
    $Models = $this->model("ProductModel");
    $this->view("master2", [
      "Page" => "product",
      "ShowNameUser" => $User->ShowNameUser($user_id),
    ]);
  }

  function name($id)
  {
    if (isset($_SESSION['userlogin'])) {
      $user_id = $_SESSION['userlogin'][3];
    } else {
      $user_id = "";
    }

    $User = $this->model("UserModel");
    $Models = $this->model("ProductModel");
    $Category = $this->model("CategoryModel");
    $this->view("master2", [
      "Page" => "product",
      "ShowMenu" => $Category->ListAll(),
      "ShowNameUser" => $User->ShowNameUser($user_id),
    ]);
  }

  function list_product()
  {
    if (isset($_SESSION['userlogin'])) {
      $user_id = $_SESSION['userlogin'][3];
    } else {
      $user_id = "";
    }

    $User = $this->model("UserModel");
    $Models = $this->model("ProductModel");
    $Category = $this->model("CategoryModel");
    $this->view("master2", [
      "Page" => "list_product",
      "ShowMenu" => $Category->ListAll(),
      "ShowNameUser" => $User->ShowNameUser($user_id),
    ]);
  }
}
