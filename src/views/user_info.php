<?php
define('TITLE', 'Thông tin tài khoản');
include_once __DIR__ . '/../partials/header.php';

?>


<body>
    <?php if (isset($_SESSION['update'])) {
        unset($_SESSION['update']);
        echo '<div class="alert alert-success mb-0 alert-dismissible fade show" role="alert">
    <strong>Cập nhật thông tin thành công!</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }  ?>
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <div class="container">
        <div class="d-flex flex-column">
            <div class="detail-section d-flex flex-column mb-3 me-3 detail-item p-3">
                <h3>Thông tin tài khoản</h3>
                <div class="container">
                    <div class="row">
                        <div class="info col-8">
                            <i class="fas fa-address-card" style="font-size: 3rem;"></i>
                            <form action="/customer/profile" method="post" class="mt-3">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $id ?? '' ?>">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="passwd" name="passwd" value="<?= htmlspecialchars($passwd) ?? '' ?>">
                                </div>
                                <div class="form-group">
                                    <div class="mb-3 row">
                                        <label for="name" class="col-sm-2 col-form-label">Họ và tên</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($name) ?? '' ?>">
                                            <p class="invalid text-start"><?= $errors['name'] ?? '' ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-3 row">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="email" name="email" value="<?= htmlspecialchars($email) ?? '' ?>">
                                            <p class="invalid text-start"><?= $errors['email'] ?? '' ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-3 row">
                                        <label for="phone_number" class="col-sm-2 col-form-label">Số điện thoại</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= htmlspecialchars($phone_number) ?? '' ?>">
                                            <p class="invalid text-start"><?= $errors['phone'] ?? '' ?></p>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-3 row">
                                        <label for="address" class="col-sm-2 col-form-label">Địa chỉ</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($address) ?? '' ?>">
                                            <p class="invalid text-start"><?= $errors['address'] ?? '' ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="saveChangesBtn text-center">
                                    <button class="btn btn-primary" type="submit">Lưu thay đổi</button>
                                </div>
                            </form>
                        </div>
                        <div class="social-icons flex-column border-start align-item-center col social-link">
                            <div class="change-passwd mb-3">
                                <a href="/customer/changePasswd">Đổi mật khẩu</a>
                            </div>
                            <div>
                                <h4>Liên kết mạng xã hội</h4>
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-facebook-square"></i>
                                            Facebook
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fab fa-google	"></i>
                                            Google
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php
    include_once __DIR__ . '/../partials/footer.php';
    include_once __DIR__ . '/../partials/foot.php';
    ?>