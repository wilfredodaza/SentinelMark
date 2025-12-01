<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use DateTime;

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

    public function report(){

        $this->data->sub_title = '<small class="text-muted"> | Reporte de conflictividad</small>';

        $this->data->breadcrumbs = [
            (object) ['name'    => 'Home', 'url' => base_url(['dashboard'])],
            (object) ['name'    => $this->data->title, 'url' => base_url(['dashboard', 'vigiamarca'])],
            (object) ['name'    => 'Reporte'],
        ];

        $hoy = new DateTime();
        $mesActual  = (int)$hoy->format('n');   // 1–12
        $anioActual = (int)$hoy->format('Y');  // año actual
        $months     = getMonths();
        $clases     = getClasesNiza();

        foreach ($months as $key => $m) {
            $m->hallazgos = random_int(0, 80);
            if ($m->num > $mesActual) {
                $m->year = $anioActual - 1;       // año pasado
            }
            else {
                $m->year = $anioActual;           // mes actual
            }
        }

        usort($months, function($a, $b) {
            // Primero ordenar por año DESC
            if ($a->year !== $b->year) {
                return $a->year - $b->year;
            }
        
            // Luego por número de mes DESC
            return $a->num - $b->num;
        });
        

        $months_chunks = array_chunk($months, ceil(count($months) / 2));
        // $meses  = getMonths();

        $mapheat = [];
        foreach ($clases as $key => $clase) {
            $clase->meses = getMonths();
            $mapheat[] = [
                "name" => $clase->id,
                "data" => []
            ];
            foreach ($clase->meses as $key_2 => $mes) {
                $mes->hallazgos   = random_int(5, 30);
                $mapheat[$key]["data"][] = [
                    "x" => $mes->short,
                    "y" => $mes->hallazgos
                ];
            }
        }

        // var_dump($mapheat); die;

        // 1. Obtener totales
        $totales = [];
        foreach ($clases as $clase) {
            $total = array_sum(array_map(fn($m) => $m->hallazgos, $clase->meses));
            $totales[] = $total;
        }

        // Ordenar para calcular percentiles
        sort($totales);

        // 2. Calcular percentiles para 5 grupos
        $percentiles = [
            25 => $totales[(int)(count($totales) * 0.25)],
            50 => $totales[(int)(count($totales) * 0.50)],
            75 => $totales[(int)(count($totales) * 0.75)],
            // 80 => $totales[(int)(count($totales) * 0.80)],
        ];

        // 4. Construir estructura de grupos
        $treemapGroups = [];

        foreach ($clases as $clase) {

            $totalHallazgos = array_sum(array_map(fn($m) => $m->hallazgos, $clase->meses));
            $grupo = getGrupoDinamico($totalHallazgos, $percentiles);

            if (!isset($treemapGroups[$grupo])) {
                $treemapGroups[$grupo] = [];
            }

            $treemapGroups[$grupo][] = [
                "x" => $clase->id,
                "y" => $totalHallazgos
            ];
        }

        // var_dump($treemapGroups); die;

        // 5. Convertir a formato ApexCharts
        $seriesTreemap = [];

        foreach ($treemapGroups as $grupo => $data) {
            $seriesTreemap[] = [
                "name" => $grupo,
                "data" => $data
            ];
        }

        $porcentajes = [-0.40, -0.20, 0, 0.20, 0.40];
        $coloresGenerados = [];
        foreach ($porcentajes as $p) {
            $coloresGenerados[] = ajustarColor($p);
        }

        // var_dump([$seriesTreemap, $percentiles]); die;

        $brands = getBrands();

        $brands = array_slice($brands, 0, 5);

        foreach ($brands as $key => $b) {
            $b->hallazgos = random_int(5, 30);
        }

        return view('vigiamarca/report', [
            'data'          => $this->data,
            'months_chunks' => $months_chunks,
            'months'        => $months,
            'clases'        => $clases,
            'brands'        => $brands,
            'seriesTreemap' => $seriesTreemap,
            'coloresGenerados' => $coloresGenerados,
            'mapheat'        => $mapheat
        ]);
    }
}
