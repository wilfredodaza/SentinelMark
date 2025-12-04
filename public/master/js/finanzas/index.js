let myDropzone;

$(() => {
    const dateInput = $('.date-input');
    if (dateInput.length) {
        dateInput.flatpickr({
            locale:             "es",
            monthSelectorType:  'dropdown',
        });
    }

    const url = 'dashboard/finances/data';
    const columns = [
        {title: '#', data: 'id'},
        {title: 'Marca', data: 'brand.Marca', render: (_,__, res) => `
            <a href="${base_url(['dashboard/brand_portfolio', res.brand.id])}" target="_blank">${res.brand.icon} ${_}</a>
        `},
        {title: 'País', data: 'country.name'},
        {title: 'Tipo de costo', data: 'type.name'},
        {title: 'Sub tipo', data: 'sub_type.name'},
        {title: 'Módulo origen', data: 'module.name'},
        {title: 'Monto', data: 'amount', render:(value) => formatPrice(parseFloat(value))},
        {title: 'Estado', data: 'state.name'},
        {title: 'Fecha', data: 'date'},
        {title: 'Comprobante', data: 'file', render: (file) => {
            if(!file)
                return "";
            return `
                <a href="${base_url(['master/docs/gacetas', file])}" target="_blank"><i class="ri-coupon-line"></i></a>
            `
        }},
        {title: 'Responsable', data: 'responsable'},
        {title: 'Acciones', data: 'id', render:(_,__, res) => {
            return `
                <div class="d-flex justify-content-center align-items-center">

                    <a href="javascript:void(0);" onclick="edit(${res.id})" class="btn btn-sm btn-text-warning rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-warning" data-bs-original-title="Editar">
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
                
                $('#brand-add').val(null).trigger('change')
                $('#pais-add').val(null).trigger('change')
                $('#module-add').val(null).trigger('change')
                $('#type-add').val(null).trigger('change')
                $('#sub_type-add').val(null).trigger('change')
                $('#amount-add').val(null)
                $('#date').val(null).trigger('change')
                $('#state-add').val(null).trigger('change')
                $('#proveedor-add').val(null).trigger('change')

                // ----- Quitar elementos previos del contenedor -----
                const dropzoneElement = document.querySelector("#dropzone-basic-add"); // tu ID real
                if (dropzoneElement) {
                    dropzoneElement.querySelectorAll(".dz-preview").forEach(el => el.remove());
                }

                // ----- Reiniciar dropzones previas -----
                if (Dropzone.instances.length > 0) {
                    Dropzone.instances.forEach(dz => dz.destroy());
                }


                const offCanvasElement = document.querySelector('#canvasAdd');
                let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
                offCanvasEl.show();
            }
        }
    ];

    load_datatable(url, columns, buttons, `dashboard/finances/data`, true)

    const dropzoneBasicAddDoc = document.querySelector('#dropzone-basic-add');
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

function edit(id){
    const costs = getDataDT();
    const cost = costs.find(c => c.id == id);

    $('#brand-add').val(cost.brand_id).trigger('change')
    $('#pais-add').val(cost.country_id).trigger('change')
    $('#module-add').val(cost.origen).trigger('change')
    $('#type-add').val(cost.type.id).trigger('change')
    $('#sub_type-add').val(cost.sub_type.id).trigger('change')
    $('#amount-add').val(cost.amount)
    $('#date').val(cost.date).trigger('change')
    $('#state-add').val(cost.state.id).trigger('change')
    $('#proveedor-add').val(cost.responsable).trigger('change')


    // ----- Reiniciar dropzones previas -----
    if (Dropzone.instances.length > 0) {
        Dropzone.instances.forEach(dz => dz.destroy());
    }

    // console.log(gaceta)

    if (cost.file) {
        const existingFileUrl = base_url([`master/docs/gacetas/${cost.file}`]);
        const existingFileName = cost.file;
    
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

    console.log(cost);

    const offCanvasElement = document.querySelector('#canvasAdd');
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