<?php

define('TITLE', 'Cập nhật thông tin sản phẩm');

include_once __DIR__ . '/../partials/header.php';

?>

<body>
    <?php
    include_once __DIR__ . '/../partials/admin_navbar.php';
    if (isset($_SESSION['updated'])) {
        unset($_SESSION['updated']);
        echo '<div class="alert alert-success alert-dismissible fade show admin-alert" role="alert">
        <strong>Cập nhật thành công</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <div class="container-fluid d-flex justify-content-center align-items-start mt-3">

        <div class="container bg-white rounded col m-1 product-update-content">
            <div class="container col-3 bg-white rounded m-1">
                <img src="<?= '/uploads/' . $image ?>" alt="book_thumbnail" width="100%" height="100%">
            </div>
            <div class="header border-bottom d-flex justify-content-between p-3">
                <h3>Thông tin sản phẩm</h3>
            </div>
            <div class="content mt-3">
                <form action="/product/changes" method="post" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Tên sách</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="book_name" value="<?= htmlspecialchars($book_name) ?? '' ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="author" class="col-sm-2 col-form-label">Tác giả</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="author" value="<?= htmlspecialchars($author) ?? '' ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="genre" class="col-sm-2 col-form-label">Thể loại</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="genre" value="<?= htmlspecialchars($genre) ?? '' ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="page_quantity" class="col-sm-2 col-form-label">Số trang</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="page_quantity" value="<?= htmlspecialchars($page_quantity) ?? '' ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="description" class="col-sm-2 col-form-label">Mô tả</label>
                        <div class="col-sm-10">
                            <textarea rows="5" type="text" class="form-control" name="description"><?= htmlspecialchars($description) ?? '' ?></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="price" class="col-sm-2 col-form-label">Giá</label>
                        <div class="col-sm-10">
                            <input type="float" class="form-control" name="price" value="<?= htmlspecialchars($price) ?? '' ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="quantity" class="col-sm-2 col-form-label">Số lượng</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="quantity" value="<?= htmlspecialchars($quantity) ?? '' ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="quantity_sold" class="col-sm-2 col-form-label">Số lượng đã bán</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="quantity_sold" value="<?= htmlspecialchars($quantity_sold) ?? '' ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="manufactorer" class="col-sm-2 col-form-label">Nhà xuất bản</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="manufactorer" value="<?= htmlspecialchars($manufactorer) ?? '' ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="year" class="col-sm-2 col-form-label">Năm sản xuất</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="year" value="<?= htmlspecialchars($year) ?? '' ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="cover" class="col-sm-2 col-form-label">Bìa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="cover" value="<?= htmlspecialchars($cover) ?? '' ?>">
                        </div>
                    </div>

                    <!-- Ảnh -->
                    <input type="hidden" name="oldImage" value="<?= $image ?>">
                    <div class="mb-3">
                        <label for="newImage" class="form-label">Ảnh bìa sách</label>
                        <input class="form-control" type="file" id="formFile" name="newImage">
                    </div>
                    <div class="img"></div>
                    <p class="invalid"><?= $number_error ?? '' ?></p>
                    <p class="invalid"><?= $empty_input ?? '' ?></p>
                    <button class="btn btn-primary float-end mb-3" type="submit">Lưu thay đổi</button>
                </form>
            </div>
        </div>
    </div>
    <?php include_once __DIR__ . '/../partials/foot.php';
