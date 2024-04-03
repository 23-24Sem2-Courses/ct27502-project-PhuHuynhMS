// classList - shows/gets all classes
// contains - checks classList for specific class
// add - add class
// remove - remove class
// toggle - toggles class


$(document).ready(function () {
    //Show confirmation alert
    $('button[name="delete-btn"]').on('click', function (e) {
        e.preventDefault();
        const form = $(this).closest('form');
        const nameTd = $(this).closest('tr').children('td').eq(2);

        if (nameTd.length > 0) {
            $('.modal-body').html(
                `Bạn có chắc chắn muốn xóa "${nameTd.text()}" ?`
            );
        }
        $('#delete-confirm').modal({
            backdrop: 'static',
            keyboard: false
        }).on('click', '#delete', function () {
            form.trigger('submit');
        })
    });

    $('.btn-more').on('click', function () {
        if ($(this)[0].innerText === 'Xem thêm') {
            $(this)[0].innerText = 'Thu gọn';
            $('.item-description')[0].attributes[1].nodeValue = '';
            $('.gradient').hide();
        }
        else {
            $('.item-description').css('max-height', '300px');
            $('.item-description').css('overflow', 'hidden');
            $('.gradient').show();
            $(this)[0].innerText = 'Xem thêm';

        }
    })

    //Show image before change
    let imgURL = null;
    const imgElement =
        `<img src="" alt="" class="avatar-img" width="180px">`;

    $('input[name="avatar"]').change(function (e) {
        if (imgURL) {
            URL.revokeObjectURL(imgURL);
        }

        $('.img').append(imgElement);

        imgURL = URL.createObjectURL(e.target.files[0]);
        $('.avatar-img').attr('src', imgURL);
    });
});




//Show search icon in small screen
const btn = document.querySelector('.nav-toggle');
const links = document.querySelector('.links');
const searchBtn = document.querySelector('.search-btn-sm');
const searchBar = document.querySelector('.searchbar');
const navImg = document.querySelector('.nav-img');
const navTools = document.querySelector('.nav-header');
const search = document.querySelector('.search');

btn.addEventListener('click', function () {
    links.classList.toggle("show-links");
});

searchBtn.addEventListener('click', function (e) {
    navTools.classList.add('hide');
    searchBar.classList.add('d-flex');
    search.focus();
});

search.addEventListener('focusout', function () {
    navImg.classList.remove('hide');
    navTools.classList.remove('hide');
    searchBar.classList.remove('d-flex');
});

