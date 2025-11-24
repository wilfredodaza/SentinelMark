<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AlertBoardController extends BaseController
{

    use ResponseTrait;

    public function __construct(){
        helper('info');
        $title = 'AlertBoard';
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
            'start'     => $start = $_GET['start'] ?? 1,
            'page'      => $_GET['page'] ?? ceil(($start - 1) / $length + 1)
        ];
        $this->search = $_GET['search'] ?? [];
    }

    public function index()
    {
        return view('alertboard/index', [
            'data'          => $this->data,
            'tipos'         => getCategoriesDoculaw(),
            'clasesNiza'    => getClasesNiza(),
            'marcas'        => getBrands(),
            'recordatorios' => recordatorios()
        ]);
    }

    public function getAlerts(){
        $total = count(alerts());

        // if (!empty($search)) {
        //     $builder->groupStart();
        //     foreach ($columns as $col) {
        //         $builder->orLike($col, $search);
        //     }
        //     $builder->groupEnd();
        // }

        $filteredData = array_reverse(alerts());
        
        $pagedData = $this->dataTable->length >= 0
            ? array_slice($filteredData, ($this->dataTable->start - 1), $this->dataTable->length)
            : $filteredData;

        foreach ($filteredData as $key => $data) {

            $data->type = array_values(array_filter(getCategoriesDoculaw(), function($item) use ($data) {
                return $item->id == $data->type;
            }))[0] ?? null;

            $data->brand = array_values(array_filter(getBrands(), function($item) use ($data) {
                return $item->id == $data->brand;
            }))[0] ?? null;

            $data->class = array_values(array_filter(getClasesNiza(), function($item) use ($data) {
                return in_array($item->id, $data->class);
            }));

            $data->reminders = array_values(array_filter(recordatorios(), function($item) use ($data) {
                return in_array($item->id, $data->reminders);
            }));

            $data->channels = array_values(array_filter(channels(), function($item) use ($data) {
                return in_array($item->id, $data->channels);
            }));
        }

        $return = (object) [
            'data'              => $filteredData,
            'draw'              => $this->dataTable->draw,
            'recordsTotal'      => $total,
            'recordsFiltered'   => count($filteredData),
            'post'              => $this->dataTable
        ];

        return $this->respond($return);
    }

    public function alerts(){
        $this->data->sub_title= ' <small class="text-muted">| Notificaciones</small>';
        $this->data->breadcrumbs = [
            (object) ['name'    => 'Home', 'url' => base_url(['dashboard'])],
            (object) ['name'    => 'Notificaciones'],
        ];
        $this->data->tablists      = [
            (object) ['id' => 1, 'name' => "Canales", 'icon' => "ri-list-ordered-2"],
            (object) ['id' => 2, 'name' => "Frecuencia", 'icon' => "ri-time-line"],
            (object) ['id' => 3, 'name' => "Registro de envio", 'icon' => "ri-send-plane-fill"],
        ];

        return view('alertboard/notification', [
            'data' => $this->data
        ]);
    }
}
