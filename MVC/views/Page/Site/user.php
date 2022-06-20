<main class="grid wide container user" style="margin: 100px auto 20px;">
    <nav class="nav-top">
        <ul>
            <li><a href=""><i class="fas fa-home"></i>Trang chủ</a></li><span>/</span>
            <li><a href="">Thông tin người dùng</a></li>
        </ul>
    </nav>
    <div class="info-user">
        <h2 class="info-user__heading">Thông tin khách hàng</h2>
        <div class="form-info-user row">
            <form action="" id="changepass_form" method="" class="col l-3 change-password">
                <h2 class="change-password__heading">Đổi mật khẩu</h2>
                <div class="change-password__main">
                    <div class="change-password__item">
                        <p class="change-password__text">Mật khẩu cũ <sup style="color:red;">*</sup></p>
                        <input type="password" name="password" id="" class="change-password__input" placeholder="Nhập mật khẩu cũ">
                    </div>
                    <div class="clear"></div>

                    <div class="change-password__item">
                        <p class="change-password__text">Mật khẩu mới <sup style="color:red;">*</sup></p>
                        <input type="password" name="passwordnew" id="" class="change-password__input" placeholder="Nhập mật khẩu mới">
                        <input type="text" hidden name="user_id" value="<?= $_SESSION['userlogin'][3] ?>">
                        <span class="error"></span>
                    </div>
                </div>
                <button class="btn btn--primary change-password__btn">Thay đổi</button>
            </form>

            <form action="" id="edit_user" method="" class="col l-9 info-user__main">
                <?php $rows = mysqli_fetch_assoc($data['ShowAbout']) ?>

                <div class="info-user__main-item">
                    <p class="info-user__text">Tên <sup style="color:red;">*</sup></p>
                    <input type="text" name="name" id="" class="info-user__input" value="<?= $rows['name'] ?>" placeholder="Nhập tên của bạn">
                    <input type="text" name="user_id" hidden id="" class="info-user__input" value="<?= $rows['user_id'] ?>">
                </div>

                <div class="info-user__main-item">
                    <p class="info-user__text">Địa chỉ <sup style="color:red;">*</sup></p>
                    <input type="text" name="address" id="" class="info-user__input" value="<?= $rows['address'] ?>" placeholder="Nhập địa chỉ của bạn">
                </div>

                <div class="info-user__main-item contact-info__list">
                    <div class="contact-info__item">
                        <p class="info-user__text">Số điện thoại <sup style="color:red;">*</sup></p>
                        <input type="text" name="phone" id="" class="info-user__input" value="<?= $rows['phone'] ?>" placeholder="Nhập số điện thoại của bạn">
                    </div>
                    <div class="contact-info__item">
                        <p class="info-user__text">Email <small style="color:red;">(Không thay đổi)</small></p>
                        <input type="text" name="" id="" class="info-user__input" value="<?= $rows['email'] ?>" disabled>
                    </div>
                </div>
                <button class="btn btn--primary info-user__main--btn">Cập nhật</button>
            </form>
        </div>
    </div>
</main>
<style>
    .error{
        font-size: 1.4rem;
    }
</style>