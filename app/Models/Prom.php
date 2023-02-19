<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prom extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'promedio',
        'id_notas',
        'estado'
    ];
}
