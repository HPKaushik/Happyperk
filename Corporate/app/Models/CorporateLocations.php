<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorporateLocations extends Model
{
    protected $table = 'hp_corporate_locations';
    protected $fillable = ['location_name', 'pincode', 'address', 'email', 'state', 'city', 'primary_contact','telephone'];
}
