$(() => {

    const select2 = $('.form-select'),
    flatpickrTime = document.querySelector('#flatpickr-time');

    if (flatpickrTime) {
        flatpickrTime.flatpickr({
          enableTime: true,
          noCalendar: true
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
        // {title: "", data: ''},
        {title: "#", data: 'id'},
        {title: 'Nombre de vigilancia', data: 'name'},
        {title: "Tipo", data: 'tipo'},
        {title: "Ambito", data: 'country.name'},
        {title: "Estado", data: 'state'},
        // {title: "Tipo Causal", data: 'tipo_causal'},
        {title: "Última ejecución", data: 'last'},
        {title: "Próxima ejecución", data: 'next'},
        {title: "Hits nuevos", data: 'hits', render: (data, _, res) => {
            if(res.state == 'En curso' || res.state == 'Pausado'){
                return `
                    <div class="progress bg-label-primary">
                      <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 55%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                `;
            }
            const total = data.length;
            return `${total > 0 ? `<b><a href="javascript:void(0)" onclick="verHallazgos(${res.id})" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Ver hallazgos">` : ''}${total} hit${total == 1 ? '' : 's'} nuevo${total == 1 ? '' : 's'}. ${total > 0 ? `<i class="ri-expand-diagonal-s-fill"></i>` : ``} ${total > 0 ? '</a></b>' : ''}`
        }},
        {title: "Responsable", data: 'responsable'},
        // {title: "Estado", data: 'state'},
        {title: "Acciones", data: 'id', render: (_, __, res) => {
            return `
                <div class="d-flex justify-content-center align-items-center">
                    <a href="javascript:void(0)" onclick="edit(${_})" class="btn btn-sm btn-text-secundary rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-secundary" data-bs-original-title="Ver resultados">
                        <i class="ri-file-search-line"></i>
                    </a>
                    <a href="javascript:void(0);" class="btn btn-sm btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-2-line"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end m-0" style="">

                        <li><a href="javascript:void(0);" class="dropdown-item">
                            <i class="fa-duotone fa-solid fa-pen-to-square"></i> Editar  
                        </a></li>

                        ${
                            res.state == 'En curso' ? `
                                <li><a href="javascript:void(0);" class="dropdown-item">
                                    <i class="fa-duotone fa-light fa-circle-pause"></i> Pausar
                                </a></li>
                            ` : ''
                        }

                        ${
                            res.state == 'Pausado' ? `
                                <li><a href="javascript:void(0);" class="dropdown-item">
                                    <i class="ri-restart-line"></i> Reanudar
                                </a></li>
                            ` : ''
                        }

                        ${
                            res.state == 'Activa' ? `
                                <li><a href="javascript:void(0);" class="dropdown-item">
                                    <i class="ri-play-circle-line"></i> Ejecutar
                                </a></li>
                            ` : ''
                        }
                        
                        <li><a href="javascript:void(0);" onclick="decline(${res.id})" class="dropdown-item text-red">
                            <i class="fa-duotone fa-solid fa-circle-trash"></i> Eliminar
                        </a></li>
                    </ul>
                </div>
            `
        }}
    ];

    const url = `dashboard/vigiamarca/data`;

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

    $('#table_datatable_2').DataTable({
        data: gacetas,
        columns: [
            { title: '#', data: 'id' },
            { title: 'Fecha registro', data: 'date' },
            { title: '# Registros', data: 'register' },
            { title: 'Estado', data: 'state' },
            { title: 'Acciones', data: 'id', render: (id) => `
                <div class="d-flex justify-content-center align-items-center">
                    <a href="javascript:void(0);" class="btn btn-sm btn-text-info rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" data-bs-original-title="Editar">
                        <i class="ri-edit-line"></i>
                    </a>
                    <a href="javascript:void(0);" class="btn btn-sm btn-text-danger rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-danger" data-bs-original-title="Eliminar">
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
            // {
            //   extend: 'collection',
            //   className: 'btn btn-label-primary dropdown-toggle me-4 waves-effect waves-light',
            //   text: '<i class="ri-external-link-line me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
            //   buttons: [
            //     {
            //       extend: 'print',
            //       text: '<i class="ri-printer-line me-1" ></i>Print',
            //       className: 'dropdown-item',
            //       exportOptions: {
            //         columns: [3, 4, 5, 6, 7],
            //         // prevent avatar to be display
            //         format: {
            //           body: function (inner, coldex, rowdex) {
            //             if (inner.length <= 0) return inner;
            //             var el = $.parseHTML(inner);
            //             var result = '';
            //             $.each(el, function (index, item) {
            //               if (item.classList !== undefined && item.classList.contains('user-name')) {
            //                 result = result + item.lastChild.firstChild.textContent;
            //               } else if (item.innerText === undefined) {
            //                 result = result + item.textContent;
            //               } else result = result + item.innerText;
            //             });
            //             return result;
            //           }
            //         }
            //       },
            //       customize: function (win) {
            //         //customize print view for dark
            //         $(win.document.body)
            //           .css('color', config.colors.headingColor)
            //           .css('border-color', config.colors.borderColor)
            //           .css('background-color', config.colors.bodyBg);
            //         $(win.document.body)
            //           .find('table')
            //           .addClass('compact')
            //           .css('color', 'inherit')
            //           .css('border-color', 'inherit')
            //           .css('background-color', 'inherit');
            //       }
            //     },
            //     {
            //       extend: 'csv',
            //       text: '<i class="ri-file-text-line me-1" ></i>Csv',
            //       className: 'dropdown-item',
            //       exportOptions: {
            //         columns: [3, 4, 5, 6, 7],
            //         // prevent avatar to be display
            //         format: {
            //           body: function (inner, coldex, rowdex) {
            //             if (inner.length <= 0) return inner;
            //             var el = $.parseHTML(inner);
            //             var result = '';
            //             $.each(el, function (index, item) {
            //               if (item.classList !== undefined && item.classList.contains('user-name')) {
            //                 result = result + item.lastChild.firstChild.textContent;
            //               } else if (item.innerText === undefined) {
            //                 result = result + item.textContent;
            //               } else result = result + item.innerText;
            //             });
            //             return result;
            //           }
            //         }
            //       }
            //     },
            //     {
            //       extend: 'excel',
            //       text: '<i class="ri-file-excel-line me-1"></i>Excel',
            //       className: 'dropdown-item',
            //       exportOptions: {
            //         columns: [3, 4, 5, 6, 7],
            //         // prevent avatar to be display
            //         format: {
            //           body: function (inner, coldex, rowdex) {
            //             if (inner.length <= 0) return inner;
            //             var el = $.parseHTML(inner);
            //             var result = '';
            //             $.each(el, function (index, item) {
            //               if (item.classList !== undefined && item.classList.contains('user-name')) {
            //                 result = result + item.lastChild.firstChild.textContent;
            //               } else if (item.innerText === undefined) {
            //                 result = result + item.textContent;
            //               } else result = result + item.innerText;
            //             });
            //             return result;
            //           }
            //         }
            //       }
            //     },
            //     {
            //       extend: 'pdf',
            //       text: '<i class="ri-file-pdf-line me-1"></i>Pdf',
            //       className: 'dropdown-item',
            //       exportOptions: {
            //         columns: [3, 4, 5, 6, 7],
            //         // prevent avatar to be display
            //         format: {
            //           body: function (inner, coldex, rowdex) {
            //             if (inner.length <= 0) return inner;
            //             var el = $.parseHTML(inner);
            //             var result = '';
            //             $.each(el, function (index, item) {
            //               if (item.classList !== undefined && item.classList.contains('user-name')) {
            //                 result = result + item.lastChild.firstChild.textContent;
            //               } else if (item.innerText === undefined) {
            //                 result = result + item.textContent;
            //               } else result = result + item.innerText;
            //             });
            //             return result;
            //           }
            //         }
            //       }
            //     },
            //     {
            //       extend: 'copy',
            //       text: '<i class="ri-file-copy-line me-1" ></i>Copy',
            //       className: 'dropdown-item',
            //       exportOptions: {
            //         columns: [3, 4, 5, 6, 7],
            //         // prevent avatar to be display
            //         format: {
            //           body: function (inner, coldex, rowdex) {
            //             if (inner.length <= 0) return inner;
            //             var el = $.parseHTML(inner);
            //             var result = '';
            //             $.each(el, function (index, item) {
            //               if (item.classList !== undefined && item.classList.contains('user-name')) {
            //                 result = result + item.lastChild.firstChild.textContent;
            //               } else if (item.innerText === undefined) {
            //                 result = result + item.textContent;
            //               } else result = result + item.innerText;
            //             });
            //             return result;
            //           }
            //         }
            //       }
            //     }
            //   ]
            // },
            {
              text: '<i class="ri-add-line ri-16px me-sm-2"></i> <span class="d-none d-sm-inline-block">Añadir Gaceta</span>',
              className: 'create-new btn btn-primary waves-effect waves-light',
              action: async function (e, dt, button, config) {
                // canvasAddClaseNiza
                const offCanvasElement = document.querySelector('#canvasGaceta');
                let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
                offCanvasEl.show();
            }
            }
          ],
          initComplete: () => {
            $('.title-tabla-2.head-label').html('<h5 class="card-title mb-0">Gacetas cargadas</h5>');
            const dropzoneBasicAddDoc = document.querySelector('#dropzone-basic-created');
            if (dropzoneBasicAddDoc) {
                const myDropzone = new Dropzone(dropzoneBasicAddDoc, {
                previewTemplate: previewTemplate(),
                    parallelUploads: 1,
                    maxFilesize: 5,
                    addRemoveLinks: true,
                    maxFiles: 1
                });
            }
          }
      })

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

function verHallazgos(id){
    const data = getDataDT();
    const vigiamarca = data.find(v => v.id == id);

    const offCanvasElement = document.querySelector('#canvasHallazgos');

    $('#canvasHallazgos table tbody').html(`
        ${
            vigiamarca.hits.reduce((acc, hit) => {
                const tr = `
                    <tr>
                        <td>${hit.id}</td>
                        <td>${hit.brand.Marca}</td>
                        <td>${hit.description}</td>
                        <td>${hit.umbral}</td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                <a href="javascript:void(0)" onclick="changeHit(${vigiamarca.id}, ${hit.id}, 1)" class="btn btn-sm btn-text-success rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-success" data-bs-original-title="Aceptar hit">
                                    <i class="ri-checkbox-circle-line"></i>
                                </a>
                                <a href="javascript:void(0)" onclick="changeHit(${vigiamarca.id}, ${hit.id}, 0)" class="btn btn-sm btn-text-danger rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-danger" data-bs-original-title="Rechazar hit">
                                    <i class="ri-error-warning-line"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                `
                acc.push(tr);
                return acc;
            }, []).join('')
        }    
    `);

    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
        const tooltip = bootstrap.Tooltip.getInstance(el);
        if (tooltip) {
            tooltip.dispose();
        }
    });

    // Crear tooltips nuevos
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
        new bootstrap.Tooltip(el);
    });
    
    let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
    offCanvasEl.show();
}

function changeHit(vigiamarca, id, state){

    // setTimeout(() => {
        // $('#closeBtn').click();
    // }, 300);

    switch (state) {
        case 1:
            Swal.fire({
                icon: 'success',
                title: `Aceptar Hit`,
                text: `¿Seguro de aceptar el hit?`,
                showCancelButton: true,
                confirmButtonText: `Aceptar`,
                cancelButtonText: "Cancelar",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-outline-danger"
                },
              }).then(async (result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: `Hit aceptado`,
                        showConfirmButton: true,
                        allowOutsideClick: false,
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
            break;
    
        default:
            Swal.fire({
                title: "Rechazar registro",
                html: `
                    <div class="form-floating form-floating-outline mb-6">
                        <textarea class="form-control h-px-100" id="swal-motivo" placeholder=""></textarea>
                        <label for="swal-motivo">Motivo del rechazo</label>
                    </div>
                `,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Rechazar",
                cancelButtonText: "Cancelar",
                focusConfirm: false,
                confirmButtonColor: "#d33",
                preConfirm: () => {
                  const motivo = document.getElementById("swal-motivo").value.trim();
              
                  if (!motivo) {
                    Swal.showValidationMessage("Debes escribir el motivo del rechazo.");
                    return false;
                  }
              
                  return motivo;
                }
              }).then((result) => {
                if (result.isConfirmed) {
                  // Aquí procesas el rechazo
                  console.log("Motivo del rechazo:", result.value);
              
                  Swal.fire({
                    icon: "success",
                    title: "Registro rechazado",
                    text: "El registro ha sido rechazado correctamente."
                  });
              
                  // Aquí podrías llamar un AJAX para enviar el motivo, por ejemplo:
                  // $.post("/rechazar", { id: idRegistro, motivo: result.value });
                }
              });
            break;
    }

    // verHallazgos(vigiamarca)
}