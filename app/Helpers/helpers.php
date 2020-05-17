<?php

use \Carbon\Carbon;

if(!function_exists('to_locale_date')){
    function to_locale_date(string $date): string {
        return Carbon::createFromFormat('Y-m-d', $date)->format('d.m.Y');
    }
}

if(!function_exists('from_locale_date')){
    function from_locale_date(string $date): string {
        return Carbon::createFromFormat('d.m.Y', $date)->format('Y-m-d');
    }
}

if(!function_exists('to_export_list')){
    function to_export_list(array $items){
        return array_map(function($item) {
            return implode('-', $item);
        }, array_values($items));
    }
}
