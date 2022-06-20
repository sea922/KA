<main class="grid wide container user" style="margin: 85px auto 20px;">
    <nav class="nav-top">
        <ul>
            <li><a href="<?=BASE_URL?>"><i class="fas fa-home"></i>Trang chủ</a></li><span>/</span>
            <li><a href="<?=BASE_URL?>/home/regsiter">Đăng ký</a></li>
        </ul>
    </nav>
    <div id="regsiter-dev">
        <h3 class="regsiter-title pt-2">Đăng ký hệ thống</h3>
        <form action="" method="POST" id="form_regsiter" class="regsiter_alone">
            <div class="form-group-regsiter">
                <label for="">Họ tên</label>
                <input type="text" name="name" id="" class="email-ip" placeholder="Nhập họ và tên" />
            </div>
            <div class="form-group-regsiter">
                <label for="">Email</label>
                <input type="text" name="email" id="" class="email-ip" placeholder="Nhập email" />
            </div>
            <div class="form-group-regsiter">
                <label for="">Số điện thoại</label>
                <input type="text" name="phone" id="" class="email-ip" placeholder="Nhập số điện thoại" />
            </div>
            <div class="form-group-regsiter">
                <label for="">Mật khẩu</label>
                <input type="password" name="password" id="" placeholder="Mật khẩu" />
            </div>
            <div class="forgot-passs"><span class="forgot-show">Quên mật khẩu?</span></div>
            <div class="btn-regsiter pt-2">
                <button>Đăng ký</button>
            </div>
            <p class="textLogin">Bạn đã có tài khoản? <a href="<?=BASE_URL?>/home/login" class="login-shows">Đăng nhập</a></p>
        </form>
    </div>
</main>