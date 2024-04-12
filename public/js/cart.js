
const cart = document.querySelector('.cart');

let dataString = localStorage.getItem('cartList');
let cartItemsData;
if (dataString) {
    cartItemsData = JSON.parse(dataString);
}
else {
    cartItemsData = [];
}


let generateCart = () => {
    return cart.innerHTML = cartItemsData.map((x) => {
        let { id, image, name, author, price, quantity } = x;

        imageArray = image.split('/');
        image = imageArray[imageArray.length - 1];

        price = price.replace('.', '');
        console.log(price);
        return `
        <div class="bg-white mt-1 grid-col-template ps-3 align-items-center cart-item">
        <div class="d-flex align-items-center">
            <div class="d-flex align-items-center">
                <label for="">
                    <input type="checkbox" name="" id="" style="height: 15px; width:15px">
                </label>
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
            <p style="display: contents;">${price}<sup>đ</sup></p>
        </div>
        <div class="d-flex align-items-center">
        <i class="fa fa-minus-circle me-1 cart-minus-btn" style="cursor: pointer;" onclick="decrease(${id})"></i>
        <p class="text-black" id="quantity${id}" style="display: contents;">${quantity}</p>
        <i class='fas fa-plus-circle ms-1 cart-plus-btn' style="cursor: pointer;" onclick="increase(${id})"></i>
        </div>
        <div>
            <p style="display: contents;" id="price${id}">${parseFloat(price) * quantity}<sup>đ</sup></p>
        </div>
        <div style="height: 44px;display: contents;">
            <button type="button" class="align-items-center border-0" name="delete-cart-item" style="background: transparent;"><i onclick="deleteItem(${id})" class="fas fa-trash-alt"></i></button>
        </div>
    </div>
        `;
    }).join('');
}

generateCart();

let deleteItem = function (id) {

    const Index = cartItemsData.findIndex((x) => x.id == id);

    $('#delete-cart-confirm').modal('show');
    $('.cart-modal-body').html(
        `Bạn có chắc chắn muốn xóa "${cartItemsData[Index].name}" ?`
    );

    const deleteItemBtn = document.querySelector('#delete-cart-item');

    deleteItemBtn.addEventListener('click', function () {
        cartItemsData = cartItemsData.filter((x) => x.id != id);

        generateCart();

        localStorage.setItem('cartList', JSON.stringify(cartItemsData));
        updateTotal();

        $('#delete-cart-confirm').modal('hide');

        disabledOrderBtn();

    });


}


//Plus button
let increase = function (id) {
    let search = cartItemsData.find((x) => x.id == id);
    let index = cartItemsData.findIndex((x) => x.id == id);
    let quantity = parseInt(search.quantity);
    const quantity_field = document.querySelector('#quantity' + id);
    const string = "#price" + id;
    const price = document.querySelector(string);

    console.log(price);
    quantity = quantity + 1;

    quantity_field.innerText = quantity;

    const Stringprice = cartItemsData[index].price.replace('.', '');
    price.innerHTML = (quantity * parseFloat(Stringprice)) + '<sup>đ</sup>';

    cartItemsData[index].quantity = quantity;
    updateTotal();
    disabledOrderBtn();

    localStorage.setItem('cartList', JSON.stringify(cartItemsData));
}

//Decrease button
let decrease = function (id) {
    let search = cartItemsData.find((x) => x.id == id);
    let index = cartItemsData.findIndex((x) => x.id == id);
    let quantity = parseInt(search.quantity);
    const quantity_field = document.querySelector('#quantity' + id);
    const string = "#price" + id;
    const price = document.querySelector(string);

    quantity = quantity - 1;

    quantity_field.innerText = quantity;
    cartItemsData[index].quantity = quantity;

    const Stringprice = cartItemsData[index].price.replace('.', '');
    price.innerHTML = (quantity * parseFloat(Stringprice)) + '<sup>đ</sup>';
    if (quantity === 0) {
        cartItemsData = cartItemsData.filter((x) => x.quantity !== 0);
    }
    localStorage.setItem('cartList', JSON.stringify(cartItemsData));
    generateCart();
    updateTotal();
    disabledOrderBtn();


}

let updateTotal = function () {
    const total_field = document.querySelector('#total');
    let temp_cal = document.querySelector('#temp_cal');

    let totalPrice = cartItemsData.reduce((total, x) => {
        let price = `#price${x.id}`;
        let price_field = document.querySelector(price);

        return total + parseFloat(price_field.innerText);
    }, 0);

    if (totalPrice === 0) {
        total_field.innerText = "Vui lòng chọn sản phẩm";
        temp_cal.innerHTML = 0 + "<sup>đ</sup>";
    }
    else {
        total_field.innerHTML = totalPrice + "<sup>đ</sup>";
        temp_cal.innerHTML = totalPrice + "<sup>đ</sup>";
    }
}

updateTotal();

//order button
const orderBtn = document.querySelector('#order-btn');

const disabledOrderBtn = function () {
    if (cartItemsData.length === 0) {

        orderBtn.classList.add('disable');
    }
}

disabledOrderBtn();



