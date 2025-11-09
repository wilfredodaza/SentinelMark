$(() => {
    const columns = [
        {title: "#", data: 'caso'},
        {title: "Marca propia", data: 'Marca_Referencia.Marca'},
        {title: "Marca opositora", data: 'Marca_Opositora.Marca'},
        {title: "País", data: 'pais'},
        {title: "Clase", data: 'clase'},
        {title: "Tipo Causal", data: 'tipo_causal'},
        {title: "Estado", data: 'estado'},
        {title: "Riesgo", data: 'riesgo'},
        {title: "Fecha<br>Límite", data: 'fecha_limite'},
        {title: "Abogado asignado", data: 'abogado_asignado'},
        {title: "Acciones", data: 'id', render: (_, __, res) => {
            return `
                <div class="d-flex justify-content-center align-items-center">
                    <a href="${base_url(['dashboard/trademark_protection', res.id])}" class="btn btn-sm btn-text-info rounded-pill btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-info" data-bs-original-title="Ver">
                        <i class="ri-search-eye-line"></i>
                    </a>
                </div>
            `
        }}
    ];

    const url = `dashboard/trademark_protection/data`;

    const buttons = [];

    load_datatable(url, columns, buttons, url, true);
})