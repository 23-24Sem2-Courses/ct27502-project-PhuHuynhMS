<?php
define('TITLE', 'Đăng Nhập');
include_once __DIR__ . '/../partials/header.php';
?>

<body>
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <div class="d-flex flex-column align-items-center form-body">
        <form class="py-4 w-50" action="" method="POST">
            <p style="text-align: center;" class="sign-up-text">Đăng nhập</p>
            <div class="container w-75">
                <div class="mb-3">
                    <label for="InputNumber" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="InputNumber" name="phonenumber">
                </div>
                <div class="mb-3">
                    <label for="InputPassword1" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="InputPassword1" name="pwd">
                </div>
                <hr>

                <a href="#" class="d-inline-block mb-3 text-decoration-none">Quên mật khẩu</a>
                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary d-inline">Đăng nhập</button>
                    <p class="d-inline ms-2 float-end mb-0">Bạn mới biết đến Jupiter? <a href="/customer" class="login-link">Đăng ký</a></p>
                </div>
            </div>
            <?php
            ?>
        </form>
    </div>

    <?php
    include_once __DIR__ . '/../partials/footer.php';
    ?>