const datatables = {
    init() {
        $('[data-toggle="datatable"]').each((_, element) => {
            let e = $(element);
            e.DataTable(this.options(e.data('url'), e.data('columns')));
        });
    },
    options(ajax, columns) {
        return {
            language: {
                url: window.location.origin + "/datatables/language.json",
            },
            serverSide: true,
            processing: true,
            autoWidth: true,
            ajax: ajax,
            columns: columns,
            aaSorting: [[0, 'desc']],
        }
    },
    setReloadInterval(table, interval) {
        setInterval(backend.datatables.reload(table) && $('#' + $(table)[0].id + '_processing').toggle(), interval);
    },
    reloadAll() {
        $('[data-toggle="datatable"]').each((_, element) => this.reload(element));
    },
    reload(table) {
        $(table).DataTable().ajax.reload();
    },
};
export {datatables};
