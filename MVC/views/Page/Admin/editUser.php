<main class="pt-3 container-fluid">
    <section class="name-pages">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <h5>Sửa người dùng</h5>
                </li>
            </ol>
        </nav>
    </section>
    <?php
      $row = mysqli_fetch_assoc($data['ShowEdit']);
      if (mysqli_num_rows($data['ShowEdit']) < 1) {
        echo '
        <script>
            alert("Tài khoản không tồn tại!")
            window.location.assign("../user");
        </script>
        ';
      }
      ?>

    <?php
    $row = mysqli_fetch_assoc($data['showUserItem']);
    ?>
    <section class="category container pb-5">
        <form action="<?= BASE_URL ?>/Admin/editUserAct" method="POST" id="editUserForm" enctype="multipart/form-data">
            <div class="modal-body">
                <input type="text" hidden name="user_id" value="<?= $row['user_id'] ?>" id="">
                <!-- <div class="form-group">
                    <label for="exampleFormControlFile1">Ảnh</label>
                    <input type="file" required name="thumbnail" class="form-control-file" id="exampleFormControlFile1">
                </div> -->
                <div class="form-group">
                    <label for="formGroupExampleInput">Tên người dùng</label>
                    <input type="text" name="name" value="<?= $row['name'] ?>" required class="form-control" id="formGroupExampleInput" placeholder="Tên người dùng...">
                </div>
                <div class="form-group">
                    <div class="form-group row">
                        <div class="input-group input-group-sm mb-3 col-6 pt-2">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
                            <input type="text" value="<?= $row['email'] ?>" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>
                        <div class="input-group input-group-sm mb-3 col-6 pt-2">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Số điện thoại</span>
                            <input type="text" name="phone" value="<?= $row['phone'] ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="formGroupExampleInput">Địa chỉ</label>
                    <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3"><?= $row['address'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" value="noverify" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">Chưa xác nhận</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="verify" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">Đã xác nhận</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" value="lock" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                        <label class="form-check-label" for="flexRadioDefault3">Khóa tài khoản</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">Quyền</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="role_id">
                        <?php
                        while ($item = mysqli_fetch_array($data['showRole'])) {
                            if ($row['role_id'] == $item['role_id']) {
                                echo '<option selected value="' . $item['role_id'] . '">' . $item['role_name'] . '</option>';
                            } else {
                                echo '<option value="' . $item['role_id'] . '">' . $item['role_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <?php
                    $previous = "javascript:history.go(-1)";
                    if (isset($_SERVER['HTTP_REFERER'])) {
                        $previous = $_SERVER['HTTP_REFERER'];
                    }
                    ?>
                    <a href="<?= $previous ?>" class="btn btn-warning">Quay lại</a>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
        </form>
    </section>
</main>