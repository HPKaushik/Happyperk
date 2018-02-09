<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorporateBankAccount extends Model {

    protected $table = 'hp_corporate_bank_details';
    protected $fillable = ['name', 'account_number', 'ifsc_code', 'bank_name', 'state', 'city', 'branch_name'];

}
