<main class="grid wide container">
    <nav class="nav-top">
        <ul>
            <li><a href=""><i class="fas fa-home"></i>Trang chủ</a></li><span>/</span>
            <li><a href="">Thực đơn</a></li>
        </ul>
    </nav>
    <div class="row sm-gutter app__content">
        <form method="GET" action="" id="filter" class="col l-2-4">
            <div class="slidebar">
                <div class="slidebar-menu">
                    <h3 class="slidebar-menu__heading">Thực đơn</h3>
                    <div class="slidebar-menu__category">
                        <?php
                        if (isset($data['showMenu'])) {
                            while ($row = mysqli_fetch_array($data['showMenu'])) {
                        ?>
                                <div class="category-item">
                                    <label class="checkbox">
                                        <input class="category" value="<?= $row['category_id'] ?>" type="checkbox" name="category">
                                        <i class="icon-checkbox"></i>
                                        <span class="category-name"><?= $row['category_name'] ?></span>
                                    </label>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </form>
        <div class="col l-9 ml-auto">
            <div class="product-all__title">
                <?php
                if (isset($data['ListAllAdmin'])) {
                ?>
                    <h3 class="product-all_heading">Tất cả sản phẩm</h3>
                <?php
                }
                ?>
                <div class="product-all__filter">
                    <div class="locsp">
                        <p>Lọc theo: </p>
                        <select id="cars" class="locSP">
                            <option value="DESC">Giá thấp nhất</option>
                            <option value="ASC">Giá cao nhất</option>
                        </select>
                    </div>
                    <div id="showNum"></div>

                </div>
            </div>
            <?php
            if (isset($data['ListNumSearch'])) {
                if ($item['count(*)'] == 0) {
            ?>
                    <div class="error-search">
                        <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg//assets/a60759ad1dabe909c46a817ecbf71878.png" alt="">
                        <div class="title">Không tìm thấy kết quả nào</div>
                        <div>Hãy thử sử dụng các từ khóa chung chung hơn</div>
                    </div>
            <?php
                }
            }
            ?>

            <div class="product-all-list" id="pagination_data">
                <!-- <div class="list-product grid-3" id="pagination_data"> -->
                <?php
                if (isset($data['ListAllCt'])) {
                    while ($item = mysqli_fetch_array($data['ListAllCt'])) {
                ?>
                        <a href="<?= BASE_URL ?>/product" class="product-cart">
                            <div class="product-cart__tags justify-content-right">
                                <!-- <div class="tag-new">new</div> -->
                                <?php
                                if ($item['price_sale'] > 0) {
                                ?>
                                    <div class="tag-discount"><?= $item['price_sale'] ?>%</div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="product-cart__img">
                                <img src="<?= BASE_URL ?>/<?= $item['thumbnail'] ?>" alt="">
                            </div>
                            <div class="product-cart__info">
                                <div class="info-title"><?= $item['product_name'] ?></div>
                                <div class="info-rating">
                                    <div class="rating-list">
                                        <i class="rating-icon fas fa-star"></i>
                                        <i class="rating-icon fas fa-star"></i>
                                        <i class="rating-icon fas fa-star"></i>
                                        <i class="rating-icon fas fa-star"></i>
                                        <i class="rating-icon fas fa-star"></i>
                                    </div>
                                    <p class="rating-text">(2 đánh giá)</p>
                                </div>
                                <div class="info-price">
                                    <?php
                                    if ($item['price_sale'] > 0) {
                                        $price = $item['price']; // 22
                                        $sale = $item['price_sale']; // 50
                                        $price_sale = ($sale / 100) * $price;
                                        $priceTop = $price - $price_sale;
                                    ?>
                                        <div class="info-origin-price"><?= number_format($priceTop, 0, ",", ".") ?> VNĐ</div>
                                        <div class="info-sale-price"><?= number_format($item['price'], 0, ",", ".") ?> VNĐ</div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="info-origin-price"><?= number_format($item['price'], 0, ",", ".") ?> VNĐ</div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="btn btn--primary btn-order-product">Đặt hàng</div>
                            </div>
                        </a>
                <?php
                    }
                }
                ?>

                <?php
                if (isset($data['ListSearch'])) {
                    while ($item = mysqli_fetch_array($data['ListSearch'])) {
                ?>
                        <a href="<?= BASE_URL ?>/product" class="product-cart">
                            <div class="product-cart__tags justify-content-right">
                                <!-- <div class="tag-new">new</div> -->
                                <?php
                                if ($item['price_sale'] > 0) {
                                ?>
                                    <div class="tag-discount"><?= $item['price_sale'] ?>%</div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="product-cart__img">
                                <img src="<?= BASE_URL ?>/<?= $item['thumbnail'] ?>" alt="">
                            </div>
                            <div class="product-cart__info">
                                <div class="info-title"><?= $item['product_name'] ?></div>
                                <div class="info-rating">
                                    <div class="rating-list">
                                        <i class="rating-icon fas fa-star"></i>
                                        <i class="rating-icon fas fa-star"></i>
                                        <i class="rating-icon fas fa-star"></i>
                                        <i class="rating-icon fas fa-star"></i>
                                        <i class="rating-icon fas fa-star"></i>
                                    </div>
                                    <p class="rating-text">(2 đánh giá)</p>
                                </div>
                                <div class="info-price">
                                    <?php
                                    if ($item['price_sale'] > 0) {
                                        $price = $item['price']; // 22
                                        $sale = $item['price_sale']; // 50
                                        $price_sale = ($sale / 100) * $price;
                                        $priceTop = $price - $price_sale;
                                    ?>
                                        <div class="info-origin-price"><?= number_format($priceTop, 0, ",", ".") ?> VNĐ</div>
                                        <div class="info-sale-price"><?= number_format($item['price'], 0, ",", ".") ?> VNĐ</div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="info-origin-price"><?= number_format($item['price'], 0, ",", ".") ?> VNĐ</div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="btn btn--primary btn-order-product">Đặt hàng</div>
                            </div>
                        </a>
                <?php
                    }
                }
                ?>
            </div>
            <!-- <div class="pagination">
                    <div class="pagination_link">1</div>
                </div> -->
            <!-- <div class="btn btn--primary btn-view-all" style="padding: 0;"><a href="">Xem thêm</a></div> -->
            <!-- </div> -->
        </div>
    </div>

    </div>
</main>
<style>
    .pagination {
        margin-top: 3rem;
    }

    .pagination_link {
        cursor: pointer;
        padding: 5px 10px;
        border: 1px solid grey;
        border-radius: 4px;
        /* background-color: #aaa; */
        margin: 0 2px;
    }
</style>