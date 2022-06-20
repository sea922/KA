<main class="pt-3 container-fluid">
  <section>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <h5>Thống kê</h5>
        </li>
      </ol>
    </nav>
  </section>
  <section>
    <div class="row">
      <div class="col col-4 pb-4">
        <a href="<?= BASE_URL ?>/Admin/category" class="card border-0 rounded">
          <div class="card-body text-center">
            <h6 class="card-title text-uppercase">Danh Mục</h6>
            <h1 class="card-text text-dark">
              <?php
              if (isset($data['countCategory'])) {
                $row = mysqli_fetch_assoc($data['countCategory']);
                echo $row['count(*)'];
              }
              ?>
            </h1>
            <p class="text-danger">
              <i class="fas"></i>
            </p>
          </div>
        </a>
      </div>
      <div class="col col-4 pb-4">
        <a href="<?= BASE_URL ?>/Admin/product" class="card border-0 rounded">
          <div class="card-body text-center">
            <h6 class="card-title text-uppercase">Sản phẩm</h6>
            <h1 class="card-text text-dark">
              <?php
              if (isset($data['countProduct'])) {
                $row = mysqli_fetch_assoc($data['countProduct']);
                echo $row['count(*)'];
              }
              ?>
            </h1>
            <p class="text-success">
              <i class="fas "></i>
            </p>
          </div>
        </a>
      </div>
      <div class="col col-4 pb-4">
        <a href="<?= BASE_URL ?>/Admin/user" class="card border-0 rounded">
          <div class="card-body text-center">
            <h6 class="card-title text-uppercase">Người dùng</h6>
            <h1 class="card-text text-dark">
              <?php
              if (isset($data['countUser'])) {
                $row = mysqli_fetch_assoc($data['countUser']);
                echo $row['count(*)'];
              }
              ?>
            </h1>
            <p class="text-danger">
              <i class="fas"></i>
            </p>
          </div>
        </a>
      </div>
      <div class="col col-4 pb-4">
        <a href="<?= BASE_URL ?>/Admin/order" class="card border-0 rounded">
          <div class="card-body text-center">
            <h6 class="card-title text-uppercase">Đơn hàng</h6>
            <h1 class="card-text text-dark">
              <?php
              if (isset($data['countOrder'])) {
                $row = mysqli_fetch_assoc($data['countOrder']);
                echo $row['count(*)'];
              }
              ?>
            </h1>
            <p class="text-success">
              <i class="fas "></i>
            </p>
          </div>
        </a>
      </div>
      <div class="col col-4 pb-4">
        <a href="<?= BASE_URL ?>/Admin/comment" class="card border-0 rounded">
          <div class="card-body text-center">
            <h6 class="card-title text-uppercase">Bình luận</h6>
            <h1 class="card-text text-dark">
              <?php
              if (isset($data['countComment'])) {
                $row = mysqli_fetch_assoc($data['countComment']);
                echo $row['count(*)'];
              }
              ?>
            </h1>
            <p class="text-danger">
              <i class="fas"></i>
            </p>
          </div>
        </a>
      </div>
    </div>
  </section>
  <section class="pt-5">
    <h4>Thống kế sản phẩm theo danh mục</h4>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Tên danh mục</th>
          <th scope="col">Số lượng sản phẩm</th>
          <th scope="col">Giá thấp nhất</th>
          <th scope="col">Giá Trung bình</th>
          <th scope="col">Giá cáo nhất</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total = 0;
        $count = 0;
        foreach ($data['ThongKe'] as $item) {
        ?>
          <tr>
            <th scope="row"><?= (++$count) ?></th>
            <td><?= $item['name_category'] ?></td>
            <td><?= $item['numProduct'] ?></td>
            <td><?= number_format($item['priceMin']) ?></td>
            <td><?= number_format($item['priceAvg']) ?></td>
            <td><?= number_format($item['priceMax']) ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </section>
  <section class="chart row pt-5 mb-5 pb-5">
    <div class="chart-line col-10 mx-auto">
      <h4 class="text-center">Sản phẩm theo danh mục</h4>
      <canvas class="col-12" id="myChartLine"></canvas>
    </div>
    <div class="chart-line col-10 mx-auto mt-5">
      <h4 class="text-center">Sản phẩm bán nhiều nhất</h4>
      <canvas class="col-12" id="myChartLine2"></canvas>
    </div>
  </section>
</main>

<script>
  // chart 1
  const ctx = document.getElementById("myChartLine").getContext("2d");
  const myChartLine = new Chart(ctx, {
    type: "bar",
    data: {
      labels: [
        <?php
        $tongCategory = mysqli_num_rows($data['thongkeChartName']);
        $i = 1;
        foreach ($data['thongkeChartName'] as $item) {
          if ($i == $tongCategory) $phay = "";
          else $phay = ",";
          echo "'" . $item['name_category'] . "'" . $phay;
          $i += 1;
        }
        ?>
      ],
      datasets: [{
        label: 'Thống kê danh mục theo sản phẩm',
        data: [
          <?php
          $tongCategory = mysqli_num_rows($data['thongkeChartNum']);
          $i = 1;
          foreach ($data['thongkeChartNum'] as $item) {
            if ($i == $tongCategory) $phay = "";
            else $phay = ",";
            echo $item['numProduct'] . $phay;
            $i += 1;
          }
          ?>
        ],
        backgroundColor: [
          "rgba(255, 99, 132, 0.2)",
          "rgba(54, 162, 235, 0.2)",
          "rgba(255, 206, 86, 0.2)",
          "rgba(75, 192, 192, 0.2)",
          "rgba(153, 102, 255, 0.2)",
          "rgba(255, 159, 64, 0.2)",
        ],
        borderColor: [
          "rgba(255, 99, 132, 1)",
          "rgba(54, 162, 235, 1)",
          "rgba(255, 206, 86, 1)",
          "rgba(75, 192, 192, 1)",
          "rgba(153, 102, 255, 1)",
          "rgba(255, 159, 64, 1)",
        ],
        borderWidth: 1,
      }, ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });



  // chart 2
  const ctx2 = document.getElementById("myChartLine2").getContext("2d");
  const myChartLine2 = new Chart(ctx2, {
    type: "line",
    data: {
      labels: [
        <?php
        $tongCategory = mysqli_num_rows($data['ThongKeOrderName']);
        $i = 1;
        foreach ($data['ThongKeOrderName'] as $item) {
          if ($i == $tongCategory) $phay = "";
          else $phay = ",";
          echo "'" . $item['product_name'] . "'" . $phay;
          $i += 1;
        }
        ?>
      ],
      datasets: [{
        label: 'Thống kê sản phẩm mua nhiều nhất',
        data: [
          <?php
          $tongCategory = mysqli_num_rows($data['ThongKeOrderNum']);
          $i = 1;
          foreach ($data['ThongKeOrderNum'] as $item) {
            if ($i == $tongCategory) $phay = "";
            else $phay = ",";
            echo $item['ProductNum'] . $phay;
            $i += 1;
          }
          ?>
        ],
        backgroundColor: [
          "rgba(255, 99, 132, 0.2)",
          "rgba(54, 162, 235, 0.2)",
          "rgba(255, 206, 86, 0.2)",
          "rgba(75, 192, 192, 0.2)",
          "rgba(153, 102, 255, 0.2)",
          "rgba(255, 159, 64, 0.2)",
        ],
        borderColor: [
          "rgba(255, 99, 132, 1)",
          "rgba(54, 162, 235, 1)",
          "rgba(255, 206, 86, 1)",
          "rgba(75, 192, 192, 1)",
          "rgba(153, 102, 255, 1)",
          "rgba(255, 159, 64, 1)",
        ],
        borderWidth: 1,
      }, ],
    },
    options: {
      plugins: {
        filler: {
          propagate: false,
        },
        title: {
          display: true,
          text: (ctx2) => 'Fill: ' + ctx2.chart.data.datasets[0].fill
        }
      },
      interaction: {
        intersect: false,
      }
    },
  });
</script>