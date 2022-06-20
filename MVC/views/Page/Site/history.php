<main class="container">
    <nav class="nav-top">
        <ul>
            <li><a href=""><i class="fas fa-home"></i>Trang chủ</a></li><span>/</span>
            <li><a href="">Lịch sử mua hàng</a></li>
        </ul>
    </nav>
    <section class="product-carts">
        <h1 class="product-carts_title">Lịch sử mua hàng</h1>
        <section class="cart-list">
            <table class="table-cart">
                <thead>
                    <tr class="title-table">
                        <th>Tên khách hàng</th>
                        <th>Địa chỉ</th>
                        <th width="200px">Số điện thoại</th>
                        <th width="200px">Thời gian</th>
                        <th width="200px">Trạng thái</th>
                        <th width="50px"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($history = mysqli_fetch_array($data['showHistoty'])) {
                    ?>
                        <tr>
                            <td class="img-name"><?= $history['name'] ?></td>
                            <td class="address_hisory"><span class="size-cart"><?= $history['address'] ?></span></td>
                            <td><?= $history['phone'] ?></td>
                            <td><?= $history['order_date'] ?></td>
                            <?php
                            if ($history['status'] == "Đang tiến hành") {
                            ?>
                                <td class="dangtienhanh status_history"><?= $history['status'] ?></td>
                            <?php
                            }
                            if ($history['status'] == "Đang giao") {
                            ?>
                                <td class="danggiao status_history"><?= $history['status'] ?></td>
                            <?php
                            }
                            if ($history['status'] == "Đã nhận hàng") {
                            ?>
                                <td class="danhan status_history"><?= $history['status'] ?></td>
                            <?php
                            }
                            if ($history['status'] == "Đã hủy") {
                            ?>
                                <td class="dahuy status_history"><?= $history['status'] ?></td>
                            <?php
                            }
                            ?>

                            <td class="success"><a href="<?= BASE_URL ?>/Home/historyDetails/<?= $history['order_id'] ?>">Xem</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
</main>