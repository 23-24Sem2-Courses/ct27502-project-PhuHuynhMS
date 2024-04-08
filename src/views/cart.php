<?php
define('TITLE', 'Giỏ hàng');
include_once __DIR__ . '/../partials/header.php';

?>

<body>
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>
    <div class="container">
        <h3 class="mt-3 mb-3">Giỏ hàng</h3>

        <div class="d-flex justify-content-between">
            <div class="item-list col-sm-9">
                <div class="bg-white ps-3 grid-col-template align-items-center">
                    <div>
                        <p class="m-0"><strong>Sản phẩm</strong></p>
                    </div>
                    <div>
                        <p class="m-0"><strong>Đơn giá</strong></p>
                    </div>
                    <div>
                        <p class="m-0"><strong>Số lượng</strong></p>
                    </div>
                    <div>
                        <p class="m-0"><strong>Thành tiền</strong></p>
                    </div>
                    <div>
                        <p class="m-0"><i class="fas fa-trash-alt"></i></p>
                    </div>
                </div>

                <div class="cart">

                </div>
            </div>
            <div class="cart-info col-sm-3 ms-2 position-sticky" style="top: 12px;">
                <div class=" address bg-white shadow-sm p-2">
                    <div class="d-flex justify-content-between">
                        <p>Giao tới</p>
                        <a href="/customer/profile">thay đổi</a>
                    </div>
                    <div class="d-flex justify-content-start">
                        <p class="text-black border-end pe-2"><strong><?= $name ?></strong></p>
                        <p class="text-black ms-2"><strong><?= $phone_number ?></strong></p>
                    </div>
                    <div class="address-detail">
                        <p><?= $address ?></p>
                    </div>
                </div>
                <div class="temporary-cashier mt-2 shadow-sm bg-white">
                    <div class="d-flex justify-content-between p-2">
                        <p>Tạm tính</p>
                        <p id="temp_cal" style="color: black; font-weight:bold">0<sup>₫</sup></p>
                    </div>
                    <div class="d-flex justify-content-between p-2 border-bottom">
                        <p>Giảm giá</p>
                        <p style="color: black; font-weight:bold">0<sup>₫</sup></p>
                    </div>
                    <div class="d-flex justify-content-between p-2 border-bottom">
                        <p>Tổng tiền</p>
                        <p id="total" style="color: black; font-weight:bold">Vui lòng chọn sản phẩm</p>
                    </div>
                </div>
                <div class="text-center mt-2">
                    <a href="/checkout/order" class="text-center btn btn-danger w-100" id="order-btn">Đặt hàng</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="delete-cart-confirm" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Xác nhận xóa</h4>
                </div>
                <div class="cart-modal-body p-2">Do you want to delete this contact?</div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-danger" id="delete-cart-item">Xóa</button>
                    <button type="button" data-bs-dismiss="modal" class="btn btn-default">Hủy</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once __DIR__ . '/../partials/footer.php';
    include_once __DIR__ . '/../partials/foot.php';
    ?>