

const data_niza = clasesNiza.filter(c => detail.Clase.includes(c.id));


const cardColor = config.colors.cardColor;
const labelColor = config.colors.textMuted;
const headingColor = config.colors.headingColor;
const borderColor = config.colors.borderColor;
const bodyColor = config.colors.bodyColor;
const legendColor = config.colors.bodyColor;

// Color constant
const chartColors = {
    column: {
        series1: '#826af9',
        series2: '#d2b0ff',
        bg: '#f8d3ff'
    },
    donut: {
        series1: '#fdd835',
        series2: '#32baff',
        series3: '#ffa1a1',
        series4: '#7367f0',
        series5: '#29dac7'
    },
    area: {
        series1: '#ab7efd',
        series2: '#b992fe',
        series3: '#e0cffe'
    }
};

$(() => {

    const select2 = $('.form-select');
    
    if (select2.length) {
        select2.each(function () {
            var $this = $(this);
            const placeholder = $this.attr('placeholder') || 'Seleccione una opción';
            select2Focus($this);
            $this.wrap('<div class="position-relative"></div>').select2({
                placeholder,
                dropdownParent: $this.parent()
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

    const dropzoneBasicEdit = document.querySelector('#dropzone-basic-edit');
    if (dropzoneBasicEdit) {
        const myDropzone = new Dropzone(dropzoneBasicEdit, {
        previewTemplate: previewTemplate(),
            parallelUploads: 1,
            maxFilesize: 5,
            addRemoveLinks: true,
            maxFiles: 1,
            init: function() {
              if(detail.Tipo != "Denominativa"){
                const existingFileUrl = base_url([`master/imgs/branding/logo-${detail.logo}`]); // URL de tu archivo actual
                const existingFileName = `logo-${detail.logo}`; // Nombre del archivo
    
                if (existingFileUrl) {
                    const mockFile = { 
                        name: existingFileName, 
                        size: 123456 // tamaño aproximado, no afecta la visualización
                    };
    
                    // Simula que el archivo ya fue subido
                    this.emit("addedfile", mockFile);
                    this.emit("thumbnail", mockFile, existingFileUrl);
                    this.emit("complete", mockFile);
                    this.files.push(mockFile); // Agrega al array interno de Dropzone
                }
              }
            }
        });
    }

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

    const dropzoneBasicAddEvidencia = document.querySelector('#dropzone-basic-add-evidencia');
    if (dropzoneBasicAddEvidencia) {
        const myDropzone = new Dropzone(dropzoneBasicAddEvidencia, {
        previewTemplate: previewTemplate(),
            parallelUploads: 1,
            maxFilesize: 5,
            addRemoveLinks: true,
            maxFiles: 1
        });
    }

    var dt_basic_table = $('.datatables-basic'),
    dt_basic;

  // DataTable with buttons
  // --------------------------------------------------------------------

  if (dt_basic_table.length) {

    dt_basic = dt_basic_table.DataTable({
      data: data_niza,
      columns: [
        { title: 'Clase', data: 'id' },
        { title: 'Descripción', data: 'description' },
        { title: 'Producto / Servicio', data: 'title' },
        { title: 'Accion', data: 'id', render: (_, __, niza) => {
            return `
                <div class="d-flex justify-content-center align-items-center">

                    <a href="javascript:void(0);" onclick="editNiza(${_})" class="btn btn-sm btn-text-warning rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-warning" data-bs-original-title="Editar">
                        <i class="ri-edit-line"></i>
                    </a>
                    
                    <a href="javascript:void(0);" class="btn btn-sm btn-text-danger rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-danger" data-bs-original-title="Eliminar">
                        <i class="ri-delete-bin-2-line"></i>
                    </a>
                </div>
            `
        } }
      ],
      dom: '<"card-header flex-column flex-md-row border-bottom"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6 mt-5 mt-md-0"><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    //   displayLength: 7,
    //   lengthMenu: [7, 10, 25, 50, 75, 100],
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
        processing: 'Cargando datos',
        paginate: {
          next: '<i class="ri-arrow-right-s-line"></i>',
          previous: '<i class="ri-arrow-left-s-line"></i>'
        }
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
          text: '<i class="ri-add-line ri-16px me-sm-2"></i> <span class="d-none d-sm-inline-block">Añadir Clase niza</span>',
          className: 'create-new btn btn-primary waves-effect waves-light',
          action: async function (e, dt, button, config) {
            $('#clase-niza-add').val("").trigger('change');
            // width-add
            $('#add-niza-form').removeClass('col-lg-4').addClass('col-lg-12')
            $('#add-niza-chat').hide();
            $('#canvasAddClaseNiza').removeClass('width-add')
            // canvasAddClaseNiza
            const offCanvasElement = document.querySelector('#canvasAddClaseNiza');
            let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
            offCanvasEl.show();
        }
        }
      ],
      initComplete: () => {
        $('.content-datatables-basic .head-label').html('<h5 class="card-title mb-0">Clases Niza</h5>');
      }
    });
    
  }

  $('.datatables-basic-2').DataTable({
    data: [{
        id: 1,
        name: 'Doc 1',
        type: 'Requerimiento',
        date: '2025-10-31',
        template: "Plantilla de requerimiento",
        status: 'Activa'
    }, {
        id: 2,
        name: 'Doc 2',
        type: 'Resolucion',
        date: '2025-10-31',
        template: "Plantilla de defecto",
        status: 'Activa'
    }],
    columns: [
        { data: 'name' },
        { data: 'type' },
        { data: 'date' },
        { data: 'template' },
        { data: 'status' },
        { data: 'id', render: (id) => `
            <div class="d-flex justify-content-center align-items-center">
                <a href="javascript:void(0);" class="btn btn-sm btn-text-info rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" data-bs-original-title="Editar">
                    <i class="ri-edit-line"></i>
                </a>

                ${
                  id == 2 ? `
                    <a href="javascript:void(0);" class="btn btn-sm btn-text-danger rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-danger" data-bs-original-title="Descargar">
                        <i class="ri-file-download-line"></i>
                    </a>
                  ` : `
                    <a href="javascript:void(0);" class="btn btn-sm btn-text-warning rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-warning" data-bs-original-title="DocuLaw">
                        <i class="ri-links-line"></i>
                    </a>
                  `
                }
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
            const offCanvasElement = document.querySelector('#canvasAddDoc');
            let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
            offCanvasEl.show();
        }
        }
      ],
      initComplete: () => {
        $('.title-tabla-2.head-label').html('<h5 class="card-title mb-0">Documento Vinculados</h5>');
      }
  })

  $('.datatables-basic-3').DataTable({
    data: [{
        id: 1,
        description: "Publicidad usada",
        file: 'https://r-charts.com/es/miscelanea/procesamiento-imagenes-magick_files/figure-html/importar-imagen-r.png',
        type: 'Publicidad',
        date: '2025-10-31',
    }],
    columns: [
        { data: 'file', render: (img) => `<img  class="d-block flex-shrink-0 rounded-circle me-sm-2 me-0" height="40" width="40" src="${img}"/>` },
        { data: 'type' },
        { data: 'description' },
        { data: 'date' },
        { data: 'file', render:(file) => `<a href="${file}" target="_blank"><i class="ri-links-fill"></i></a>` },
        { data: 'id', render: (id) => `
            <div class="d-flex justify-content-center align-items-center">

                    <a href="javascript:void(0);" class="btn btn-sm btn-text-warning rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-warning" data-bs-original-title="Editar">
                        <i class="ri-edit-line"></i>
                    </a>
                    
                    <a href="javascript:void(0);" class="btn btn-sm btn-text-danger rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-danger" data-bs-original-title="Eliminar">
                        <i class="ri-delete-bin-2-line"></i>
                    </a>
                </div>
        ` }
    ],
    dom: '<"card-header flex-column flex-md-row border-bottom"<"head-label table-title-3 text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6 mt-5 mt-md-0"><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
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
          text: '<i class="ri-add-line ri-16px me-sm-2"></i> <span class="d-none d-sm-inline-block">Añadir Evidencia</span>',
          className: 'create-new btn btn-primary waves-effect waves-light',
          action: async function (e, dt, button, config) {
            // canvasAddClaseNiza
            const offCanvasElement = document.querySelector('#canvasAddEvidencia');
            let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
            offCanvasEl.show();
        }
        }
      ],
      initComplete: () => {
        $('.table-title-3.head-label').html('<h5 class="card-title mb-0">Evidencias y pruebas de uso</h5>');
      }
  })
  $('.datatables-basic-4').DataTable({
    data: [{
        id: 1,
        item: "Verificacion de distintividad",
        description: 'Nombre unico y no generico',
        state: 'check',
        observation: '',
    }, {
        id: 2,
        item: "Revisión de signos similares",
        description: 'VigiaMarca ejecutado',
        state: 'pending',
        observation: 'Revision manual',
    }, {
        id: 3,
        item: "Clasificación correcta Niza",
        description: 'Incluye productos ejecutados',
        state: 'check',
        observation: '',
    }, {
        id: 4,
        item: "Conflictos legales previos",
        description: 'Ninguno detectado',
        state: 'check',
        observation: '',
    }, {
        id: 5,
        item: "Documentación completa",
        description: 'Factura, logo,  poder',
        state: 'uncheck',
        observation: 'Falta poder legal',
    }],
    columns: [
        { title: 'Item', data: 'item' },
        { title: 'Descripción', data: 'description' },
        { title: 'Estado', data: 'state', render: state => {
            if(state == 'check'){
                return `
                <i class="ri-checkbox-circle-line text-success"></i>
                `
            }else if(state == 'pending'){
                return `
                <i class="ri-indeterminate-circle-line text-warning"></i>
                `
            }else{
                return `
                    <i class="ri-error-warning-line text-danger"></i>                    `
                }
            }
        },
        { title: 'Observación', data: 'observation'},
        { title: 'Editar', data: 'id', render: (id, _, info) => {
            if(info.state != 'check'){
                return `
                  <a href="javascript:void(0);" onclick="marcarCompletado()" class="btn btn-sm btn-text-warning rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-warning" data-bs-original-title="Editar">
                      <i class="ri-edit-line"></i>
                  </a>
                `
            }
            return "" 
            
        }}       
    ],
    dom: '<"card-header flex-column flex-md-row border-bottom"<"head-label table-title-4 text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6 mt-5 mt-md-0"><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
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
    
    ordering: false,
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
              }
            ]
          }
    ],
    initComplete: () => {
      $('.table-title-4.head-label').html('<h5 class="card-title mb-0">Flujo de disclosure</h5>');
    }
  })

  const months = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

    const areaChartEl = document.querySelector('#lineAreaChart'),
    areaChartConfig = {
        chart: {
        height: 400,
        fontFamily: 'Inter',
        type: 'area',
        parentHeightOffset: 0,
        toolbar: { show: false }
        },
        dataLabels: { enabled: false },
        stroke: {
        show: false,
        curve: 'straight'
        },
        legend: {
        show: true,
        position: 'top',
        horizontalAlign: 'start',
        fontSize: '13px',
        markers: { width: 10, height: 10 },
        labels: {
            colors: legendColor,
            useSeriesColors: false
        }
        },
        grid: {
        borderColor: borderColor,
        xaxis: {
            lines: { show: true }
        }
        },
        colors: [
        chartColors.area.series3,
        chartColors.area.series2,
        chartColors.area.series1
        ],
        series: [
            {
                name: 'Costo',
                data: [10000000, 25000000, 20000000]
            },
        ],
        xaxis: {
        categories: ['2025', '2024', '2023'].slice().reverse(),
        axisBorder: { show: false },
        axisTicks: { show: false },
        labels: {
            style: {
            colors: labelColor,
            fontSize: '13px'
            }
        }
        },
        yaxis: {
        labels: {
            style: {
            colors: labelColor,
            fontSize: '13px'
            },
            formatter: function (val) {
            if (val >= 1e9) return `${(val / 1e9).toFixed(1).replace(/\.0$/, '')} B`;
            if (val >= 1e6) return `${(val / 1e6).toFixed(1).replace(/\.0$/, '')} M`;
            if (val >= 1e3) return `${(val / 1e3).toFixed(1).replace(/\.0$/, '')} K`;
            return val.toLocaleString(); // 👉 si es menor a 1000, se muestra con separador de miles normal
            },
        }
        },
        fill: {
        opacity: 1,
        type: 'solid'
        },
        tooltip: {
        shared: false,
        y: {
            formatter: val =>
            val.toLocaleString('es-CO', {
                style: 'currency',
                currency: 'COP'
            })
        }
        }
    };

    // 🔹 Renderizar el gráfico
    if (typeof areaChartEl !== 'undefined' && areaChartEl !== null) {
    const areaChart = new ApexCharts(areaChartEl, areaChartConfig);
    areaChart.render();
    }

    const areaChartEl2 = document.querySelector('#lineAreaChart-2'),
    areaChartConfig2 = {
        chart: {
        height: 400,
        fontFamily: 'Inter',
        type: 'bar',
        parentHeightOffset: 0,
        toolbar: { show: false }
        },
        dataLabels: { enabled: false },
        stroke: {
        show: false,
        curve: 'straight'
        },
        legend: {
            show: true,
            position: 'top',
            horizontalAlign: 'start',
            fontSize: '13px',
            markers: { width: 10, height: 10 },
            labels: {
                colors: legendColor,
                useSeriesColors: false
            }
        },
        grid: {
            strokeDashArray: 8,
            borderColor,
            xaxis: { lines: { show: true } },
            yaxis: { lines: { show: false } },
            padding: {
                top: -18,
                left: 21,
                right: 33,
                bottom: 10,
            },
        },
        colors: [
        chartColors.area.series3,
        ],
        series: [
            {
                name: 'Historico',
                data: [12850000, 15674000, 20967000]
            },
        ],
        xaxis: {
        categories: ['2025', '2024', '2023'].slice().reverse(),
        axisBorder: { show: false },
        axisTicks: { show: false },
        labels: {
            style: {
            colors: labelColor,
            fontSize: '13px'
            }
        }
        },
        yaxis: {
        labels: {
            style: {
            colors: labelColor,
            fontSize: '13px'
            },
            formatter: function (val) {
            if (val >= 1e9) return `${(val / 1e9).toFixed(1).replace(/\.0$/, '')} B`;
            if (val >= 1e6) return `${(val / 1e6).toFixed(1).replace(/\.0$/, '')} M`;
            if (val >= 1e3) return `${(val / 1e3).toFixed(1).replace(/\.0$/, '')} K`;
            return val.toLocaleString(); // 👉 si es menor a 1000, se muestra con separador de miles normal
            },
        }
        },
        // fill: {
        // opacity: 1,
        // type: 'solid'
        // },
        tooltip: {
            y: {
                formatter: val =>
                val.toLocaleString('es-CO', {
                    style: 'currency',
                    currency: 'COP'
                })
            }
        },
        states: {
            hover: {
                filter: {
                    type: "none",
                },
            },
            active: {
                filter: {
                    type: "none",
                },
            },
        },
    };

    // 🔹 Renderizar el gráfico
    if (typeof areaChartEl2 !== 'undefined' && areaChartEl2 !== null) {
        const areaChart2 = new ApexCharts(areaChartEl2, areaChartConfig2);
        areaChart2.render();
    }
})

function changeClaseNiza(id){
    if(id){
        const clase_niza = clasesNiza.find(n => n.id == id);
        $('#descripcion-clase-niza-add').val(clase_niza.description);
        $('#name-class-niza').val(clase_niza.title);
        $('#btn-validar-niza').attr('disabled', false)
    }else{
        $('#descripcion-clase-niza-add').val("");
        $('#name-class-niza').val("");
        $('#btn-validar-niza').attr('disabled', true)
    }
}

function validarListNiza(){
    $('#add-niza-form').removeClass('col-lg-12').addClass('col-lg-4')
    $('#add-niza-chat').show();
    $('#canvasAddClaseNiza').addClass('width-add')
}

function editNiza(id){
    $('#clase-niza-add').val(id).trigger('change');
    // canvasAddClaseNiza
    const offCanvasElement = document.querySelector('#canvasAddClaseNiza');
    let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
    offCanvasEl.show();
}

function marcarCompletado(){
  const offCanvasElement = document.querySelector('#canvasCompletado');
  let offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
  offCanvasEl.show();
}

function changeTipo(tipo){
  console.log(tipo)
  if(tipo != 'Denominativa')
    $("#dropzone-basic-edit").removeClass("d-none");
  else 
    $("#dropzone-basic-edit").addClass("d-none");
}