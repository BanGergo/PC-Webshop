<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class billing extends Model
{
    protected $table = 'billing';
    public $primaryKey = 'billing_id';
    public $timestamps = false;
}
