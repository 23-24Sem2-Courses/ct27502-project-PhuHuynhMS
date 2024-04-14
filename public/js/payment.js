const cart_detail = document.querySelector('.cart_detail');
let totalDetail = 0;

let generateCartDetail = () => {
    return cart_detail.innerHTML = cartItemsData.map((x) => {
        let { id, image, name, author, price, quantity } = x;

        imageArray = image.split('/');
        image = imageArray[imageArray.length - 1];

        price = price.replace('.', '');
        totalDetail += parseFloat(price) * parseInt(quantity);
        return `<div class="bg-white mt-1 grid-col-template ps-3 pb-2 align-items-center cart-item">
        <div class="d-flex align-items-center">
            <div class="d-flex align-items-center">
                <a href="/product/detail/id=">
                    <img src="/uploads/${image}" alt="" width="120px" height="120px">
                </a>
            </div>
            <div>
                <a href="/product/detail/id=" style="color:black">${name}</a>
                <p>${author}</p>
            </div>
        </div>
        <div>
            <p style="display: contents;">Đơn giá: ${price}<sup>đ</sup></p>
        </div>
        <div class="d-flex align-items-center">
            <p id="quantity${id}" style="display: contents;">Số lượng: ${quantity}</p>
        </div>
        <div>
            <p style="display: contents;" id="price${id}">Thành tiền: ${parseFloat(price) * quantity}<sup>đ</sup></p>
        </div>
    </div>`;
    }).join('');
}

generateCartDetail();


const total_field = document.querySelector('#total');
let temp_cal = document.querySelector('#temp_cal');
let total_input = document.querySelector('#total_input');

total_input.value = totalDetail + 32000;
total_field.innerHTML = totalDetail + 32000 + "<sup>đ</sup>";
temp_cal.innerHTML = totalDetail + "<sup>đ</sup>";


const confirmOderBtn = document.querySelector('#confirmation-order-btn');

confirmOderBtn.addEventListener('click', function (e) {
    e.preventDefault();
    var formData = new FormData(document.querySelector('#confirm-form'));
    formData.append('dataFromLocalStorage', JSON.stringify(cartItemsData));

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/checkout/confirmation", true);
    // xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.status === 200) {
            console.log('Dữ liệu đã được gửi thành công');
        } else {
            console.error('Đã xảy ra lỗi khi gửi dữ liệu');
        }
    }
    xhr.send(formData);

    $('#order-confirm').modal('show');

    localStorage.clear();
});
