<?php
define('TITLE', 'Chi tiết đơn hàng');
include_once __DIR__ . '/../partials/header.php';
?>

<body>
    <?php include_once __DIR__ . '/../partials/admin_navbar.php'; ?>
    <div class="container admin_container">
        <div class="d-flex justify-content-between">

            <div class="item-list col-sm-9">
                <div class="bg-white ps-3 align-items-center pt-2">
                    <?php
                    if (isset($_SESSION['pass'])) {
                        $passed = $_SESSION['pass'];
                        unset($_SESSION['pass']);

                        if ($passed === 'failed') {
                            echo '<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                            <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </symbol>
                        </svg>

                        <div class="alert alert-warning alert-dismissible fade show me-3" role="alert">
                        <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Warning:" width=40 height=20><use xlink:href="#exclamation-triangle-fill"/></svg>
                            Đơn hàng đã được duyệt từ trước.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                        }
                    }
                    ?>
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
                        <?= $invoice['shipment_method'] ?? '' ?>
                    </p>
                </div>
                <div class="bg-white mt-2 ps-3 pt-2 pb-2">
                    <h4>Hình thức thanh toán</h4>
                    <p class="text-black">
                        <i class="fas fa-money-bill" style="color:green; font-size:x-large;"></i>
                        <?= $invoice['payment_method'] ?? '' ?>
                    </p>
                </div>
            </div>
            <div class="cart-info col-sm-3 ms-2 position-sticky" style="top: 12px;">
                <div class=" address bg-white shadow-sm p-2">
                    <div class="d-flex justify-content-between">
                        <p>Giao tới</p>
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
                    <div class="d-flex justify-content-between p-2 border-bottom">
                        <p>Tổng tiền</p>
                        <p id="total" style="color: black; font-weight:bold"><?= $invoice['total'] ?? '' ?><sup>đ</sup></p>
                    </div>
                </div>
                <div>
                    <form action="/invoice/pass" method="post">
                        <input type="hidden" value="<?= $invoice['invoice_id'] ?? '' ?>" name="invoice_id">
                        <button type="submit" class="btn btn-success w-100 mt-2">
                            <i class='fas fa-check-circle'></i>
                            Duyệt
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once __DIR__ . '/../partials/foot.php';
    ?>