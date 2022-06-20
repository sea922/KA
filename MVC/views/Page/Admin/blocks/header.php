        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">Kim Anh</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="container collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                            <a class="nav-link" href="<?=BASE_URL?>/Admin/">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=BASE_URL?>/Admin/category">Danh mục</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=BASE_URL?>/Admin/product">Sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=BASE_URL?>/Admin/user">Người dùng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=BASE_URL?>/Admin/comment">Bình luận</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=BASE_URL?>/Admin/order">Đơn hàng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link logout_nav" href="<?=BASE_URL?>/Admin/logout"><i class="fas fa-sign-out-alt"></i></a>
                        </li>
                    </ul>
                    <form class="form-inline">
                        <input class="form-control mr-sm-2" type="search" id="search" placeholder="Tìm kiếm..." aria-label="Search" />
                        <button class="btn btn-outline-info my-2 my-sm-0" type="submit">
                            Tìm kiếm
                        </button>
                    </form>
                </div>
            </nav>
        </header>
        <style>
            .navbar-dark .navbar-nav .nav-item .logout_nav i{
                color: white;
                border-radius: 10px;
                font-weight: 600;
                padding: 5px 10px;
                background-color: #c15a5a;
            }
            .navbar-dark .navbar-nav .nav-item .logout_nav i:hover{
                cursor: pointer;
                opacity: 0.9;
            }
        </style>
       