<?php

use CodeIgniter\I18n\Time;

function different($data)
{
    $myTime = new Time('now', 'America/Bogota', 'es_CO');
    $time = Time::parse($data, 'America/Bogota', 'es_CO');
    $diff =  $time->difference($myTime, 'America/Bogota');
    return $diff->humanize();
}

function formatDate($fecha){
    $meses = [
        1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
        5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
        9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
    ];
    
    // $fecha = date('Y-m-d'); // "2025-03-11"
    $partes = explode('-', $fecha);
    
    $dia = (int)$partes[2];
    $mes = $meses[(int)$partes[1]];
    $anio = $partes[0];
    
    return "$dia de $mes de $anio";
    
}

function getMonths() {
    $months = [
        1  => ['nombre' => 'Enero',      'short' => 'Ene'],
        2  => ['nombre' => 'Febrero',    'short' => 'Feb'],
        3  => ['nombre' => 'Marzo',      'short' => 'Mar'],
        4  => ['nombre' => 'Abril',      'short' => 'Abr'],
        5  => ['nombre' => 'Mayo',       'short' => 'May'],
        6  => ['nombre' => 'Junio',      'short' => 'Jun'],
        7  => ['nombre' => 'Julio',      'short' => 'Jul'],
        8  => ['nombre' => 'Agosto',     'short' => 'Ago'],
        9  => ['nombre' => 'Septiembre', 'short' => 'Sep'],
        10 => ['nombre' => 'Octubre',    'short' => 'Oct'],
        11 => ['nombre' => 'Noviembre',  'short' => 'Nov'],
        12 => ['nombre' => 'Diciembre',  'short' => 'Dic']
    ];

    // Convertimos el array en objetos
    $objects = [];
    foreach ($months as $num => $info) {
        $obj = (object) [
            'num'    => $num,
            'nombre' => $info['nombre'],
            'short'  => $info['short']
        ];
        $objects[] = $obj;
    }

    return $objects;
}
