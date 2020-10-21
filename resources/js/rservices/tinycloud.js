import * as $ from "jquery";

var tinymce = require('tinymce/tinymce');

require('tinymce/icons/default');
require('tinymce/themes/silver');
require('tinymce/plugins/paste');
require('tinymce/plugins/link');

$('[data-toggle="tinymce"]').each((_, ele) => {
    tinymce.init({
        selector: "#" + $(ele).attr('id'),
        content_style: 'body .mce-content-body { background: #2C2F33;color: #fff; } .tox-statusbar {display:none} .tox-tinymce {1px solid transparent !important;}'
    });
    setTimeout(() => tinyMCE.get($(ele).attr('id')).on('input', () => {
        var value = tinyMCE.get($(ele).attr('id')).save();
        console.log(value)
        $(ele).val(value);
    }), 500)
});
