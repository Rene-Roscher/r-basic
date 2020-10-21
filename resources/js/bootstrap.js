import 'bootstrap';

window._ = require('lodash');
import * as $ from 'jquery';

window.$ = window.jQuery = $;

// DataTable jQuery
require('datatables.net-bs4');

// Basic construction of Developments
import * as rservices from './rservices/';

import 'popper.js';

window.tinymce = require('tinymce');

// For requesting
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.rservices = rservices;

// Init
rservices.form.init();
rservices.datatables.init();
