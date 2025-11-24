$(() => {

    $('#datatables-basic-1').DataTable({
        data: canales,
        columns: [
            { title: '#', data: 'id' },
            { title: 'Canal', data: 'name' },
            { title: 'Hora envio', data: 'hour' },
            { title: 'Acciones', data: 'id', render: (id) => `
                <div class="d-flex justify-content-center align-items-center">
                    <a href="javascript:void(0);" class="btn btn-sm btn-text-info rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" data-bs-original-title="Ver">
                        <i class="ri-edit-line"></i>
                    </a>
                        
                    <a href="javascript:void(0);" onclick="decline()" class="btn btn-sm btn-text-danger rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-danger" data-bs-original-title="Eliminar">
                        <i class="ri-delete-bin-2-line"></i>
                    </a>
                </div>
            ` }
        ],
        dom: '<"card-header flex-column flex-md-row border-bottom"<"head-label title-tabla-1 text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6 mt-5 mt-md-0"><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        lengthMenu: [10, 25, 50, 75, 100],
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
            {
              text: '<i class="ri-add-line ri-16px me-sm-2"></i> <span class="d-none d-sm-inline-block">Añadir</span>',
              className: 'create-new btn btn-primary waves-effect waves-light',
              action: async function (e, dt, button, config) {
                // canvasAddClaseNiza
                const offCanvasElement = document.querySelector('#canvasAddCanal');
                let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
                offCanvasEl.show();
            }
            }
        ],
        initComplete: () => {
            $('.title-tabla-1.head-label').html('<h5 class="card-title mb-0">Canales</h5>');
        }
    })

    $('#datatables-basic-2').DataTable({
        data: frecuencias,
        columns: [
            { title: '#', data: 'id' },
            { title: 'Dias', data: 'day' },
            { title: 'Titulo', data: 'text' },
            { title: 'Acciones', data: 'id', render: (id) => `
                <div class="d-flex justify-content-center align-items-center">
                    <a href="javascript:void(0);" class="btn btn-sm btn-text-info rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" data-bs-original-title="Ver">
                        <i class="ri-edit-line"></i>
                    </a>
                        
                    <a href="javascript:void(0);" onclick="decline()" class="btn btn-sm btn-text-danger rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-danger" data-bs-original-title="Eliminar">
                        <i class="ri-delete-bin-2-line"></i>
                    </a>
                </div>
            ` }
        ],
        dom: '<"card-header flex-column flex-md-row border-bottom"<"head-label title-tabla-2 text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6 mt-5 mt-md-0"><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        lengthMenu: [10, 25, 50, 75, 100],
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
            {
              text: '<i class="ri-add-line ri-16px me-sm-2"></i> <span class="d-none d-sm-inline-block">Añadir</span>',
              className: 'create-new btn btn-primary waves-effect waves-light',
              action: async function (e, dt, button, config) {
                // canvasAddClaseNiza
                const offCanvasElement = document.querySelector('#canvasAddFrecuencia');
                let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
                offCanvasEl.show();
            }
            }
        ],
        initComplete: () => {
            $('.title-tabla-2.head-label').html('<h5 class="card-title mb-0">Frecuencias</h5>');
        }
    })

    $('#datatables-basic-3').DataTable({
        data: [
            {
                id: 1,
                event: "Evento #1",
                channel: 'WhatsApp',
                limit: '21-11-2025',
                date: '17-11-2025',
                state: 'Entregado'
            },
            {
                id: 2,
                event: "Evento #1",
                channel: 'Gmail',
                limit: '21-11-2025',
                date: '17-11-2025',
                state: 'Entregado'
            },
        ],
        columns: [
            { title: '#', data: 'id' },
            { title: 'Evento', data: 'event' },
            { title: 'Canal', data: 'channel' },
            { title: 'Limite', data: 'limit' },
            { title: 'Fecha de envio', data: 'date' },
            { title: 'Estado', data: 'state' },
        ],
        dom: '<"card-header flex-column flex-md-row border-bottom"<"head-label title-tabla-3 text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6 mt-5 mt-md-0"><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        lengthMenu: [10, 25, 50, 75, 100],
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
        initComplete: () => {
            $('.title-tabla-3.head-label').html('<h5 class="card-title mb-0">Registro de envios</h5>');
        }
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