// Increase and descrease quantity buttons

let book_quantity = document.querySelector('#quantity').innerText;

const minusBtn = document.querySelector('.minus-btn');
const plusBtn = document.querySelector('.plus-btn');
const quantity_field = document.querySelector('#quantity');
let item_detail_quantity = parseInt(document.querySelector('#quantity').innerText);
let cost_field = document.querySelector('.cost');

minusBtn.addEventListener('click', function () {
    if (item_detail_quantity >= 1) {
        item_detail_quantity -= 1;
    }
    quantity_field.innerText = item_detail_quantity;
    cost_field.innerText = parseFloat(book_price.replace('.', '')) * item_detail_quantity;
    book_quantity = document.querySelector('#quantity').innerText;
});

plusBtn.addEventListener('click', function () {
    item_detail_quantity += 1;
    quantity_field.innerText = item_detail_quantity;
    cost_field.innerText = parseFloat(book_price.replace('.', '')) * item_detail_quantity;
    book_quantity = document.querySelector('#quantity').innerText;

});


const book_image = document.querySelector('#book-image').src;
const book_name = document.querySelector('.book-name').innerText;
const book_author = document.querySelector('.author').innerText;
const book_price = document.querySelector('.price').innerText;
const book_id = document.querySelector('#book_id').value;


let data = localStorage.getItem('cartList');
let cartList;

if (data) {
    cartList = JSON.parse(data);
}
else {
    cartList = [];
}


let addToCart = function (id) {
    if (book_quantity != 0) {
        let selectedItemID = id;
        if (data) {
            let search = cartList.find((x) => x.id == selectedItemID);
            if (search === undefined) {
                cartList.push({
                    id: book_id,
                    image: book_image,
                    name: book_name,
                    quantity: book_quantity,
                    author: book_author,
                    price: book_price
                });

                localStorage.setItem('cartList', JSON.stringify(cartList));
            }
            else {
                const foundItemIndex = cartList.findIndex((x) => x.id == selectedItemID);

                search.quantity = parseInt(search.quantity) + parseInt(book_quantity);
                cartList[foundItemIndex] = search;

                localStorage.setItem('cartList', JSON.stringify(cartList));
            }
        } else {
            cartList.push({
                id: book_id,
                image: book_image,
                name: book_name,
                quantity: book_quantity,
                author: book_author,
                price: book_price
            });
            localStorage.setItem('cartList', JSON.stringify(cartList));
        }
        $('.modal').modal('show');
    }
}




