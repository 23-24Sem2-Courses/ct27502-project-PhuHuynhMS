// classList - shows/gets all classes
// contains - checks classList for specific class
// add - add class
// remove - remove class
// toggle - toggles class

const btn = document.querySelector('.nav-toggle');
const links = document.querySelector('.links');
const searchBtn = document.querySelector('.search-btn-sm');
const searchBar = document.querySelector('.searchbar');
const navImg = document.querySelector('.nav-img');
const navTools = document.querySelector('.nav-header');
const search = document.querySelector('.search');

btn.addEventListener('click', function() {
    links.classList.toggle("show-links");
});

searchBtn.addEventListener('click', function(e) {
    navTools.classList.add('hide');
    searchBar.classList.add('d-flex');
    search.focus();
});

search.addEventListener('focusout', function() {
    navImg.classList.remove('hide');
    navTools.classList.remove('hide');
    searchBar.classList.remove('d-flex');
});

//Show image before change
$(document).ready(function() {
    let imgURL = null;
    const imgElement =
        `<img src="" alt="" class="avatar-img" width="180px">`;

    $('input[name="avatar"]').change(function(e) {
        if (imgURL) {
            URL.revokeObjectURL(imgURL);
        }

        $('.img').append(imgElement);

        imgURL = URL.createObjectURL(e.target.files[0]);
        $('.avatar-img').attr('src', imgURL);
    });
})