$(() => {

    const select2 = $('.form-select');

    if (select2.length) {
        select2.each(function () {
            var $this = $(this);

            const placeholder = $this.attr('placeholder') || 'Seleccione una opción';
            const enableTags  = $this.data('tag') === true;      // ← lee data-tag
            const allowClear  = $this.data('allow-clear') === true;

            select2Focus($this);

            $this.wrap('<div class="position-relative"></div>').select2({
                placeholder,
                dropdownParent: $this.parent(),
                tags: enableTags,
                allowClear: allowClear,
                createTag: function (params) {
                    var term = $.trim(params.term);
                    if (term === '') return null;

                    return {
                        id: term,
                        text: term,
                        newOption: true
                    };
                }
            });
        });
    }

    const columns = [
        // {title: "", data: ''},
        {title: "#", data: 'id'},
        {title: 'País/Jurisdicción', data: 'country.name'},
        {title: "Código de regla", data: 'code'},
        {title: "Descripción", data: 'description'},
        {title: "Tipo", data: 'type'},
        // {title: "Tipo Causal", data: 'tipo_causal'},
        {title: "Entidad", data: 'entidad'},
        {title: "Evento de origen", data: 'origen'},
        {title: "Expresión de plazo", data: 'plazo'},
        {title: "Módulo destino", data: 'module.name'},
        {title: "Estado", data: 'state'},
        {title: "Acciones", data: 'id', render: (_, __, res) => {
            return `
                <div class="d-flex justify-content-center align-items-center">
                    <a href="javascript:void(0)" onclick="edit(${_})" class="btn btn-sm btn-text-info rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" data-bs-original-title="Editar">
                        <i class="ri-edit-2-line"></i>
                    </a>
                    <a href="javascript:void(0)" onclick="decline('${res.state}')" class="btn btn-sm btn-text-warning rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-warning" data-bs-original-title="${res.state == 'Activa' ? 'Inactivar' : 'Activar' }">
                        <i class="${res.state == 'Activa' ? 'ri-eye-close-line' : 'ri-eye-2-line' }"></i>
                    </a>
                </div>
            `
        }}
    ];

    const url = `dashboard/regulamark/data`;

    const buttons = [
        {
            text: '<i class="ri-filter-3-line"></i><span class="d-none d-sm-inline-block">Filtrar</span>',
            className: `btn rounded-pill btn-label-info waves-effect mx-2 mt-2`,
            action: async function (e, dt, button, config) {
                const offCanvasElement = document.querySelector('#canvasFilter');
                let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
                offCanvasEl.show();
            }
        },
        {
            text: '<i class="ri-add-fill me-1"></i><span class="d-none d-sm-inline-block">Agregar</span>',
            className: `btn rounded-pill btn-primary waves-effect mx-2 mt-2 btn-add`,
            action: async function (e, dt, button, config) {
                
                $('#canvasAddLabel').html('Añadir');

                $('#pais-add').val(null).trigger('change');
                $('#code-add').val(null);
                $('#code-add').attr('readonly', false);
                $('#description').val(null);
                $('#tipo').val(null).trigger('change');
                $('#entidad').val(null).trigger('change');
                $('#origen').val(null);
                $('#plazo').val(null);
                $('#modulo-add').val(null).trigger('change');

                const offCanvasElement = document.querySelector('#canvasAdd');
                let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
                offCanvasEl.show();
            }
        }
    ];

    load_datatable(url, columns, buttons, url, true);
})



function decline(state){

    Swal.fire({
        title: `${state == 'Activa' ? 'Inactivar' : 'Activar'} registro`,
        showCancelButton: true,
        confirmButtonText: `${state == 'Activa' ? 'Inactivar' : 'Activar'} registro`,
        cancelButtonText: "Cancelar",
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-outline-danger"
        },
      }).then(async (result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'success',
                title: `Registro ${state == 'Activa' ? 'inactivado' : 'activado'}.`,
                showConfirmButton: true,
                allowOutsideClick: false,
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        }
    });
}

function edit(id){
    const rules = getDataDT();
    const ruler = rules.find(r => r.id == id);
    
    $('#pais-add').val(ruler.country.id).trigger('change');
    $('#code-add').val(ruler.code);
    $('#description').val(ruler.description);
    $('#tipo').val(ruler.type).trigger('change');
    $('#entidad').val(ruler.entidad).trigger('change');
    $('#origen').val(ruler.origen);
    $('#plazo').val(ruler.plazo);
    $('#modulo-add').val(ruler.module.id).trigger('change');

    
    $('#code-add').attr('readonly', true);
    
    const offCanvasElement = document.querySelector('#canvasAdd');
    
    $('#canvasAddLabel').html('Editar')
    
    let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
    offCanvasEl.show();
    console.log(ruler)
}