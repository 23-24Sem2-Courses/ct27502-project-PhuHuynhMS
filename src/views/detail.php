<?php
define('TITLE', 'Thanh toán');
include_once __DIR__ . '/../partials/header.php';

print_r($_SESSION);
?>

<body>
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>
    <div class="container">
        <h3 class="mt-3 mb-3">Thanh toán</h3>
        <div>
            <form class="d-flex justify-content-between" id="confirm-form" action="/checkout/confirmation" method="post">
                <div class="item-list col-sm-9">
                    <div class="bg-white ps-3 align-items-center pt-2">
                        <h4><u>Xác nhận đơn hàng bao gồm:</u></h4>
                        <div class="cart_detail">
                        </div>
                    </div>
                    <div class="bg-white mt-2 ps-3 pt-2 pb-2">
                        <h4>Chọn hình thức vận chuyển</h4>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="shipment" value="Giao hàng tiết kiệm" id="shipment" checked>
                            <label class="form-check-label" for="shipment">
                                Giao hàng tiết kiệm
                            </label>
                        </div>
                    </div>
                    <div class="bg-white mt-2 ps-3 pt-2 pb-2">
                        <h4>Chọn hình thức thanh toán</h4>
                        <div class="form-check mb-4">
                            <i class="fas fa-money-bill" style="color:green; font-size:x-large;"></i>
                            <input class="form-check-input" type="radio" name="payment" value="payByCash" checked>
                            <label class="form-check-label" for="payByCash">
                                Thanh toán bằng tiền mặt
                            </label>
                        </div>
                        <div class="form-check">
                            <i class="fa fa-credit-card" style="color:deepskyblue; font-size:x-large;"></i>
                            <input class="form-check-input" type="radio" name="payment" value="payByCredit">
                            <label class="form-check-label" for="payByCredit">
                                Thanh toán bằng thẻ
                            </label>
                        </div>
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
                        <div class="d-flex justify-content-between p-2">
                            <p>Phí vận chuyển</p>
                            <p style="color: black; font-weight:bold">32000<sup>₫</sup></p>
                        </div>
                        <div class="d-flex justify-content-between p-2 border-bottom">
                            <p>Giảm giá</p>
                            <p style="color: black; font-weight:bold">0<sup>₫</sup></p>
                        </div>
                        <div class="d-flex justify-content-between p-2 border-bottom">
                            <p>Tổng tiền</p>
                            <p id="total" style="color: black; font-weight:bold">Vui lòng chọn sản phẩm</p>
                            <input type="hidden" id="total_input" class="form-control" name="total">
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <button type="submit" class="text-center btn btn-danger w-100" id="confirmation-order-btn">Đặt hàng</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div id="order-confirm" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Xác nhận đặt hàng</h4>
                </div>
                <div class="cart-modal-body p-2">
                    <i class="fa fa-check-circle" style="font-size:20px;color:green"></i>
                    Đặt hàng thành công
                </div>
                <div class="modal-footer">
                    <a href="/checkout/confirmation" class="btn btn-danger">Xem đơn hàng</a>
                    <a href="/" class="btn btn-primary">
                        <i class="fa fa-shopping-cart" style="font-size:15px"></i>
                        Tiếp tục mua sắm
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
    include_once __DIR__ . '/../partials/footer.php';
    include_once __DIR__ . '/../partials/foot.php';
    ?>