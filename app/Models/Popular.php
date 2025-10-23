<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Popular extends Model
{
    use HasFactory;
    protected $table='populars';
    protected $fillable = [
        'name','cover','type','author','filebook'
    ];
}
