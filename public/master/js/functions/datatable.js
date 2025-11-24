
let url_base;

function load_datatable(url, columns, buttons = [], url_page, filter = false){
    url_base = url_page;

    table_datatable[0] = $(`#table_datatable`).DataTable({
        ajax: {
            url: base_url([url]),
            data: function(d) {
                // d.date_init     = $('#date_init').val();
                $('#form-filter').serializeArray().forEach(field => {
                    d[field.name] = field.value;
                });
            },
            dataSrc: 'data',
            error: function (xhr, error, thrown) {
                console.error("Error en la petición AJAX:", error, thrown);
                console.log("Respuesta del servidor:", xhr.responseText);
    
                // Ejemplo: mostrar alerta con SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la carga',
                    text: 'No se pudieron obtener los datos del servidor',
                    allowOutsideClick: false,
                    customClass: {
                        confirmButton: 'btn btn-primary waves-effect'
                    },
                });
            }
        },
        // <"card-header flex-column flex-md-row border-bottom"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>>
        columns,
        columnDefs: [
            {
              // For Responsive
              className: 'pointer',
              orderable: false,
              searchable: false,
            //   responsivePriority: 2,
              targets: 0,
              render: function (data, type, full, meta) {
                return `<b class="pointer">${data}</b>`;
              }
            },
          ],
        dom: 'r<"row"<"col-sm-12 col-md-6 mt-3 mt-md-0 d-flex justify-content-center justify-content-md-start align-items-center"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"<"card-header py-2 flex-column flex-md-row border-bottom"<"head-label text-center"><"dt-action-buttons text-end pt-0 pt-md-0"B>>>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json",
            processing: 'Cargando datos',
            paginate: {
                next: '<i class="ri-arrow-right-s-line"></i>',
                previous: '<i class="ri-arrow-left-s-line"></i>'
            }
        },
        responsive: {
            details: {
              display: $.fn.dataTable.Responsive.display.modal({
                header: function (row) {
                  var data = row.data();
                  return '';
                }
              }),
              type: 'column',
              renderer: function (api, rowIdx, columns) {
                var data = $.map(columns, function (col, i) {
                  return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                    ? '<tr data-dt-row="' +
                        col.rowIndex +
                        '" data-dt-column="' +
                        col.columnIndex +
                        '">' +
                        '<td>' +
                        col.title +
                        ':' +
                        '</td> ' +
                        '<td>' +
                        col.data +
                        '</td>' +
                        '</tr>'
                    : '';
                }).join('');
    
                return data ? $('<table class="table"/><tbody />').append(data) : false;
              }
            }
          },
        // scrollX: true,
        // scrollY: false,
        ordering: false,
        processing: true,
        serverSide: true,
        search: true,
        drawCallback: async function(setting){
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
              return new bootstrap.Tooltip(tooltipTriggerEl);
            });            

            Swal.close();
            setTimeout(() => {
                this.api().columns.adjust();
            }, 300);

        },
        initComplete: async () => {
            // if(filter){
            //     $('.filter').html(`
            //         <div class="col-sm-6 w-100">
            //             <div class="input-group input-group-merge">
            //                 <span class="input-group-text cursor-pointer" id="filter-global-2"><i class="ri-menu-search-line"></i></span>
            //                 <div class="form-floating form-floating-outline">
            //                     <input type="text" id="filter-global" class="form-control" placeholder="" aria-describedby="password2-modern">
            //                     <label for="filter-global">Buscador</label>
            //                 </div>
            //             </div>
            //         </div>    
            //     `)
            //     let searchTimeout; // variable global para controlar el tiempo

            //     $('#filter-global').on('keyup', function () {
            //         clearTimeout(searchTimeout); // limpia el tiempo anterior
                    
            //         const value = this.value;
            //         table_datatable[0].search(value).draw();
            //     });
            // }
        },


        buttons: [
            {
                extend: 'collection',
                className: 'btn rounded-pill btn-label-primary waves-effect mx-2 mt-2 dropdown-toggle',
                text: '<i class="ri-external-link-line me-sm-1"></i> <span class="d-none d-sm-inline-block">Reportes</span>',
                buttons: default_buttons()
            },
            ...buttons
        ]
    });
}

function load_datatable_total(columns, data, buttons = []){
    table_datatable[0] = $(`#table_datatable`).DataTable({
        data,
        columns,
        dom: '<"card-header flex-column flex-md-row border-bottom"<"head-label text-center"><"dt-action-buttons text-end pt-0 pt-md-0"B>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        language: { url: "https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json" },
        responsive: false,
        scrollX: true,
        scrollY: false,
        ordering: false,
        processing: true,
        serverSide: false,
        drawCallback: async function(setting){
        },
        initComplete: async () => {
            // await indicadores();
        },
        buttons
    });
}

const exportConfig = {
    format: {
      body: function (inner, coldex, rowdex) {
        if (inner.length <= 0) return inner;
        var el = $.parseHTML(inner);
        var result = '';
        $.each(el, function (index, item) {
          if (item.classList !== undefined && item.classList.contains('user-name')) {
            result += item.lastChild.firstChild.textContent;
          } else if (item.innerText === undefined) {
            result += item.textContent;
          } else {
            result += item.innerText;
          }
        });
        return result;
      }
    }
  };

function default_buttons(){
    const buttons = [
        {
            extend: 'excel',
            text: '<i class="ri-file-excel-line me-1"></i><span class="d-none d-sm-inline-block">Excel</span>',
            className: `dropdown-item`,
            filename: `Reporte_${info_page.title.replace(/\s+/g, "_").toLowerCase()}`,
            title: `Reporte de ${info_page.title}`,
            action: async function (e, dt, button, config) {
        
                // 🔹 Traer columnas visibles
                const visibleColumns = dt.columns(':visible').indexes().toArray();
        
                const selected = await sweetAlertExport(visibleColumns, dt)
        
                // Si no selecciona nada o cancela
                if (!selected || selected.length === 0) {
                    return;
                }

                config.exportOptions = {
                    ...exportConfig,
                    columns: selected
                };

                const getData = {
                    length:         -1,
                }

                const url = base_url(['dashboard/brand_portfolio/data'], getData);
                const {data: dataExport} = await fetchHelper.get(url);

                // 🔹 Recargar datos temporalmente
                dt.clear();
                dt.rows.add(dataExport);
                dt.draw();
        
                // 🔹 Ejecutar exportación normal de Excel
                $.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, dt, button, config);
            }
        },
        {
            extend: 'csv',
            text: '<i class="ri-file-text-line me-1"></i><span class="d-none d-sm-inline-block">CSV</span>',
            className: 'dropdown-item',
            filename: `Reporte_${info_page.title.replace(/\s+/g, "_").toLowerCase()}`,
            title: `Reporte de ${info_page.title}`,
            action: async function (e, dt, button, config) {
                // 🔹 Traer columnas visibles
                const visibleColumns = dt.columns(':visible').indexes().toArray();
            
                const selected = await sweetAlertExport(visibleColumns, dt)
        
                // Si no selecciona nada o cancela
                if (!selected || selected.length === 0) {
                    return;
                }

                config.exportOptions = {
                    ...exportConfig,
                    columns: selected
                };

                const getData = {
                    length:         -1,
                }

                const url = base_url(['dashboard/brand_portfolio/data'], getData);
                const {data: dataExport} = await fetchHelper.get(url);

                // 🔹 Recargar datos temporalmente
                dt.clear();
                dt.rows.add(dataExport);
                dt.draw();
            
                $.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, button, config);
            }
        },
        {
            extend: 'pdf',
            text: '<i class="ri-file-pdf-2-line me-1"></i><span class="d-none d-sm-inline-block">PDF</span>',
            className: 'dropdown-item',
            filename: `Reporte_${info_page.title.replace(/\s+/g, "_").toLowerCase()}`,
            title: `Reporte de ${info_page.title}`,
            action: async function (e, dt, button, config) {
                // 🔹 Traer columnas visibles
                const visibleColumns = dt.columns(':visible').indexes().toArray();
            
                const selected = await sweetAlertExport(visibleColumns, dt)
        
                // Si no selecciona nada o cancela
                if (!selected || selected.length === 0) {
                    return;
                }

                config.exportOptions = {
                    ...exportConfig,
                    columns: selected
                };

                const getData = {
                    length:         -1,
                }

                const url = base_url(['dashboard/brand_portfolio/data'], getData);
                const {data: dataExport} = await fetchHelper.get(url);

                // 🔹 Recargar datos temporalmente
                dt.clear();
                dt.rows.add(dataExport);
                dt.draw();
            
                $.fn.dataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, button, config);
            }
        }
    ].filter(Boolean);

    return buttons;
}

function reloadTable(){
    table_datatable[0].ajax.reload();
}

async function sendFilter(e){
    e.preventDefault();
    Swal.fire({
        showConfirmButton: false,
        allowOutsideClick: false,
        customClass: {},
        // timer: time,
        willOpen: function () {
            Swal.showLoading();
        }
    });
    $('#canvasFilter .btn-close').click();
    await reloadTable();

}

function getDataDT(){
    return table_datatable[0].rows().data().toArray();
}

async function sweetAlertExport(visibleColumns, dt){
    // 🔹 Armar HTML con checkboxes
    let html = '<div style="text-align:left">';
    visibleColumns.forEach(i => {
        const colTitle = dt.column(i).header().textContent.trim();
        // Última columna (acciones) la puedes excluir si quieres
        if (i !== visibleColumns[visibleColumns.length - 1] && colTitle != "") {
            html += `
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="col_${i}" value="${i}" checked>
                    <label class="form-check-label" for="col_${i}">${colTitle}</label>
                </div>`;
        }
    });
    html += '</div>';

    // 🔹 Mostrar SweetAlert con checkboxes
    const { value: selected } = await Swal.fire({
        title: 'Selecciona las columnas a exportar',
        html: html,
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Exportar',
        preConfirm: () => {
            return [...document.querySelectorAll('input[type=checkbox]:checked')]
                .map(cb => parseInt(cb.value));
        }
    });

    return selected;
}