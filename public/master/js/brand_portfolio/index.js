$(() => {
    const select2 = $('.form-select');
    
    if (select2.length) {
        select2.each(function () {
            var $this = $(this);
            const placeholder = $this.attr('placeholder') || 'Seleccione una opción';
            select2Focus($this);
            $this.wrap('<div class="position-relative"></div>').select2({
                placeholder,
                dropdownParent: $this.parent(),
                tags: true, // ✅ Permite agregar nuevas opciones
                createTag: function (params) {
                    var term = $.trim(params.term);
                    if (term === '') {
                        return null;
                    }
                    return {
                        id: term,
                        text: term,
                        newOption: true
                    };
                },
            });
        });
    }
    
    const dateInput = $('.date-input');
    if (dateInput.length) {
        dateInput.flatpickr({
            locale:             "es",
            monthSelectorType:  'dropdown',
        });
    }

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

    const url = 'dashboard/brand_portfolio/data';
    const columns = [
        {title: '#', data: 'id'},
        {title: 'Marca', data: 'Marca', render: (_,__, res) => `${res.icon} ${_}`},
        {title: 'País', data: 'País'},
        {title: 'Clase', data: 'Clase'},
        {title: 'Estado', data: 'company_state.title'},
        {title: 'Titular', data: 'Titular'},
        {title: 'Expediente', data: 'Expediente'},
        {title: 'Fecha Solicitud', data: 'Fecha_Solicitud'},
        {title: 'Última Actuación', data: 'Última_Actuación'},
        {title: 'Acciones', data: 'id', render:(_,__, res) => {
            return `
                <div class="d-flex justify-content-center align-items-center">
                    <a href="${base_url(['dashboard/brand_portfolio', res.id])}" class="btn btn-sm btn-text-info rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" data-bs-original-title="Ver">
                        <i class="ri-search-eye-line"></i>
                    </a>

                    <a href="javascript:void(0);" onclick="loadEdit(${res.id})" class="btn btn-sm btn-text-warning rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-warning" data-bs-original-title="Editar">
                        <i class="ri-edit-line"></i>
                    </a>
                    
                    <a href="javascript:void(0);" onclick="decline(${res.id})" class="btn btn-sm btn-text-danger rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-danger" data-bs-original-title="Eliminar">
                        <i class="ri-delete-bin-2-line"></i>
                    </a>
                </div>
            `
        }},
    ];
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
                const offCanvasElement = document.querySelector('#canvasAdd');
                let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
                offCanvasEl.show();
            }
        }
    ];

    load_datatable(url, columns, buttons, `dashboard/brand_portfolio/data`, true)

})

function loadEdit(id){
    const datas = getDataDT();
    const data = datas.find(d => d.id == id);

    console.log(data)

    $("#canvasEditLabel").html(`Editar portafolio de marcas #${data.id}`);

    $("#form-edit #marca").val(data.Marca)
    $("#form-edit #tipo").val(data.Tipo).trigger('change');
    const paisSelect = $("#form-edit #pais");
    const paisValor = data.País;

    // Verificar si existe la opción
    if (paisSelect.find("option[value='" + paisValor + "']").length) {
        // Si existe, seleccionarla
        paisSelect.val(paisValor).trigger("change");
    } else if (paisValor) {
        // Si no existe, agregarla y seleccionarla
        const newOption = new Option(paisValor, paisValor, true, true);
        paisSelect.append(newOption).trigger("change");
    }
    $("#form-edit #clasesNiza").val(data.Clase).trigger('change');
    $("#form-edit #estado").val(data.Estado).trigger('change');
    const titularSelect = $("#form-edit #titular");
    const titularValor = data.Titular;

    // Verificar si existe la opción
    if (titularSelect.find("option[value='" + titularValor + "']").length) {
        // Si existe, seleccionarla
        titularSelect.val(titularValor).trigger("change");
    } else if (titularValor) {
        // Si no existe, agregarla y seleccionarla
        const newOption = new Option(titularValor, titularValor, true, true);
        titularSelect.append(newOption).trigger("change");
    }


    $("#form-edit #date").val(data.Fecha_Solicitud);

    initDropzoneEdit();

    // Si el registro tiene logo, mostrarlo
    if (data.logo) {
        const existingFileUrl = base_url([`master/imgs/branding/logo-${data.logo}`]);
        const existingFileName = existingFileUrl.split('/').pop();

        const mockFile = {
            name: existingFileName,
            size: 123456,
            type: 'image/jpeg'
        };

        myDropzone.emit("addedfile", mockFile);
        myDropzone.emit("thumbnail", mockFile, existingFileUrl);
        myDropzone.emit("complete", mockFile);
        myDropzone.files.push(mockFile);
    }

    const offCanvasElement = document.querySelector('#canvasEdit');
    let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
    offCanvasEl.show();
}

function decline(id){
    const datas = getDataDT();
    const data = datas.find(d => d.id == id);

    Swal.fire({
        title: `Eliminar la marca ${data.Marca.toLowerCase()}`,
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
                title: `Marca ${data.Marca.toLowerCase()} eliminada.`,
                showConfirmButton: true,
                allowOutsideClick: false,
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
            reloadTable()
        }
    });
}

let myDropzone; // declarar fuera para poder reutilizarla

function initDropzoneEdit() {
    const dropzoneElement = document.querySelector('#dropzone-basic-edit');
    if (!dropzoneElement) return;

    // Si ya existe una instancia previa, destruirla antes de crear una nueva
    if (myDropzone) {
        myDropzone.destroy();
    }

    myDropzone = new Dropzone(dropzoneElement, {
        previewTemplate: previewTemplate(),
        parallelUploads: 1,
        maxFilesize: 5, // MB
        addRemoveLinks: true,
        maxFiles: 1,
        autoProcessQueue: false, // evita subir automáticamente al abrir modal
        init: function() {
            const dz = this;

            // Limitar a 1 archivo
            dz.on("maxfilesexceeded", function(file) {
                dz.removeAllFiles();
                dz.addFile(file);
            });
        }
    });
}

function changeTipo(tipo){
    console.log(tipo)
    if(tipo != 'Denominativa')
      $("#dropzone-basic-edit").removeClass("d-none");
    else 
      $("#dropzone-basic-edit").addClass("d-none");
  }