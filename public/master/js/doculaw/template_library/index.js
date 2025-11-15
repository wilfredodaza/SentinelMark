const tables = [];

$(() => {

    const dropzoneBasicCreated = document.querySelector('#dropzone-basic-created');
    if (dropzoneBasicCreated) {
        const myDropzone = new Dropzone(dropzoneBasicCreated, {
        previewTemplate: previewTemplate(),
            parallelUploads: 1,
            maxFilesize: 5,
            addRemoveLinks: true,
            maxFiles: 1
        });
    }

    enableClickCopy('.copy-item');

    data.tablists.map(tablist => {
        $(`#table_datatable_${tablist.id}`).DataTable({
            data: tablist.templates,
            columns: [
                {title: 'Titulo', data: 'title'},
                {title: 'Estado', data: 'state'},
                {title: 'País/Juridicción', data: 'pais'},
                {title: 'Comentario', data: 'use'},
                {title: 'Versión', data: 'version'},
                {title: 'Acciones', data: 'enlace', render: (value, _, res) => {
                    return `
                        <div class="d-flex justify-content-center align-items-center">
                            <a href="javascript:void(0);" onclick="previsualizar(${tablist.id}, ${res.id})" class="btn btn-sm btn-text-secundary rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secundary" data-bs-original-title="Vista previa">
                                <i class="fa-duotone fa-light fa-eye"></i>
                            </a>
                            
                            <a href="javascript:void(0);" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-line"></i></a>
                            <ul class="dropdown-menu dropdown-menu-fixed dropdown-menu-end m-0" style="">
                                ${value ? `<li><a href="javascript:void(0);" onclick="loadEdit(${res.id})" class="dropdown-item">
                                    <i class="ri-file-word-line"></i> Archivo
                                </a></li>` : ''}
                                

                                <li><a href="javascript:void(0);" onclick="loadEdit(${tablist.id}, ${res.id})" class="dropdown-item">
                                    <i class="fa-duotone fa-solid fa-pen-to-square"></i> Editar
                                </a></li>

                                <li><a href="${base_url(['dashboard/doculaw/template_library/versions', res.id])}" class="dropdown-item">
                                    <i class="fa-duotone fa-solid fa-clock-rotate-left"></i></i> Historial
                                </a></li>
                                
                                <li><a href="javascript:void(0);" onclick="decline(${res.id})" class="dropdown-item text-red">
                                    <i class="fa-duotone fa-solid fa-circle-trash"></i> Eliminar
                                </a></li>
                            </ul>
                        </div>
                    `
                }},
            ],
            dom: '<"card-header flex-column flex-md-row border-bottom"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6 mt-5 mt-md-0"><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
                processing: 'Cargando datos',
                paginate: {
                  next: '<i class="ri-arrow-right-s-line"></i>',
                  previous: '<i class="ri-arrow-left-s-line"></i>'
                }
            },
            drawCallback: async function(setting){
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function (tooltipTriggerEl) {
                  return new bootstrap.Tooltip(tooltipTriggerEl);
                });    
            },
            ordering: false,
            buttons: [
                {
                    extend: 'collection',
                    className: 'btn btn-label-primary dropdown-toggle me-4 waves-effect waves-light',
                    text: '<i class="ri-external-link-line me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                    buttons: [
                        {
                        extend: 'csv',
                        text: '<i class="ri-file-text-line me-1" ></i>Csv',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [3, 4, 5, 6, 7],
                            // prevent avatar to be display
                            format: {
                            body: function (inner, coldex, rowdex) {
                                if (inner.length <= 0) return inner;
                                var el = $.parseHTML(inner);
                                var result = '';
                                $.each(el, function (index, item) {
                                if (item.classList !== undefined && item.classList.contains('user-name')) {
                                    result = result + item.lastChild.firstChild.textContent;
                                } else if (item.innerText === undefined) {
                                    result = result + item.textContent;
                                } else result = result + item.innerText;
                                });
                                return result;
                            }
                            }
                        }
                        },
                        {
                        extend: 'excel',
                        text: '<i class="ri-file-excel-line me-1"></i>Excel',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [3, 4, 5, 6, 7],
                            // prevent avatar to be display
                            format: {
                            body: function (inner, coldex, rowdex) {
                                if (inner.length <= 0) return inner;
                                var el = $.parseHTML(inner);
                                var result = '';
                                $.each(el, function (index, item) {
                                if (item.classList !== undefined && item.classList.contains('user-name')) {
                                    result = result + item.lastChild.firstChild.textContent;
                                } else if (item.innerText === undefined) {
                                    result = result + item.textContent;
                                } else result = result + item.innerText;
                                });
                                return result;
                            }
                            }
                        }
                        },
                        {
                        extend: 'pdf',
                        text: '<i class="ri-file-pdf-line me-1"></i>Pdf',
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [3, 4, 5, 6, 7],
                            // prevent avatar to be display
                            format: {
                            body: function (inner, coldex, rowdex) {
                                if (inner.length <= 0) return inner;
                                var el = $.parseHTML(inner);
                                var result = '';
                                $.each(el, function (index, item) {
                                if (item.classList !== undefined && item.classList.contains('user-name')) {
                                    result = result + item.lastChild.firstChild.textContent;
                                } else if (item.innerText === undefined) {
                                    result = result + item.textContent;
                                } else result = result + item.innerText;
                                });
                                return result;
                            }
                            }
                        }
                        }
                    ]
                },
                {
                    text: `<i class="ri-add-line ri-16px me-sm-2"></i> <span class="d-none d-sm-inline-block">Añadir</span>`,
                    className: 'create-new btn btn-primary waves-effect waves-light',
                    action: async function (e, dt, button, config) {

                        $('#diccionary').html(`
                            <small class="text-light fw-medium">Diccionario de datos</small>
                            <div class="demo-inline-spacing mt-4">
                                <div class="list-group list-group-flush">
                                    ${
                                        tablist.diccionary.reduce((acc, diccionary) => {
                                            acc.push(`<a href="javascript:void(0);" class="list-group-item list-group-item-action waves-effect copy-item">${diccionary}</a>`)
                                            return acc;
                                        }, []).join('')
                                    }
                                    
                                </div>
                            </div>
                        `);

                        $('#canvasAddLabel').html('Añadir');

                        // canvasAddClaseNiza
                        const offCanvasElement = document.querySelector('#canvasAdd');
                        let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
                        offCanvasEl.show();
                    }
                }
            ],
        })
    })

    tables[0] = $(`#table_datatable_history`).DataTable({
        data: [],
        columns: [
            {title: 'Campo', data: 'field'},
            {title: 'Cambio', data: 'diff'},
            {title: 'Comentario', data: 'comment'},
            {title: 'Fecha de cambio', data: 'date'},
            {title: 'Acciones', data: 'enlace', render: (value, _, res) => {
                return ``
            }},
        ],
        dom: '<"card-header flex-column flex-md-row border-bottom"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6 mt-5 mt-md-0"><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
            processing: 'Cargando datos',
            paginate: {
              next: '<i class="ri-arrow-right-s-line"></i>',
              previous: '<i class="ri-arrow-left-s-line"></i>'
            }
        },
        drawCallback: async function(setting){
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
              return new bootstrap.Tooltip(tooltipTriggerEl);
            });    
        },
        buttons: [
        ],
    })
})


function decline(){

    Swal.fire({
        title: `Eliminar registro`,
        html: `Recuerde que al eliminar se perdera toda información.`,
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        cancelButtonText: "Cancelar",
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-outline-danger"
        },
      }).then(async (result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'success',
                title: `Registro eliminado.`,
                showConfirmButton: true,
                allowOutsideClick: false,
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        }
    });
}

function loadEdit(id, id_template){
    console.log(data)
    const tablist = data.tablists.find(t => t.id == id);
    const template = tablist.templates.find(t => t.id == id_template);
    $('#diccionary').html(`
        <small class="text-light fw-medium">Diccionario de datos</small>
        <div class="demo-inline-spacing mt-4">
            <div class="list-group list-group-flush">
                ${
                    tablist.diccionary.reduce((acc, diccionary) => {
                        acc.push(`<a href="javascript:void(0);" class="list-group-item list-group-item-action waves-effect copy-item">${diccionary}</a>`)
                        return acc;
                    }, []).join('')
                }
                
            </div>
        </div>
    `);

    $('#canvasAddLabel').html(`Editar plantilla #${id_template}`);
    $('#title').val(template.title);
    $('#full-editor').html(template.text.replace(/\n/g, '<br>'));

    // canvasAddClaseNiza
    const offCanvasElement = document.querySelector('#canvasAdd');
    let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
    offCanvasEl.show();
}

function previsualizar(id, id_template){
    const tablist = data.tablists.find(t => t.id == id);
    const template = tablist.templates.find(t => t.id == id_template);

    $('#canvasPrevLabel').html(`Previsualizar plantilla ${template.title}`);
    $('#texto').html(template.prev.replace(/\n/g, '<br>'));

    // canvasAddClaseNiza
    const offCanvasElement = document.querySelector('#canvasPrev');
    let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
    offCanvasEl.show();
}

function historialDiff(id, id_template){
    const tablist = data.tablists.find(t => t.id == id);
    const template = tablist.templates.find(t => t.id == id_template);

    $('#canvasHistoryDiffLabel').html(`Historial de cambios ${template.title}`);

    tables[0].clear();
    tables[0].rows.add(template.history.slice().reverse());
    tables[0].draw(false);

    // canvasAddClaseNiza
    const offCanvasElement = document.querySelector('#canvasHistoryDiff');
    let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
    offCanvasEl.show();
}