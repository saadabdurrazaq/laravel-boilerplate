<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SequenceGenerator extends Model
{
    use HasFactory;
    protected $fillable = [
        'inv_number',
        'do_number'
    ];
}
