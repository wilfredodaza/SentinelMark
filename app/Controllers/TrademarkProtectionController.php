<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TrademarkProtectionController extends BaseController
{

    use ResponseTrait;

    protected $dataTable;
    protected $data;

    protected $registers;

    public function __construct(){

        helper('info');

        $this->dataTable    = (object) [
            'draw'      => $_GET['draw'] ?? 1,
            'length'    => $length = $_GET['length'] ?? 10,
            'start'     => $start = $_GET['start'] ?? 1,
            'page'      => $_GET['page'] ?? ceil(($start - 1) / $length + 1)
        ];
        $this->search = $_GET['search'] ?? [];

        $title = 'Protección de marcas';
        $this->data = (object) [
            'title'         => $title,
            'breadcrumbs'   => [
                (object) ['name'    => 'Home', 'url' => base_url(['dashboard'])],
                (object) ['name'    => $title],
            ]
        ];

        $this->registers = getOppositions();
    }

    public function index()
    {
        return view('trademark_protection/index', [
            'data'          => $this->data
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
            'title'         => "{$this->data->title}  <span class=\"text-muted ms-1\"><small>| {$detail->caso}</small></span>",
            'breadcrumbs'   => [
                (object) ['name'    => 'Home', 'url' => base_url(['dashboard'])],
                (object) ['name'    => $this->data->title, 'url' => base_url(['dashboard', 'trademark_protection'])],
                (object) ['name'    => $detail->caso],
            ],
            'tablists'      => [
                (object) ['id' => 1, 'name' => "Resumen", 'icon' => "ri-file-paper-2-line"],
                (object) ['id' => 2, 'name' => "Matriz de riesgo", 'icon' => "ri-error-warning-line"],
                (object) ['id' => 3, 'name' => "Documentos Adjuntos", 'icon' => "ri-file-copy-2-line"],
                (object) ['id' => 4, 'name' => "Plantillas recomendadas (DocuLaw)", 'icon' => "ri-folder-open-line"],
                (object) ['id' => 5, 'name' => "Historial de Acciones", 'icon' => "ri-hourglass-2-fill"],
            ]
        ];

        return view('trademark_protection/detail', [
            'detail'        => $detail,
            'data'          => $this->data,
            // 'clasesNiza'    => $this->clasesNiza,
            // 'states_companies'   => $this->states_companies,
            // 'states_entities'    =>  $this->states_entities,
            // 'eventos_sic'       => array_reverse($this->eventos_sic)
        ]);
    }
}
