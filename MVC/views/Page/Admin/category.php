      <main class="pt-3 container-fluid">
        <section class="name-pages">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">
                <h5>Danh mục</h5>
              </li>
            </ol>
          </nav>
        </section>
        <section class="row display-flex justify-content-between ml-0 mr-0">
          <button class="btn btn-success mb-3" data-toggle="modal" data-target="#tabCategory">
            <i class="fas fa-plus-circle"></i> Thêm danh mục
          </button>
          <!-- Load Tab-->
          <div class="modal fade" id="tabCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4>Thêm danh mục</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="<?= BASE_URL ?>/Admin/addCategory" method="POST">
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="formGroupExampleInput">Tên danh mục</label>
                      <input type="text" class="form-control" name="name" id="formGroupExampleInput" required placeholder="Tên danh mục..." />
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                      Đóng
                    </button>
                    <!-- <input type="submit" class="btn btn-primary"></input> -->
                    <input type="submit" class="btn btn-primary" value="Lưu">
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- Load Tab-->

          <select class="form-control col-4" id="mySelect">
            <option>Sắp xếp theo</option>
            <option class="sortbyAz">Theo A-Z</option>
            <option>Theo Z-A</option>
          </select>
        </section>
        <section class="category">
          <table class="table border-0 rounded">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Tên</th>
                <th style="width: 10px" scope="col"></th>
                <th style="width: 10px" scope="col"></th>
              </tr>
            </thead>
            <tbody id="tableSearch">
              <?php
              while ($row = mysqli_fetch_array($data['ShowCategory'])) {
              ?>
                <tr class="sortby">
                  <td><?= $row['category_name'] ?></td>
                  <td><a href="<?=BASE_URL?>/Admin/editCategory/<?=$row['category_id']?>" class="btn btn-warning">Sửa</a></td>
                  <td><button class="btn btn-danger" onclick="deleteCategory(<?=$row['category_id']?>)">Xóa</button></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </section>
      </main>