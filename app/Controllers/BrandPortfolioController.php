<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BrandPortfolioController extends BaseController
{

    use ResponseTrait;

    protected $dataTable;
    protected $data;
    protected $registers;
    protected $clasesNiza;
    protected $search;
    protected $eventos_sic;

    public function __construct(){

        helper('info');

        $this->dataTable    = (object) [
            'draw'      => $_GET['draw'] ?? 1,
            'length'    => $length = $_GET['length'] ?? 10,
            'start'     => $start = $_GET['start'] ?? 1,
            'page'      => $_GET['page'] ?? ceil(($start - 1) / $length + 1)
        ];
        $this->search = $_GET['search'] ?? [];

        $title = 'Portafolio de Marcas';
        $this->data = (object) [
            'title'         => $title,
            'breadcrumbs'   => [
                (object) ['name'    => 'Home', 'url' => base_url(['dashboard'])],
                (object) ['name'    => $title],
            ]
        ];

        $this->registers = getBrands();

        $icons = ['<i class="fa-duotone fa-light fa-circle-d"></i>', '<i class="fa-duotone fa-solid fa-images"></i>', '<i class="fa-duotone fa-light fa-circle-m"></i>'];
        $types = ['Denominativa', 'Figurativa', 'Mixta'];

        $this->states_companies = [
            (object)['id' => 1, 'title' => 'Activa', 'description' => 'La empresa está operando normalmente.'],
            (object)['id' => 2, 'title' => 'Inactiva', 'description' => 'La empresa está registrada pero no realiza operaciones.'],
            (object)['id' => 3, 'title' => 'Suspendida', 'description' => 'La empresa fue suspendida temporalmente.'],
            (object)['id' => 4, 'title' => 'En liquidación', 'description' => 'En proceso de liquidar sus activos.'],
            // (object)['id' => 5, 'title' => 'Disuelta', 'description' => 'La empresa fue cerrada oficialmente.'],
            // (object)['id' => 6, 'title' => 'Bloqueada', 'description' => 'Acceso bloqueado por incumplimiento o revisión.'],
            // (object)['id' => 7, 'title' => 'Pendiente de aprobación', 'description' => 'Esperando validación o aprobación administrativa.'],
            // (object)['id' => 8, 'title' => 'Eliminada', 'description' => 'Marcada como eliminada, pero conservada para registro histórico.']
        ];

        $this->states_entities = [
            (object)['id' => 1, 'title' => 'Presentada', 'description' => 'La empresa está operando normalmente.'],
            (object)['id' => 2, 'title' => 'Publicada', 'description' => 'La empresa está registrada pero no realiza operaciones.'],
            (object)['id' => 3, 'title' => 'Registrada', 'description' => 'La empresa fue suspendida temporalmente.']
        ];

        $this->clasesNiza = getClasesNiza();

        $this->eventos_sic = [
            (object)[
                'fecha' => '2025-09-30',
                'tipo' => 'Creación',
                'descripcion' => 'Radicación inicial de la solicitud de marca “CAFÉ DEL HUILA” ante la SIC.',
                'usuario' => 'William Bonilla',
                'documento' => 'https://sic.gov.co/expedientes/solicitud-2025-091.pdf',
                'color' => 'azul',
                'tiempo' => '<small class="text-muted">hace 30 días</small>'
            ],
            (object)[
                'fecha' => '2025-10-03',
                'tipo' => 'Requerimiento',
                'descripcion' => 'La SIC solicita aclaración sobre el tipo de producto declarado en la solicitud.',
                'usuario' => 'Analista SIC - División Signos Distintivos',
                'documento' => 'https://sic.gov.co/expedientes/requerimiento-2025-091.pdf',
                'color' => 'rojo',
                'tiempo' => '<small class="text-muted">hace 27 días</small>'
            ],
            (object)[
                'fecha' => '2025-10-06',
                'tipo' => 'Aprobación',
                'descripcion' => 'Se aprueba el examen de forma tras la respuesta al requerimiento.',
                'usuario' => 'Revisor jurídico SIC',
                'documento' => 'https://sic.gov.co/expedientes/aprobacion-forma-2025-091.pdf',
                'color' => 'verde',
                'tiempo' => '<small class="text-muted">hace 24 días</small>'
            ],
            (object)[
                'fecha' => '2025-10-10',
                'tipo' => 'Publicación',
                'descripcion' => 'Publicación del extracto en la Gaceta de Propiedad Industrial No. 2041.',
                'usuario' => 'Sistema SIC',
                'documento' => 'https://sic.gov.co/gaceta/2041.pdf',
                'color' => 'verde',
                'tiempo' => '<small class="text-muted">hace 20 días</small>'
            ],
            (object)[
                'fecha' => '2025-10-14',
                'tipo' => 'Alerta',
                'descripcion' => 'Inicio del periodo de oposiciones (30 días hábiles).',
                'usuario' => 'Sistema automático SIC',
                'documento' => 'https://sic.gov.co/expedientes/alerta-oposicion-2025-091.pdf',
                'color' => 'naranja',
                'tiempo' => '<small class="text-muted">hace 16 días</small>'
            ],
            (object)[
                'fecha' => '2025-10-20',
                'tipo' => 'Requerimiento',
                'descripcion' => 'Se recibe oposición por parte de la empresa “Café Andino S.A.S.”.',
                'usuario' => 'Abogado SIC - Signos Distintivos',
                'documento' => 'https://sic.gov.co/expedientes/oposicion-2025-091.pdf',
                'color' => 'rojo',
                'tiempo' => '<small class="text-muted">hace 10 días</small>'
            ],
            (object)[
                'fecha' => '2025-10-26',
                'tipo' => 'Aprobación',
                'descripcion' => 'Resolución favorable al solicitante tras revisar la oposición presentada.',
                'usuario' => 'Dirección de Signos Distintivos',
                'documento' => 'https://sic.gov.co/expedientes/resolucion-favorable-2025-091.pdf',
                'color' => 'verde',
                'tiempo' => '<small class="text-muted">hace 4 días</small>'
            ],
            (object)[
                'fecha' => '2025-10-31',
                'tipo' => 'Registro',
                'descripcion' => 'Emisión del certificado de registro de marca “CAFÉ DEL HUILA”.',
                'usuario' => 'Superintendencia de Industria y Comercio',
                'documento' => 'https://sic.gov.co/expedientes/certificado-2025-091.pdf',
                'color' => 'verde',
                'tiempo' => '<small class="text-muted">hoy</small>'
            ]
        ];
    }

    public function index()
    {
        return view('brand_portfolio/index', [
            'data'          => $this->data,
            'clasesNiza'    => $this->clasesNiza
        ]);
    }

    public function getData(){
        $total = count($this->registers);

        // if (!empty($search)) {
        //     $builder->groupStart();
        //     foreach ($columns as $col) {
        //         $builder->orLike($col, $search);
        //     }
        //     $builder->groupEnd();
        // }

        $filteredData = array_reverse($this->registers);
        
        $pagedData = $this->dataTable->length >= 0
            ? array_slice($filteredData, $this->dataTable->start, $this->dataTable->length)
            : $filteredData;

        $return = (object) [
            'data'              => $pagedData,
            'draw'              => $this->dataTable->draw,
            'recordsTotal'      => $total,
            'recordsFiltered'   => count($filteredData),
            'post'              => $this->dataTable
        ];

        return $this->respond($return);
    }

    public function detail($id){

        $detail = array_values(array_filter($this->registers, function($item) use ($id) {
            return $item->id == $id;
        }))[0] ?? null;
        
        $this->data = (object) [
            'title'         => "{$this->data->title}  <span class=\"text-muted ms-1\"><small>| {$detail->Marca}</small></span>",
            'breadcrumbs'   => [
                (object) ['name'    => 'Home', 'url' => base_url(['dashboard'])],
                (object) ['name'    => $this->data->title, 'url' => base_url(['dashboard', 'brand_portfolio'])],
                (object) ['name'    => $detail->nombre_corto],
            ],
            'tablists'      => [
                (object) ['id' => 1, 'name' => "Resumen general", 'icon' => "ri-file-paper-2-line"],
                (object) ['id' => 2, 'name' => "Clases Niza", 'icon' => "ri-file-list-3-line"],
                (object) ['id' => 3, 'name' => "Titular y Agente", 'icon' => "ri-user-2-line"],
                (object) ['id' => 4, 'name' => "Documentos Vinculados", 'icon' => "ri-file-copy-2-line"],
                (object) ['id' => 5, 'name' => "Evidencias y Pruebas de Uso", 'icon' => "ri-folder-shield-line"],
                (object) ['id' => 6, 'name' => "Costos & ROI", 'icon' => "ri-currency-line"],
                (object) ['id' => 7, 'name' => "Flujo de Disclosure", 'icon' => "ri-flow-chart"],
                (object) ['id' => 8, 'name' => "Línea de Tiempo", 'icon' => "ri-git-commit-line"],
            ]
        ];

        return view('brand_portfolio/detail', [
            'detail'        => $detail,
            'data'          => $this->data,
            'clasesNiza'    => $this->clasesNiza,
            'states_companies'   => $this->states_companies,
            'states_entities'    =>  $this->states_entities,
            'eventos_sic'       => array_reverse($this->eventos_sic)
        ]);
    }
}
