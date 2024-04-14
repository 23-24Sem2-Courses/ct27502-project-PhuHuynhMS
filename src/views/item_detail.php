<?php
define('TITLE', 'Chi tiết sản phẩm');
include_once __DIR__ . '/../partials/header.php';

?>


<body>
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>

    <div class="d-flex justify-content-around align-items-start">
        <div class="img-section ms-3 position-sticky" style="margin-bottom: 15px; top:12px">
            <img src="/uploads/<?= $image ?>" id="book-image" alt="" width=400 height=400>
        </div>
        <div class="d-flex flex-column">
            <div class="detail-section d-flex flex-column mb-3 me-3 detail-item p-3">
                <div class="detail-header mb-3">
                    <h3 class="book-name"><?= htmlspecialchars($book_name) ?? '' ?></h3>
                    <p class='author'><?= htmlspecialchars($author) ?? '' ?></p>
                    <p><span class="price"><?= number_format(htmlspecialchars($price), thousands_separator: '.') ?? '' ?></span><sup>₫</sup></p>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="col-sm-5 cashier mb-3 me-4">
                        <form action="/invoice/detail" method="post">
                            <input hidden name="id_book" id="book_id" value="<?= $id_book ?>">
                            <div class="quantity-container ">
                                <h4>Số lượng</h4>
                                <div class="quatity-btns d-flex align-items-center mb-3">
                                    <div class="border quantity-btn rounded d-flex justify-content-center align-items-center">
                                        <button type="button" class="minus-btn bg-transparent border-0 m-1">-</button>
                                    </div>
                                    <div id="quantity" class="border quantity-btn rounded d-flex justify-content-center align-items-center m-1">
                                        0
                                    </div>
                                    <div class="border quantity-btn rounded d-flex justify-content-center align-items-center">
                                        <button type="button" class="plus-btn quantity-btn bg-transparent border-0">+</button>
                                    </div>
                                </div>
                                <h4>Tạm tính</h4>
                                <h4><span class="cost text-black"><strong>0</span><sup class="text-black">₫</sup></strong></h4>
                            </div>
                            <div class="order">
                                <a href="/checkout/cart" class="text-white btn btn-danger mb-2" onclick="addToCart(<?= $id_book ?>)">Mua ngay</a>
                                <button type="button" class="btn btn-outline-primary add-btn" onclick="addToCart(<?= $id_book ?>)">Thêm vào giỏ</button>
                            </div>
                        </form>
                    </div>
                    <div class="item-detail col-sm-5 d-flex justify-content-center">
                        <div class="container-fluid detail-table table border pb-2 ps-4 pe-4">
                            <div class="row">
                                <h4><strong>Thông số chi tiết</strong></h4>
                            </div>
                            <div class="row text-center border-bottom">
                                <div class="col-sm-6 border-end">
                                    <p>Năm xuất bản</p>
                                </div>
                                <div class="col-sm-6">
                                    <p><?= $year ?? '' ?></p>
                                </div>
                            </div>
                            <div class="row text-center border-bottom">
                                <div class="col-sm-6 border-end">
                                    <p>Nhà xuất bản</p>
                                </div>
                                <div class="col-sm-6">
                                    <p><?= $manufactorer ?? '' ?></p>
                                </div>
                            </div>
                            <div class="row text-center border-bottom">
                                <div class="col-sm-6 border-end">
                                    <p>Số trang</p>
                                </div>
                                <div class="col-sm-6">
                                    <p><?= $page_quantity ?? '' ?></p>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-sm-6 border-end">
                                    <p>Bìa</p>
                                </div>
                                <div class="col-sm-6">
                                    <p><?= $cover ?? '' ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="item-description position-relative" style="max-height: 300px; overflow: hidden;">
                        <h4>Mô tả sản phẩm</h4>
                        <?php
                        $paragraph_array = split_paragraph($description);
                        foreach ($paragraph_array as $para) {
                            echo '<p>' . $para . '</p>';
                        }
                        ?>
                        <div class="gradient"></div>
                    </div>
                    <button class="btn-more border-0 transparent text-primary" style="background: transparent;">Xem thêm</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body d-flex align-items-center flex-column pb-0">
                    <i class='far fa-check-circle' style="font-size: 50px; color:green"></i>
                    <p>Sản phẩm đã được thêm vào giỏ hàng</p>
                </div>
                <div class="modal-footer pt-0 border-0">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Ok!!!</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    include_once __DIR__ . '/../partials/footer.php';
    include_once __DIR__ . '/../partials/foot.php';
    ?>