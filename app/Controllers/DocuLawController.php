<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use cogpowered\FineDiff\Diff;
use cogpowered\FineDiff\Render\Html;

use SebastianBergmann\Diff\Differ;
use SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder;

class DocuLawController extends BaseController
{
    use ResponseTrait;

    public function __construct(){

        helper('info');

        $this->dataTable    = (object) [
            'draw'      => $_GET['draw'] ?? 1,
            'length'    => $length = $_GET['length'] ?? 10,
            'start'     => $start = $_GET['start'] ?? 1,
            'page'      => $_GET['page'] ?? ceil(($start - 1) / $length + 1)
        ];
        $this->search = $_GET['search'] ?? [];

        $title = 'DocuLaw';
        $this->data = (object) [
            'title'         => $title,
            'breadcrumbs'   => [
                (object) ['name'    => 'Home', 'url' => base_url(['dashboard'])],
                (object) ['name'    => $title],
            ]
        ];
    }
    
    public function index_template_library()
    {
        $this->data->sub_title= ' <small class="text-muted">| Biblioteca de plantillas</small>';
        $this->data->breadcrumbs = [
            (object) ['name'    => 'Home', 'url' => base_url(['dashboard'])],
            (object) ['name'    => 'DocuLaw'],
            (object) ['name'    => 'Biblioteca de plantillas'],
        ];
        $this->data->tablists = getCategoriesDoculaw();

        foreach ($this->data->tablists  as $key => $tablists) {
            // var_dump($tablists); die;
            foreach ($tablists->templates as $key => $templates) {
                foreach ($templates->history as $key => $history) {

                    // $differ = new Differ("");
                    // $diff = $differ->diff($history->value_old, $history->value_new);

                    // // 3. Filtrar solo líneas válidas
                    // $lines = explode("\n", $diff);
                    // $clean = [];

                    // foreach ($lines as $line) {

                    //     $trim = ltrim($line);

                    //     // Mantener líneas válidas
                    //     if (
                    //         preg_match('/^\+/', $trim) ||              // líneas agregadas
                    //         (preg_match('/^\-/', $trim) && !preg_match('/^\-+$/', $trim)) || // líneas eliminadas
                    //         preg_match('/^\-+$/', trim($line))         // separadores -----
                    //     ) {
                    //         $clean[] = $line;
                    //     }
                    // }

                    // // Unir nuevamente
                    // $diffHTML = implode("\n", $clean);

                    // // 4. Convertir a HTML
                    // $diffHTML = nl2br(htmlentities($diffHTML));

                    // // 5. Pintar en rojo (sin tocar -----)
                    // $diffHTML = preg_replace(
                    //     '/^-\s*(?!-+$)(.*)$/m',
                    //     '<span class="text-red red lighten-5">-$1</span>',
                    //     $diffHTML
                    // );

                    // // 6. Pintar en verde
                    // $diffHTML = preg_replace(
                    //     '/^\+\s*(.*)$/m',
                    //     '<span class="text-green green lighten-5">+$1</span>',
                    //     $diffHTML
                    // );

                    // // 7. Quitar <br> inicial si existe
                    // $diffHTML = preg_replace('/^<br\s*\/>?/i', '', $diffHTML, 1);

                    // $history->diff = $diffHTML;

                    // $diff = new Diff;
                    // $render = new Html;
                    // $opcodes = $diff->getOpcodes($history->value_old, $history->value_new);
                    // $history->diff = $render->process($history->value_old, $opcodes);
                }
            }
        }

        return view('doculaw/template_library/index', [
            'data'  => $this->data
        ]);
    }

    public function view_versions($id){

        $detail = null;
        foreach (getCategoriesDoculaw() as $category) {
            foreach ($category->templates as $template) {
                if ($template->id == $id) {
                    $detail = $template; // ← Plantilla encontrada
                    break;
                }
            }
        }

        foreach ($detail->history as $key => $history) {
            $differ = new Differ("");
            $diff = $differ->diff($history->value_old, $history->value_new);

            // 3. Filtrar solo líneas válidas
            $lines = explode("\n", $diff);
            $clean = [];

            foreach ($lines as $line) {

                $trim = ltrim($line);

                // Mantener líneas válidas
                if (
                    preg_match('/^\+/', $trim) ||              // líneas agregadas
                    (preg_match('/^\-/', $trim) && !preg_match('/^\-+$/', $trim)) || // líneas eliminadas
                    preg_match('/^\-+$/', trim($line))         // separadores -----
                ) {
                    $clean[] = $line;
                }
            }

            // Unir nuevamente
            $diffHTML = implode("\n", $clean);

            // 4. Convertir a HTML
            $diffHTML = nl2br(htmlentities($diffHTML));

            // 5. Pintar en rojo (sin tocar -----)
            $diffHTML = preg_replace(
                '/^-\s*(?!-+$)(.*)$/m',
                '<span class="text-red red lighten-5">-$1</span>',
                $diffHTML
            );

            // 6. Pintar en verde
            $diffHTML = preg_replace(
                '/^\+\s*(.*)$/m',
                '<span class="text-green green lighten-5">+$1</span>',
                $diffHTML
            );

            // 7. Quitar <br> inicial si existe
            $diffHTML = preg_replace('/^<br\s*\/?>/i', '', $diffHTML, 1);

            $history->diff = $diffHTML;
        }

        // var_dump([$history->diff]); die;


        $this->data->sub_title= ' <small class="text-muted">| '.$detail->title.' / versiones</small>';
        $this->data->breadcrumbs = [
            (object) ['name'    => 'Home', 'url' => base_url(['dashboard'])],
            (object) ['name'    => 'Biblioteca Plantillas', 'url' => base_url(['dashboard/doculaw/template_library'])],
            (object) ['name'    => 'Versiones'],
        ];

        

        return view('doculaw/template_library/versions', [
            'detail'    => $detail,
            'data'      => $this->data
        ]);
    }

    // Generar Documento

    public function index_generate(){
        $this->data->sub_title= ' <small class="text-muted">| Documentos</small>';
        $this->data->breadcrumbs = [
            (object) ['name'    => 'Home', 'url' => base_url(['dashboard'])],
            (object) ['name'    => 'DocuLaw'],
            (object) ['name'    => 'Documentos'],
        ];

        $brands = getBrands();
        $categories = getCategoriesDoculaw();

        // // Primero quitamos los templates vacíos
        // foreach ($categories as &$cat) {
        //     if (isset($cat->templates)) {
        //         $cat->templates = array_values(array_filter($cat->templates, function($tpl){
        //             return isset($tpl->text) && trim($tpl->text) !== '';
        //         }));
        //     }
        // }
        // unset($cat);

        // Ahora quitamos categorías sin templates
        $categories = array_values(array_filter($categories, function($cat){
            return isset($cat->templates) && count($cat->templates) > 0;
        }));

        return view('doculaw/generate/index', [
            'data'          => $this->data,
            'brands'        => $brands,
            'categories'    => $categories
        ]);
    }

    public function generate_data(){
        
        $documents = getDocuLaws();
        $total = count($documents);
        $filteredData = array_reverse($documents);
        
        $pagedData = $this->dataTable->length >= 0
            ? array_slice($filteredData, $this->dataTable->start, $this->dataTable->length)
            : $filteredData;

        foreach ($filteredData as $key => $data) {
            $data->brand = array_values(array_filter(getBrandsDefenses(), function($item) use ($data) {
                return $item->id == $data->brand;
            }))[0] ?? null;

            $data->marca = array_values(array_filter(getBrands(), function($item) use ($data) {
                return $item->id == $data->brand->Marca_Referencia;
            }))[0] ?? null;

            foreach (getCategoriesDoculaw() as $category) {
                foreach ($category->templates as $template) {
                    if ($template->id == $data->template_id) {
                        $data->category = $category; // ← Plantilla encontrada
                        $data->template = $template; // ← Plantilla encontrada
                        break;
                    }
                }
            }
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
