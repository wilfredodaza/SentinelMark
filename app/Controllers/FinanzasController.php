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
        $title = 'Finanzas IP';
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

        $this->data->breadcrumbs = [
            (object) ['name'    => 'Home', 'url' => base_url(['dashboard'])],
            (object) ['name'    => $this->data->title],
            (object) ['name'    => 'Panel de costo'],
        ];

        $this->data->sub_title = '<small class="text-muted">| Panel de costo</small>';

        $litigios_registros  = 0;

        $this->data->litigios_registros = (object) [
            'litigios'              => 0,
            'litigios_porcentage'   => 50,
            'registros'             => 0,
            'registros_porcentage'  => 50
        ];

        foreach ($this->registers as $register) {

            // Normalizar amount a número
            $amount = floatval(str_replace(',', '', $register->amount));

            switch ($register->type) {

                case '3':
                    // Suma litigios
                    $this->data->litigios_registros->litigios += $amount;
                    $litigios_registros += $amount;
                    break;

                case '4':
                    // Subtipos que cuentan para registros
                    if (in_array($register->sub_type, ['3', '4'])) {
                        $this->data->litigios_registros->registros += $amount;
                        $litigios_registros += $amount;
                    }
                    break;
            }
        }

        if($litigios_registros > 0){
            $this->data->litigios_registros->litigios_porcentage = round(($this->data->litigios_registros->litigios * 100) / $litigios_registros, 1);
            $this->data->litigios_registros->registros_porcentage = round(($this->data->litigios_registros->registros * 100) / $litigios_registros, 1);
        }



        // return $this->respond($this->data);

        return view('finanzas/index', [
            'data'      => $this->data,
            'registros' => $this->registers
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
