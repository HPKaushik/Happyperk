<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorporateDepartments extends Model {

    protected $table = 'hp_departments';
    protected $fillable = ['department_name', 'department_description'];

}
