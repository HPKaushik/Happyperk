<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'hp_employee';
    protected $primaryKey = 'employee_id';
    protected $fillable = ['first_name','last_name','emp_code','department_id','location_id','joining_date','dob'];
}
