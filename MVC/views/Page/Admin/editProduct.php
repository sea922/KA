<main class="pt-3 container-fluid">
    <section class="name-pages">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <h5>Thêm/Sửa danh mục</h5>
                </li>
            </ol>
        </nav>
    </section>
    <?php
      $row = mysqli_fetch_assoc($data['ShowEdit']);
      if (mysqli_num_rows($data['ShowEdit']) < 1) {
        echo '
        <script>
            alert("Sản phẩm không tồn tại!")
            window.location.assign("../product");
        </script>
        ';
      }
      ?>
    <section class="category container pb-5">
        <?php $item = mysqli_fetch_assoc($data['ShowProduct']); ?>
        <!-- Hiển thị SP theo ID -->
        <form action="<?= BASE_URL ?>/Admin/editProductAct" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Danh mục</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                        <?php
                        while ($row = mysqli_fetch_array($data['ShowCategory'])) {
                            if ($item['category_id'] == $row['category_id']) {
                                echo '<option selected value="' . $item['category_id'] . '">' . $row['category_name'] . '</option>';
                            } else {
                                echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Tên sản phẩm</label>
                    <input type="text" name="name" value="<?= $item['product_name'] ?>" required class="form-control" id="formGroupExampleInput" placeholder="Tên sản phẩm...">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Giá cho từng kích thước</label>
                    <div class="form-group row">
                        <?php
                        while ($avt = mysqli_fetch_array($data['ShowVariant'])) {
                        ?>
                            <div class="input-group input-group-sm mb-3 col-4 pt-2">
                                <span class="input-group-text" id="inputGroup-sizing-sm"><?= $avt['size'] ?></span>
                                <input type="text" name="<?= $avt['size'] ?>" value="<?= $avt['price'] ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Giảm giá (%)</label>
                    <input type="text" name="priceSale" value="<?= $item['price_sale'] ?>" class="form-control" id="formGroupExampleInput" placeholder="Giảm giá (%)">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Ảnh</label>
                    <input type="file" name="thumbnail" class="form-control-file" id="exampleFormControlFile1">
                    <img class="pt-2" src="<?= BASE_URL ?>/<?= $item['thumbnail'] ?>" style="max-width: 200px" id="img_thumbnail">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Mô tả</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"><?= $item['description'] ?></textarea>
                </div>
                <input type="text" name="product_id" hidden value="<?= $item['product_id'] ?>">
                <div class="modal-footer">
                    <?php
                    $previous = "javascript:history.go(-1)";
                    if (isset($_SERVER['HTTP_REFERER'])) {
                        $previous = $_SERVER['HTTP_REFERER'];
                    }
                    ?>
                    <a href="<?= $previous ?>" class="btn btn-warning">Back</a>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
        </form>
    </section>
</main>