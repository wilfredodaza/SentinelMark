let myDropzone;

$(() => {

    const select2 = $('.form-select');
    // flatpickrTime = document.querySelector('#flatpickr-time');

    // if (flatpickrTime) {
    //     flatpickrTime.flatpickr({
    //       enableTime: true,
    //       noCalendar: true
    //     });
    // }

    const dateInput = $('.date-input');
    if (dateInput.length) {
        dateInput.flatpickr({
            locale:             "es",
            monthSelectorType:  'dropdown',
        });
    }

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
        { title: '#', data: 'id' },
        { title: 'Fecha registro', data: 'date' },
        { title: '# Registros', data: 'register' },
        { title: 'Estado', data: 'state' },
        { title: 'Acciones', data: 'id', render: (id) => `
            <div class="d-flex justify-content-center align-items-center">
                <a href="javascript:void(0);" onclick="editGaceta(${id})" class="btn btn-sm btn-text-info rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" data-bs-original-title="Editar">
                    <i class="ri-edit-line"></i>
                </a>
                <a href="javascript:void(0);" onclick="decline()" class="btn btn-sm btn-text-danger rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-danger" data-bs-original-title="Eliminar">
                    <i class="ri-delete-bin-2-line"></i>
                </a>
            </div>
        ` }
    ];

    const url = `dashboard/vigiamarca/gacetas/data`;

    const buttons = [
        {
            text: '<i class="ri-add-line ri-16px me-sm-2"></i> <span class="d-none d-sm-inline-block">Añadir Gaceta</span>',
            className: 'create-new btn btn-primary waves-effect waves-light my-2',
            action: async function (e, dt, button, config) {
                // canvasAddClaseNiza
                if (Dropzone.instances.length > 0) {
                    Dropzone.instances.forEach(dz => dz.destroy());
                }

                const offCanvasElement = document.querySelector('#canvasGaceta');
                let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
                offCanvasEl.show();
            }
        }
    ];

    load_datatable(url, columns, buttons, url, true);

    const dropzoneBasicAddDoc = document.querySelector('#dropzone-basic-created');
    if (dropzoneBasicAddDoc) {
        myDropzone = new Dropzone(dropzoneBasicAddDoc, {
        previewTemplate: previewTemplate(),
            parallelUploads: 1,
            maxFilesize: 5,
            addRemoveLinks: true,
            maxFiles: 1
        });
    }
})

function editGaceta(id){
    const gacetas = getDataDT()
    const gaceta = gacetas.find(g => g.id == id);

    // ----- Reiniciar dropzones previas -----
    if (Dropzone.instances.length > 0) {
        Dropzone.instances.forEach(dz => dz.destroy());
    }

    // console.log(gaceta)

    if (gaceta.file) {
        const existingFileUrl = base_url([`master/docs/gacetas/${gaceta.file}`]);
        const existingFileName = gaceta.file;
    
        const mockFile = {
            name: existingFileName,
            size: 123456 // si no sabes el tamaño no importa
        };
    
        // Mostrar archivo existente en Dropzone
        myDropzone.displayExistingFile(mockFile, existingFileUrl);
    
        // Registrar el archivo como cargado
        myDropzone.files.push(mockFile);
    
        // Evitar que permita agregar otro si maxFiles = 1
        myDropzone.emit("complete", mockFile);
            const previewEl = mockFile.previewElement;
            const imgThumb = previewEl.querySelector("img[data-dz-thumbnail]");
            const noPreview = previewEl.querySelector(".dz-nopreview");
    
            // ocultamos la imagen
            imgThumb.style.display = "none";
    
            // mostramos el ícono PDF
            noPreview.style.display = "flex";
            noPreview.innerHTML = `
                <i class="fa-solid fa-file-pdf" style="
                    font-size: 48px;
                    color: #e74c3c;
                    width: 100%;
                    text-align: center;
                "></i>
            `;
    }

    const offCanvasElement = document.querySelector('#canvasGaceta');
    let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
    offCanvasEl.show();
}

function decline(state){

    Swal.fire({
        title: `Eliminar registro`,
        showCancelButton: true,
        confirmButtonText: `Eliminar registro`,
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