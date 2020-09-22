import {notify} from './';
const handle = async (request, button = null) => {
    var state = rservices.buttonState.setPending(button);
    let response = await request;
    let keys = Object.keys(response.messages);
    if (keys.length > 0)
        keys.forEach(key => {
            response.messages[key].forEach(v => notify[key](v))
        });
    if (response.redirect != null) setTimeout(() => location.href = response.redirect, 300);
    rservices.cache.isRequesting = false;
    state.setDone();
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
};

export {handle, request};
