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
                                <a href="<?= BASE_URL ?>/home/danhmuc/<?= $row['category_id'] ?>" class="category-item">
                                    <label class="checkbox">
                                        <span class="category-name"><?= $row['category_name'] ?></span>
                                    </label>
                                </a>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>

                <!-- <div class="slidebar-filter__price">
                    <h3 class="slidebar-filter__price-heading">Giá</h3>
                    <div class="price-slider">
                        <span>
                            from
                            <input type="number" value="20000" min="20000" max="200000" />
                            to
                            <input type="number" value="150000" min="20000" max="200000" />
                        </span>
                        <input color="#FFA8A8" value="20000" min="20000" max="200000" step="5000" type="range" />
                        <input value="150000" min="20000" max="200000" step="5000" type="range" />
                        <svg width="100%" height="5">
                        </svg>
                    </div>
                </div> -->

                <!-- <div class="slidebar-product-size">
                    <h3 class="product-size__heading">Kích thước</h3>
                    <div class="product-size__list">
                        <div class="product-size__item">
                            <span class="product-size__text">Lớn</span>
                        </div>
                        <div class="product-size__item">
                            <span class="product-size__text">Vừa</span>
                        </div>
                        <div class="product-size__item">
                            <span class="product-size__text">Nhỏ</span>
                        </div>
                    </div>
                </div> -->


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
                <?php
                if (isset($_POST['search'])) {
                ?>
                    <h3 class="product-all_heading">Sản phẩm cho: <?= $_POST['search'] ?></h3>
                <?php
                }
                ?>

                <?php
                if (isset($data['ListAllCt'])) {
                    $row = mysqli_fetch_assoc($data['ShowName']);
                ?>
                    <h3 class="product-all_heading">Sản phẩm cho: <?= $row['category_name'] ?></h3>
                <?php
                }
                ?>


                <div class="product-all__filter">
                    <p>Lọc theo: <span>A - Z</span> </p>
                    <p><span>
                            <?php
                            if (isset($data['showNum'])) {
                                $item = mysqli_fetch_assoc($data['showNum']);
                                echo $item['count(*)'];
                            }
                            ?>
                            <?php
                            if (isset($data['ListNumSearch'])) {
                                $item = mysqli_fetch_assoc($data['ListNumSearch']);
                                echo $item['count(*)'];
                            }
                            ?>
                        </span> sản phẩm</p>
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

            <div class="product-all-list">
                <div class="list-product grid-3">

                    <?php
                    if (isset($data['ListAllAdmin'])) {
                        while ($row = mysqli_fetch_array($data['ListAllAdmin'])) {
                    ?>
                            <a href="<?= BASE_URL ?>/home/product/<?= $row['product_id'] ?>" class="product-cart">
                                <div class="product-cart__tags justify-content-right">
                                    <!-- <div class="tag-new">new</div> -->
                                    <?php
                                    if ($row['price_sale'] > 0) {
                                    ?>
                                        <div class="tag-discount"><?= $row['price_sale'] ?>%</div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="product-cart__img">
                                    <img src="<?= BASE_URL ?>/<?= $row['thumbnail'] ?>" alt="">
                                </div>
                                <div class="product-cart__info">
                                    <div class="info-title"><?= $row['product_name'] ?></div>
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
                                        if ($row['price_sale'] > 0) {
                                            $price = $row['price']; // 22
                                            $sale = $row['price_sale']; // 50
                                            $price_sale = ($sale / 100) * $price;
                                            $priceTop = $price - $price_sale;
                                        ?>
                                            <div class="info-origin-price"><?= number_format($priceTop, 0, ",", ".") ?> VNĐ</div>
                                            <div class="info-sale-price"><?= number_format($row['price'], 0, ",", ".") ?> VNĐ</div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="info-origin-price"><?= number_format($row['price'], 0, ",", ".") ?> VNĐ</div>
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
                    if (isset($data['ListAllCt'])) {
                        while ($item = mysqli_fetch_array($data['ListAllCt'])) {
                    ?>
                            <a href="<?= BASE_URL ?>/home/product/<?= $item['product_id'] ?>" class="product-cart">
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
                            <a href="<?= BASE_URL ?>/home/product/<?= $item['product_id'] ?>" class="product-cart">
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
                <!-- <div class="btn btn--primary btn-view-all" style="padding: 0;"><a href="">Xem thêm</a></div> -->
            </div>
        </div>
    </div>

    </div>
</main>