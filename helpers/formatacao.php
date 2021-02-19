<?php

if (!function_exists('formatar_cpf')) {

    function formatar_cpf($cpf) {
        return substr($cpf, 0, 3) . "." . substr($cpf, 3, 3) . "." . substr($cpf, 6, 3) . "-" . substr($cpf, 8, 2);
    }
    
}

if (!function_exists('formatar_data')) {

    function formatar_data($data) {
        return substr($data, 8, 2) . "/" . substr($data, 5, 2) . "/" . substr($data, 0, 4);
    }
    
}