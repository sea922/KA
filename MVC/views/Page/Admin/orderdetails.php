<main class="pt-3 container-fluid pb-5">
    <section class="name-pages">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <h5>Đơn hàng</h5>
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
                    <th scope="col">Ảnh</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Kích thước</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Giá</th>
                </tr>
            </thead>
            <tbody id="tableSearch">
                <?php
                while ($row = mysqli_fetch_array($data['showOrderDetails'])) {
                ?>
                    <tr>
                        <td class="capitalize"><img class="thumbnailOD" src="<?= BASE_URL ?>/<?= $row['thumbnail'] ?>" alt=""></td>
                        <td><?= $row['product_name'] ?></td>
                        <td><?= $row['size'] ?></td>
                        <td><?= $row['num'] ?></td>
                        <td class="address_user_truncate"><?= $row['price'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </section>
    <?php
    $item = mysqli_fetch_assoc($data['showOrderDetailsID']);
    ?>
    <form action="<?= BASE_URL ?>/Admin/updateOrder/<?= $item['order_id'] ?>" method="POST" class="modal-footer updateOrder container mb-5 pb-9">
        <select class="form-status form-select form-select-lg mb-3 mt-3" name="status" aria-label=".form-select-lg example">
            <?php
            $result = mysqli_fetch_assoc($data['showStatus']);
            if ($result['status'] == 'Đang tiến hành') {
            ?>
                <option selected value="Đang tiến hành">Đang tiến hành</option>
                <option value="Đang giao">Đang giao</option>
                <option value="Đã nhận hàng">Đã nhận hàng</option>
                <option value="Đã hủy">Đã hủy</option>
            <?php
            }
            if ($result['status'] == 'Đã nhận hàng') {
            ?>
                <option value="Đang tiến hành">Đang tiến hành</option>
                <option value="Đang giao">Đang giao</option>
                <option selected value="Đã nhận hàng">Đã nhận hàng</option>
                <option value="Đã hủy">Đã hủy</option>
            <?php
            }
            if ($result['status'] == 'Đã hủy') {
            ?>
                <option value="Đang tiến hành">Đang tiến hành</option>
                <option value="Đang giao">Đang giao</option>
                <option selected value="Đã nhận hàng">Đã nhận hàng</option>
                <option value="Đã hủy">Đã hủy</option>
            <?php
            }
            if ($result['status'] == 'Đang giao') {
            ?>
                <option value="Đang tiến hành">Đang tiến hành</option>
                <option selected value="Đang giao">Đang giao</option>
                <option value="Đã nhận hàng">Đã nhận hàng</option>
                <option value="Đã hủy">Đã hủy</option>
            <?php
            }
            ?>
        </select>
        <div>
            <?php
            $previous = "javascript:history.go(-1)";
            if (isset($_SERVER['HTTP_REFERER'])) {
                $previous = $_SERVER['HTTP_REFERER'];
            }
            ?>
            <a href="<?= $previous ?>" class="btn btn-warning">Quay lại</a>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>
</main>