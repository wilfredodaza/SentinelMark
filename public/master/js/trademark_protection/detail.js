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

    $('.datatables-basic-1').DataTable({
        data: detail.documents,
        columns: [
            { title: '#', data: 'id' },
            { title: 'Tipo', data: 'tipo' },
            { title: 'Fecha', data: 'fecha' },
            { title: 'Estado', data: 'estado' },
            { title: 'Version', data: 'version' },
            { title: 'Acciones', data: 'id', render: (id) => `
                <div class="d-flex justify-content-center align-items-center">
                    <a href="javascript:void(0);" class="btn btn-sm btn-text-info rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" data-bs-original-title="Ver">
                        <i class="ri-search-eye-line"></i>
                    </a>

                    <a href="javascript:void(0);" class="btn btn-sm btn-text-warning rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-warning" data-bs-original-title="Descargar">
                        <i class="ri-file-download-line"></i>
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
              extend: 'collection',
              className: 'btn btn-label-primary dropdown-toggle me-4 waves-effect waves-light',
              text: '<i class="ri-external-link-line me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
              buttons: [
                {
                  extend: 'print',
                  text: '<i class="ri-printer-line me-1" ></i>Print',
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
                  },
                  customize: function (win) {
                    //customize print view for dark
                    $(win.document.body)
                      .css('color', config.colors.headingColor)
                      .css('border-color', config.colors.borderColor)
                      .css('background-color', config.colors.bodyBg);
                    $(win.document.body)
                      .find('table')
                      .addClass('compact')
                      .css('color', 'inherit')
                      .css('border-color', 'inherit')
                      .css('background-color', 'inherit');
                  }
                },
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
                },
                {
                  extend: 'copy',
                  text: '<i class="ri-file-copy-line me-1" ></i>Copy',
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
              text: '<i class="ri-add-line ri-16px me-sm-2"></i> <span class="d-none d-sm-inline-block">Añadir Documento</span>',
              className: 'create-new btn btn-primary waves-effect waves-light',
              action: async function (e, dt, button, config) {
                // canvasAddClaseNiza
                const offCanvasElement = document.querySelector('#canvasAddDocAdjunto');
                let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
                offCanvasEl.show();
            }
            }
        ],
        initComplete: () => {
            $('.title-tabla-1.head-label').html('<h5 class="card-title mb-0">Documento Adjuntos</h5>');
            const dropzoneBasicAddDoc = document.querySelector('#dropzone-basic-add-doc');
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