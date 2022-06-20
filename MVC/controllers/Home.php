<?php
class Home extends Controller
{
  public function __construct()
  {
  }

  function Default()
  {
    // session_destroy();
    if (isset($_SESSION['userlogin'])) {
      $user_id = $_SESSION['userlogin'][3];
    } else {
      $user_id = "";
    }
    $User = $this->model("UserModel");
    $Product = $this->model("ProductModel");
    $Category = $this->model("CategoryModel");
    $this->view("master1", [
      "Page" => "home",
      "showProduct" => $Product->ListAllAdmin1(),
      "showProductSelling" => $Product->showProductSelling(),
      "ShowMenu" => $Category->ListAll(),
      "ShowNameUser" => $User->ShowNameUser($user_id),
    ]);
  }

  function logout()
  {
    unset($_SESSION['userlogin']);
    echo '
      <script>
      history.back();
      </script>
    ';
  }
  
  function phantrang()
  {
    if (isset($_POST['category'])) {
      $category_id_o = implode("','",$_POST['category']);
    } 
    $ProductModel = $this->model("ProductModel");
    $phantrang = $ProductModel->phantrang();
  }

  function showNumAjax()
  {
    $ProductModel = $this->model("ProductModel");
    $showNumAjax = $ProductModel->showNumAjax();
  }

  function product($id)
  {
    if (isset($_SESSION['userlogin'])) {
      $user_id = $_SESSION['userlogin'][3];
    } else {
      $user_id = "";
    }
    $_SESSION['idSP'] = $id;
    $User = $this->model("UserModel");
    $Product = $this->model("ProductModel");
    $Category = $this->model("CategoryModel");
    $this->view("master2", [
      "Page" => "product",
      "showProductItem" => $Product->ListItemProduct($id),
      "showPrice" => $Product->showPrice($id),
      "showComment" => $Product->showComment($id),
      "showSize" => $Product->showPrice($id),
      "showSize2" => $Product->showPrice($id),
      "ShowMenu" => $Category->ListAll(),
      "ProductRelated" => $Product->ProductRelated($id),
      "ShowNameUser" => $User->ShowNameUser($user_id),
    ]);
  }

  function forgotAction()
  {
    $user = $this->model("UserModel");
    $kq = $user->forgot();
  }

  function login()
  {
    if (isset($_SESSION['userlogin'])) {
      $user_id = $_SESSION['userlogin'][3];
    } else {
      $user_id = "";
    }

    $User = $this->model("UserModel");
    $Models = $this->model("HomeModel");
    $Category = $this->model("CategoryModel");
    $this->view("master3", [
      "Page" => "login1",
      "ShowMenu" => $Category->ListAll(),
      "ShowNameUser" => $User->ShowNameUser($user_id),
    ]);
  }



  function regsiter()
  {
    $Category = $this->model("CategoryModel");
    $this->view("master3", [
      "Page" => "regsiter1",
      "ShowMenu" => $Category->ListAll(),
    ]);
  }

  function loginAction()
  {
    $Login = $this->model("UserModel");
    $kq = $Login->Login();
  }

  function thucdon()
  {
    
    if (isset($_SESSION['userlogin'])) {
      $user_id = $_SESSION['userlogin'][3];
    } else {
      $user_id = "";
    }

    $User = $this->model("UserModel");
    $CategoryModel = $this->model("CategoryModel");
    $ProductModel = $this->model("ProductModel");
    $this->view("master2", [
      "Page" => "list_Product",
      "showMenu" => $CategoryModel->ListAll(),
      "showAll" => $ProductModel->ListAll(),
      "showNum" => $ProductModel->showNum(),
      "ListAllAdmin" => $ProductModel->ListAllAdmin(),
      "ShowMenu" => $CategoryModel->ListAll(),
      "ShowNameUser" => $User->ShowNameUser($user_id),
    ]);
  }

  function danhmuc($id)
  {
    if (isset($_SESSION['userlogin'])) {
      $user_id = $_SESSION['userlogin'][3];
    } else {
      $user_id = "";
    }
    $User = $this->model("UserModel");
    $CategoryModel = $this->model("CategoryModel");
    $ProductModel = $this->model("ProductModel");
    $this->view("master2", [
      "Page" => "danhmuc",
      "showMenu" => $CategoryModel->ListAll(),
      "ListItemId" => $ProductModel->ListItemId($id),
      "showNum" => $ProductModel->showNumId($id),
      "ListAllCt" => $ProductModel->ListAllCt($id),
      "ShowMenu" => $CategoryModel->ListAll(),
      "ShowName" => $CategoryModel->ListItem($id),
      "ShowNameUser" => $User->ShowNameUser($user_id),
    ]);
  }

  function search()
  {
    if (isset($_SESSION['userlogin'])) {
      $user_id = $_SESSION['userlogin'][3];
    } else {
      $user_id = "";
    }

    $User = $this->model("UserModel");
    $CategoryModel = $this->model("CategoryModel");
    $ProductModel = $this->model("ProductModel");
    if (isset($_POST['search'])) {
      $id = $_POST['search'];
    }
    $this->view("master2", [
      "Page" => "danhmuc",
      "showMenu" => $CategoryModel->ListAll(),
      "ShowMenu" => $CategoryModel->ListAll(),
      "ListSearch" => $ProductModel->ListSearch($id),
      "ListNumSearch" => $ProductModel->ListNumSearch($id),
      "ShowNameUser" => $User->ShowNameUser($user_id),
    ]);
  }

  function checkout()
  {
    if (isset($_SESSION['userlogin'])) {
      $user_id = $_SESSION['userlogin'][3];
    } else {
      $user_id = "";
    }

    $User = $this->model("UserModel");
    // if (sizeof($_SESSION['giohang']) == 0) {
    if (!isset($_SESSION['giohang'])) {
      echo '
            <script>
                alert("Chưa có sản phẩm trong giỏ hàng")
                window.location.assign("../");
            </script>
        ';
    } else {
      if (isset($_SESSION['giohang'])) {
        $numCart = 0;
        for ($i = 0; $i < count($_SESSION['giohang']); $i++) {
          $numCart += $_SESSION['giohang'][$i][2];
        }
        if ($numCart == 0) {
          echo '
            <script>
                alert("Chưa có sản phẩm trong giỏ hàng")
                window.location.assign("../");
            </script>
        ';
        }
      }
    }

    if (isset($_SESSION['userlogin'])) {
      $user_id = $_SESSION['userlogin'][3];
    } else {
      echo '
            <script>
                alert("Vui lòng đăng nhập để tiến hành đặt hàng")
                window.location.assign("../home/login");
            </script>
        ';
    }
    $User = $this->model("UserModel");
    $Category = $this->model("CategoryModel");
    $this->view("master2", [
      "Page" => "checkout",
      "showUserCheckout" => $User->showUserCheckout($user_id),
      "ShowMenu" => $Category->ListAll(),
      "ShowNameUser" => $User->ShowNameUser($user_id),
    ]);
  }

  function checkoutAct()
  {
    if (isset($_SESSION['userlogin'])) {
      $user_id = $_SESSION['userlogin'][3];
    } else {
      $user_id = "";
    }

    $User = $this->model("UserModel");
    $Product = $this->model("ProductModel");
    $checkoutAct = $Product->checkoutAct();
  }

  function history()
  {
    if (isset($_SESSION['userlogin'])) {
      $user_id = $_SESSION['userlogin'][3];
    } else {
      $user_id = "";
    }

    $User = $this->model("UserModel");
    if (isset($_SESSION['userlogin'])) {
      $id = $_SESSION['userlogin'][3];
    } else {
      $id = "1";
    }
    $ProductModel = $this->model("ProductModel");
    $Category = $this->model("CategoryModel");
    $this->view("master2", [
      "Page" => "history",
      "showHistoty" => $ProductModel->showHistoty($id),
      "ShowMenu" => $Category->ListAll(),
      "ShowNameUser" => $User->ShowNameUser($user_id),
    ]);
  }
  function historyDetails($id)
  {
    if (isset($_SESSION['userlogin'])) {
      $user_id = $_SESSION['userlogin'][3];
    } else {
      $user_id = "";
    }

    $User = $this->model("UserModel");
    $ProductModel = $this->model("ProductModel");
    $Category = $this->model("CategoryModel");
    $this->view("master2", [
      "Page" => "historyDetails",
      "showHistoryDetails" => $ProductModel->showHistoryDetails($id),
      "ShowMenu" => $Category->ListAll(),
      "ShowNameUser" => $User->ShowNameUser($user_id),
    ]);
  }

  function user()
  {
    if (isset($_SESSION['userlogin'])) {
      $user_id = $_SESSION['userlogin'][3];
    } else {
      $user_id = "";
    }

    $User = $this->model("UserModel");
    $id = $_SESSION['userlogin'][3];
    $UserModel = $this->model("UserModel");
    $Category = $this->model("CategoryModel");
    $this->view("master3", [
      "Page" => "user",
      "ShowMenu" => $Category->ListAll(),
      "ShowAbout" => $UserModel->ListItem($id),
      "ShowNameUser" => $User->ShowNameUser($user_id),
    ]);
  }

  function RegisterAction()
  {
    $register = $this->model("UserModel");
    $kq = $register->register();
  }
  function commentAction()
  {
    $comment = $this->model("UserModel");
    $kq = $comment->comment();
  }

  // function changepass()
  // {
  //   $UserModel = $this->model("UserModel");
  //   $password = $_POST['password'];
  //   $user_id = $_POST['user_id'];
  //   $passwordnew = $_POST['passwordnew'];
  //   $checkPass = $UserModel->checkPass($password, $passwordnew, $user_id);
  // }

  function changepass()
  {
    $UserModel = $this->model("UserModel");
    $password = $_POST['password'];
    $user_id = $_POST['user_id'];
    $passwordnew = $_POST['passwordnew'];
    $checkPass = $UserModel->checkPass($password, $passwordnew, $user_id);
  }

  function edituser()
  {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $user_id = $_POST['user_id'];

    $UserModel = $this->model("UserModel");
    $checkPass = $UserModel->editUser($user_id, $name, $address, $phone);
  }

  function deleteComment()
  {
    if (isset($_POST['id'])) {
      $id = $_POST['id'];
    } else {
      $id = 0;
    }
    $ProductModel = $this->model("ProductModel");
    $deleteComment = $ProductModel->deleteComment($id);
  }
  function loadComment()
  {
    $ProductModel = $this->model("ProductModel");
    $id = $_SESSION['idSP'];
    $result = $ProductModel->showComment($id);

    while ($binhluan = mysqli_fetch_assoc($result)) {
    ?>
      <div class="comment-list" id="load_data">
        <div class="comment">
          <div class="comment-avatar">
            <img src="<?= BASE_URL ?>/MVC/public/images/users/SEIJ6567.JPG" alt="">
          </div>
          <div class="comment-user">
            <div class="comment-user__name"><?= $binhluan['name'] ?></div>
            <div class="comment-user__content"><?= $binhluan['comment_content'] ?></div>
            <div class="comment-user__content time"><?= $binhluan['comment_date'] ?></div>
            <?php
            if (isset($_SESSION['userlogin'])) {
              if ($binhluan['user_id'] == $_SESSION['userlogin'][3]) {
            ?>
                <p id="deletecomment" onclick="deleteComment(<?= $binhluan['comment_id'] ?>)" class="deletecomment">Xóa</p>
            <?php
              }
            }
            ?>
          </div>
        </div>
      </div>
<?php
    }
  }

  function AddToCart()
  {
    if (!isset($_SESSION['giohang'])) {
      $_SESSION['giohang'] = [];
    }

    if (isset($_POST["addToCart"])) {
      $num = $_POST['num'];
      $size = $_POST['size'];
      $id = $_POST['id'];
      $thumbnail = $_POST['thumbnail'];
      $price = $_POST['price'];
      $name = $_POST['name'];

      // kiểm tra sp có chưa, nếu có thì cột số lượng
      $check = 0;
      for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
        if ($_SESSION['giohang'][$i][1] == $id and $_SESSION['giohang'][$i][0] == $size) {
          $check = 1;
          $numNew = $num + $_SESSION['giohang'][$i][2];
          $_SESSION['giohang'][$i][2] = $numNew;
          break;
        }
      }
      if ($check == 0) {
        $cartList = [$size, $id, $num, $price, $thumbnail, $name];
        $_SESSION['giohang'][] = $cartList;
        // header("Location: " . $_SERVER["HTTP_REFERER"]);
      }
      header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
  }
}
