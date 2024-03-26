<?php
define('TITLE', 'Đăng Nhập');
include_once __DIR__ . '/../partials/header.php';
?>

<body>
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <div class="d-flex flex-column align-items-center form-body">
        <form class="py-4 w-50 form" action="/login" method="POST">
            <h3 style="text-align: center;" class="sign-up-text">Đăng nhập</h3>
            <div class="container w-75">
                <div class="mb-3">
                    <label for="InputNumber" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="InputNumber" name="phone_number">
                    <span class="invalid"><strong><?= isset($phone_error) ? $phone_error : ""; ?></strong></span>
                </div>
                <div class="mb-3">
                    <label for="InputPassword1" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="InputPassword1" name="passwd">
                    <span class="invalid"><strong><?= isset($passwd_error) ? $passwd_error : ""; ?></strong></span>
                </div>
                <hr>

                <a href="#" class="d-inline-block mb-3 text-decoration-none">Quên mật khẩu</a>
                <p class="invalid"><?= isset($empty_input) ? $empty_input : ""; ?></p>
                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary d-inline">Đăng nhập</button>
                    <p class="d-inline ms-2 float-end mb-0">Bạn mới biết đến Jupiter? <a href="/signup" class="login-link">Đăng ký</a></p>
                </div>
            </div>
            <?php
            ?>
        </form>
    </div>

    <?php
    include_once __DIR__ . '/../partials/footer.php';
    ?>