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
                                <th>Trạng thái</th>
                                <th>Thời gian lập</th>
                                <th>Hình thức thanh toán</th>
                                <th>Hình thức giao hàng</th>
                                <th>Tổng tiền</th>
                                <th>Tùy chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($invoices as $invoice) : ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($invoice->invoice_id ?? '') ?></strong></td>
                                    <td><?= htmlspecialchars($invoice->invoice_status ?? '') ?></td>
                                    <td><?= htmlspecialchars(date("d-m-Y", strtotime($invoice->created_at))) ?></td>
                                    <td><?= htmlspecialchars($invoice->payment_method ?? '') ?></td>
                                    <td><?= htmlspecialchars($invoice->shipment_method ?? '') ?></td>
                                    <td><?= htmlspecialchars($invoice->total ?? '') ?></td>
                                    <td style="min-width: 100px;">
                                        <div class="d-flex flex-column align-items-center">
                                            <a href="/product_alter/id=<?= htmlspecialchars($invoice->invoice_id ?? '') ?>" class="btn btn-primary mb-1" style="min-width: 90px;">
                                                <i class="fas fa-edit"></i>
                                                Xem
                                            </a>
                                            <form action="/product_del/id=<?= htmlspecialchars($invoice->invoice_id ?? '') ?>" method="get" class="form-inline ml-1">
                                                <button type="submit" class="btn btn-xs btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#delete-confirm" name="delete-btn" style="min-width: 90px;">
                                                    <i class="fa fa-trash" alt="delete">
                                                    </i> Hủy
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <nav class="d-flex justify-content-center mt-2" style="background: transparent;">
                        <ul class="pagination">
                            <li class="page-item<?= $paginator->getPrevPage() ? '' : ' disabled' ?>">
                                <a role="button" class="page-link" href="/admin/invoice?page=<?= $paginator->getPrevPage() ?>&limit=5">
                                    <span>&laquo;</span>
                                </a>
                            </li>
                            <?php if (isset($pages)) foreach ($pages as $page) : ?>
                                <li class="page-item<?= $paginator->currentPage === $page ? ' active' : '' ?>">
                                    <a href="/admin/invoice?page=<?= $page ?>&limit=5" class="page-link"><?= $page ?></a>
                                </li>
                            <?php endforeach ?>
                            <li class="page-item<?= $paginator->getNextpage() ? '' : ' disabled' ?>">
                                <a href="/admin/invoice?page=<?= $paginator->getNextpage() ?>&limit=5" role="button" class="page-link"><span>&raquo;</span></a>
                            </li>
                        </ul>
                    </nav>
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