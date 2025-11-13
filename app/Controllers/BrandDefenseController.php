<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BrandDefenseController extends BaseController
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

        $title = 'Defensa de Marcas';
        $this->data = (object) [
            'title'         => $title,
            'breadcrumbs'   => [
                (object) ['name'    => 'Home', 'url' => base_url(['dashboard'])],
                (object) ['name'    => $title],
            ]
        ];

        

        $this->registers = getBrandsDefenses();
        $this->clasesNiza = getClasesNiza();
    }

    public function index()
    {
        return view('brand_defense/index', [
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

        foreach ($filteredData as $key => $data) {
            $data->marca = array_values(array_filter(getBrands(), function($item) use ($data) {
                return $item->id == $data->Marca_Referencia;
            }))[0] ?? null;
        }

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

        $detail->marca = array_values(array_filter(getBrands(), function($item) use ($detail) {
            return $item->id == $detail->Marca_Referencia;
        }))[0] ?? null;
        
        $this->data = (object) [
            'title'         => "{$this->data->title}  <span class=\"text-muted ms-1\"><small>| {$detail->marca->nombre_corto}</small></span>",
            'breadcrumbs'   => [
                (object) ['name'    => 'Home', 'url' => base_url(['dashboard'])],
                (object) ['name'    => $this->data->title, 'url' => base_url(['dashboard', 'brand_defense'])],
                (object) ['name'    => $detail->marca->nombre_corto],
            ],
            'tablists'      => [
                (object) ['id' => 1, 'name' => "Resumen general", 'icon' => "ri-file-paper-2-line"],
                (object) ['id' => 2, 'name' => "Requerimiento Recibido", 'icon' => "ri-file-list-3-line"],
                (object) ['id' => 3, 'name' => "Generar respuesta", 'icon' => "ri-file-edit-line"],
                (object) ['id' => 4, 'name' => "Documentos y estado ", 'icon' => "ri-file-copy-2-line"],
                (object) ['id' => 5, 'name' => "Costos & ROI", 'icon' => "ri-currency-line"],
                (object) ['id' => 6, 'name' => "Línea de Tiempo", 'icon' => "ri-git-commit-line"],
            ]
        ];

        return view('brand_defense/detail', [
            'detail'        => $detail,
            'data'          => $this->data,
            'clasesNiza'    => $this->clasesNiza,
            // 'states_companies'   => $this->states_companies,
            // 'states_entities'    =>  $this->states_entities,
            // 'eventos_sic'       => array_reverse($this->eventos_sic)
        ]);
    }
}
