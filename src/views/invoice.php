<?php
define('TITLE', 'Thanh toán');
include_once __DIR__ . '/../partials/header.php';



?>

<body>
    <?php include_once __DIR__ . '/../partials/navbar.php'; ?>
    <div class="container">
        <h3 class="mt-3 mb-3">Hóa đơn</h3>
        <?php if (isset($_SESSION['delete_invoice'])) {
            if ($_SESSION['delete_invoice'] === 'success') {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Đơn hàng đã được hủy
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Đơn hàng đã được duyệt, không thể hủy.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
            }
            unset($_SESSION['delete_invoice']);
        } ?>
        <div class="d-flex justify-content-between">
            <div class="item-list col-sm">
                <div class="bg-white mb-2 grid-col-template2 ps-3">
                    <div>
                        <p class="text-black"><strong>Mã hóa đơn</strong></p>
                    </div>
                    <div>
                        <p class="text-black"><strong>Hình thức giao hàng</strong></p>
                    </div>
                    <div>
                        <p class="text-black"><strong>Hình thức thanh toán</strong></p>
                    </div>
                    <div>
                        <p class="text-black"><strong>Tổng thanh toán</strong></p>
                    </div>
                    <div>
                        <p class="text-black"><strong>Ngày tạo hóa đơn</strong></p>
                    </div>
                    <div>
                        <p class="text-black"><strong>Trạng thái đơn hàng</strong></p>
                    </div>
                    <div>
                        <p class="text-black"><strong>Tùy chọn</strong></p>
                    </div>
                </div>

                <?php foreach ($invoices as $invoice) : ?>
                    <div class="bg-white ps-3 align-items-center pt-2 pb-2 mt-1">
                        <div class="bg-white mt-1 grid-col-template2 ps-3 align-items-center cart-item">
                            <div class="d-flex align-items-center">
                                <div class="me-2" style="display: contents;">
                                    <p class="text-black"><?= htmlspecialchars($invoice['invoice_id'] ?? '') ?></p>
                                </div>
                            </div>
                            <div>
                                <p class="text-black" style="display: contents;"><?= htmlspecialchars($invoice['shipment_method'] ?? '') ?></p>
                            </div>
                            <div>
                                <p class="text-black" style="display: contents;"><?= htmlspecialchars($invoice['payment_method'] ?? '') ?></p>
                            </div>
                            <div>
                                <p class="text-black" style="display: contents;"><strong><?= htmlspecialchars($invoice['total'] ?? 0) ?><sup>đ</sup></strong></p>
                            </div>
                            <div>
                                <p class="text-black" style="display: contents;"><?= htmlspecialchars($invoice['created_at'] ?? '') ?></p>
                            </div>
                            <div class="d-flex align-items-center">
                                <p class="<?php
                                            if ($invoice['invoice_status'] === 'Đang chờ kiểm duyệt') {
                                                echo 'text-warning';
                                            } else {
                                                echo 'text-success';
                                            }
                                            ?>" id="<?= $invoice['invoice_id'] ?? '' ?>_status" style="display: contents;">
                                    <?= $invoice['invoice_status'] ?? '' ?>
                                </p>
                            </div>
                            <div class="p-2 d-flex flex-column">
                                <a href="/check/invoice/id=<?= htmlspecialchars($invoice['invoice_id'] ?? '') ?>" class="btn btn-primary mb-2">Chi tiết</a>
                                <form action="/invoice/delete" method="post">
                                    <input type="hidden" name="invoice_delete_id" value="<?= htmlspecialchars($invoice['invoice_id'] ?? '') ?>">
                                    <input type="hidden" name="invoice_delete_status" value="<?= htmlspecialchars($invoice['invoice_status'] ?? '') ?>">
                                    <button type="submit" class="btn btn-danger " name="destroy-invoice" id="<?= htmlspecialchars($invoice['invoice_id'] ?? '') ?>_destroy">Hủy đơn hàng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- Modal -->
        <div id="invoice-delete-confirm" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Xác nhận xóa</h4>
                    </div>
                    <div class="modal-body">Do you want to delete this contact?</div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" data-bs-dismiss="modal" class="btn btn-danger" id="delete">Hủy đơn hàng</button>
                        <button type="button" data-bs-dismiss="modal" class="btn btn-default">Hủy</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include_once __DIR__ . '/../partials/footer.php';
        include_once __DIR__ . '/../partials/foot.php';
        ?>