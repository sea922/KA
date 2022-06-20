<main class="pt-3 container-fluid">
    <section class="name-pages">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <h5>Bình luận</h5>
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
                    <th scope="col">Tên người dùng</th>
                    <th scope="col">Sản phẩm</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Ngày bình luận</th>
                    <th style="width: 5px" scope="col"></th>
                </tr>
            </thead>
            <tbody id="tableSearch">
                <?php
                while ($row = mysqli_fetch_array($data['showCommentAd'])) {
                ?>
                    <tr>
                        <td class="capitalize"><?=$row['name']?></td>
                        <td><?=$row['product_name']?></td>
                        <td><?=$row['comment_content']?></td>
                        <td class="address_user_truncate"><?=$row['comment_date']?></td>
                        <td><button class="btn btn-danger" onclick="deleteComment(<?= $row['comment_id'] ?>)">Xóa</button></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </section>
</main>