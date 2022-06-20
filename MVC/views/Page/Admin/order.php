<main class="pt-3 container-fluid">
    <section class="name-pages">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <h5>Đơn hàng</h5>
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
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Ngày đặt hàng</th>
                    <th scope="col">Thanh toán</th>
                    <th scope="col">Trạng thái</th>
                    <th style="width: 5px" scope="col"></th>
                </tr>
            </thead>
            <tbody id="tableSearch">
                <?php
                while ($row = mysqli_fetch_array($data['showOrder'])) {
                ?>
                    <tr>
                        <td class="capitalize"><?=$row['name']?></td>
                        <td><?=$row['phone']?></td>
                        <td><?=$row['address']?></td>
                        <td><?=$row['order_date']?></td>
                        <td class="address_user_truncate"><?=$row['method']?></td>
                        <?php
                        if($row['status']=="Đang tiến hành"){
                            ?>
                            <td class="bold dangtienhanh status_order"><?=$row['status']?></td>
                            <?php
                        }
                        if($row['status']=="Đang giao"){
                            ?>
                            <td class="bold danggiao status_order"><?=$row['status']?></td>
                            <?php
                        }
                        if($row['status']=="Đã nhận hàng"){
                            ?>
                            <td class="bold danhan status_order"><?=$row['status']?></td>
                            <?php
                        }
                        if($row['status']=="Đã hủy"){
                            ?>
                            <td class="bold dahuy status_order"><?=$row['status']?></td>
                            <?php
                        }
                        ?>
                        <td><a href="<?=BASE_URL?>/Admin/orderDetails/<?= $row['order_id']?>" class="btn btn-success">Xem</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </section>
</main>