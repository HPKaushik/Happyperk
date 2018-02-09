<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcements extends Model {

    protected $table = 'hp_announcements';
    protected $fillable = ['announcement_id','name', 'description', 'image', 'department_id','status'];

}
