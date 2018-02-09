<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Awards extends Model {

    protected $table = 'hp_awards';
    protected $fillable = ['title', 'description','employee', 'status'];

}
