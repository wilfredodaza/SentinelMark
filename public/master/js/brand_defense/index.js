$(() => {
    const columns = [
        {title: "#", data: 'caso'},
        {title: 'Tipo', data: 'tipo'},
        {title: "Marca propia", data: 'marca.Marca'},
        {title: "País", data: 'pais'},
        {title: "Clase", data: 'clase'},
        // {title: "Tipo Causal", data: 'tipo_causal'},
        {title: "Estado", data: 'estado'},
        {title: "Riesgo", data: 'riesgo'},
        {title: "Fecha<br>Límite", data: 'fecha_limite'},
        {title: "Abogado asignado", data: 'abogado_asignado'},
        {title: "Acciones", data: 'id', render: (_, __, res) => {
            return `
                <div class="d-flex justify-content-center align-items-center">
                    <a href="${base_url(['dashboard/brand_defense', res.id])}" class="btn btn-sm btn-text-info rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" data-bs-original-title="Ver">
                        <i class="ri-search-eye-line"></i>
                    </a>
                </div>
            `
        }}
    ];

    const url = `dashboard/brand_defense/data`;

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
    ];

    load_datatable(url, columns, buttons, url, true);
})