<main class="pt-3 container-fluid">
    <section class="name-pages">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <h5>Người dùng</h5>
                </li>
            </ol>
        </nav>
    </section>
    <section class="row display-flex justify-content-between ml-0 mr-0">
        <div></div>
        <select class="form-control col-4 mb-3">
            <option>Sắp xếp theo</option>
            <option>Theo ngày mới nhất</option>
            <option>Theo ngày cũ nhất</option>
            <option>Theo giá cao nhất</option>
            <option>Theo giá thấp nhất</option>
        </select>
    </section>
    <section class="Product">
        <table class="table border-0 rounded">
            <thead class="thead-dark">
                <tr>
                    <!-- <th style="width: 10px" scope="col">STT</th> -->
                    <th scope="col">Ảnh</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col" width="300px">Địa chỉ</th>
                    <th scope="col">verify</th>
                    <th scope="col">Quyền</th>
                    <th style="width: 5px" scope="col"></th>
                    <th style="width: 5px" scope="col"></th>
                </tr>
            </thead>
            <tbody id="tableSearch">
                <?php
                while ($row = mysqli_fetch_array(($data['showUser']))) {
                ?>
                    <tr>
                        <td>
                            <img style="width: 70px" src="https://simg.nicepng.com/png/small/804-8049853_med-boukrima-specialist-webmaster-php-e-commerce-web.png" alt="" />
                        </td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['phone'] ?></td>
                        <td class="address_user_truncate"><?= $row['address'] ?></td>
                        <td><?= $row['verify'] ?></td>
                        <td><?= $row['role_name'] ?></td>
                        <td><a href="<?= BASE_URL ?>/Admin/editUser/<?= $row['user_id'] ?>" class="btn btn-warning">Sửa</a></td>
                        <td><button class="btn btn-danger" onclick="deleteUser(<?= $row['user_id'] ?>)">Xóa</button></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </section>
</main>