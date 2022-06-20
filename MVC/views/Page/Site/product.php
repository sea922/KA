<main id="nhan" class="grid wide container">
  <?php
  $row = mysqli_fetch_assoc($data['showProductItem']);
  ?>
  <nav class="nav-top">
    <ul>
      <li><a href=""><i class="fas fa-home"></i>Trang chủ</a></li><span>/</span>
      <li><a href="">Chi tiết sản phẩm</a></li><span>/</span>
      <li><a href=""><?= $row['product_name'] ?></a></li>
    </ul>
  </nav>
  <div class="card mt-1">
    <!-- card left -->
    <div class="product-imgs">
      <div class="img-display">
        <div class="img-showcase">
          <a class="price_sale_a" href="<?= BASE_URL ?>/<?= $row['thumbnail'] ?>">
            <img src="<?= BASE_URL ?>/<?= $row['thumbnail'] ?>" alt="">
          </a>
          <?php
          if ($row['price_sale'] > 0) {
          ?>
            <p class="price_sale_img"><?= $row['price_sale'] ?>%</p>
          <?php
          }
          ?>
        </div>
      </div>

    </div>
    <!-- card right -->
    <div class="product-content">
      <h3 class="product-title"><?= $row['product_name'] ?></h3>
      <form action="<?= BASE_URL ?>/Home/AddToCart" method="POST">
        <div class="product-price">
          <?php
          while ($item = mysqli_fetch_array(($data['showPrice']))) {
          ?>
            <p class="new-price price-bg <?= $item['size'] ?>" hidden name="<?= $item['price'] ?>" style="font-size: 3rem;"><?= number_format($item['price'], 0, ",", ",") ?> VNĐ</p>
          <?php
          }
          ?>
          <p class="new-price price-bg" id="priceSize" name="<?= $row['size'] ?>" style="font-size: 3rem;"><?= number_format($row['price'], 0, ",", ",") ?> VNĐ</p>
          <p class="new-price slogan" style="font-size: 16px;">Ở đâu rẻ hơn, KA Coffee hoàn tiền</p>
        </div>
        <div class="product-detail">
          <ul class="product-detail__list">
            <li class="product-detail__item">Danh mục: <span><?= $row['category_name'] ?></span></li>
            <li class="product-detail__item">Tình trạng: <span>Còn hàng</span></li>
            <li class="product-detail__item">Vận chuyển: <span>Có</span></li>
          </ul>
        </div>
        <div class="purchase-info">
          <!-- <button name="sizeS" value="S" class="size">S</button>
        <button name="sizeM" class="size">M</button>
        <button name="sizeL" class="size">L</button> -->
          <span class="giapos"></span>
          <input class="sizes" hidden checked name="size" type="radio" value="Nhỏ" id="sizeNho">
          <label for="sizeNho">Nhỏ</label>
          <input class="sizes" hidden name="size" type="radio" value="Vừa" id="sizeVua">
          <label for="sizeVua">Vừa</label>
          <input class="sizes" hidden name="size" type="radio" value="Lớn" id="sizeLon">
          <label for="sizeLon">Lớn</label>
        </div>
        <div class="purchase-info">
          <span class="btn" id="minus">-</span>
          <input type="number" name="num" min="1" value="1" id="input">
          <span class="btn" id="plus" style="margin-right: 50px;">+</span>
        </div>
        <input type="number" hidden name="id" value="<?= $row['product_id'] ?>">
        <input type="text" hidden id="pricePost" name="" value="<?= $row['price'] ?>">
        <input type="text" hidden id="pricePost2" name="price" value="<?= $row['price'] ?>">
        <input type="text" hidden name="thumbnail" value="<?= $row['thumbnail'] ?>">
        <input type="text" hidden name="name" value="<?= $row['product_name'] ?>">

        <div class="click">
          <button type="submit" name="addToCart" id="btn1"><i class="fas fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
        </div>
      </form>
    </div>
  </div>
  <div class="nhan_container">
    <ul class="tab_navigation">
      <li class="mota active">Mô tả</li>
      <li class="danhgia">Đánh giá</li>
    </ul>
    <div class="tab_container_area" id="mota">
      <div class="tab_container">
        <h3 class="comment-heading">Mô tả sản phẩm</h3>
        <p><?= $row['description'] ?></p>
      </div>
    </div>
    <div class="tab_container_area" id="danhgia">
      <div class="tab_container">
        <h3 class="comment-heading">Bình luận</h3>
        <div id="loadComment">
          <!-- NÔI DUNG BÌNH LUẬN Ở ĐÂY -->
        </div>
        <form action="" method="post" id="formComment">
          <textarea cols="131" name="content" rows="4" placeholder="Viết bình luận..."></textarea>
          <input type="text" hidden name="product_id" value="<?= $row['product_id'] ?>"> <br>
          <?php
          if (isset($_SESSION['userlogin'])) {
          ?>
            <input type="text" hidden name="user_id" value="<?= $_SESSION['userlogin'][3] ?>"> <br>
          <?php
          }
          ?>
          <button type="submitComment">Gửi bình luận</button>
        </form>
      </div>
    </div>
  </div>
  <div class="nhan_container related-products">
    <div class="featured-product__title linecha">
      <div class="text-2 line-bottom">
        SẢN PHẨM LIÊN QUAN
      </div>
    </div>
    <div class="list-product related-products__list row sm-gutter grid-4">
      <?php
      if (isset($data['ProductRelated'])) {
        while ($item = mysqli_fetch_array($data['ProductRelated'])) {
      ?>
          <div class="col l-2-5 m-4 c-6">
            <a href="<?= BASE_URL ?>/home/product/<?= $item['product_id'] ?>" class="product-cart">
              <div class="product-cart__tags justify-content-right">
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
                    $price = $item['price'];
                    $sale = $item['price_sale'];
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
          </div>
      <?php
        }
      }
      ?>
    </div>
  </div>
</main>
<style>
  #content-error {
    font-size: 1.6rem;
  }
</style>