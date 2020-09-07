const datatables = {
    init() {
        $('[data-toggle="datatable"]').each((_, element) => {
            let e = $(element);
            e.DataTable(this.options(e.data('url'), e.data('columns')));
        });
    },
    options(ajax, columns) {
        return {
            // dom: '<"row justify-between g-2"<""f><"col-5 col-sm-6 text-right"<"datatable-filter"l>>><"datatable-wrap my-3"t><"row align-items-center"<"col-7 col-sm-12 col-md-9"p><"col-5 col-sm-12 col-md-3 text-left text-md-right"i>>',
            language: {
                // lengthMenu: "<span class='d-none d-sm-inline-block'>Zeige</span><div class='form-control-select'> _MENU_ </div>",
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
        $('[data-toggle="datatable"]').each((_, element) => $(element).DataTable().ajax().reload());
    },
    reload(table) {
        $(table).DataTable().ajax().reload();
    },
};
export {datatables};
