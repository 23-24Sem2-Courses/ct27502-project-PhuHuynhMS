$(document).ready(function () {
    //Show confirmation alert
    $('button[name="destroy-invoice"]').on('click', function (e) {
        e.preventDefault();
        const form = $(this).closest('form');

        $('.modal-body').html(
            `Bạn có chắc chắn muốn hủy đơn hàng này ?`
        );
        $('#invoice-delete-confirm').modal('show');
        $('#invoice-delete-confirm').modal({
            backdrop: 'static',
            keyboard: false
        }).on('click', '#delete', function () {
            form.trigger('submit');
        })
    });
});

$(document).ready(function () {
    //Show confirmation alert
    $('button[name="destroy-invoice-admin"]').on('click', function (e) {
        e.preventDefault();
        const form = $(this).closest('form');

        $('.modal-body').html(
            `Bạn có chắc chắn muốn hủy đơn hàng này ?`
        );
        $('#delete-confirm-admin').modal('show');

        $('#delete-confirm-admin').modal({
            backdrop: 'static',
            keyboard: false
        }).on('click', '#delete-invoice-admin', function () {
            form.trigger('submit');
        })
    });
})