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
            if(isset($type[1])) {
                if ($type[1] == 'hour')
                    $date = date('d/m/Y H:i:s', strtotime($date));
            }
            else
            {
                $date = date('d/m/Y', strtotime($date));
            }
        }
        else if($type[0] == 'ymd')
        {
            if(isset($type[1])) {
                if ($type[1] == 'hour')
                    $date = date('Y/m/d H:i:s', strtotime($date));
            }
            else
            {
                $date = date('Y/m/d', strtotime($date));
            }

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
            else {
                return strtotime($date);
                $date = date('Y-m-d', strtotime($date));
            }
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