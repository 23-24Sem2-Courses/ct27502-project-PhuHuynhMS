<?php

define('TITLE', 'Thêm sản phẩm');
include_once __DIR__ . '/../partials/header.php';
?>

<body>
    <?php include_once __DIR__ . '/../partials/admin_navbar.php';
    if (isset($_SESSION['added'])) {
        unset($_SESSION['added']);
        echo '<div class="alert alert-success alert-dismissible fade show admin-alert" role="alert">
        <strong>Thêm sản phẩm thành công</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    } ?>
    <div class="container-fluid d-flex justify-content-center align-items-start mt-3 product-content product-add-content">
        <div class="container bg-white rounded col m-1">
            <div class="header border-bottom d-flex justify-content-between p-3">
                <h3>Thông tin sản phẩm</h3>
            </div>
            <div class="content mt-3">
                <form action="/admin/add" method="post" enctype="multipart/form-data">
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Tên sách</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="book_name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="author" class="col-sm-2 col-form-label">Tác giả</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="author">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="genre" class="col-sm-2 col-form-label">Thể loại</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="genre">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="page_quantity" class="col-sm-2 col-form-label">Số trang</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="page_quantity">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="description" class="col-sm-2 col-form-label">Mô tả</label>
                        <div class="col-sm-10">
                            <textarea rows="5" type="text" class="form-control" name="description"></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="price" class="col-sm-2 col-form-label">Giá</label>
                        <div class="col-sm-10">
                            <input type="float" class="form-control" name="price">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="quantity" class="col-sm-2 col-form-label">Số lượng</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="quantity">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="quantity_sold" class="col-sm-2 col-form-label">Số lượng đã bán</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="quantity_sold">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="manufactorer" class="col-sm-2 col-form-label">Nhà sản xuất</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="manufactorer">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="year" class="col-sm-2 col-form-label">Năm sản xuất</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="year">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="cover" class="col-sm-2 col-form-label">Bìa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="cover">
                        </div>
                    </div>

                    <!-- Ảnh -->
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