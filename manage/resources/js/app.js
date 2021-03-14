
window._ = require('lodash');
window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.moment = require('moment');
require('bootstrap');
require('summernote/dist/summernote-bs4');
require('summernote-image-attributes-editor/summernote-image-attributes');

require('datatables.net/js/jquery.dataTables');
require('datatables.net-bs4/js/dataTables.bootstrap4');
require('datatables.net-responsive/js/dataTables.responsive');
require('datatables.net-responsive-bs4/js/responsive.bootstrap4');
require('./sidebar.js');
require('../../vendor/unisharp/laravel-filemanager/public/js/lfm');
require('select2/dist/js/select2.full');
require('tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4');
require('bootstrap-select')

// window.CKEDITOR_BASEPATH = '../ckeditor/';

// require('../../public/ckeditor/ckeditor');
// require('../../public/ckeditor/adapters/jquery');

require('./nepnep.js');
require('./custom.js');


