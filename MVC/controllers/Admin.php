<?php
class Admin extends Controller
{
  public function __construct()
  {
  }

  function Default()
  {
    if (!isset($_SESSION['userAdmin'])) {
      header('Location: http://localhost/DuAn1/Admin/login');
    }
    $Models = $this->model("HomeModel");
    $Category = $this->model("CategoryModel");
    $Product = $this->model("ProductModel");
    $Admin = $this->model("AdminModel");
    $User = $this->model("UserModel");
    $this->view("masterAdmin", [
      "Page" => "home",
      "countCategory" => $Category->countCategory(),
      "countProduct" => $Product->countProduct(),
      "countUser" => $User->countUser(),
      "countOrder" => $Models->countOrder(),
      "countComment" => $Models->countComment(),
      "thongkeChartName" => $Admin->ThongKe(),
      "thongkeChartNum" => $Admin->ThongKe(),
      "ThongKe" => $Admin->ThongKe(),
      "ThongKeOrderName" => $Admin->ThongKeOrder(),
      "ThongKeOrderNum" => $Admin->ThongKeOrder(),
    ]);
  }


  function logout()
  {
    unset($_SESSION['userAdmin']);
    header("Location: http://localhost/DuAn1/Admin/login");
  }

  function login()
  {
    $Category = $this->model("CategoryModel");
    $this->view("masterAdmin", [
      "Page" => "login",
      "countCategory" => $Category->ListAll()
    ]);
  }

  function loginAction()
  {
    $Login = $this->model("UserModel");
    $kq = $Login->LoginAdmin();
  }

  function category()
  {
    if (!isset($_SESSION['userAdmin'])) {
      header('Location: http://localhost/DuAn1/Admin/login');
    }
    $Category = $this->model("CategoryModel");
    $this->view("masterAdmin", [
      "Page" => "category",
      "ShowCategory" => $Category->ListAll()
    ]);
  }

  function editCategory($id)
  {
    if (!isset($_SESSION['userAdmin'])) {
      header('Location: http://localhost/DuAn1/Admin/login');
    }
    $Category = $this->model("CategoryModel");
    $Category->checkid($id);
    $this->view("masterAdmin", [
      "Page" => "editcategory",
      "ShowEdit" => $Category->ListItem($id)
    ]);
    if (isset($_POST['name'])) {
      $name = $_POST['name'];
      $Category->editcategory($id, $name);
    }
  }

  function addCategory()
  {
    if (!isset($_SESSION['userAdmin'])) {
      header('Location: http://localhost/DuAn1/Admin/login');
    }
    $Category = $this->model("CategoryModel");
    if (isset($_POST['name'])) {
      $name = $_POST['name'];
    }
    $Category->addCategory($name);
  }

  function deleteCategory()
  {
    if (!isset($_SESSION['userAdmin'])) {
      header('Location: http://localhost/DuAn1/Admin/login');
    }
    $Category = $this->model("CategoryModel");
    if (!empty($_POST)) {
      if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
          case 'delete':
            if (isset($_POST['id'])) {
              $id = $_POST['id'];
              $Category->deleteCategory($id);
            }
            break;
        }
      }
    }
  }


  function product()
  {
    if (!isset($_SESSION['userAdmin'])) {
      header('Location: http://localhost/DuAn1/Admin/login');
    }
    $Category = $this->model("CategoryModel");
    $Product = $this->model("ProductModel");
    $Models = $this->model("AdminModel");
    $this->view("masterAdmin", [
      "Page" => "product",
      "ShowCategory" => $Category->ListAll(),
      "ShowProduct" => $Product->ListAllAdmin(),
    ]);
  }

  // Thêm sản phẩm
  function addProduct()
  {
    $Product = $this->model("ProductModel");
    $Add = $Product->add();
  }

  // Sửa sản phẩm
  function editProduct($id)
  {
    if (!isset($_SESSION['userAdmin'])) {
      header('Location: http://localhost/DuAn1/Admin/login');
    }
    $Product = $this->model("ProductModel");
    $Category = $this->model("CategoryModel");
    // $Category->checkid($id);
    $this->view("masterAdmin", [
      "Page" => "editProduct",
      "ShowEdit" => $Product->ListItem($id),
      "ShowCategory" => $Category->ListAll(),
      "ShowProduct" => $Product->ListItem($id),
      "ShowVariant" => $Product->ShowVariant($id),
    ]);
  }
  function editProductAct()
  {
    $Product = $this->model("ProductModel");
    $Add = $Product->edit();
  }

  function deleteProduct()
  {
    $Product = $this->model("ProductModel");
    if (!empty($_POST)) {
      if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
          case 'delete':
            if (isset($_POST['id'])) {
              $id = $_POST['id'];
              $Product->deleteProduct($id);
              $Product->deleteVariant($id);
            }
            break;
        }
      }
    }
  }

  // USER

  function user()
  {
    if (!isset($_SESSION['userAdmin'])) {
      header('Location: http://localhost/DuAn1/Admin/login');
    }
    $Category = $this->model("CategoryModel");
    $Product = $this->model("ProductModel");
    $UserModel = $this->model("UserModel");
    $Models = $this->model("AdminModel");
    $this->view("masterAdmin", [
      "Page" => "user",
      "showUser" => $UserModel->ListUserRole(),
      "ShowCategory" => $Category->ListAll(),
      "ShowProduct" => $Product->ListAllAdmin(),
    ]);
  }

  function editUser($id)
  {
    if (!isset($_SESSION['userAdmin'])) {
      header('Location: http://localhost/DuAn1/Admin/login');
    }
    $UserModel = $this->model("UserModel");
    $this->view("masterAdmin", [
      "Page" => "editUser",
      "ShowEdit" => $UserModel->ListItem($id),
      "showUserItem" => $UserModel->ListItem($id),
      "showRole" => $UserModel->showRole(),
    ]);
  }

  function editUserAct()
  {
    $UserModel = $this->model("UserModel");
    $edit = $UserModel->edit();
  }

  function deleteUser()
  {
    $User = $this->model("UserModel");
    if (!empty($_POST)) {
      if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
          case 'delete':
            if (isset($_POST['id'])) {
              $id = $_POST['id'];
              $User->deleteUser($id);
            }
            break;
        }
      }
    }
  }

  // COMMENT
  function comment()
  {
    if (!isset($_SESSION['userAdmin'])) {
      header('Location: http://localhost/DuAn1/Admin/login');
    }
    $AdminModel = $this->model("AdminModel");
    $this->view("masterAdmin", [
      "Page" => "comment",
      "showCommentAd" => $AdminModel->showCommentAd(),
    ]);
  }

  function deleteComment()
  {
    $User = $this->model("UserModel");
    if (!empty($_POST)) {
      if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
          case 'delete':
            if (isset($_POST['id'])) {
              $id = $_POST['id'];
              $User->deleteComment($id);
            }
            break;
        }
      }
    }
  }

  // ORDER
  function order()
  {
    if (!isset($_SESSION['userAdmin'])) {
      header('Location: http://localhost/DuAn1/Admin/login');
    }
    $AdminModel = $this->model("AdminModel");
    $this->view("masterAdmin", [
      "Page" => "order",
      "showOrder" => $AdminModel->showOrder(),
    ]);
  }
  function orderDetails($id)
  {
    $ProductModel = $this->model("ProductModel");
    $this->view("masterAdmin", [
      "Page" => "orderdetails",
      "showOrderDetails" => $ProductModel->showHistoryDetails($id),
      "showOrderDetailsID" => $ProductModel->showHistoryDetails($id),
      "showStatus" => $ProductModel->showStatus($id),
    ]);
  }
  function updateOrder($id)
  {
    if (isset($_POST['status'])) {
      $status = $_POST['status'];
    }
    $Product = $this->model("ProductModel");
    $Add = $Product->updateOrder($status, $id);
  }
}
