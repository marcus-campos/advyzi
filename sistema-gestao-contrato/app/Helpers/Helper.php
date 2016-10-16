<?php
/**
 * @author: Marcus Campos - marcus.campos@devyzi.com
 * Date: 16/10/16
 * Time: 14:04
 */

function roles()
{
    if (Auth::user()->role == 'admin'){
        return [
            'salesman' => 'Vendedor',
            'boss' => 'Chefe',
            'admin' => 'Administrador'
        ];
    }
    else
    {
        return [
            'salesman' => 'Vendedor',
            'boss' => 'Chefe'
        ];
    }
}