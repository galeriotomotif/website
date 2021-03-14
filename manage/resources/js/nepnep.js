// sidebar
$(".sidebar-dropdown > a").click(function () {
    $(".sidebar-submenu").slideUp(200);
    if (
        $(this)
            .parent()
            .hasClass("active")
    ) {
        $(".sidebar-dropdown").removeClass("active");
        $(this)
            .parent()
            .removeClass("active");
    } else {
        $(".sidebar-dropdown").removeClass("active");
        $(this)
            .next(".sidebar-submenu")
            .slideDown(200);
        $(this)
            .parent()
            .addClass("active");
    }
});


$("#close-sidebar").click(function () {
    $(".page-wrapper").removeClass("toggled");
});
$("#btn-show-sidebar").click(function () {
    $(".page-wrapper").addClass("toggled");
});


if ($(window).width() > 768) {
    $(".page-wrapper").addClass("toggled");
} else if ($(window).width() < 768) {
    $(".page-wrapper").removeClass("toggled");
}

// end sidebar


$('[data-toggle="tooltip"]').tooltip();

// datatables

var datatables;

function initDatatables(url) {
    axios.get(url)
        .then(function (response) {
            drawDatatables(response.data.datatables_url, response.data.table_options, response.data.table_structure)
        });
}

function drawDatatables(datatables_url, table_options, table_structure) {
    var searching = true;
    var paging = true;
    var ordering = true;
    var info = true;
    var scrollX = false;

    if (table_options != null) {
        if (typeof table_structure.searching != 'undefined') {
            searching = table_structure.searching;
        }

        if (typeof table_structure.paging != 'undefined') {
            paging = table_structure.paging;
        }

        if (typeof table_structure.ordering != 'undefined') {
            ordering = table_structure.ordering;
        }

        if (typeof table_structure.info != 'undefined') {
            info = table_structure.info;
        }

        if (typeof table_structure.scrollX != 'undefined') {
            scrollX = table_structure.scrollX;
        }
    }

    datatables = datatables.DataTable({
        processing: true,
        serverSide: true,
        ordering: ordering,
        searching: searching,
        info: info,
        paging: paging,
        order: [[table_structure.default_order_on_collumn, 'desc']],
        ajax: {
            url: datatables_url,
            data: function data(d) {
                $("#datatables-filters :input").each(function () {
                    var name = $(this).attr('name');
                    var val = $(this).val();
                    d[name] = val;
                });
            }
        },
        scrollX: scrollX,
        response: true,
        columns: table_structure.collumns
    });
}

$(document).ready(function () {
    datatables = $("#datatables");

    if (datatables.length) {
        initDatatables(datatables.data('datatables-structure-url'));
    }
});

window.drawDatatables = function () {
    datatables.draw();
}



$('#datatables-filters :input').change(function (e) {
    datatables.draw();
});

$("#datatables-filters :input").on("change.datetimepicker", ({ date, oldDate }) => {
    datatables.draw();
})

$(document).ready(function () {
    $('#client-side-datatables').DataTable();
});

// end datatables

// modal
window.deleteComfirmation = function (elem) {
    $('#delete-comfirmation-form').attr('action', $(elem).data('url'));
    $('#delete-comfirmation-modal').modal('show');
};

$(document).ready(function () {
    if ($('#notification-modal').length) {
        $('#notification-modal').modal('show');
    };
});
// end modal

// lfm
var route_prefix = $('#lfm-init').data('route-prefix');
var csrf_token = $('#lfm-init').data('csrf-token');
$('.lfm-field').filemanager('image', { prefix: route_prefix });

// lfm summernote
$(document).ready(function () {
    // Define function to open filemanager window
    var lfm = function (options, cb) {
        window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
        window.SetUrl = cb;
    };

    // Define LFM summernote button
    var LFMButton = function (context) {
        var ui = $.summernote.ui;
        var button = ui.button({
            contents: '<i class="note-icon-picture"></i> ',
            tooltip: 'Insert image with filemanager',
            click: function () {

                lfm({ type: 'image' }, function (lfmItem, path) {
                    context.invoke('insertImage', lfmItem);
                });

            }
        });
        return button.render();
    };
    $('.summernote').summernote({
        height: "400px",
        imageAttributes: {
            icon: '<i class="note-icon-pencil"/>',
            figureClass: 'figure',
            figcaptionClass: 'caption',
            captionText: 'Caption Goes Here.',
            manageAspectRatio: true // true = Lock the Image Width/Height, Default to true
        },
        lang: 'en-US',
        popover: {
            image: [
                ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']],
                ['custom', ['imageAttributes']],
            ],
            link: [
                ['link', ['linkDialogShow', 'unlink']]
            ], table: [
                ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
            ],
        },
        toolbar: [
            ['style', ['style']],
            ['styleTags', ['p', 'h1', 'h2']],
            ['font', ['bold', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['codeview']],
            ['popovers', ['lfm']],
            ['table', ['table']],
            ['insert', ['link']],
        ],
        buttons: {
            lfm: LFMButton
        }
    });
});

// select2
$(document).ready(function () {
    $('.select2').select2({
        theme: 'bootstrap4',
    });

    $('.select2').find('.select2-selection').addClass('form-control-sm');
});
// end select2

// tempus dattimepicker init
$.fn.datetimepicker.Constructor.Default = $.extend({}, $.fn.datetimepicker.Constructor.Default, {
    icons: {
        time: 'fas fa-clock',
        date: 'fas fa-calendar',
        up: 'fas fa-arrow-up',
        down: 'fas fa-arrow-down',
        previous: 'fas fa-chevron-left',
        next: 'fas fa-chevron-right',
        today: 'fas fa-calendar-check-o',
        clear: 'fas fa-trash',
        close: 'fas fa-times'
    }
});

$(document).ready(function () {
    var dateTimePickerInput = $('.datetimepicker-input');

    $.each(dateTimePickerInput, function (indexInArray, valueOfElement) {
        var dateTimePicker = $(valueOfElement);

        dateTimePicker.datetimepicker({
            format: dateTimePicker.data('format'),
            date: moment(dateTimePicker.data('value'), dateTimePicker.data('format'))
        });
    });
});
// end tempus dattimepicker init

// notification javascript

window.showNotification = function (message) {
    var modalNotification = $('#modal-notification');

    modalNotification.modal('show');
    $('#modal-notification-message').html(message);
};

window.imageFieldChanged = function (baseUrl, elem) {
    elem = $(elem);
    lfmImagePreview = $('.lfm-image-preview');
    $(lfmImagePreview).removeAttr('style');
    $(lfmImagePreview).attr('style', '--image:url("' + baseUrl + '/' + elem.val() + '")');
};

// bootstrap-select init

$(document).ready(function () {
    $('.selectpicker').selectpicker();
});


