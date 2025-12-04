<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class FinanzasController extends BaseController
{
    use ResponseTrait;

    public function __construct(){
        helper('info');
        $title = 'Finanzas';
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
        

        $this->registers = getCosts();
    }

    public function index()
    {
        return view('finanzas/index', [
            'data'  => $this->data
        ]);
    }

    public function getData(){
        $total = count($this->registers);

        $filteredData = array_reverse($this->registers);
        
        $pagedData = $this->dataTable->length >= 0
            ? array_slice($filteredData, $this->dataTable->start, $this->dataTable->length)
            : $filteredData;

        foreach ($pagedData as $key => $data) {
            $data->brand = array_values(array_filter(getBrands(), function($item) use ($data) {
                return $item->id == $data->brand_id;
            }))[0] ?? null;

            $data->country = array_values(array_filter(countries(), function($item) use ($data) {
                return $item->id == $data->country_id;
            }))[0] ?? null;

            $data->module = array_values(array_filter(modules(), function($item) use ($data) {
                return $item->id == $data->origen;
            }))[0] ?? null;
            
            $data->type = array_values(array_filter(typeCosts(), function($item) use ($data) {
                return $item->id == $data->type;
            }))[0] ?? null;

            $data->sub_type = array_values(array_filter(subtype(), function($item) use ($data) {
                return $item->id == $data->sub_type;
            }))[0] ?? null;

            $data->state = array_values(array_filter(state_costs(), function($item) use ($data) {
                return $item->id == $data->state;
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

    public function roi(){

        $this->data->sub_title = '<small class="text-muted">| ROI</small>';

        return view('finanzas/roi', [
            'data'  => $this->data
        ]);
    }
}
