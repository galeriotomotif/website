window.openFileDialog = function (inputId) {
    $('#' + inputId).trigger('click');
};

window.readUrl = function (input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        let productImageHolder = $('.product-image-holder');

        reader.onload = function (e) {
            productImageHolder.attr('style', '--image:url("' + e.target.result + '")');
        }

        reader.readAsDataURL(input.files[0]);
    }
}

window.productImageChange = function (elem) {
    window.readUrl(elem);
};

$('#product_image').change(function (elem) {
    window.readUrl(elem);
});


window.showModalDetail = function (elem) {
    var elem = $(elem);
    console.log(elem);

    $('#modal-detail').modal('show');
    $('#modal-detail-order_number').html(elem.data('order_number'));
};

window.addEventListener('paste', e => {
    var productImage = document.getElementById("product_image");
    if (productImage) {
        productImage.files = e.clipboardData.files;
        console.log(e.clipboardData.items);
        window.readUrl(productImage);
    }
});

window.addEventListener("dragover", function (e) {
    e = e || event;
    e.preventDefault();
}, false);

window.addEventListener('drop', e => {
    e.preventDefault();

    var productImage = document.getElementById("product_image");

    if (productImage) {
        productImage.files = e.dataTransfer.files;
        console.log(e.dataTransfer.items);
        window.readUrl(productImage);
    }

}, false);
