<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class termek extends Model
{
    protected $table = "termek";
    public $timestamps = false;
    public $primaryKey = "cikkszam";
}
