<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendors extends Model {

    protected $table = 'hp_vendors';
    protected $fillable = ['user_id', 'email', 'name', 'address', 'phone', 'city'];

}
