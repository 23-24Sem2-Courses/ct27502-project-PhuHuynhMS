
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
        return `
        <div class="bg-white mt-1 grid-col-template ps-3 align-items-center cart-item">
        <div class="d-flex align-items-center">
            <div class="d-flex align-items-center">
                <label for="product${id}">
                </label>
                <input type="checkbox" class="product" value="${id}" id="product${id}" style="height: 15px; width:15px">
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
            <p style="display: contents;" id="price${id}">${price}<sup>đ</sup></p>
        </div>
        <div class="d-flex align-items-center">
        <i class="fa fa-minus-circle me-1 cart-minus-btn" style="cursor: pointer;" onclick="decrease(${id})"></i>
        <p class="text-black" id="quantity${id}" style="display: contents;">${quantity}</p>
        <i class='fas fa-plus-circle ms-1 cart-plus-btn' style="cursor: pointer;" onclick="increase(${id})"></i>
        </div>
        <div>
            <p style="display: contents;" id="total${id}">${parseFloat(price) * quantity}<sup>đ</sup></p>
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
    const string = "#total" + id;
    const price = document.querySelector(string);

    quantity = quantity + 1;

    quantity_field.innerText = quantity;

    const Stringprice = cartItemsData[index].price.replace('.', '');
    price.innerHTML = (quantity * parseFloat(Stringprice)) + '<sup>đ</sup>';

    cartItemsData[index].quantity = quantity;
    // updateTotal();
    disabledOrderBtn();

    localStorage.setItem('cartList', JSON.stringify(cartItemsData));
    // updateTotal();
}

//Decrease button
let decrease = function (id) {
    let search = cartItemsData.find((x) => x.id == id);
    let index = cartItemsData.findIndex((x) => x.id == id);
    let quantity = parseInt(search.quantity);
    const quantity_field = document.querySelector('#quantity' + id);
    const string = "#total" + id;
    const price = document.querySelector(string);

    quantity = quantity - 1;

    quantity_field.innerText = quantity;
    cartItemsData[index].quantity = quantity;

    const Stringprice = cartItemsData[index].price.replace('.', '');
    price.innerHTML = (quantity * parseFloat(Stringprice)) + '<sup>đ</sup>';
    if (quantity === 0) {
        cartItemsData = cartItemsData.filter((x) => x.quantity !== 0);
        generateCart();
    }
    // updateTotal();
    disabledOrderBtn();
    localStorage.setItem('cartList', JSON.stringify(cartItemsData));
    // updateTotal();

}

function removeElement(array, elem) {
    var index = array.indexOf(elem);
    if (index > -1) {
        array.splice(index, 1);
    }
}

const checkedID = [];
// let updateTotal = function () {
//     

//     // let totalPrice = cartItemsData.reduce((total, x) => {
//     //     let price = `#total${x.id}`;
//     //     let price_field = document.querySelector(price);

//     //     return total + parseFloat(price_field.innerText);
//     // }, 0);

//     total_field.innerText = "Vui lòng chọn sản phẩm";
//     temp_cal.innerHTML = 0 + "<sup>đ</sup>";


//     let sum = parseFloat(document.querySelector('#temp_cal').innerText);
//     const selectedValue = document.querySelectorAll('.product');
//     selectedValue.forEach(function (e) {
//         if (e.checked && !checkedID.includes(e.value)) {
//             const total = document.querySelector(`#total${e.value}`).innerText;
//             checkedID.push(e.value);
//             sum += parseFloat(total);
//             total_field.innerHTML = sum + '<sup>đ</sup>';
//             temp_cal.innerHTML = sum + '<sup>đ</sup>';
//         } else {
//             if (checkedID.includes(e.value) && !e.checked) {
//                 const total = document.querySelector(`#total${e.value}`).innerText;
//                 sum -= parseFloat(total);
//                 total_field.innerHTML = sum + '<sup>đ</sup>';
//                 temp_cal.innerHTML = sum + '<sup>đ</sup>';
//                 removeElement(checkedID, e.value);
//                 console.log(checkedID);
//             }
//         }
//     });
// }


// updateTotal();

//order button
const orderBtn = document.querySelector('#order-btn');
const Items = document.querySelectorAll('.product');

const disabledOrderBtn = function () {
    if (cartItemsData.length === 0) {

        orderBtn.classList.add('disable');
    }
    let check = false;
    Items.forEach(function (e) {
        if (e.checked) {
            check = true;
        }
    });

    if (!check) {
        orderBtn.classList.add('disable');
    }
    else {
        orderBtn.classList.remove('disable');
    }
}


orderBtn.addEventListener('click', function (e) {
    const selectedItems = [];
    Items.forEach(function (e) {
        if (e.checked) {
            selectedItems.push(e.value);
        }
    });
    cartItemsData = cartItemsData.filter((x) => selectedItems.includes(x.id));
    localStorage.setItem('cartList', JSON.stringify(cartItemsData));
});

disabledOrderBtn();

document.querySelector('.sign-out').addEventListener('click', function () {
    localStorage.clear();
});

let sum = 0;
//check what if product in total
const total_field2 = document.querySelector('#total');
let temp_cal2 = document.querySelector('#temp_cal');

Items.forEach(function (e) {
    e.addEventListener('click', function (btn) {
        if (!checkedID.includes(btn.target.value)) {
            if (e.checked) {
                checkedID.push(btn.target.value);
                const price = parseFloat(document.querySelector(`#total${btn.target.value}`).innerText);
                sum += price;

            }
        }
        else {
            if (!e.checked) {
                const price = parseFloat(document.querySelector(`#total${btn.target.value}`).innerText);
                removeElement(checkedID, btn.target.value);
                sum -= price;
                console.log(sum);
            }
        }
        disabledOrderBtn();
        total_field2.innerHTML = sum + '<sup>đ</sup>';
        temp_cal2.innerHTML = sum + '<sup>đ</sup>';
    });
});

