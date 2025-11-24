<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class RegulaMarkController extends BaseController
{
    
    use ResponseTrait;

    public function __construct(){
        helper('info');
        $title = 'RegulaMark';
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

        $this->registers = regulamarks();
        $this->histories = regulamarks_history();
    }

    public function index()
    {
        $this->data->tablists      = [
            (object) ['id' => 1, 'name' => "Reglas por País / Jurisdicción", 'icon' => "ri-global-line"],
            (object) ['id' => 2, 'name' => "Frecuencia", 'icon' => "ri-time-line"],
            (object) ['id' => 3, 'name' => "Registro de envio", 'icon' => "ri-send-plane-fill"],
        ];

        return view('regulamark/index', [
            'data'          => $this->data,
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

        foreach ($pagedData as $key => $data) {
            $data->country = array_values(array_filter(countries(), function($item) use ($data) {
                return $item->id == $data->country_id;
            }))[0] ?? null;

            $data->module = array_values(array_filter(modules(), function($item) use ($data) {
                return $item->id == $data->modulo;
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

    public function history(){
        $this->data->sub_title= ' <small class="text-muted">| Historial</small>';
        $this->data->breadcrumbs = [
            (object) ['name'    => 'Home', 'url' => base_url(['dashboard'])],
            (object) ['name'    => 'Historial'],
        ];

        return view('regulamark/history', [
            'data'          => $this->data,
        ]);
    }

    public function historyData(){
        
        $total = count($this->histories);

        // if (!empty($search)) {
        //     $builder->groupStart();
        //     foreach ($columns as $col) {
        //         $builder->orLike($col, $search);
        //     }
        //     $builder->groupEnd();
        // }

        $filteredData = array_reverse($this->histories);
        
        $pagedData = $this->dataTable->length >= 0
            ? array_slice($filteredData, $this->dataTable->start, $this->dataTable->length)
            : $filteredData;

        foreach ($pagedData as $key => $data) {
            $data->country = array_values(array_filter(countries(), function($item) use ($data) {
                return $item->id == $data->country;
            }))[0] ?? null;
            $data->ruler = array_values(array_filter($this->registers, function($item) use ($data) {
                return $item->id == $data->ruler;
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
}
