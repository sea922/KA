<main class="container">
    <nav class="nav-top">
        <ul>
            <li><a href=""><i class="fas fa-home"></i>Trang chủ</a></li><span>/</span>
            <li><a href="">Giỏ hàng</a></li>
        </ul>
    </nav>
    <section class="product-carts">
        <h1 class="product-carts_title">Giỏ hàng</h1>
        <section class="cart-list">
            <table class="table-cart">
                <thead>
                    <tr class="title-table">
                        <th>Sản phẩm</th>
                        <th>Kích thước</th>
                        <th width="200px">Giá tiền</th>
                        <th width="200px">Số lượng</th>
                        <th width="200px">Tổng giá</th>
                        <th width="50px"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tongTien = 0;
                    if (isset($_SESSION['giohang'])) {
                        for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
                            $total = $_SESSION['giohang'][$i][2] * $_SESSION['giohang'][$i][3];
                    ?>
                            <tr>
                                <td class="img-name"><img src="<?= BASE_URL ?>/<?= $_SESSION['giohang'][$i][4] ?>" alt=""><a href="<?= BASE_URL ?>/home/product/<?= $_SESSION['giohang'][$i][1] ?>"><?= $_SESSION['giohang'][$i][5] ?></a></td>
                                <td><span class="size-cart"><?= $_SESSION['giohang'][$i][0] ?></span></td>
                                <td><?= number_format($_SESSION['giohang'][$i][3], 0, ",", ".") ?> VNĐ</td>
                                <td><input class="numCart" type="number" value="<?= $_SESSION['giohang'][$i][2] ?>"></td>
                                <td><?= number_format($total, 0, ",", ".") ?> VNĐ</td>
                                <td>
                                    <a href="<?=BASE_URL?>/Cart/deldCart/<?=$i?>"><i class="far fa-trash-alt tooltip"><span class="tooltiptext">Xóa</span></i></a>
                                </td>
                            </tr>
                    <?php
                            $tongTien = $total + $tongTien;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <section class="cart-act">
            <div class="cart-act_shopping">
                <a href="<?= BASE_URL ?>">Tiếp tục mua hàng</a>
            </div>
            <div class="cart-act_checkout">
                <h3>Tổng giỏ hàng</h3>
                <div class="price-provisional">
                    <p>Tạm tính</p>
                    <p class="text-red font-bold"><?= number_format($tongTien, 0, ",", ".") ?> VNĐ</p>
                </div>
                <div class="price-provisional">
                    <p>Phí ship</p>
                    <p class="text-red font-bold">0 VNĐ</p>
                </div>
                <div class="price-total">
                    <p>Tổng đơn hàng</p>
                    <p class="text-red font-bold"><?= number_format($tongTien, 0, ",", ".") ?> VNĐ</p>
                </div>
                <a class="checkout-btn" href="<?= BASE_URL ?>/home/checkout">Tiến hành thanh toán</a>
            </div>
        </section>
    </section>

</main>