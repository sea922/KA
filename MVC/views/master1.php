<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KA Coffee</title>
    <link rel="shortcut icon" href="<?= BASE_URL ?>/MVC/public/images/icon_logo.png" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/MVC/public/css/grid.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/MVC/public/css/base.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/MVC/public/css/style.css" />
    <link rel="stylesheet" href="<?= BASE_URL ?>/MVC/public/css/responsive.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/MVC/public/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/MVC/public/themify-icons/themify-icons.css" />
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src=" https://unpkg.com/sweetalert/dist/sweetalert.min.js "> </script>
</head>

<body>
    <div class="app">
        <span class="scroll-top show-scroll" id="toTop">
            <i class="scroll-top__icon fas fa-chevron-up"></i>
        </span>
        <?php require_once "./mvc/views/blocks/header.php"; ?>
        <?php require_once "./mvc/views/Page/Site/" . $data["Page"] . ".php" ?>
        <?php require_once "./mvc/views/blocks/footer.php"; ?>
    </div>
    <?php require_once "./mvc/views/Page/site/login.php"; ?>
    <?php require_once "./mvc/views/Page/site/regsiter.php"; ?>
    <?php require_once "./mvc/views/Page/site/forgot.php"; ?>
    <!-- ============================= Javascript ===================================== -->
    <script src="<?= BASE_URL ?>/MVC/public/js/sroll.js"></script>
    <script src="<?= BASE_URL ?>/MVC/public/js/jquery.validate.min.js"></script>
    <script src="<?= BASE_URL ?>/MVC/public/js/jquery-ui.min.js"></script>
    <script src="<?= BASE_URL ?>/MVC/public/js/slider.js"></script>
    <script>
        window.addEventListener("scroll", function() {
            let headerMenu = document.querySelector('#menu-area');
            if (window.pageYOffset > 0) {
                headerMenu.classList.add("cus-nav");
            } else {
                headerMenu.classList.remove("cus-nav");
            }
        })
    </script>
</body>

</html>