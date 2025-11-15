<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // SELECT `option`, url, icon, position, type, `references`, status, component, title, description, `table` FROM `menus`

        $menus = [
            array('id' => '1','option' => 'Portafolio de Marcas','url' => '','icon' => 'ri-folders-line','position' => '1','type' => 'primario','references' => '0','status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'table'),
            array('id' => '2','option' => 'Protección de Marcas','url' => '','icon' => 'ri-folder-shield-2-line','position' => '2','type' => 'primario','references' => '0','status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'table'),
            array('id' => '3','option' => 'Defensa de Marcas','url' => '','icon' => 'ri-file-shield-2-line','position' => '3','type' => 'primario','references' => '0','status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'table'),
            array('id' => '4','option' => 'DocuLaw','url' => '','icon' => 'ri-article-line','position' => '4','type' => 'primario','references' => '0','status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'table'),
            array('id' => '5','option' => 'AlertBoard','url' => '','icon' => 'ri-alarm-warning-line','position' => '5','type' => 'primario','references' => '0','status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'table'),
            array('id' => '6','option' => 'RegulaMark','url' => '','icon' => 'ri-pencil-ruler-2-line','position' => '6','type' => 'primario','references' => '0','status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'table'),
            array('id' => '7','option' => 'Finanzas IP','url' => '','icon' => 'ri-money-dollar-circle-line','position' => '8','type' => 'primario','references' => NULL,'status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'table'),
            array('id' => '8','option' => 'Admin & Seguridad','url' => '','icon' => 'ri-shield-user-line','position' => '9','type' => 'primario','references' => NULL,'status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => 'table'),
            array('id' => '9','option' => 'Listado de marcas','url' => 'brand_portfolio','icon' => NULL,'position' => '1','type' => 'secundario','references' => '1','status' => 'active','component' => 'controller','title' => 'Listado de marcas','description' => NULL,'table' => 'users'),
            array('id' => '10','option' => 'Crear  marca nueva','url' => 'users','icon' => NULL,'position' => '2','type' => 'secundario','references' => '1','status' => 'active','component' => 'table','title' => 'Crear nueva marca','description' => NULL,'table' => 'users'),
            array('id' => '11','option' => 'Tablero de Oposiciones','url' => 'trademark_protection','icon' => '1','position' => '1','type' => 'secundario','references' => '2','status' => 'active','component' => 'controller','title' => 'Tablero de oposiciones','description' => NULL,'table' => 'users'),
            array('id' => '12','option' => 'Tablero de requerimientos y recursos','url' => 'brand_defense','icon' => NULL,'position' => '1','type' => 'secundario','references' => '3','status' => 'active','component' => 'controller','title' => NULL,'description' => NULL,'table' => 'users'),
            array('id' => '13','option' => 'Biblioteca de plantillas','url' => 'doculaw/template_library','icon' => NULL,'position' => '1','type' => 'secundario','references' => '4','status' => 'active','component' => 'controller','title' => NULL,'description' => NULL,'table' => 'users'),
            array('id' => '14','option' => 'Generador de documentos','url' => 'doculaw/generate','icon' => NULL,'position' => '1','type' => 'secundario','references' => '4','status' => 'active','component' => 'controller','title' => 'Generador de documentos','description' => NULL,'table' => 'users'),
            array('id' => '15','option' => 'Calendario de plazos','url' => '3','icon' => NULL,'position' => '1','type' => 'secundario','references' => '5','status' => 'active','component' => 'table','title' => 'Calendario de plazos','description' => NULL,'table' => 'users'),
            array('id' => '16','option' => 'Alerta y notificaciones','url' => '4','icon' => NULL,'position' => '2','type' => 'secundario','references' => '5','status' => 'active','component' => 'table','title' => 'Alerta y notificaciones','description' => NULL,'table' => 'users'),
            array('id' => '17','option' => 'Reglas por país','url' => '5','icon' => NULL,'position' => '1','type' => 'secundario','references' => '6','status' => 'active','component' => 'table','title' => 'Reglas por país','description' => NULL,'table' => 'users'),
            array('id' => '18','option' => 'Reglas aplicadas','url' => '6','icon' => NULL,'position' => '1','type' => 'secundario','references' => '6','status' => 'active','component' => 'table','title' => 'Reglas aplicadas','description' => NULL,'table' => 'users'),
            array('id' => '19','option' => 'VigíaMarca','url' => '','icon' => 'ri-eye-2-line','position' => '7','type' => 'primario','references' => NULL,'status' => 'active','component' => 'table','title' => NULL,'description' => NULL,'table' => NULL),
            array('id' => '20','option' => 'Panel de busqueda','url' => '6','icon' => NULL,'position' => '1','type' => 'secundario','references' => '19','status' => 'active','component' => 'table','title' => 'Panel de busqueda de vigilancia','description' => NULL,'table' => 'users'),
            array('id' => '21','option' => 'Reporte de conflictividad','url' => '7','icon' => NULL,'position' => '2','type' => 'secundario','references' => '19','status' => 'active','component' => 'table','title' => 'Reporte de conflictividad','description' => NULL,'table' => 'users'),
            array('id' => '22','option' => 'Panel de costo','url' => '7','icon' => NULL,'position' => '1','type' => 'secundario','references' => '7','status' => 'active','component' => 'table','title' => 'Panel de costos','description' => NULL,'table' => 'users'),
            array('id' => '23','option' => 'Dashboard ROI','url' => '8','icon' => NULL,'position' => '2','type' => 'secundario','references' => '7','status' => 'active','component' => 'table','title' => 'Dashboard ROI','description' => NULL,'table' => 'users'),
            array('id' => '24','option' => 'Users','url' => '9','icon' => NULL,'position' => '1','type' => 'secundario','references' => '8','status' => 'active','component' => 'table','title' => 'Usuarios del sistema','description' => NULL,'table' => 'users'),
            array('id' => '25','option' => 'Organizaciones','url' => '10','icon' => NULL,'position' => '2','type' => 'secundario','references' => '8','status' => 'active','component' => 'table','title' => 'Organizaciones','description' => NULL,'table' => 'users'),
            array('id' => '26','option' => 'Auditoria','url' => 'auditoria','icon' => NULL,'position' => '3','type' => 'secundario','references' => '8','status' => 'active','component' => 'table','title' => 'Auditoria','description' => NULL,'table' => 'audit_log'),
            array('id' => '27','option' => 'Configuracion General','url' => 'sd','icon' => NULL,'position' => '4','type' => 'secundario','references' => '8','status' => 'active','component' => 'table','title' => 'Configuración General','description' => NULL,'table' => 'user')
        ];

        $m_model = new Menu();
        foreach ($menus as $key => $menu) {
            // array_splice($menu, 0, 1);
            $m_model->save($menu);
        }
    }
}
