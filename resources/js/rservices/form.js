import {request} from './';

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
            let bs = buttonState.setPending(button);
            request.post(form.attr('action'), formData).handle().then(() => bs.setDone());
        })
    },
};
export {form, buttonState};
