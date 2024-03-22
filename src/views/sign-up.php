<?php
define('TITLE', 'Đăng Ký');

include_once __DIR__ . '/../partials/header.php';
?>

<body>
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>


    <div class="d-flex flex-column align-items-center form-body">
        
        <form class="py-4 w-50" action="/customer" method="POST">
            <h3 style="text-align: center;" class="sign-up-text">Đăng ký</h3>
            <div class="container w-75">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label for="passwd" class="form-label">Password</label>
                    <input type="password" class="form-control" id="passwd" name="passwd">
                </div>
                <div class="mb-3">
                    <label for="confirmpasswd" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmpasswd" name="confirmpasswd">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Họ tên</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="Address" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" id="Address" name="address">
                </div>
                <div class="mb-3">
                    <label for="InputNumber" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="InputNumber" name="phone_number">
                </div>
                <hr>
                <p style="text-align:center;">Bằng việc đăng kí, bạn đã đồng ý với Jupiter về <span style="color: red;">Điều khoản dịch vụ</span></p>
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