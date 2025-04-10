<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class guest extends Model
{
    protected $table = 'guest';
    public $primaryKey = 'guest_id';
    public $timestamps = false;
}
