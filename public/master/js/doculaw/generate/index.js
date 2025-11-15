$(() => {
    const columns = [
        {title: "", data: 'id'},
        {title: "#", data: 'id'},
        {title: "Categoria", data: 'category.name'},
        {title: "Plantilla", data: 'template.title'},
        {title: "Marca", data: 'marca.nombre_corto'},
        {title: "Expediente", data: 'marca.Expediente'},
        {title: "Clases", data: 'marca.Clase', render:(clases) => clases.reduce((acc, clase) => {
            acc.push(clase);
            return acc;
        }, []).join(', ')},
        {title: "Titular", data: 'marca.Titular'},
        {title: "Agente", data: 'brand.abogado_asignado'},
        {title: "Evidencias", data: 'brand.adjuntos', render:(adjuntos) => {
            return `<ul class="my-0">
                ${
                   adjuntos.reduce((acc, adjunto) => {
                        acc.push(`<li><a href="${adjunto.adjunto}"><i class="fa-duotone fa-solid fa-link"></i> ${adjunto.reference}</a></li>`);
                        return acc;
                    }, []).join('') 
                }
                </ul>
            `
        }},
        {title: 'Acciones', data: 'id', render: (value, _, res) => {
            return `
                <div class="d-flex align-items-center">
                    <a href="javascript:void(0);" onclick="editDocument(${res.id})" class="btn btn-sm btn-text-secundary rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secundary" data-bs-original-title="Editar">
                        <i class="fa-duotone fa-solid fa-pen-to-square"></i>
                    </a>

                    <a href="javascript:void(0);" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-line"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end m-0" style="">

                        <li><a href="javascript:void(0);" class="dropdown-item">
                            <i class="fa-duotone fa-solid fa-file-doc"></i> Word
                        </a></li>

                        <li><a href="javascript:void(0);" class="dropdown-item">
                            <i class="fa-duotone fa-solid fa-file-pdf"></i> PDF
                        </a></li>

                        <li><a href="javascript:void(0);" class="dropdown-item">
                            <i class="fa-duotone fa-solid fa-bell"></i> Notificar
                        </a></li>
                        
                        <li><a href="javascript:void(0);" onclick="decline(${res.id})" class="dropdown-item text-red">
                            <i class="fa-duotone fa-solid fa-circle-trash"></i> Eliminar
                        </a></li>
                    </ul>
                </div>
            `
        }}
    ];

    const url = `dashboard/doculaw/generate/data`;

    const buttons = [
        {
            text: '<i class="ri-file-add-line"></i><span class="d-none d-sm-inline-block">Añadir</span>',
            className: `btn rounded-pill btn-primary waves-effect mx-2 mt-2`,
            action: async function (e, dt, button, config) {
                const offCanvasElement = document.querySelector('#canvasAdd');

                $('#tipo').val(null).trigger('change')
                $('#template').val(null).trigger('change')

                $('#canvasAddLabel').html('Añadir')

                let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
                offCanvasEl.show();
            }
        },
    ];

    load_datatable(url, columns, buttons, url, true);
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

function editDocument(id){
    const documents = getDataDT();
    const info = documents.find(d => d.id == id);

    console.log(info)

    $('.btn-close').click();

    const offCanvasElement = document.querySelector('#canvasAdd');

    $('#canvasAddLabel').html('Editar')

    $('#tipo').val(info.marca.id).trigger('change')
    $('#template').val(info.template_id).trigger('change')

    let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
    offCanvasEl.show();
}