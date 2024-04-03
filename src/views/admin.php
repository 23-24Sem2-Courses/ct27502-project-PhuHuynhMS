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
                            <form action="/admin" method="get">
                                <div class="searchbar admin-searchbar mb-2">
                                    <input type="text" class="search" name="searchKey" placeholder="Tìm kiếm">
                                    <button type="submit" class="search-btn-lg show-searchBtn ">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </form>
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
                                    <td><strong><?= htmlspecialchars($book['id_book'] ?? '') ?></strong></td>
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
                                    <td style="min-width: 100px;">
                                        <div class="d-flex flex-column align-items-center">
                                            <a href="/product_alter/id=<?= htmlspecialchars($book['id_book'] ?? '') ?>" class="btn btn-primary mb-1">
                                                <i class="fas fa-edit"></i>
                                                Sửa
                                            </a>
                                            <form action="/product_del/id=<?= htmlspecialchars($book['id_book'] ?? '') ?>" method="get" class="form-inline ml-1">
                                                <button type="submit" class="btn btn-xs btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#delete-confirm" name="delete-btn">
                                                    <i class="fa fa-trash" alt="delete">
                                                    </i> Xóa
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="delete-confirm" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Xác nhận xóa</h4>
                </div>
                <div class="modal-body">Do you want to delete this contact?</div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Xóa</button>
                    <button type="button" data-bs-dismiss="modal" class="btn btn-default">Hủy</button>
                </div>
            </div>
        </div>
    </div>
    <?php include_once __DIR__ . '/../partials/foot.php' ?>