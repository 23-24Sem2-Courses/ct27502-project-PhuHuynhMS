$(document).ready(function () {
    let imgURL = null;
    const imgElement =
        ``;

    $('input[name="newImage"]').change(function (e) {
        if (imgURL) {
            URL.revokeObjectURL(imgURL);
        }

        // $('.img').append(imgElement);

        imgURL = URL.createObjectURL(e.target.files[0]);
        $('.avatar-img').attr('src', imgURL);
    });
});