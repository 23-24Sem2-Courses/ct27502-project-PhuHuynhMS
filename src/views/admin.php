<?php

define('TITLE', 'Trang chủ Admin');

include_once __DIR__ . '/../partials/header.php';

if (isset($_SESSION['added'])) {
    unset($_SESSION['added']);
    echo '<div class="alert alert-success" role="alert">
    Thêm sản phẩm thành công!
  </div>';
}

?>

<body>

    <?php include_once __DIR__ . '/../partials/admin_navbar.php'; ?>

    <div class="container-fluid d-flex justify-content-center align-items-start">

        <div class="container bg-white rounded col-sm ms-2 end-0 top-0">
            <div class="row product-content">
                <div class="content mt-3">
                    <table class="table table-striped table-hover">
                        <div class="d-flex justify-content-between mt-1">
                            <a href="/admin/add" class="btn btn-primary mb-2 admin-add-btn">Thêm sản phẩm</a>
                            <div class="searchbar admin-searchbar mb-2">
                                <input type="text" class="search" placeholder="Tìm kiếm">
                                <button type="submit" class="search-btn-lg show-searchBtn ">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Tác giả</th>
                                <th>Thể loại</th>
                                <th>Mô tả</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Số lượng đã bán</th>
                                <th>Tùy chỉnh</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($books as $book) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($book['id_book'] ?? '') ?></td>
                                    <td>
                                        <img src="<?= './uploads/' . $book['image'] ?>" alt="" width="100px" height="100px">
                                    </td>
                                    <td><?= htmlspecialchars($book['book_name'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($book['author'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($book['genre'] ?? '') ?></td>
                                    <td><?= limit_word(htmlspecialchars($book['description']) ?? '', true, 400) ?></td>
                                    <td><?= htmlspecialchars(number_format($book['price'], thousands_separator: ',') ?? '') ?></td>
                                    <td><?= htmlspecialchars($book['quantity'] ?? '') ?></td>
                                    <td><?= htmlspecialchars($book['quantity_sold'] ?? '') ?></td>
                                    <td>
                                        <a href="/product_alter/id=<?= htmlspecialchars($book['id_book'] ?? '') ?>" class="btn btn-primary m-1">Sửa</a>
                                        <a href="/book_del/id=<?= htmlspecialchars($book['id_book'] ?? '') ?>" class="btn btn-danger m-1">Xóa</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include_once __DIR__ . '/../partials/foot.php' ?>