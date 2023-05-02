<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class EmployeeImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


   

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        return new Employee([
            'employee_id'     => $row[0],
            'name'    => $row[1], 
            'email'    => $row[2], 
            'phone'    => $row[3], 
            'doj'    => $row[4], 
            'gender'    => $row[5], 
            'salary'    => $row[6], 
            
        ]);
    }
}
