      <main class="pt-3 container-fluid">
        <section class="name-pages">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">
                <h5>Sản phẩm</h5>
              </li>
            </ol>
          </nav>
        </section>
        <section class="row display-flex justify-content-between ml-0 mr-0">
          <button class="btn btn-success mb-3" data-toggle="modal" data-target="#tabProduct">
            <i class="fas fa-plus-circle"></i> Thêm sản phẩm
          </button>

          <!-- Load Tab -->
          <div class="modal fade" id="tabProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4>Thêm sản phẩm</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="<?= BASE_URL ?>/Admin/addProduct" method="POST" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Danh mục</label>
                      <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                        <?php
                        if (isset($data['ShowCategory'])) {
                          while ($row = mysqli_fetch_array($data['ShowCategory'])) {
                        ?>
                            <option value="<?= $row['category_id'] ?>"><?= $row['category_name'] ?></option>
                        <?php
                          }
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="formGroupExampleInput">Tên sản phẩm</label>
                      <input type="text" name="name" required class="form-control" id="formGroupExampleInput" placeholder="Tên sản phẩm...">
                    </div>
                    <div class="form-group">
                      <label for="formGroupExampleInput">Giá cho từng kích thước</label>
                      <div class="form-group row">
                        <div class="input-group input-group-sm mb-3 col-4 pt-2">
                          <span class="input-group-text" id="inputGroup-sizing-sm">Nhỏ</span>
                          <input type="text" name="sizeM" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>
                        <div class="input-group input-group-sm mb-3 col-4 pt-2">
                          <span class="input-group-text" id="inputGroup-sizing-sm">Vừa</span>
                          <input type="text" name="sizeML" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>
                        <div class="input-group input-group-sm mb-3 col-4 pt-2">
                          <span class="input-group-text" id="inputGroup-sizing-sm">Lớn</span>
                          <input type="text" name="sizeL" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="formGroupExampleInput">Giảm giá (%)</label>
                      <input type="text" name="priceSale" class="form-control" id="formGroupExampleInput" placeholder="Giảm giá (%)">
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlFile1">Ảnh</label>
                      <input type="file" required name="thumbnail" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                    <div class="form-group">
                      <label for="formGroupExampleInput">Mô tả</label>
                      <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                      <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Load Tab-->
          <select class="form-control col-4" id="mySelect">
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
                <th scope="col">Giá</th>
                <th scope="col">Sale</th>
                <th scope="col">Ngày nhập</th>
                <th style="width: 5px" scope="col"></th>
                <th style="width: 5px" scope="col"></th>
              </tr>
            </thead>
            <tbody id="tableSearch">
              <?php
              while ($row = mysqli_fetch_array(($data['ShowProduct']))) {
              ?>
                <tr class="sortby">
                  <!-- <th scope="row">1</th> -->
                  <td>
                    <img style="width: 70px" src="<?= BASE_URL ?>/<?= $row['thumbnail'] ?>" alt="" />
                  </td>
                  <td><?= $row['product_name'] ?></td>
                  <td class="gia"><?= number_format($row['price'], 0, ",", ".") ?> VNĐ</td>
                  <td><?= $row['price_sale'] ?>%</td>
                  <td><?= date("d/m/Y", strtotime($row['import_date'])); ?></td>
                  <td><a href="<?= BASE_URL ?>/Admin/editProduct/<?= $row['product_id'] ?>" class="btn btn-warning">Sửa</a></td>
                  <td><button class="btn btn-danger" onclick="deleteProduct(<?= $row['product_id'] ?>)">Xóa</button></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </section>
      </main>