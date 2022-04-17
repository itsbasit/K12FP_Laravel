<?php

namespace App\Imports;

use App\Models\admin\States;
use App\Models\admin\Counties;
use App\Models\admin\District;
use App\Models\admin\Schools;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Throwable;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');


class SchoolsDataImport implements ToModel, WithHeadingRow, SkipsOnError
{
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        // dd($row);
        $states =  new States([
            'stateName'=> $row['State'],
        ]);

        $counties =  new Counties([
            'countyName'=> $row['County Name*'],
            'stateName'=> $row['State'],
        ]);

        $district =  new District([
            'districtName'=> $row['District'],
            'countyName'=> $row['County Name*'],
        ]);

        $school =  new Schools([
            'schoolName'=> $row['School Name'],
            'districtName'=> $row['District'],
        ]);

        return [$states,$counties,$district,$school];

        
    }

    public function onError(Throwable $error){}
}
