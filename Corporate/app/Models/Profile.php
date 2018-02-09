<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

    protected $table = 'hp_corporate';
    protected $primaryKey = 'corporate_id';
    protected $fillable = ['company_name', 'short_name', 'company_established', 'address', 'domain', 'pan_number', 'description'];

    public function Designations() {
        return $this->belongsToMany('App\Models\Designations', 'hp_corporate_designations_map', 'corporate_id', 'designation_id')->withTimestamps();
    }

}
