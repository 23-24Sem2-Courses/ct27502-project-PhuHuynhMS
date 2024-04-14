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
                        <div class="d-flex flex-start mt-1 mb-2 align-items-center">
                            <form action="/admin/invoice/filter" method="post" id="statusForm">
                                <label for="status">Chọn trạng thái đơn hàng: </label>
                                <select class="me-2" name="status" form="statusForm">
                                    <option value="#">--Trạng thái--</option>
                                    <option value="Đã duyệt">Đã duyệt</option>
                                    <option value="Đang chờ kiểm duyệt">Đang chờ kiểm duyệt</option>
                                </select>
                                <input type="date" name="date">
                                <button type="submit" class="btn btn-primary ms-2">
                                    <i class='fas fa-filter'></i>
                                    Lọc
                                </button>
                            </form>

                        </div>
                        <?php if (isset($_SESSION['pass'])) {
                            echo '
                        <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                            <symbol id="check-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </symbol>
                        </svg>

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:" style="width: 40px; height: 40px;">
                                <use xlink:href="#check-circle-fill" />
                            </svg>
                            Duyệt đơn hàng thành công.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                            unset($_SESSION['pass']);
                        }

                        if (isset($_SESSION['admin-invoice-delete'])) {
                            $delete = $_SESSION['admin-invoice-delete'];
                            if ($delete === 'success') {
                                echo '
                        <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                            <symbol id="check-circle-fill" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                            </symbol>
                        </svg>

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Success:" style="width: 40px; height: 40px;">
                                <use xlink:href="#check-circle-fill" />
                            </svg>
                            Xóa đơn hàng thành công.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                            } else {
                                echo '<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
                                <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </symbol>
                            </svg>
    
                            <div class="alert alert-warning alert-dismissible fade show me-3" role="alert">
                            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Warning:" width=40 height=20><use xlink:href="#exclamation-triangle-fill"/></svg>
                                Không thể xóa đơn hàng đã được duyệt.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                            }
                            unset($_SESSION['admin-invoice-delete']);
                        }
                        ?>
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
                                    <td class="<?php
                                                if ($invoice->invoice_status === "Đang chờ kiểm duyệt") {
                                                    echo 'text-warning';
                                                } else {
                                                    echo 'text-success';
                                                }
                                                ?>"><?= htmlspecialchars($invoice->invoice_status ?? '') ?></td>
                                    <td><?= htmlspecialchars(date("d-m-Y", strtotime($invoice->created_at))) ?></td>
                                    <td><?= htmlspecialchars($invoice->payment_method ?? '') ?></td>
                                    <td><?= htmlspecialchars($invoice->shipment_method ?? '') ?></td>
                                    <td><?= htmlspecialchars($invoice->total ?? '') ?></td>
                                    <td style="min-width: 100px;">
                                        <div class="d-flex flex-column align-items-center">
                                            <a href="/admin/invoice/detail/id=<?= htmlspecialchars($invoice->invoice_id ?? '') ?>" class="btn btn-primary mb-1" style="min-width: 90px;">
                                                <i class="fas fa-eye"></i>
                                                Chi tiết
                                            </a>
                                            <form action="/admin/invoice/delete" method="post" class="form-inline ml-1">
                                                <input type="hidden" name="invoice_id_hidden" value="<?= htmlspecialchars($invoice->invoice_id ?? '') ?>">
                                                <button type="submit" class="btn btn-xs btn-danger ml-1" data-bs-toggle="modal" data-bs-target="#delete-confirm" name="destroy-invoice-admin" style="min-width: 90px;">
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
    <div id="delete-confirm-admin" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Xác nhận xóa</h4>
                </div>
                <div class="modal-body">Do you want to delete this contact?</div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-danger" id="delete-invoice-admin">Xóa</button>
                    <button type="button" data-bs-dismiss="modal" class="btn btn-default">Hủy</button>
                </div>
            </div>
        </div>
    </div>
    <?php include_once __DIR__ . '/../partials/foot.php' ?>