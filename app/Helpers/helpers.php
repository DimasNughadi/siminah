<?php

function isRouteActive($routeName)
{
    return request()->route()->getName() === $routeName;
}

function isAdminKelurahan()
{
    return auth()->check() && auth()->user()->role == 'admin_kelurahan';
}

function isAdminCsr()
{
    return auth()->check() && auth()->user()->role == 'admin_csr';
}

function datetimeFormat($timestamp){
    $data = date('h:i', strtotime($timestamp)). ', ' .date('d M Y', strtotime($timestamp));
    return $data;
}

function dateFormat($timestamp){
    if ($timestamp !== '-') {
        $data = date('d M Y', strtotime($timestamp));
    }else {
        $data = '-';
    }
    return $data;
}

function getFirstName($name) {
    $data = explode(' ', $name);
    return substr($data[0], 0, 7);
}