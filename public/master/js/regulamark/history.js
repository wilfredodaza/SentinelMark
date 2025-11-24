$(() => {
    const columns = [
        // {title: "", data: ''},
        {title: "#", data: 'id'},
        {title: "Fecha aplicada", data: 'date'},
        {title: "Código de regla", data: 'ruler', render:(r) => `${r.code}`},
        {title: 'País/Jurisdicción', data: 'country.name'},
        {title: "Entidad afectada", data: 'entity'},
        {title: "Identificación Entidad", data: 'entity_id'},
        {title: "Evento de origen", data: 'origen'},
        {title: "Resultado", data: 'result'},
        {title: "Usuario", data: 'user'},
        // {title: "Entidad", data: 'entity'},
        {title: "Proceso", data: 'procces'}
    ];

    const url = `dashboard/regulamark/history/data`;

    const buttons = [
        // {
        //     text: '<i class="ri-filter-3-line"></i><span class="d-none d-sm-inline-block">Filtrar</span>',
        //     className: `btn rounded-pill btn-label-info waves-effect mx-2 mt-2`,
        //     action: async function (e, dt, button, config) {
        //         const offCanvasElement = document.querySelector('#canvasFilter');
        //         let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
        //         offCanvasEl.show();
        //     }
        // },
        // {
        //     text: '<i class="ri-add-fill me-1"></i><span class="d-none d-sm-inline-block">Agregar</span>',
        //     className: `btn rounded-pill btn-primary waves-effect mx-2 mt-2 btn-add`,
        //     action: async function (e, dt, button, config) {
                
        //         $('#canvasAddLabel').html('Añadir');

        //         $('#pais-add').val(null).trigger('change');
        //         $('#code-add').val(null);
        //         $('#code-add').attr('readonly', false);
        //         $('#description').val(null);
        //         $('#tipo').val(null).trigger('change');
        //         $('#entidad').val(null).trigger('change');
        //         $('#origen').val(null);
        //         $('#plazo').val(null);
        //         $('#modulo-add').val(null).trigger('change');

        //         const offCanvasElement = document.querySelector('#canvasAdd');
        //         let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
        //         offCanvasEl.show();
        //     }
        // }
    ];

    load_datatable(url, columns, buttons, url, true);
})