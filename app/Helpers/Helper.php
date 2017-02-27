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
            'lawyer' => 'Advogado',
            'admin' => 'Administrador'
        ];
    }
}

function clientType()
{
    return [
        'company' => 'Empresa',
        'private' => 'Particular'
    ];
}

function clientStatus()
{
    return [
        'effective' => 'Cliente Efetivo',
        'external' => 'Cliente Externo'
    ];
}

/**
 * @param $date
 * @param $type
 * @return false|string
 */
function formatDate($date, $type)
{
    $type = explode(':', $type); // Explode second param ex: formatDate('2016/10/14', 'db:start')
    if($date != null)
    {
        if($type[0] == 'dmy')
        {
            $date = date('d/m/Y', strtotime($date));
        }
        else if($type[0] == 'mdy'){
            $date = date('m/d/Y', strtotime($date));
        }
        else if($type[0] == 'ymd')
        {
            $date = date('Y/m/d', strtotime($date));
        }
        else if($type[0] = 'db')
        {
            if(isset($type[1])) {
                if ($type[1] == 'start')
                    $date = date('Y-m-d', strtotime($date)) . ' 00:00:00';
                else if ($type[1] == 'end') {
                    $date = date('Y-m-d', strtotime($date)) . ' 23:59:59';
                }
            }
            else
                $date = date('Y-m-d', strtotime($date));
        }
    }

    return $date;
}

function getDaysBetweenDates($date)
{
    $now = time(); // or your date as well
    $your_date = strtotime($date);
    $datediff = $your_date - $now;

    return floor($datediff / (60 * 60 * 24));
}

function contracts()
{
    $contract = App::make('SgcAdmin\Http\Controllers\ContractsController');
    return $contract->contracts();
}

function contractsAdded()
{
    $contract = App::make('SgcAdmin\Http\Controllers\ContractsController');
    return $contract->contractsAdded();
}

function clientsAdded()
{
    $contract = App::make('SgcAdmin\Http\Controllers\CustomerController');
    return $contract->clientsAdded();
}