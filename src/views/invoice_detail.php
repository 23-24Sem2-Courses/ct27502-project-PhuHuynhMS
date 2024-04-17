<?php
define('TITLE', 'Chi tiết đơn hàng');
include_once __DIR__ . '/../partials/header.php';
// print_r($books);
?>

<body>
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>
    <div class="container">
        <div class="d-flex justify-content-between">
            <div class="item-list col-sm-9">
                <div class="bg-white ps-3 align-items-center pt-2">
                    <h4><u>Thông tin đơn hàng</u></h4>
                    <div>
                        <div>
                            <h5>Mã đơn hàng: <?= $invoice['invoice_id'] ?? '' ?></h5>
                        </div>
                        <ul>
                            <?php foreach ($books as $a) : ?>
                                <?php foreach ($a as $book) : ?>
                                    <li>
                                        <div class="bg-white mt-1 grid-col-template ps-3 pb-2 align-items-center" <?php
                                                                                                                    if (!isset($book['image'])) {
                                                                                                                        echo 'style="display: none;"';
                                                                                                                    }
                                                                                                                    ?>>
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <a href="/product/detail/id=">
                                                        <img src="/uploads/<?= htmlspecialchars($book['image'] ?? "") ?>" alt="" width="120px" height="120px">
                                                    </a>
                                                </div>
                                                <div>
                                                    <a href="/product/detail/id=" style="color:black"><?= htmlspecialchars($book['book_name'] ?? "") ?></a>
                                                    <p><?= htmlspecialchars($book['author'] ?? "") ?></p>
                                                </div>
                                            </div>
                                            <div>
                                                <p style="display: contents;">Đơn giá: <?= htmlspecialchars($book['price'] ?? "") ?><sup>đ</sup></p>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <p id="quantity${id}" style="display: contents;">Số lượng: <?= htmlspecialchars($a['quantity'] ?? "") ?></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            <?php endforeach; ?>

                        </ul>
                    </div>
                </div>
                <div class="bg-white mt-2 ps-3 pt-2 pb-2">
                    <h4>Hình thức vận chuyển</h4>
                    <p class="text-black">
                        <?= htmlspecialchars($invoice['shipment_method'] ?? '')  ?>
                    </p>
                </div>
                <div class="bg-white mt-2 ps-3 pt-2 pb-2">
                    <h4>Hình thức thanh toán</h4>
                    <p class="text-black">
                        <i class="fas fa-money-bill" style="color:green; font-size:x-large;"></i>
                        <?= htmlspecialchars($invoice['payment_method'] ?? '') ?>
                    </p>
                </div>
            </div>
            <div class="cart-info col-sm-3 ms-2 position-sticky" style="top: 12px;">
                <div class=" address bg-white shadow-sm p-2">
                    <div class="d-flex justify-content-between">
                        <p>Giao tới</p>
                    </div>
                    <div class="d-flex justify-content-start">
                        <p class="text-black border-end pe-2"><strong><?= htmlspecialchars($name ?? '') ?></strong></p>
                        <p class="text-black ms-2"><strong><?= htmlspecialchars($phone_number ?? '') ?></strong></p>
                    </div>
                    <div class="address-detail">
                        <p><?= htmlspecialchars($address ?? '') ?></p>
                    </div>
                </div>
                <div class="temporary-cashier mt-2 shadow-sm bg-white">
                    <div class="d-flex justify-content-between p-2 border-bottom">
                        <p>Tổng tiền</p>
                        <p id="total" style="color: black; font-weight:bold"><?= htmlspecialchars($invoice['total'] ?? '') ?><sup>đ</sup></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once __DIR__ . '/../partials/footer.php';
    include_once __DIR__ . '/../partials/foot.php';
    ?>