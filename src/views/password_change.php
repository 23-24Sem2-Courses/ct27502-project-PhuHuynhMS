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
                            <form action="/customer/changePasswd" method="post" class="mt-3">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $id ?? '' ?>">
                                </div>
                                <div class="form-group">
                                    <div class="mb-3 row">
                                        <label for="oldPassword" class="col-sm-2 col-form-label">Mật khẩu cũ</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="oldPassword" name="oldPassword">
                                            <p class="invalid text-start"><?= $errors['invalidPassword'] ?? '' ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-3 row">
                                        <label for="newPassword" class="col-sm-2 col-form-label">Mật khẩu mới</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="newPassword" name="newPassword">
                                            <p class="invalid text-start"><?= $errors[0]['passwd'] ?? '' ?></p>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="mb-3 row">
                                        <label for="newConfirmPassword" class="col-sm-2 col-form-label">Xác nhận lại mật khẩu</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="newConfirmPassword" name="newConfirmPassword">
                                            <p class="invalid text-start"><?= $errors[0]['passwd_confirm'] ?? '' ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="saveChangesBtn text-center">
                                    <button class="btn btn-primary" type="submit">Lưu thay đổi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . '/../partials/footer.php';
