<?php

use App\Models\Transactions;

function changeDateFormate($date,$date_format){
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);    
}
   
function csvToArray($filename = '', $delimiter = ',')
{
    if (!file_exists($filename) || !is_readable($filename))
        return false;

    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
        {
            if (!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }

    return $data;
}


function getSum($fundraiser = '', $student = '')
{
    if($student == '')
    {
        $total_amount = Transactions::where('fundraiser', $fundraiser)
        ->sum('amount_donated');
    } else {
        $total_amount = Transactions::where('student', $student)
        ->sum('amount_donated');
    }
    return $total_amount;
}