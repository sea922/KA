<main class="grid wide container user" style="margin: 85px auto 20px;">
<nav class="nav-top">
        <ul>
            <li><a href="<?=BASE_URL?>"><i class="fas fa-home"></i>Trang chủ</a></li><span>/</span>
            <li><a href="<?=BASE_URL?>/home/login">Đăng nhập</a></li>
        </ul>
    </nav>
<div id="login-dev">
      <h3 class="login-title">Đăng nhập hệ thống</h3>
      <form action="" method="POST" id="form_login" class="login_alone">
        <div class="form-group-login">
          <label for="">Email</label>
          <input type="text" name="email" id="" class="email-ip" placeholder="Nhập email" />
        </div>
        <div class="form-group-login">
          <label for="">Mật khẩu</label>
          <input type="password" name="password" id="" placeholder="Nhập mật khẩu" />
        </div>
        <!-- <div class="savepass-login">
          <input type="checkbox" id="savepass" />
          <label for="savepass">Lưu mật khẩu</label>
        </div> -->
        <p class="forgot-shows forgot-show">Quên mật khẩu?</p>        
        <div class="btn-login">
          <button>Đăng nhập</button>
        </div>
        <p class="titlelogin">Bạn chưa có tài khoản? <a href="<?=BASE_URL?>/home/regsiter" >Đăng ký</a></p>
      </form>

    </div>
</main>