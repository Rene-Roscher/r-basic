import {request} from './';
import {notify} from "./index";

const buttonState = {
    setPending(button) {
        button = $(button);
        let html = button.html();
        button.html('<span><i class="fa fa-spinner fa-spin"></i> ' + button.text() + '</span>');
        return {
            setDone() {
                return button.html(html);
            }
        };
    },
};

const validation = {
    handle(response) {
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        if(response.status === 'validation') {
            let keys = Object.keys(response.errors);
            if (keys.length > 0)
                keys.forEach(key => {
                    var $1 = $(`input[name="${key}"]`);
                    $1.addClass('is-invalid');
                    $1.closest('.form-group').append(`<div class="invalid-feedback">${response.errors[key][0]}</div>`);
                });
        }
    },
};

const form = {
    init() {
        $('form[data-rs]').on('submit', event => {
            event.preventDefault();
            if (rservices.cache.isRequesting)
                return;
            rservices.cache.isRequesting = true;
            let form = $(event.target);
            let button = form.find('[type="submit"]');
            let formData = new FormData(event.target);
            form.find('[type="checkbox"]').each((_, ele) => {
                formData.set($(ele).attr('name'), $(ele).is(':checked'))
            });
            let bs = buttonState.setPending(button);
            request.post(form.attr('action'), formData).handle().then(validation.handle).then(() => bs.setDone());
        })
    },
};
export {form, buttonState};
