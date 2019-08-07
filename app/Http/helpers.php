<?php

if (! function_exists('icon_status')) {

    function icon_status(int $status)
    {
        $icon = $status == 1
                ? ['icon' => 'check', 'color' => 'text-success']
                : ['icon' => 'times', 'color' => 'text-danger'];

        echo vsprintf('<i class="fa fa-%s %s"></i>', $icon);
    }
}

if (! function_exists('uploads_path')) {

    function uploads_path(string $path = '')
    {
        return asset('storage/' . $path);
    }
}

if (! function_exists('public_storage_path')) {

    function public_storage_path(string $path = '')
    {
        return public_path('storage/' . $path);
    }
}

if (! function_exists('get_type_ticket')) {

    function get_type_ticket(int $key = null)
    {
        $typeList = [
            1 => 'Incidente',
            2 => 'Requisição',
        ];

        return $key ? $typeList[$key] : $typeList;
    }
}

if (! function_exists('get_priority_ticket')) {

    function get_priority_ticket(int $key = null)
    {
        $priorityList = [
            1 => 'Muito Alta',
            2 => 'Alta',
            3 => 'Média',
            4 => 'Baixa',
            5 => 'Muito Baixa',
        ];

        return $key ? $priorityList[$key] : $priorityList;
    }
}

if (! function_exists('get_status_ticket')) {

    function get_status_ticket(int $key = null)
    {
        $statusList = [
            1 => 'Novo',
            2 => 'Em Andamento',
            3 => 'Pendente',
            4 => 'Solucionado',
            5 => 'Fechado',
        ];

        return $key ? $statusList[$key] : $statusList;
    }
}

if (! function_exists('format_ticket_id')) {

    function format_ticket_id(int $id)
    {
        return '#' . str_pad($id, 6, 0, STR_PAD_LEFT);
    }
}

if (! function_exists('get_color_ticket')) {

    function get_color_ticket(int $status)
    {
        $colorList = [
            1 => 'info',
            2 => 'primary',
            3 => 'warning',
            4 => 'success',
            5 => 'dark',
        ];
        
        return $colorList[$status];
    }
}

if (! function_exists('calc_percentage')) {

    function calc_percentage($value, $total = 0)
    {
        return $total == 0 ? 0 : round(($value / $total) * 100, 2);
    }
}

if (! function_exists('date_db')) {

    function date_db($date)
    {
        return implode('-', array_reverse(explode('/', $date)));
    }
}