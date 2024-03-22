<?php

include_once __DIR__ . '/../../src/partials/header.php';

?>


<body>
    <?php include_once __DIR__ . '/../../src/partials/navbar.php'; ?>

    <div class="d-flex justify-content-around align-items-start">
        <div class="img-section ms-3">
            <img src="./../uploads/2a6154ba08df6ce6161c13f4303fa19e.jpg.webp" alt="" width=400 height=400>
        </div>
        <div class="d-flex flex-column">
            <div class="detail-section d-flex flex-column mb-3 me-3 detail-item p-3">
                <div class="detail-header mb-3">
                    <h3 class="book-name">Ba nguoi thay vi dai</h3>
                    <p class='author'>Robin Sharma</p>
                    <p class="price">67.000<sup>₫</sup></p>
                </div>
                <div class="cashier mb-3">
                    <div class="quantity-container ">
                        <h4>So luong</h4>
                        <div class="quatity-btns d-flex justify-content-between align-items-center mb-3">
                            <div class="border quantity-btn rounded d-flex justify-content-center align-items-center">
                                <button class="minus-btn bg-transparent border-0">-</button>
                            </div>
                            <div class="border quantity-btn rounded d-flex justify-content-center align-items-center">
                                <input type="text" name="" id="" value="0" style="width: 38px;" class="border-0 text-center ">
                            </div>
                            <div class="border quantity-btn rounded d-flex justify-content-center align-items-center">
                                <button class="plus-btn quantity-btn bg-transparent border-0">+</button>
                            </div>
                        </div>
                        <h4>Tam tinh</h4>
                        <p>0</p>
                    </div>
                    <div class="order">
                        <button class="text-white btn btn-danger mb-2">Mua ngay</button>
                        <button class="btn btn-outline-primary">Them vao gio</button>
                    </div>
                </div>
                <div class="item-description">
                    <h4>Mo ta san pham</h4>
                    <p>Câu chuyện cảm động và lời khuyên ý nghĩa từ ba người thầy vĩ đại.
                        Tác giả truyền đạt thông điệp về sự trưởng thành và lòng nhân ái.
                        Kích thước tiện lợi, dễ mang theo và đọc.</p>
                </div>
            </div>
            <div class="detail-section d-flex flex-column mb-3 me-3 detail-item p-3">
                <h3>Mot so san pham tuong tu</h3>
            </div>
        </div>
    </div>


    <?php include_once __DIR__ . '/../../src/partials/footer.php';
