const datatables = {
    init() {
        $('[data-toggle="datatable"]').each((_, element) => {
            let e = $(element);
            e.DataTable(this.options(e.data('url'), e.data('columns'), e.data('serverSide')));
        });
    },
    options(ajax, columns, serverSide) {
        return {
            language: {
                url: window.location.origin + "/datatables/language.json",
            },
            serverSide,
            processing: true,
            autoWidth: true,
            ajax: ajax,
            columns: columns,
            aaSorting: [[0, 'desc']],
        }
    },
    setReloadInterval(table, interval) {
        setInterval(this.reload(table) && $('#' + $(table)[0].id + '_processing').toggle(), interval);
    },
    reloadAll() {
        $('[data-toggle="datatable"]').each((_, element) => $(element).DataTable().ajax.reload());
    },
    reload(table) {
        $(table).DataTable().ajax.reload();
    },
};
export {datatables};
