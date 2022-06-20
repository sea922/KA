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
                        <th>Sản phẩm</th>
                        <th>Kích thước</th>
                        <th width="200px">Số lượng</th>
                        <th width="200px">Tổng giá</th>
                        <!-- <th width="200px">Trạng thái</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($history = mysqli_fetch_assoc($data['showHistoryDetails'])) {
                    ?>
                        <tr>
                            <td class="img-name"><img src="<?=BASE_URL?>/<?=$history['thumbnail']?>" alt=""><a href="<?=BASE_URL?>/home/product/<?=$history['product_id']?>"><?=$history['product_name']?></a></td>
                            <td><span class="size-cart"><?=$history['size']?></span></td>
                            <td><?=$history['num']?></td>
                            <td><?=number_format($history['num'] * $history['price'], 0, ",", ".")?> VNĐ</td>
                            <!-- <td class="success">Đã nhận hàng</td> -->
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>
                    <?php
                    $previous = "javascript:history.go(-1)";
                    if (isset($_SERVER['HTTP_REFERER'])) {
                        $previous = $_SERVER['HTTP_REFERER'];
                    }
                    ?>
                    <a href="<?= $previous ?>" class="btn btn-warning">Quay lại</a>
        <!-- <nav aria-label="">
            <ul class="pagination pt-2">
                <li class="page-item ">
                    <span class="page-link">Previous</span>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item" aria-current="page">
                    <span class="page-link">2</span>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav> -->
    </section>

</main>