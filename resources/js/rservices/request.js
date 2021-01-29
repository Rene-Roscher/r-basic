import {notify} from './';

const handle = async (request, button = null, callback = null) => {
    var state = rservices.buttonState.setPending(button);
    let response = await request;
    if (callback) {
        callback(response);
    } else {
        let keys = Object.keys(response.messages);
        if (keys.length > 0)
            keys.forEach(key => {
                response.messages[key].forEach(v => notify[key](v))
            });
    }
    if (response.redirect != null) setTimeout(() => location.href = response.redirect, 300);
    rservices.cache.isRequesting = false;
    state.setDone();
    rservices.datatables.reloadAll();
    $('div.modal.fade.show').removeClass('show');
    $('body').removeClass('modal-open');
    $('.modal-backdrop.fade.show').remove();
    return response;
};

const request = {
    get(url, params) {
        return {
            request: axios.get(url, {params}).then(res => res.data).catch(e => e.response.data),
            async handle(button) {
                return await handle(this.request, button);
            },
        };
    },
    post(url, data) {
        return {
            request: axios.post(url, data).then(res => res.data).catch(e => e.response.data),
            async handle(button) {
                return await handle(this.request, button);
            }
        };
    },
    put(url, data) {
        return {
            request: axios.put(url, data).then(res => res.data).catch(e => e.response.data),
            async handle(button) {
                return await handle(this.request, button);
            }
        };
    },
    patch(url, data) {
        return {
            request: axios.patch(url, data).then(res => res.data).catch(e => e.response.data),
            async handle(button) {
                return await handle(this.request, button);
            }
        };
    },
    delete(url) {
        return {
            request: axios.delete(url).then(res => res.data).catch(e => e.response.data),
            async handle(button) {
                return await handle(this.request, button);
            }
        };
    },
    deleteConfirm(url, title = 'Bist du dir sicher?', text = 'Diese Aktion kann nicht rückgängig gemacht werden!', confirmButtonText = 'Ausführen', icon = 'warning') {
        return {
            async handle(button) {
                swal.fire({
                    title,
                    text,
                    icon,
                    showCancelButton: true,
                    confirmButtonText
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        await handle(axios.delete(url).then(res => res.data).catch(e => e.response.data), button, (response) => {
                            let keys = Object.keys(response.messages);
                            if (keys.length > 0) {
                                keys.forEach(key => {
                                    if (response.messages[key].length > 0) {
                                        swal.fire(
                                            key == 'success' ? 'Erfolgreich!' : (key == 'warning' ? 'Achtung!' : 'Fehler!'),
                                            response.messages[key][0],
                                            key
                                        )
                                    }
                                });
                            }
                        })

                    }
                })
            }
        };
    },
    postConfirm(url, data = {}, title = 'Bist du dir sicher?', text = 'Diese Aktion kann nicht rückgängig gemacht werden!', confirmButtonText = 'Ausführen', icon = 'warning') {
        return {
            async handle(button) {
                swal.fire({
                    title,
                    text,
                    icon,
                    showCancelButton: true,
                    confirmButtonText
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        await handle(axios.post(url, data).then(res => res.data).catch(e => e.response.data), button, (response) => {
                            let keys = Object.keys(response.messages);
                            if (keys.length > 0) {
                                keys.forEach(key => {
                                    if (response.messages[key].length > 0) {
                                        swal.fire(
                                            key == 'success' ? 'Erfolgreich!' : (key == 'warning' ? 'Achtung!' : 'Fehler!'),
                                            response.messages[key][0],
                                            key
                                        )
                                    }
                                });
                            }
                        })
                    }
                })
            }
        };
    },
};

export {handle, request};
