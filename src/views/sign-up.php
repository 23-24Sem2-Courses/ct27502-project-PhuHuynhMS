<?php
define('TITLE', 'Đăng Ký');

include_once __DIR__ . '/../partials/header.php';
?>

<body>
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>


    <div class="d-flex flex-column align-items-center form-body">

        <form class="py-4 w-50" action="/signup" method="POST">
            <div class="container form w-75">
                <h3 style="text-align: center;" class="sign-up-text">Đăng ký</h3>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= isset($oldValues['email']) ? htmlspecialchars($oldValues['email']) : '' ?>">
                    <?php if (isset($errors['email'])) : ?>
                        <span class="invalid">
                            <strong><?= $errors['email'] ?></strong>
                        </span>
                    <?php endif ?>
                </div>
                <div class="mb-3">
                    <label for="passwd" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="passwd" name="passwd">
                    <?php if (isset($errors['passwd'])) : ?>
                        <span class="invalid">
                            <strong><?= $errors['passwd'] ?></strong>
                        </span>
                    <?php endif ?>
                </div>
                <div class="mb-3">
                    <label for="confirmpasswd" class="form-label">Nhập lại mật khẩu</label>
                    <input type="password" class="form-control" id="confirmpasswd" name="confirmpasswd">
                    <?php if (isset($errors['passwd_confirm'])) : ?>
                        <span class="invalid">
                            <strong><?= $errors['passwd_confirm'] ?></strong>
                        </span>
                    <?php endif ?>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Họ tên</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= isset($oldValues['name']) ? htmlspecialchars($oldValues['name']) : '' ?>">
                    <?php if (isset($errors['name'])) : ?>
                        <span class="invalid">
                            <strong><?= $errors['name'] ?></strong>
                        </span>
                    <?php endif ?>
                </div>

                <div class="mb-3">
                    <label for="Address" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" id="Address" name="address" value="<?= isset($oldValues['address']) ? htmlspecialchars($oldValues['address']) : '' ?>">
                    <?php if (isset($errors['address'])) : ?>
                        <span class="invalid">
                            <strong><?= $errors['address'] ?></strong>
                        </span>
                    <?php endif ?>
                </div>
                <div class="mb-3">
                    <label for="InputNumber" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="InputNumber" name="phone_number" value="<?= isset($oldValues['phone']) ? htmlspecialchars($oldValues['phone']) : '' ?>">
                    <?php if (isset($errors['phone'])) : ?>
                        <span class="invalid">
                            <strong><?= $errors['phone'] ?></strong>
                        </span>
                    <?php endif ?>
                </div>
                <hr>
                <p style="text-align:center;">Bằng việc đăng kí, bạn đã đồng ý với Jupiter về <span style="color: red;">Điều khoản dịch vụ</span></p>
                <?php if (isset($errors['empty_input'])) : ?>
                    <span class="invalid">
                        <strong><?= $errors['empty_input'] ?></strong>
                    </span>
                <?php endif ?>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <button type="submit" class="btn btn-primary d-inline">Đăng ký</button>
                    <p class="d-inline ms-2 float-end mb-0">Bạn đã có tài khoản? <a href="/login" class="login-link">Đăng nhập</a></p>
                </div>
            </div>
        </form>
    </div>
    <?php include_once __DIR__ . '/../partials/footer.php'; ?>

</body>

</html>