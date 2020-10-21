import {notify} from './';
const handle = async (request) => {
    let response = await request;
    let keys = Object.keys(response.messages);
    if (keys.length > 0)
        keys.forEach(key => {
            response.messages[key].forEach(v => notify[key](v))
        });
    if (response.redirect != null) setTimeout(() => location.href = response.redirect, 300);
    rservices.cache.isRequesting = false;
    $('[data-toggle="datatable"]').DataTable().ajax.reload();
    return response;
};

const request = {
    get(url, params) {
        return {
            request: axios.get(url, {params}).then(res => res.data).catch(e => e.response.data),
            async handle() {
                return await handle(this.request);
            },
        };
    },
    post(url, data) {
        return {
            request: axios.post(url, data).then(res => res.data).catch(e => e.response.data),
            async handle() {
                return await handle(this.request);
            }
        };
    },
    put(url, data) {
        return {
            request: axios.put(url, data).then(res => res.data).catch(e => e.response.data),
            async handle() {
                return await handle(this.request);
            }
        };
    },
    patch(url, data) {
        return {
            request: axios.patch(url, data).then(res => res.data).catch(e => e.response.data),
            async handle() {
                return await handle(this.request);
            }
        };
    },
    delete(url) {
        return {
            request: axios.delete(url).then(res => res.data).catch(e => e.response.data),
            async handle() {
                return await handle(this.request);
            }
        };
    },
};

export {handle, request};
