<?php

function getBrands(){
    return [
        (object)[
            "id" => 15,
            "Marca" => "Café Huila Premium Selection",
            "nombre_corto" => "CafeHuila",
            "País" => "Colombia",
            "Clase" => [30, 43],
            "Estado" => "Registrada",
            "Titular" => "Café del Sur S.A.",
            "Expediente" => "EXP-001",
            "Fecha_Solicitud" => "2023-01-15",
            "Última_Actuación" => "2024-06-20",
            "Tipo" => "Denominativa",
            "icon" => '<i class="fa-duotone fa-light fa-circle-d"></i>',
            "logo" => null,
            "company_state" => (object)['id' => 1, 'title' => 'Activa', 'description' => 'La empresa está operando normalmente.'],
            "entity_state" => (object)['id' => 3, 'title' => 'Registrada', 'description' => 'La empresa fue suspendida temporalmente.'],
            "descripcion_comercial" => "Marca que representa café de origen huilense, reconocido por su sabor premium y aroma intenso.",
            "descripcion_abogado" => "Registro consolidado y en plena vigencia. Se recomienda mantener uso constante para evitar caducidad."
        ],
        (object)[
            "id" => 2,
            "Marca" => "Tech Smart Innovators",
            "nombre_corto" => "TechSmart",
            "País" => "México",
            "Clase" => [9, 42],
            "Estado" => "En trámite",
            "Titular" => "Innovaciones Digitales MX",
            "Expediente" => "EXP-002",
            "Fecha_Solicitud" => "2023-03-10",
            "Última_Actuación" => "2024-02-05",
            "Tipo" => "Figurativa",
            "icon" => '<i class="fa-duotone fa-solid fa-images"></i>',
            "logo" => "1.png",
            "company_state" => (object)['id' => 2, 'title' => 'Inactiva', 'description' => 'La empresa está registrada pero no realiza operaciones.'],
            "entity_state" => (object)['id' => 1, 'title' => 'Presentada', 'description' => 'La empresa está operando normalmente.'],
            "descripcion_comercial" => "Desarrolladora de soluciones tecnológicas y software empresarial orientado a la innovación digital.",
            "descripcion_abogado" => "El expediente se encuentra en fase de revisión formal. No se han detectado oposiciones hasta la fecha."
        ],
        (object)[
            "id" => 3,
            "Marca" => "Eco Vida Natural Balance",
            "nombre_corto" => "EcoVida",
            "País" => "Chile",
            "Clase" => [3, 5, 35],
            "Estado" => "Aprobada",
            "Titular" => "Eco Vida Ltda.",
            "Expediente" => "EXP-003",
            "Fecha_Solicitud" => "2023-05-25",
            "Última_Actuación" => "2024-08-12",
            "Tipo" => "Mixta",
            "icon" => '<i class="fa-duotone fa-light fa-circle-m"></i>',
            "logo" => "2.png",
            "company_state" => (object)['id' => 1, 'title' => 'Activa', 'description' => 'La empresa está operando normalmente.'],
            "entity_state" => (object)['id' => 2, 'title' => 'Publicada', 'description' => 'La empresa está registrada pero no realiza operaciones.'],
            "descripcion_comercial" => "Productos de cuidado personal y bienestar con ingredientes 100% naturales.",
            "descripcion_abogado" => "Aprobación otorgada. Pendiente emisión del certificado final de registro."
        ],
        (object)[
            "id" => 4,
            "Marca" => "Agro Finca Export Solutions",
            "nombre_corto" => "AgroFinca",
            "País" => "Perú",
            "Clase" => [1, 31, 44],
            "Estado" => "Rechazada",
            "Titular" => "Agroexport S.A.C.",
            "Expediente" => "EXP-004",
            "Fecha_Solicitud" => "2023-02-18",
            "Última_Actuación" => "2024-05-01",
            "Tipo" => "Denominativa",
            "icon" => '<i class="fa-duotone fa-light fa-circle-d"></i>',
            "logo" => null,
            "company_state" => (object)['id' => 3, 'title' => 'Suspendida', 'description' => 'La empresa fue suspendida temporalmente.'],
            "entity_state" => (object)['id' => 1, 'title' => 'Presentada', 'description' => 'La empresa está operando normalmente.'],
            "descripcion_comercial" => "Exportadora de productos agrícolas y soluciones logísticas para el agro.",
            "descripcion_abogado" => "El rechazo se debe a similitud fonética con marca previa. Se recomienda apelación con ajustes de denominación."
        ],
        (object)[
            "id" => 5,
            "Marca" => "Nutri Plus Advanced Nutrition",
            "nombre_corto" => "NutriPlus",
            "País" => "Argentina",
            "Clase" => [5, 29, 32],
            "Estado" => "Registrada",
            "Titular" => "Laboratorios BioPlus",
            "Expediente" => "EXP-005",
            "Fecha_Solicitud" => "2023-07-01",
            "Última_Actuación" => "2024-09-10",
            "Tipo" => "Mixta",
            "icon" => '<i class="fa-duotone fa-light fa-circle-m"></i>',
            "logo" => "3.png",
            "company_state" => (object)['id' => 1, 'title' => 'Activa', 'description' => 'La empresa está operando normalmente.'],
            "entity_state" => (object)['id' => 3, 'title' => 'Registrada', 'description' => 'La empresa fue suspendida temporalmente.'],
            "descripcion_comercial" => "Marca de suplementos alimenticios y productos de nutrición avanzada.",
            "descripcion_abogado" => "Registro firme y protegido. Se recomienda extender protección internacional bajo Protocolo de Madrid."
        ],
        (object)[
            "id" => 6,
            "Marca" => "MAWII",
            "nombre_corto" => "Mawii",
            "País" => "España",
            "Clase" => [9, 11, 37],
            "Estado" => "En revisión",
            "Titular" => "Energías Limpias S.L.",
            "Expediente" => "EXP-006",
            "Fecha_Solicitud" => "2023-09-12",
            "Última_Actuación" => "2024-07-30",
            "Tipo" => "Figurativa",
            "icon" => '<i class="fa-duotone fa-solid fa-images"></i>',
            "logo" => "4.png",
            "company_state" => (object)['id' => 2, 'title' => 'Inactiva', 'description' => 'La empresa está registrada pero no realiza operaciones.'],
            "entity_state" => (object)['id' => 1, 'title' => 'Presentada', 'description' => 'La empresa está operando normalmente.'],
            "descripcion_comercial" => "Empresa dedicada a la fabricación e instalación de paneles solares.",
            "descripcion_abogado" => "En etapa de examen de fondo. Se sugiere monitorear posibles oposiciones por marcas similares."
        ],
        (object)[
            "id" => 7,
            "Marca" => "Vida Fresca Bebidas Naturales",
            "nombre_corto" => "VidaFresca",
            "País" => "Colombia",
            "Clase" => [32, 33],
            "Estado" => "Registrada",
            "Titular" => "Jugos del Campo SAS",
            "Expediente" => "EXP-007",
            "Fecha_Solicitud" => "2023-06-08",
            "Última_Actuación" => "2024-10-01",
            "Tipo" => "Mixta",
            "icon" => '<i class="fa-duotone fa-light fa-circle-m"></i>',
            "logo" => "5.png",
            "company_state" => (object)['id' => 1, 'title' => 'Activa', 'description' => 'La empresa está operando normalmente.'],
            "entity_state" => (object)['id' => 3, 'title' => 'Registrada', 'description' => 'La empresa fue suspendida temporalmente.'],
            "descripcion_comercial" => "Marca de jugos naturales y bebidas saludables sin conservantes.",
            "descripcion_abogado" => "Registro consolidado. Recomendado mantener uso comercial activo para evitar cancelación por falta de uso."
        ],
        (object)[
            "id" => 8,
            "Marca" => "MAWIL",
            "nombre_corto" => "Mawil",
            "País" => "Brasil",
            "Clase" => [9, 12, 37, 42],
            "Estado" => "Pendiente",
            "Titular" => "MotoExpress LTDA",
            "Expediente" => "EXP-008",
            "Fecha_Solicitud" => "2023-04-22",
            "Última_Actuación" => "2024-09-15",
            "Tipo" => "Figurativa",
            "icon" => '<i class="fa-duotone fa-solid fa-images"></i>',
            "logo" => "1.png",
            "company_state" => (object)['id' => 2, 'title' => 'Inactiva', 'description' => 'La empresa está registrada pero no realiza operaciones.'],
            "entity_state" => (object)['id' => 1, 'title' => 'Presentada', 'description' => 'La empresa está operando normalmente.'],
            "descripcion_comercial" => "Servicio de entregas rápidas y mensajería urbana con enfoque tecnológico.",
            "descripcion_abogado" => "Solicitud pendiente de publicación. Se sugiere vigilancia sobre marcas del mismo rubro logístico."
        ],
        (object)[
            "id" => 9,
            "Marca" => "Agua Pura Natural Springs",
            "nombre_corto" => "AguaPura",
            "País" => "Costa Rica",
            "Clase" => [32, 35],
            "Estado" => "Aprobada",
            "Titular" => "Agua Pura Natural CR",
            "Expediente" => "EXP-009",
            "Fecha_Solicitud" => "2023-01-09",
            "Última_Actuación" => "2024-04-02",
            "Tipo" => "Denominativa",
            "icon" => '<i class="fa-duotone fa-light fa-circle-d"></i>',
            "logo" => null,
            "company_state" => (object)['id' => 1, 'title' => 'Activa', 'description' => 'La empresa está operando normalmente.'],
            "entity_state" => (object)['id' => 2, 'title' => 'Publicada', 'description' => 'La empresa está registrada pero no realiza operaciones.'],
            "descripcion_comercial" => "Marca de agua embotellada proveniente de manantiales naturales.",
            "descripcion_abogado" => "Aprobación definitiva otorgada. Pendiente entrega de título oficial del registro."
        ],
        (object)[
            "id" => 10,
            "Marca" => "Fit Zone Active Life",
            "nombre_corto" => "FitZone",
            "País" => "Chile",
            "Clase" => [25, 28, 41],
            "Estado" => "Registrada",
            "Titular" => "Fitness Global SpA",
            "Expediente" => "EXP-010",
            "Fecha_Solicitud" => "2023-05-15",
            "Última_Actuación" => "2024-08-25",
            "Tipo" => "Mixta",
            "icon" => '<i class="fa-duotone fa-light fa-circle-m"></i>',
            "logo" => "2.png",
            "company_state" => (object)['id' => 1, 'title' => 'Activa', 'description' => 'La empresa está operando normalmente.'],
            "entity_state" => (object)['id' => 3, 'title' => 'Registrada', 'description' => 'La empresa fue suspendida temporalmente.'],
            "descripcion_comercial" => "Marca dedicada a ropa deportiva y centros de acondicionamiento físico.",
            "descripcion_abogado" => "Registro en orden. Se sugiere protección ampliada en países vecinos por afinidad comercial."
        ],
        (object)[
            "id" => 11,
            "Marca" => "Bio Life Natural Health",
            "nombre_corto" => "BioLife",
            "País" => "Ecuador",
            "Clase" => [5, 35, 44],
            "Estado" => "En trámite",
            "Titular" => "BioLife Ecuador Cía. Ltda.",
            "Expediente" => "EXP-011",
            "Fecha_Solicitud" => "2023-02-28",
            "Última_Actuación" => "2024-07-11",
            "Tipo" => "Denominativa",
            "icon" => '<i class="fa-duotone fa-light fa-circle-d"></i>',
            "logo" => null,
            "company_state" => (object)['id' => 2, 'title' => 'Inactiva', 'description' => 'La empresa está registrada pero no realiza operaciones.'],
            "entity_state" => (object)['id' => 1, 'title' => 'Presentada', 'description' => 'La empresa está operando normalmente.'],
            "descripcion_comercial" => "Marca enfocada en suplementos naturales y bienestar integral.",
            "descripcion_abogado" => "Expediente en análisis. Se recomienda adjuntar evidencia de uso para fortalecer solicitud."
        ],
        (object)[
            "id" => 12,
            "Marca" => "Casa Verde Eco Construction",
            "nombre_corto" => "CasaVerde",
            "País" => "España",
            "Clase" => [19, 37, 42],
            "Estado" => "Registrada",
            "Titular" => "Construcciones Eco S.L.",
            "Expediente" => "EXP-012",
            "Fecha_Solicitud" => "2023-03-14",
            "Última_Actuación" => "2024-10-05",
            "Tipo" => "Figurativa",
            "icon" => '<i class="fa-duotone fa-solid fa-images"></i>',
            "logo" => "3.png",
            "company_state" => (object)['id' => 1, 'title' => 'Activa', 'description' => 'La empresa está operando normalmente.'],
            "entity_state" => (object)['id' => 3, 'title' => 'Registrada', 'description' => 'La empresa fue suspendida temporalmente.'],
            "descripcion_comercial" => "Constructora sostenible enfocada en edificaciones ecológicas.",
            "descripcion_abogado" => "Registro firme. Se recomienda incluir eslogan como elemento adicional distintivo."
        ],
        (object)[
            "id" => 13,
            "Marca" => "Andes Cacao Fine Selection",
            "nombre_corto" => "AndesCacao",
            "País" => "Colombia",
            "Clase" => [30, 31, 33],
            "Estado" => "Aprobada",
            "Titular" => "Cacao del Huila SAS",
            "Expediente" => "EXP-013",
            "Fecha_Solicitud" => "2023-06-10",
            "Última_Actuación" => "2024-07-19",
            "Tipo" => "Mixta",
            "icon" => '<i class="fa-duotone fa-light fa-circle-m"></i>',
            "logo" => "4.png",
            "company_state" => (object)['id' => 1, 'title' => 'Activa', 'description' => 'La empresa está operando normalmente.'],
            "entity_state" => (object)['id' => 2, 'title' => 'Publicada', 'description' => 'La empresa está registrada pero no realiza operaciones.'],
            "descripcion_comercial" => "Cacao gourmet de alta calidad cultivado en la región andina.",
            "descripcion_abogado" => "Aprobación lista para formalización. Se sugiere registrar diseño gráfico complementario."
        ],
        (object)[
            "id" => 14,
            "Marca" => "GreenFuel Energy Solutions",
            "nombre_corto" => "GreenFuel",
            "País" => "Perú",
            "Clase" => [4, 37, 42],
            "Estado" => "Rechazada",
            "Titular" => "BioEnergy Perú",
            "Expediente" => "EXP-014",
            "Fecha_Solicitud" => "2023-04-04",
            "Última_Actuación" => "2024-06-02",
            "Tipo" => "Figurativa",
            "icon" => '<i class="fa-duotone fa-solid fa-images"></i>',
            "logo" => "5.png",
            "company_state" => (object)['id' => 3, 'title' => 'Suspendida', 'description' => 'La empresa fue suspendida temporalmente.'],
            "entity_state" => (object)['id' => 1, 'title' => 'Presentada', 'description' => 'La empresa está operando normalmente.'],
            "descripcion_comercial" => "Empresa enfocada en combustibles ecológicos y energía verde.",
            "descripcion_abogado" => "Solicitud denegada por coincidencia con marca extranjera. Recomendado presentar recurso de revisión."
        ],
        (object)[
            "id" => 1,
            "Marca" => "Ocean Blue Seafoods",
            "nombre_corto" => "OceanBlue",
            "País" => "Uruguay",
            "Clase" => [29, 31, 35],
            "Estado" => "Registrada",
            "Titular" => "Mar del Sur S.A.",
            "Expediente" => "EXP-015",
            "Fecha_Solicitud" => "2023-05-02",
            "Última_Actuación" => "2024-10-21",
            "Tipo" => "Denominativa",
            "icon" => '<i class="fa-duotone fa-light fa-circle-d"></i>',
            "logo" => null,
            "company_state" => (object)['id' => 1, 'title' => 'Activa', 'description' => 'La empresa está operando normalmente.'],
            "entity_state" => (object)['id' => 3, 'title' => 'Registrada', 'description' => 'La empresa fue suspendida temporalmente.'],
            "descripcion_comercial" => "Distribuidora y procesadora de productos del mar premium.",
            "descripcion_abogado" => "Registro vigente. Se recomienda incluir nuevos logotipos en futuras solicitudes de marca figurativa."
        ],
    ];
}

function getOppositions(){

    return [
        (object) [
            'id' => 1,
            'caso' => 'OP-2025-001',
            "Marca_Referencia" => (object)[
                "id" => 2,
                "nombre_corto" => "TechSmart",
                "Marca" => "Tech Smart Innovators",
                "Expediente" => "EXP-002",
                "Clase" => [9, 42],
            ],
            "Marca_Opositora" => (object)[
                "id" => 6,
                "nombre_corto" => "SolarTech",
                "Marca" => "Solar Tech Renewables",
                "Expediente" => "EXP-006",
                "Clase" => [9, 11, 37],
            ],
            'pais' => 'CO',
            'clase' => [9],
            'tipo_causal' => 'Confusión',
            'estado' => 'En estudio',
            'riesgo' => 'Alto',
            'nivel' => 85,
            'fecha_limite' => '2025-11-15',
            'abogado_asignado' => 'Laura Gómez',
            'observation'   => 'lorem ipsum',
            'documents' => [
                (object) [
                    'id'    => 1,
                    'tipo'  => 'NN',
                    'fecha' => '2025-10-25',
                    'estado'=> 'Activo',
                    'version'   => '1.0.0'
                ],
                (object) [
                    'id'    => 2,
                    'tipo'  => 'NN',
                    'fecha' => '2025-10-28',
                    'estado'=> 'Activo',
                    'version'   => '1.0.0'
                ]
            ],
            'events'   => []
        ],
        (object) [
            'id' => 2,
            'caso' => 'OP-2025-002',
            "Marca_Referencia" => (object)[
                "id" => 3,
                "nombre_corto" => "EcoVida",
                "Marca" => "Eco Vida Natural Balance",
                "Expediente" => "EXP-003",
                "Clase" => [3, 5, 35],
            ],
            "Marca_Opositora" => (object)[
                "id" => 11,
                "nombre_corto" => "BioLife",
                "Marca" => "Bio Life Natural Health",
                "Expediente" => "EXP-011",
                "Clase" => [5, 35, 44],
            ],
            'pais' => 'CO',
            'clase' => [5, 35],
            'tipo_causal' => 'Absoluta',
            'estado' => 'Activa',
            'riesgo' => 'Medio',
            'nivel' => 55,
            'fecha_limite' => '2025-11-10',
            'abogado_asignado' => 'Carlos Pérez',
            'observation'   => 'lorem ipsum',
            'documents' => [
                (object) [
                    'id'    => 3,
                    'tipo'  => 'NN',
                    'fecha' => '2025-10-25',
                    'estado'=> 'Activo',
                    'version'   => '1.0.0'
                ]
            ],
            'events' => []
        ],
        (object) [
            'id'    => 3,
            'caso' => 'OP-2025-003',
            "Marca_Referencia" => (object)[
                "id" => 13,
                "nombre_corto" => "AndesCacao",
                "Marca" => "Andes Cacao Fine Selection",
                "Expediente" => "EXP-013",
                "Clase" => [30, 31, 33],
            ],
            "Marca_Opositora" => (object)[
                "id" => 1,
                "nombre_corto" => "CafeHuila",
                "Marca" => "Café Huila Premium Selection",
                "Expediente" => "EXP-001",
                "Clase" => [30, 43],
            ],
            'pais' => 'EC',
            'clase' => [30],
            'tipo_causal' => 'Competencia desleal',
            'estado' => 'Cerrada (favorable)',
            'riesgo' => 'Bajo',
            'nivel' => 32,
            'fecha_limite' => '2025-09-18',
            'abogado_asignado' => 'Sofía Ruiz',
            'observation'   => 'lorem ipsum',
            'documents' => [
                (object) [
                    'id'    => 4,
                    'tipo'  => 'NN',
                    'fecha' => '2025-9-25',
                    'estado'=> 'Activo',
                    'version'   => '1.0.0'
                ],
                (object) [
                    'id'    => 5,
                    'tipo'  => 'NN',
                    'fecha' => '2025-10-12',
                    'estado'=> 'Activo',
                    'version'   => '2.0.0'
                ],
                (object) [
                    'id'    => 6,
                    'tipo'  => 'NN',
                    'fecha' => '2025-10-30',
                    'estado'=> 'Activo',
                    'version'   => '1.0.0'
                ]
            ],
            'events'   => [
                (object)[
                    'tipo' => 'Creación del expediente',
                    'descripcion' => 'Se creó el expediente de oposición en el sistema SIC.',
                    'color' => 'azul',
                    'tiempo' => 'Hace 15 días',
                    'documento' => 'uploads/documentos/creacion_expediente.pdf'
                ],
                (object)[
                    'tipo' => 'Cambio de estado',
                    'descripcion' => 'El estado del expediente cambió a "En estudio".',
                    'color' => 'naranja',
                    'tiempo' => 'Hace 10 días',
                    'documento' => 'uploads/documentos/cambio_estado.pdf'
                ],
                (object)[
                    'tipo' => 'Envío de oposición',
                    'descripcion' => 'Se envió la documentación de oposición a la entidad correspondiente.',
                    'color' => 'verde',
                    'tiempo' => 'Hace 7 días',
                    'documento' => 'uploads/documentos/envio_oposicion.pdf'
                ],
                (object)[
                    'tipo' => 'Recepción de respuesta',
                    'descripcion' => 'Se recibió la respuesta del solicitante de marca.',
                    'color' => 'azul',
                    'tiempo' => 'Hace 3 días',
                    'documento' => 'uploads/documentos/recepcion_respuesta.pdf'
                ],
                (object)[
                    'tipo' => 'Decisión final',
                    'descripcion' => 'La SIC emitió la decisión final: Oposición favorable.',
                    'color' => 'verde',
                    'tiempo' => 'Hoy',
                    'documento' => 'uploads/documentos/decision_final.pdf'
                ],
            ]
        ]
    ];
}

function getBrandsDefenses(){

    return [
        (object) [
            'id' => 1,
            'caso' => 1,
            'tipo'  => 'Requerimiento',    
            "Marca_Referencia" => 2,
            'pais' => 'Colombia',
            'clase' => [9],
            'tipo_causal' => 'Confusión',
            'estado' => 'En borrador',
            'riesgo' => 'Alto',
            'nivel' => 85,
            'fecha_limite' => '2025-11-15',
            'abogado_asignado' => 'Laura Gómez',
            'observation'   => 'lorem ipsum',
            'documents' => [
                (object) [
                    'id'    => 1,
                    'tipo'  => 'NN',
                    'fecha' => '2025-10-25',
                    'estado'=> 'Activo',
                    'version'   => '1.0.0'
                ],
                (object) [
                    'id'    => 2,
                    'tipo'  => 'NN',
                    'fecha' => '2025-10-28',
                    'estado'=> 'Activo',
                    'version'   => '1.0.0'
                ]
            ],
            'events'   => [],
            'adjunto'   => [],
            'templates' => [1, 4]
        ],
        (object) [
            'id' => 2,
            'caso' => 2,
            'tipo'  => 'Recurso',
            "Marca_Referencia" => 3,
            'pais' => 'Colombia',
            'clase' => [5, 35],
            'tipo_causal' => 'Absoluta',
            'estado' => 'En decisión',
            'riesgo' => 'Medio',
            'nivel' => 55,
            'fecha_limite' => '2025-11-10',
            'abogado_asignado' => 'Carlos Pérez',
            'observation'   => 'lorem ipsum',
            'documents' => [
                (object) [
                    'id'    => 3,
                    'tipo'  => 'NN',
                    'fecha' => '2025-10-25',
                    'estado'=> 'Activo',
                    'version'   => '1.0.0'
                ]
            ],
            'adjunto' => [],
            'events' => [],
            'templates' => [1, 2, 4]
        ],
        (object) [
            'id'    => 3,
            'caso' => 3,
            'tipo'  => 'Litigio',
            "Marca_Referencia" => 13,
            'pais' => 'Ecuador',
            'clase' => [30],
            'tipo_causal' => 'Competencia desleal',
            'estado' => 'Cerrado',
            'riesgo' => 'Bajo',
            'nivel' => 32,
            'fecha_limite' => '2025-09-18',
            'abogado_asignado' => 'Sofía Ruiz',
            'observation'   => 'lorem ipsum',
            'adjuntos' => [
                (object) [
                    'id'    => 1,
                    'reference'  => '001',
                    'entidad' => 'NN',
                    'recepcion'=> '11-11-2025',
                    'notification'   => [
                        (object)['name' => 'WhatsApp', 'envio' => "57 3001234567"],
                        (object)['name' => 'Gmail', 'envio' => "usuario@sentinelmark.com"]
                    ],
                    'extracto'  => "NN",
                    'adjunto' => "https://www.turnerlibros.com/wp-content/uploads/2021/02/ejemplo.pdf"
                ]
            ],
            'documents' => [
                (object) [
                    'id'    => 4,
                    'tipo'  => 'NN',
                    'fecha' => '2025-9-25',
                    'estado'=> 'borrador',
                    'version'   => '1.0.0',
                    'responsable'   => 'Sofia Ruiz'
                ],
                (object) [
                    'id'    => 5,
                    'tipo'  => 'NN',
                    'fecha' => '2025-10-12',
                    'estado'=> 'revisión',
                    'version'   => '2.0.0',
                    'responsable'   => 'Sofia Ruiz'
                ],
                (object) [
                    'id'    => 6,
                    'tipo'  => 'NN',
                    'fecha' => '2025-10-30',
                    'estado'=> 'Final',
                    'version'   => '3.0.0',
                    'responsable'   => 'Sofia Ruiz'
                ]
            ],
            'events'   => [
                (object)[
                    'tipo' => 'Creación del expediente',
                    'descripcion' => 'Se creó el expediente de oposición en el sistema SIC.',
                    'color' => 'azul',
                    'tiempo' => 'Hace 15 días',
                    'documento' => 'uploads/documentos/creacion_expediente.pdf'
                ],
                (object)[
                    'tipo' => 'Cambio de estado',
                    'descripcion' => 'El estado del expediente cambió a "En estudio".',
                    'color' => 'naranja',
                    'tiempo' => 'Hace 10 días',
                    'documento' => 'uploads/documentos/cambio_estado.pdf'
                ],
                (object)[
                    'tipo' => 'Envío de oposición',
                    'descripcion' => 'Se envió la documentación de oposición a la entidad correspondiente.',
                    'color' => 'verde',
                    'tiempo' => 'Hace 7 días',
                    'documento' => 'uploads/documentos/envio_oposicion.pdf'
                ],
                (object)[
                    'tipo' => 'Recepción de respuesta',
                    'descripcion' => 'Se recibió la respuesta del solicitante de marca.',
                    'color' => 'azul',
                    'tiempo' => 'Hace 3 días',
                    'documento' => 'uploads/documentos/recepcion_respuesta.pdf'
                ],
                (object)[
                    'tipo' => 'Decisión final',
                    'descripcion' => 'La SIC emitió la decisión final: Oposición favorable.',
                    'color' => 'verde',
                    'tiempo' => 'Hoy',
                    'documento' => 'uploads/documentos/decision_final.pdf'
                ],
            ],
            'templates' => [1, 2, 3, 4]
        ]
    ];
}

function getClasesNiza(){
    return [
        (object)[ "id" => 1, "title" => "Productos químicos", "description" => "Productos químicos para la industria, la ciencia y la fotografía; productos químicos para la agricultura, la horticultura y la silvicultura; resinas artificiales en bruto, materias plásticas en bruto; abonos; composiciones extinguidoras; preparaciones para templar y soldar metales; productos para conservar alimentos; adhesivos (pegamentos) para la industria." ],
        (object)[ "id" => 2, "title" => "Pinturas y barnices", "description" => "Pinturas, barnices, lacas; productos contra el óxido y el deterioro de la madera; colorantes; tintes; resinas naturales en bruto; metales en hojas y en polvo para pintores, decoradores, impresores y artistas." ],
        (object)[ "id" => 3, "title" => "Productos cosméticos y de limpieza", "description" => "Preparaciones para blanquear y otras sustancias para la colada; preparaciones para limpiar, pulir, desengrasar y raspar; jabones; perfumería, aceites esenciales, cosméticos, lociones capilares; dentífricos." ],
        (object)[ "id" => 4, "title" => "Aceites y combustibles", "description" => "Aceites y grasas para uso industrial; lubricantes; productos para absorber, regar y solidificar el polvo; combustibles (incluidos los carburantes) e iluminantes; velas y mechas para iluminación." ],
        (object)[ "id" => 5, "title" => "Productos farmacéuticos", "description" => "Productos farmacéuticos y veterinarios; productos higiénicos y sanitarios para uso médico; alimentos y sustancias dietéticas para uso médico o veterinario; alimentos para bebés; suplementos alimenticios para personas o animales; emplastos, material para curas; material para empastes e improntas dentales; desinfectantes; productos para eliminar animales dañinos; fungicidas, herbicidas." ],
        (object)[ "id" => 6, "title" => "Metales comunes", "description" => "Metales comunes y sus aleaciones; materiales de construcción metálicos; construcciones transportables metálicas; materiales metálicos para vías férreas; cables y alambres metálicos no eléctricos; cerrajería y artículos de ferretería metálicos; tubos metálicos; cofres fuertes; productos metálicos no comprendidos en otras clases; minerales." ],
        (object)[ "id" => 7, "title" => "Máquinas y motores", "description" => "Máquinas y máquinas herramientas; motores (excepto los motores para vehículos terrestres); acoplamientos y elementos de transmisión (excepto los para vehículos terrestres); instrumentos agrícolas que no sean herramientas de mano accionadas manualmente; incubadoras de huevos; distribuidores automáticos." ],
        (object)[ "id" => 8, "title" => "Herramientas manuales", "description" => "Herramientas e instrumentos de mano accionados manualmente; artículos de cuchillería, tenedores y cucharas; armas blancas; maquinillas de afeitar." ],
        (object)[ "id" => 9, "title" => "Aparatos electrónicos y científicos", "description" => "Aparatos e instrumentos científicos, náuticos, geodésicos, fotográficos, cinematográficos, ópticos, de pesaje, de medida, de señalización, de control (inspección), de socorro (salvamento) y de enseñanza; aparatos e instrumentos para la conducción, distribución, transformación, acumulación, regulación o control de la electricidad; aparatos para el registro, transmisión, reproducción de sonido o imágenes; soportes de registro magnéticos, discos acústicos; máquinas de registrar, calcular y procesar datos; equipos de extinción de incendios." ],
        (object)[ "id" => 10, "title" => "Aparatos médicos", "description" => "Aparatos e instrumentos quirúrgicos, médicos, odontológicos y veterinarios, así como sus partes y accesorios; artículos ortopédicos; material de sutura; aparatos de masaje; prótesis, implantes e instrumentos de diagnóstico." ],
        (object)[ "id" => 11, "title" => "Aparatos de iluminación y calefacción", "description" => "Aparatos de alumbrado, calefacción, producción de vapor, cocción, refrigeración, secado, ventilación, distribución de agua e instalaciones sanitarias." ],
        (object)[ "id" => 12, "title" => "Vehículos", "description" => "Vehículos; aparatos de locomoción terrestre, aérea o acuática." ],
        (object)[ "id" => 13, "title" => "Armas de fuego", "description" => "Armas de fuego; municiones y proyectiles; explosivos; fuegos artificiales." ],
        (object)[ "id" => 14, "title" => "Joyería y relojería", "description" => "Metales preciosos y sus aleaciones, así como productos de estas materias o chapados no comprendidos en otras clases; joyería, bisutería, piedras preciosas; relojería e instrumentos cronométricos." ],
        (object)[ "id" => 15, "title" => "Instrumentos musicales", "description" => "Instrumentos de música." ],
        (object)[ "id" => 16, "title" => "Papelería y material de oficina", "description" => "Papel, cartón y productos de estas materias no comprendidos en otras clases; productos de imprenta; artículos para encuadernar; fotografías; artículos de papelería; adhesivos (pegamentos) para la papelería o uso doméstico; material para artistas; pinceles; máquinas de escribir y artículos de oficina (excepto muebles); material de instrucción o de enseñanza (excepto aparatos); materias plásticas para embalar; caracteres de imprenta; clichés de imprenta." ],
        (object)[ "id" => 17, "title" => "Caucho y plásticos", "description" => "Caucho, gutapercha, goma, amianto, mica y productos de estas materias no comprendidos en otras clases; productos en materias plásticas semielaboradas; materiales para calafatear, estopar y aislar; tubos flexibles no metálicos." ],
        (object)[ "id" => 18, "title" => "Artículos de cuero", "description" => "Cuero e imitaciones de cuero, productos de estas materias no comprendidos en otras clases; pieles de animales; baúles y maletas; paraguas, sombrillas y bastones; fustas y artículos de guarnicionería." ],
        (object)[ "id" => 19, "title" => "Materiales de construcción no metálicos", "description" => "Materiales de construcción no metálicos; tuberías rígidas no metálicas para la construcción; asfalto, pez y betún; construcciones transportables no metálicas; monumentos no metálicos." ],
        (object)[ "id" => 20, "title" => "Muebles", "description" => "Muebles, espejos, marcos; productos de madera, corcho, caña, junco, mimbre, cuerno, hueso, marfil, concha, ámbar, nácar, espuma de mar y sucedáneos de todas estas materias o de plásticos no comprendidos en otras clases." ],
        (object)[ "id" => 21, "title" => "Utensilios de cocina", "description" => "Utensilios y recipientes para el menaje o la cocina; peines y esponjas; cepillos (excepto pinceles); material para fabricar cepillos; material de limpieza; lana de acero; vidrio en bruto o semielaborado (excepto el vidrio de construcción); artículos de cristalería, porcelana y loza no comprendidos en otras clases." ],
        (object)[ "id" => 22, "title" => "Cuerdas y fibras textiles", "description" => "Cuerdas, cordeles, redes, tiendas de campaña, lonas, velas (para embarcaciones), sacos y bolsas (no comprendidos en otras clases); materiales de acolchado y relleno (excepto caucho o plásticos); materias textiles fibrosas en bruto." ],
        (object)[ "id" => 23, "title" => "Hilos para uso textil", "description" => "Hilos para uso textil." ],
        (object)[ "id" => 24, "title" => "Tejidos", "description" => "Tejidos y productos textiles no comprendidos en otras clases; ropa de cama y de mesa." ],
        (object)[ "id" => 25, "title" => "Ropa, calzado y sombrerería", "description" => "Prendas de vestir, calzado y artículos de sombrerería." ],
        (object)[ "id" => 26, "title" => "Encajes y bordados", "description" => "Encajes, bordados, cintas y cordones; botones, ganchos y ojetes, alfileres y agujas; flores artificiales." ],
        (object)[ "id" => 27, "title" => "Alfombras y tapices", "description" => "Alfombras, felpudos, esteras, linóleos y otros revestimientos de suelos; tapices murales no de materias textiles." ],
        (object)[ "id" => 28, "title" => "Juegos y juguetes", "description" => "Juegos, juguetes; artículos de gimnasia y deporte no comprendidos en otras clases; decoraciones para árboles de Navidad." ],
        (object)[ "id" => 29, "title" => "Productos alimenticios", "description" => "Carne, pescado, aves y caza; extractos de carne; frutas y legumbres en conserva, congeladas, secas y cocidas; jaleas, mermeladas, compotas; huevos; leche y productos lácteos; aceites y grasas comestibles." ],
        (object)[ "id" => 30, "title" => "Productos de panadería", "description" => "Café, té, cacao y sucedáneos del café; arroz; tapioca y sagú; harinas y preparaciones hechas de cereales; pan, pastelería y confitería; helados comestibles; azúcar, miel, jarabe de melaza; levadura, polvos de hornear; sal, mostaza; vinagre, salsas (condimentos); especias; hielo." ],
        (object)[ "id" => 31, "title" => "Productos agrícolas y hortícolas", "description" => "Productos agrícolas, hortícolas, forestales y granos no comprendidos en otras clases; animales vivos; frutas y legumbres frescas; semillas, plantas y flores naturales; alimentos para animales; malta." ],
        (object)[ "id" => 32, "title" => "Bebidas sin alcohol", "description" => "Cervezas; aguas minerales y gaseosas; bebidas no alcohólicas; zumos de frutas; siropes y otras preparaciones para elaborar bebidas." ],
        (object)[ "id" => 33, "title" => "Bebidas alcohólicas", "description" => "Bebidas alcohólicas (excepto cervezas)." ],
        (object)[ "id" => 34, "title" => "Tabaco", "description" => "Tabaco; artículos para fumadores; cerillas." ],
        (object)[ "id" => 35, "title" => "Publicidad y gestión", "description" => "Publicidad; gestión de negocios comerciales; administración comercial; trabajos de oficina." ],
        (object)[ "id" => 36, "title" => "Servicios financieros", "description" => "Seguros; operaciones financieras; operaciones monetarias; negocios inmobiliarios." ],
        (object)[ "id" => 37, "title" => "Construcción y reparación", "description" => "Construcción; reparación; servicios de instalación." ],
        (object)[ "id" => 38, "title" => "Telecomunicaciones", "description" => "Telecomunicaciones." ],
        (object)[ "id" => 39, "title" => "Transporte y almacenamiento", "description" => "Transporte; embalaje y almacenamiento de mercancías; organización de viajes." ],
        (object)[ "id" => 40, "title" => "Tratamiento de materiales", "description" => "Tratamiento de materiales." ],
        (object)[ "id" => 41, "title" => "Educación y formación", "description" => "Educación; formación; servicios de entretenimiento; actividades deportivas y culturales." ],
        (object)[ "id" => 42, "title" => "Servicios científicos y tecnológicos", "description" => "Servicios científicos y tecnológicos, así como servicios de investigación y diseño en estos ámbitos; servicios de análisis industrial y de investigación industrial; diseño y desarrollo de equipos informáticos y software." ],
        (object)[ "id" => 43, "title" => "Servicios de restauración y hospedaje", "description" => "Servicios de restauración (alimentación); hospedaje temporal." ],
        (object)[ "id" => 44, "title" => "Servicios médicos y agrícolas", "description" => "Servicios médicos y veterinarios; servicios de higiene y belleza; servicios agrícolas, hortícolas y silvícolas."],
        (object)[ "id" => 45, "title" => "Servicios personales y legales", "description" => "Servicios jurídicos; seguridad para protección de bienes y personas; servicios personales y sociales prestados por terceros."]
    ];
}

function getCategoriesDoculaw(){
    return [
        (object) [
            'id'            => 1,
            'name'          => 'Oposiciones',
            'examples'      => 'Absoluta, Confusión, Competencia desleal',
            'notes'         => 'Contextualizadas por país/jurisdicción',
            'icon'          => 'ri-git-pull-request-line',
            'templates'     => [
                (object) [
                    'id'        => 1,
                    'title'     => 'Oposición por causal absoluta',
                    'use'       => 'Vicios de registrabilidad, descriptividad, genericidad',
                    'state'     => 'Publicado',
                    'comment'   => 'NN',
                    'enlace'    => 'text.docx',
                    'version'   => '2.2.1',
                    'pais'      => 'CO',
                    'text'      => '
                        ----------------------------------------------------------
                        INFORME SOBRE EL EXPEDIENTE N.º {{expediente.numero}}
                        Marca: {{marca.nombre}}
                        ----------------------------------------------------------

                        {% if expediente.estado == "publicada" %}
                        Estado del Trámite: Publicada para Oposición
                        La marca {{marca.nombre}} se encuentra actualmente publicada para efectos de oposición conforme a los procedimientos administrativos vigentes.
                        {% endif %}

                        {% if expediente.estado == "en_tramite" %}
                        Estado del Trámite: En Trámite
                        La solicitud de registro para la marca {{marca.nombre}} se encuentra en etapa de examen de forma y/o fondo.
                        {% endif %}

                        {% if expediente.estado == "negada" %}
                        Estado del Trámite: Negada
                        La solicitud ha sido negada por la autoridad competente con fundamento en las causales: {{causal}}.
                        {% endif %}

                        {% if expediente.estado == "registrada" %}
                        Estado del Trámite: Registrada
                        La marca {{marca.nombre}} ha sido registrada exitosamente ante la Superintendencia de Industria y Comercio.
                        {% endif %}

                        ----------------------------------------------------------
                        Clases Asociadas
                        ----------------------------------------------------------

                        {% if expediente.clases|length > 0 %}
                        La marca solicitada se encuentra asociada a las siguientes clases:

                        {% for clase in expediente.clases %}
                        - Clase {{clase.numero}}: {{clase.descripcion}}
                        {% endfor %}

                        {% else %}
                        No se registran clases asociadas al expediente.
                        {% endif %}

                        ----------------------------------------------------------
                        Resumen
                        ----------------------------------------------------------

                        - Número del expediente: {{expediente.numero}}
                        - Nombre de la marca: {{marca.nombre}}
                        - Estado: {{expediente.estado}}
                        - País: {{pais}}
                        - Jurisdicción: {{jurisdiccion}}
                        - Idioma: {{idioma}}
                        - Causal(es): {{causal}}
                        - Etiquetas: {{etiquetas}}

                        {% if expediente.observaciones %}
                        Observaciones adicionales:
                        {{expediente.observaciones}}
                        {% endif %}
                    ',
                    'prev'      => '
                        ----------------------------------------------------------
                        INFORME SOBRE EL EXPEDIENTE N.º SD2024-12345
                        Marca: CAFÉ DORADO
                        ----------------------------------------------------------

                        Estado del Trámite: Publicada para Oposición
                        La marca CAFÉ DORADO se encuentra actualmente publicada para efectos de oposición.

                        Clases Asociadas:
                        - Clase 5: Productos farmacéuticos
                        - Clase 30: Café, té, cacao
                    ',
                    'history' => [
                        (object) [
                            'id'        => 1,
                            'value_old' => '----------------------------------------------------------
                                INFORME SOBRE EL EXPEDIENTE N.º {{expediente.numero}}
                                Marca: {{marca.nombre}}
                                ----------------------------------------------------------

                                {% if expediente.estado == "publicada" %}
                                Estado del Trámite: Publicada para Oposición
                                La marca {{marca.nombre}} se encuentra actualmente publicada para efectos de oposición conforme a los procedimientos administrativos vigentes.
                                {% endif %}

                                {% if expediente.estado == "en_tramite" %}
                                Estado del Trámite: En Trámite
                                La solicitud de registro para la marca {{marca.nombre}} se encuentra en etapa de examen de forma y/o fondo.
                                {% endif %}

                                {% if expediente.estado == "negada" %}
                                Estado del Trámite: Negada
                                La solicitud ha sido negada por la autoridad competente con fundamento en las causales: {{causal}}.
                                {% endif %}

                                {% if expediente.estado == "registrada" %}
                                Estado del Trámite: Registrada
                                La marca {{marca.nombre}} ha sido registrada exitosamente ante la Superintendencia de Industria y Comercio.
                                {% endif %}

                                ----------------------------------------------------------
                                Clases Asociadas
                                ----------------------------------------------------------

                                {% if expediente.clases|length > 0 %}
                                La marca solicitada se encuentra asociada a las siguientes clases:

                                {% for clase in expediente.clases %}
                                - Clase {{clase.numero}}: {{clase.descripcion}}
                                {% endfor %}

                                {% else %}
                                No se registran clases asociadas al expediente.
                                {% endif %}

                                ----------------------------------------------------------
                                Resumen
                                ----------------------------------------------------------

                                - Número del expediente: {{expediente.numero}}
                                - Nombre de la marca: {{marca.nombre}}
                                - Estado: {{expediente.estado}}
                                - País: {{pais}}
                                - Jurisdicción: {{jurisdiccion}}
                                - Idioma: {{idioma}}
                                - Causal(es): {{causal}}
                                - Etiquetas: {{etiquetas}}

                                {% if expediente.observaciones %}
                                Observaciones adicionales:
                                {{expediente.observaciones}}
                                {% endif %}
                            ',
                            'value_new' => '----------------------------------------------------------
                                INFORME SOBRE EL EXPEDIENTE N.º {{expediente.numero}}
                                Marca: {{marca.nombre}}
                                Abogado(a): {{abogado.nombre}}
                                ----------------------------------------------------------

                                {% if expediente.estado == "publicada" %}
                                Estado del Trámite: Publicada para Oposición
                                La marca {{marca.nombre}} se encuentra actualmente publicada para efectos de oposición conforme a los procedimientos administrativos vigentes.
                                {% endif %}

                                {% if expediente.estado == "en_tramite" %}
                                Estado del Trámite: En Trámite
                                La solicitud de registro para la marca {{marca.nombre}} se encuentra en etapa de examen de forma y/o fondo.
                                {% endif %}

                                {% if expediente.estado == "negada" %}
                                Estado del Trámite: Negada
                                La solicitud ha sido negada por la autoridad competente con fundamento en las causales: {{causal}}.
                                {% endif %}

                                {% if expediente.estado == "registrada" %}
                                Estado del Trámite: Registrada
                                La marca {{marca.nombre}} ha sido registrada exitosamente ante la Superintendencia de Industria y Comercio.
                                {% endif %}

                                ----------------------------------------------------------
                                Clases Asociadas:
                                ----------------------------------------------------------

                                {% if expediente.clases|length > 0 %}
                                La marca solicitada se encuentra asociada a las siguientes clases:

                                {% for clase in expediente.clases %}
                                - Clase {{clase.numero}}: {{clase.descripcion}}
                                {% endfor %}

                                {% else %}
                                No se registran clases asociadas al expediente.
                                {% endif %}

                                ----------------------------------------------------------
                                Resumen
                                ----------------------------------------------------------

                                - Número del expediente: {{expediente.numero}}
                                - Nombre de la marca: {{marca.nombre}}
                                - Estado: {{expediente.estado}}
                                - País: {{pais}}
                                - Jurisdicción: {{jurisdiccion}}
                                - Idioma: {{idioma}}
                                - Causal(es): {{causal}}
                                - Etiquetas: {{etiquetas}}

                                {% if expediente.observaciones %}
                                Observaciones adicionales:
                                {{expediente.observaciones}}
                                {% endif %}
                            ',
                            'comment' => '',
                            'field' => 'template',
                            'date'  => '2025-11-14 16:23:04',
                            'version'   => 'v1',
                            'diff'  => 'Se cambia titulo de marca, se agrega abogado'
                        ]
                    ]
                ],
                (object) [
                    'id'        => 2,
                    'title'     => 'Oposición por confusión',
                    'use'       => 'Comparativo denominativo/figurativo, canales de comercialización',
                    'state'     => 'Publicado',
                    'comment'   => 'NN',
                    'enlace'    => 'text.docx',
                    'pais'      => 'CO',
                    'version'   => '3.0.0',
                    'text'      => '',
                    'prev'      => '
                        ----------------------------------------------------------
                        INFORME SOBRE EL EXPEDIENTE N.º SD2024-12345
                        Marca: CAFÉ DORADO
                        ----------------------------------------------------------

                        Estado del Trámite: Publicada para Oposición
                        La marca CAFÉ DORADO se encuentra actualmente publicada para efectos de oposición.

                        Clases Asociadas:
                        - Clase 5: Productos farmacéuticos
                        - Clase 30: Café, té, cacao
                    ',
                    'history' => []
                ],
                (object) [
                    'id'        => 3,
                    'title'     => 'Competencia desleal',
                    'use'       => 'Aprovechamiento de reputación ajena, desvío de clientela',
                    'state'     => 'Publicado',
                    'comment'   => 'NN',
                    'enlace'    => 'text.docx',
                    'pais'      => 'CO',
                    'version'   => '1.0.0',
                    'text'      => '',
                    'prev'      => '
                        ----------------------------------------------------------
                        INFORME SOBRE EL EXPEDIENTE N.º SD2024-12345
                        Marca: CAFÉ DORADO
                        ----------------------------------------------------------

                        Estado del Trámite: Publicada para Oposición
                        La marca CAFÉ DORADO se encuentra actualmente publicada para efectos de oposición.

                        Clases Asociadas:
                        - Clase 5: Productos farmacéuticos
                        - Clase 30: Café, té, cacao
                    ',
                    'history' => []
                ],
                (object) [
                    'id'        => 4,
                    'title'     => 'Recurso de reposición',
                    'use'       => 'Contra decisiones desfavorables',
                    'state'     => 'Publicado',
                    'comment'   => 'NN',
                    'enlace'    => 'text.docx',
                    'pais'      => 'CO',
                    'version'   => '1.5.0',
                    'text'      => '',
                    'prev'      => '
                        ----------------------------------------------------------
                        INFORME SOBRE EL EXPEDIENTE N.º SD2024-12345
                        Marca: CAFÉ DORADO
                        ----------------------------------------------------------

                        Estado del Trámite: Publicada para Oposición
                        La marca CAFÉ DORADO se encuentra actualmente publicada para efectos de oposición.

                        Clases Asociadas:
                        - Clase 5: Productos farmacéuticos
                        - Clase 30: Café, té, cacao
                    ',
                    'history' => []
                ]
            ],
            'diccionary'    => [
                '{{marca.name}}', '{{expediente.numero}}'
            ],
        ],
        (object) [
            'id'        => 2,
            'name'      => 'Requerimientos',
            'examples'  => 'Forma, Fondo',
            'notes'     => 'Asociadas a tipos de auto/oficio',
            'icon'      => 'ri-list-check-2',
            'templates' => [
                (object) [
                    'id'        => 5,
                    'title'     => 'Oposición por causal absoluta',
                    'use'       => 'Vicios de registrabilidad, descriptividad, genericidad',
                    'state'     => 'Publicado',
                    'comment'   => 'NN',
                    'enlace'    => 'text.docx',
                    'version'   => '2.2.0',
                    'pais'      => 'CO',
                    'text'      => '
                        ----------------------------------------------------------
                        INFORME SOBRE EL EXPEDIENTE N.º {{expediente.numero}}
                        Marca: {{marca.nombre}}
                        ----------------------------------------------------------

                        {% if expediente.estado == "publicada" %}
                        Estado del Trámite: Publicada para Oposición
                        La marca {{marca.nombre}} se encuentra actualmente publicada para efectos de oposición conforme a los procedimientos administrativos vigentes.
                        {% endif %}

                        {% if expediente.estado == "en_tramite" %}
                        Estado del Trámite: En Trámite
                        La solicitud de registro para la marca {{marca.nombre}} se encuentra en etapa de examen de forma y/o fondo.
                        {% endif %}

                        {% if expediente.estado == "negada" %}
                        Estado del Trámite: Negada
                        La solicitud ha sido negada por la autoridad competente con fundamento en las causales: {{causal}}.
                        {% endif %}

                        {% if expediente.estado == "registrada" %}
                        Estado del Trámite: Registrada
                        La marca {{marca.nombre}} ha sido registrada exitosamente ante la Superintendencia de Industria y Comercio.
                        {% endif %}

                        ----------------------------------------------------------
                        Clases Asociadas
                        ----------------------------------------------------------

                        {% if expediente.clases|length > 0 %}
                        La marca solicitada se encuentra asociada a las siguientes clases:

                        {% for clase in expediente.clases %}
                        - Clase {{clase.numero}}: {{clase.descripcion}}
                        {% endfor %}

                        {% else %}
                        No se registran clases asociadas al expediente.
                        {% endif %}

                        ----------------------------------------------------------
                        Resumen
                        ----------------------------------------------------------

                        - Número del expediente: {{expediente.numero}}
                        - Nombre de la marca: {{marca.nombre}}
                        - Estado: {{expediente.estado}}
                        - País: {{pais}}
                        - Jurisdicción: {{jurisdiccion}}
                        - Idioma: {{idioma}}
                        - Causal(es): {{causal}}
                        - Etiquetas: {{etiquetas}}

                        {% if expediente.observaciones %}
                        Observaciones adicionales:
                        {{expediente.observaciones}}
                        {% endif %}
                    ',
                    'prev'      => '
                        ----------------------------------------------------------
                        INFORME SOBRE EL EXPEDIENTE N.º SD2024-12345
                        Marca: CAFÉ DORADO
                        ----------------------------------------------------------

                        Estado del Trámite: Publicada para Oposición
                        La marca CAFÉ DORADO se encuentra actualmente publicada para efectos de oposición.

                        Clases Asociadas:
                        - Clase 5: Productos farmacéuticos
                        - Clase 30: Café, té, cacao
                    ',
                    'history' => []
                ],
            ],
            'diccionary' => []
        ],
        (object) [
            'id'        => 3,
            'name'      => 'Recursos',
            'examples'  => 'Reposición, Apelación',
            'notes'     => 'Flujos conectados a Defensa',
            'icon'      => 'ri-bubble-chart-line',
            'templates' => [],
            'diccionary' => []
        ],
        (object) [
            'id'        => 4,
            'name'      => 'Litigios',
            'examples'  => 'Nulidad, Infracción, Cancelación',
            'notes'     => 'Modelos por hito procesal',
            'icon'      => 'ri-git-close-pull-request-line',
            'templates' => [],
            'diccionary' => []
        ],
        (object) [
            'id'        => 5,
            'name'      => 'Varias',
            'examples'  => 'Informes, memoriales, poderes',
            'notes'     => 'Utilitarias',
            'icon'      => 'ri-pencil-ruler-2-line',
            'templates' => [],
            'diccionary' => []
        ]
    ];
}

function getDocuLaws(){
    return [
        (object) [
            'id'            => 1,
            'template_id'   => 1,
            'brand' => 3,
        ]
    ];
}

function recordatorios(){
    return [
        (object) [
            'id'    => 1,
            'day'   => 15,
            'text'  => 'Quincenal'
        ],
        (object) [
            'id'    => 2,
            'day'   => 7,
            'text'  => 'Semanal'
        ],
        (object) [
            'id'    => 3,
            'day'   => 3,
            'text'  => '3 días antes'
        ],
        (object) [
            'id'    => 4,
            'day'   => 1,
            'text'  => 'Un dia antes'
        ]
    ];
}

function channels(){
    return [
        (object) [
            'id'    => 1,
            'name'  => 'WhatsApp',
            'icon'  => 'ri-whatsapp-line',
            'color' => 'teal-lighten-5',
            'hour'  => '07:30 a.m'
        ],
        (object) [
            'id'    => 2,
            'name'  => 'Correo Electronico',
            'icon'  => 'ri-google-fill',
            'color' => 'orange-lighten-5',
            'hour'  => '07:30 a.m'
        ]
    ];
}

function alerts(){
    return [
        (object) [
            'id'                => 1,
            'title'             => 'Evento #1',
            'type'              => 1,
            'brand'             => 5,
            'country'           => 'Colombia',
            'class'             => [5, 29, 32],
            'reminders'         => [1, 3, 4],
            'responsability'    => 'Laura Gómez',
            'channels'          => [1, 2],
            'description'       => 'Lorem Ipsum',
            'attachments'       => [],
            'limit'             => date('Y-m-d 00:00:00'),
            'calendar'          => 'Business'
        ],
        (object) [
            'id'                => 2,
            'title'             => 'Evento #2',
            'type'              => 1,
            'brand'             => 5,
            'country'           => 'Colombia',
            'class'             => [5, 29, 32],
            'reminders'         => [1, 3, 4],
            'responsability'    => 'Laura Gómez',
            'channels'          => [1, 2],
            'description'       => 'Lorem Ipsum',
            'attachments'       => [],
            'limit'             => date('Y')."-".((int) date('m') + 1) ."-04 00:00:00",
            'calendar'          => 'Holiday'
        ]
    ];
}

function countries(){
    return [
        (object) [
            'id'    => 1,
            'name'  => 'Colombia',
            'code'  => 'CO'
        ],
        (object) [
            'id'    => 2,
            'name'  => 'Argentina',
            'code'  => 'AR'
        ],
        (object) [
            'id'    => 3,
            'name'  => 'Bolivia',
            'code'  => 'BO'
        ],
        (object) [
            'id'    => 4,
            'name'  => 'Brasil',
            'code'  => 'BR'
        ],
        (object) [
            'id'    => 5,
            'name'  => 'Chile',
            'code'  => 'CL'
        ],
        (object) [
            'id'    => 6,
            'name'  => 'Ecuador',
            'code'  => 'EC'
        ],
        (object) [
            'id'    => 7,
            'name'  => 'Guyana',
            'code'  => 'GY'
        ],
        (object) [
            'id'    => 8,
            'name'  => 'Paraguay',
            'code'  => 'PY'
        ],
        (object) [
            'id'    => 9,
            'name'  => 'Perú',
            'code'  => 'PE'
        ],
        (object) [
            'id'    => 10,
            'name'  => 'Surinam',
            'code'  => 'SR'
        ],
        (object) [
            'id'    => 11,
            'name'  => 'Uruguay',
            'code'  => 'UY'
        ],
        (object) [
            'id'    => 12,
            'name'  => 'Venezuela',
            'code'  => 'VE'
        ]
    ];
}

function modules(){
    return [
        (object) [
            'id'    => 1,
            'name'  => 'Protección'
        ],
        (object) [
            'id'    => 2,
            'name'  => 'Defensa'
        ],
        (object) [
            'id'    => 3,
            'name'  => 'AlertBoard'
        ],
    ];
}

function regulamarks(){
    return [
        (object) [
            'id'            => 1,
            'country_id'    => 1,
            'code'          => 'COL_OPOS_30D',
            'description'   => '',
            'type'          => 'Plazo',
            'entidad'       => 'SIC',
            'origen'        => 'fecha_publicacion_gaceta',
            'plazo'         => '+30 D',
            'modulo'        => 1,
            'state'         => 'Activa'
        ],
        (object) [
            'id'            => 2,
            'country_id'    => 5,
            'code'          => 'CL_VIG_30D',
            'description'   => '',
            'type'          => 'Vigencia',
            'entidad'       => 'OMPI',
            'origen'        => 'fecha_publicacion_gaceta',
            'plazo'         => '+30 D',
            'modulo'        => 3,
            'state'         => 'Inactiva    '
        ]
    ];
}

function regulamarks_history(){
    return [
        (object) [
            'id'        => 1,
            'date'      => date('Y-m-d H:i:s'),
            'ruler'     => 2,
            'country'   => 5,
            'entity'    => 'Expediente',
            'entity_id' => 1,
            'origen'    => '2025-11-01 15:25:21',
            'result'    => '2025-11-18 10:45:03',
            'user'      => 'Wilfredo Daza',
            'procces'   => 'Automatico'
        ],
        (object) [
            'id'        => 2,
            'date'      => date('Y-m-d H:i:s'),
            'ruler'     => 1,
            'country'   => 4,
            'entity'    => 'Expediente',
            'entity_id' => 2,
            'origen'    => '2025-11-01 15:25:21',
            'result'    => '2025-11-18 10:45:03',
            'user'      => 'Wilfredo Daza',
            'procces'   => 'Automatico'
        ],
        (object) [
            'id'        => 3,
            'date'      => date('Y-m-d H:i:s'),
            'ruler'     => 1,
            'country'   => 5,
            'entity'    => 'Expediente',
            'entity_id' => 1,
            'origen'    => '2025-11-01 15:25:21',
            'result'    => '2025-11-18 10:45:03',
            'user'      => 'Wilfredo Daza',
            'procces'   => 'Manual'
        ]
    ];
}

function vigiaMark(){
    return [
        (object) [
            'id'    => 1,
            'name'  => 'Vigia #1',
            'tipo'  => 'Vigilar marca de mi portafolio',
            'ambito'    => 1,
            'state'     => 'Activa',
            'last'      => '2025-10-25 09:00:00',
            'next'      => '2025-11-25 09:00:00',
            'hits'      => [
                (object)  [
                    'id'            => 1,
                    'brand_id'      => 7,
                    'brand'         => array_values(array_filter(getBrands(), function($item) {
                        return $item->id == 7;
                    }))[0] ?? null,

                    'brand_reference_id'    => 15,
                    'brand_reference'       => array_values(array_filter(getBrands(), function($item) {
                        return $item->id == 15;
                    }))[0] ?? null,                    
                    'umbral'        => 0.74,
                    'termino_vigilado'  => 'Vigilar palabra / término',
                    'tipo_similitud'    => 'Figurativa',
                    'niza'              => [15, 25, 33],
                    'ambito'            => array_values(array_filter(countries(), function($item) {
                        return $item->id == 3;
                    }))[0] ?? null,
                    'gaceta'            => array_values(array_filter(getGacetas(), function($item) {
                        return $item->id == 1;
                    }))[0] ?? null,
                    'state'             => 'En oposición'
                ],
                (object)  [
                    'id'            => 2,
                    'brand_id'      => 9,
                    'brand'         => array_values(array_filter(getBrands(), function($item) {
                        return $item->id == 9;
                    }))[0] ?? null,

                    'brand_reference_id'    => 5,
                    'brand_reference'       => array_values(array_filter(getBrands(), function($item) {
                        return $item->id == 5;
                    }))[0] ?? null,                    
                    'umbral'        => 0.45,
                    
                    'termino_vigilado'  => 'Vigilar marcas de un titular',
                    'tipo_similitud'    => 'Semántica',

                    'niza'              => [15, 25, 33],
                    'ambito'            => array_values(array_filter(countries(), function($item) {
                        return $item->id == 1;
                    }))[0] ?? null,
                    'gaceta'            => array_values(array_filter(getGacetas(), function($item) {
                        return $item->id == 1;
                    }))[0] ?? null,
                    'state'             => 'Descartado'
                ],
                (object)  [
                    'id'            => 3,
                    'brand_id'      => 10,
                    'brand'         => array_values(array_filter(getBrands(), function($item) {
                        return $item->id == 10;
                    }))[0] ?? null,

                    'brand_reference_id'    => 2,
                    'brand_reference'       => array_values(array_filter(getBrands(), function($item) {
                        return $item->id == 2;
                    }))[0] ?? null,                    
                    'umbral'        => 0.95,
                    'termino_vigilado'  => 'Vigilar marca de mi portafolio',
                    'tipo_similitud'    => 'Fuzzy',
                    
                    'niza'              => [15, 25, 33],
                    'ambito'            => array_values(array_filter(countries(), function($item) {
                        return $item->id == 6;
                    }))[0] ?? null,
                    'gaceta'            => array_values(array_filter(getGacetas(), function($item) {
                        return $item->id == 1;
                    }))[0] ?? null,
                    'state'             => 'Marcado como relevante'
                ],
                (object)  [
                    'id'            => 4,
                    'brand_id'      => 8,
                    'brand'         => array_values(array_filter(getBrands(), function($item) {
                        return $item->id == 8;
                    }))[0] ?? null,

                    'brand_reference_id'    => 6,
                    'brand_reference'       => array_values(array_filter(getBrands(), function($item) {
                        return $item->id == 6;
                    }))[0] ?? null,                    
                    'umbral'        => 0.94,
                    'termino_vigilado'  => 'Vigilar marca de mi portafolio',
                    'tipo_similitud'    => 'Fonética',
                    'niza'              => [15, 25, 33],
                    'ambito'            => array_values(array_filter(countries(), function($item) {
                        return $item->id == 6;
                    }))[0] ?? null,
                    'gaceta'            => array_values(array_filter(getGacetas(), function($item) {
                        return $item->id == 1;
                    }))[0] ?? null,
                    'state'             => 'Nuevo'
                ]
            ],
            'responsable'   => 'Wilfredo Daza'
        ],
        (object) [
            'id'    => 2,
            'name'  => 'Vigia #2',
            'tipo'  => 'Vigilar palabra / término',
            'ambito'    => 1,
            'state'     => 'En curso',
            'last'      => '2025-10-25 09:00:00',
            'next'      => '2025-11-25 09:00:00',
            'hits'      => [
                // (object)  [
                //     'id'            => 1,
                //     'brand_id'      => 7,
                //     'description'   => 'Coincidencia con la marca <b>Jugos naturales</b>' 
                // ]
            ],
            'responsable'   => 'Wilfredo Daza'
        ],
        (object) [
            'id'    => 3,
            'name'  => 'Vigia #3',
            'tipo'  => 'Vigilar marcas de un titular',
            'ambito'    => 1,
            'state'     => 'Pausado',
            'last'      => '2025-10-25 09:00:00',
            'next'      => '2025-11-25 09:00:00',
            'hits'      => [
                // (object)  [
                //     'id'            => 1,
                //     'brand_id'      => 7,
                //     'description'   => 'Coincidencia con la marca <b>Jugos naturales</b>' 
                // ]
            ],
            'responsable'   => 'Wilfredo Daza'
        ],
        (object) [
            'id'    => 4,
            'name'  => 'Vigia #4',
            'tipo'  => 'Vigilar marcas de un titular',
            'ambito'    => 1,
            'state'     => 'Activa',
            'last'      => '2025-10-25 09:00:00',
            'next'      => '2025-11-25 09:00:00',
            'hits'      => [
                // (object)  [
                //     'id'            => 1,
                //     'brand_id'      => 7,
                //     'description'   => 'Coincidencia con la marca <b>Jugos naturales</b>' 
                // ]
            ],
            'responsable'   => 'Wilfredo Daza'
        ]
    ];
}

function getGacetas(){
    return [
        (object)[
            'id'        => 1,
            'date'      => '2025-10-31',
            'register'  => 867,
            'state'     => 'Correcto',
            'file'      => '1.pdf'
        ],
        (object)[
            'id'        => 2,
            'date'      => '2025-09-30',
            'register'  => 765,
            'state'     => 'Error parcial',
            'file'      => '2.pdf'
        ],
        (object)[
            'id'        => 3,
            'date'      => '2025-08-31',
            'register'  => 689,
            'state'     => 'Error',
            'file'      => '3.pdf'
        ]
    ];
}

function getGrupoDinamico($valor, $p) {
    if ($valor <= $p[25]) return "Grupo 1 (Bajo)";
    if ($valor <= $p[50]) return "Grupo 2 (Medio)";
    if ($valor <= $p[75]) return "Grupo 3 (Alto)";
    // if ($valor <= $p[80]) return "Grupo 4 (Alto)";
    return "Grupo 4 (Muy Alto)";
}

function ajustarColor($percent) {
    $hex = isset(configInfo()['primary_color']) && !empty(configInfo()['primary_color']) ? (string) configInfo()['primary_color'] : '8e24aa';
    // Limpia el "#"
    $hex = str_replace('#', '', $hex);

    // Convierte a RGB
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    // Ajuste: percent puede ser negativo (oscurecer) o positivo (aclarar)
    $r = max(0, min(255, $r + ($r * $percent)));
    $g = max(0, min(255, $g + ($g * $percent)));
    $b = max(0, min(255, $b + ($b * $percent)));

    // Regresar a HEX
    return sprintf("#%02x%02x%02x", $r, $g, $b);
}