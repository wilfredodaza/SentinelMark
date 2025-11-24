<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class VigiaMarcaController extends BaseController
{
    use ResponseTrait;

    public function __construct(){
        helper('info');
        $title = 'VigiaMarca';
        $this->data = (object) [
            'title'         => $title,
            'breadcrumbs'   => [
                (object) ['name'    => 'Home', 'url' => base_url(['dashboard'])],
                (object) ['name'    => $title],
            ]
        ];

        $this->dataTable    = (object) [
            'draw'      => $_GET['draw'] ?? 1,
            'length'    => $length = $_GET['length'] ?? 10,
            'start'     => $start = $_GET['start'] ?? 0,
            'page'      => $_GET['page'] ?? ceil(($start - 1) / $length + 1)
        ];
        $this->search = $_GET['search'] ?? [];
        

        $this->registers = vigiaMark();
    }

    public function index()
    {
        $this->data->tablists = [
                (object) ['id' => 1, 'name' => "Busquedas", 'icon' => "ri-menu-search-line"],
                (object) ['id' => 2, 'name' => "Gacetas", 'icon' => "ri-folder-received-line"],
        ];
        return view('vigiamarca/index', [
            'data'          => $this->data,
        ]);
    }

    public function data(){
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

        foreach ($pagedData as $key => $data) {
            $data->country = array_values(array_filter(countries(), function($item) use ($data) {
                return $item->id == $data->ambito;
            }))[0] ?? null;

            // $data->module = array_values(array_filter(modules(), function($item) use ($data) {
            //     return $item->id == $data->modulo;
            // }))[0] ?? null;
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
}
